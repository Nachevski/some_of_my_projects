<?php

require_once("./importAll.php");

if (!isAdmin()) {
    header('LOCATION: ../index.php');
}


$searchStatus = false;
$search = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['search'])) {
    $keyword = $_POST['search'];
    $searchResults = search($keyword, 'books');
    $books = $searchResults ['books'] ?? [];
    $authors = $searchResults['authors'] ?? [];
    $searchStatus = true;
} else {
    $books = updateBooks();
    $authors = updateAuthors();
}
$comments = updateComments();
$categories = updateCategories();
$users = updateUsers();
$commentsForApprove = unApprovedComments($comments);
$declinedComments = declinedComments($comments);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brainster Library</title>

    <link rel="stylesheet" href="./Styles/style.css">
    <link rel="stylesheet" href="./Styles/sweetalert2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
          integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body class="dark-theme">
<nav class="main-nav justiify-content-between">
    <div class="title-logo">
        <a href="../index.php">Brainster Library</a>
    </div>
    <div class="login-info d-flex align-items-center">
        <span class="loggedUser">Hello, <?= $_SESSION['loggedUser'] ?></span>
        <i id="notificationIcon" class="fa-regular fa-bell pos-rel dashboard-icon mr-10">
            <small class="notifications pos-abs text-center"><?= count($commentsForApprove) - count($declinedComments) ?></small>
        </i>
    </div>
</nav>

<main class="border-top">
    <div class="d-flex ">
        <div class="dashboard-links">

            <a href="../index.php">
                <div class="dashboard-link ">
                    <i class="fa-solid fa-house"></i>
                    <span>Home</span>
                </div>
            </a>
            <a href="./dashboard.php">
                <div class="dashboard-link">
                    <i class="fa-solid fa-list-check"></i>
                    <span>Dashboard</span>
                </div>
            </a>

            <a href="./commentsReview.php">
                <div class="dashboardHome dashboard-link pos-rel ">
                    <i class="fa-regular fa-bell "></i>
                    <span>Unpublished comments:</span>
                    <small class="notifications pos-abs text-center"><?= count($commentsForApprove) ?></small>
                </div>
            </a>

            <hr>

            <a href="./books.php">
                <div class="dashboardHome dashboard-link active">
                    <i class="fa-solid fa-book"></i>
                    <span>Books</span>
                </div>
            </a>

            <a href="./authors.php">
                <div class="dashboardHome dashboard-link">
                    <i class="fa-solid fa-user-pen"></i>
                    <span>Authors</span>
                </div>
            </a>

            <a href="./categories.php">
                <div class="dashboardHome dashboard-link">
                    <i class="fa-solid fa-code-branch fa-rotate-90"></i>
                    <span>Categories</span>
                </div>
            </a>

            <a href="./comments.php">
                <div class="dashboardHome dashboard-link">
                    <i class="fa-solid fa-comments"></i>
                    <span>Comments</span>
                </div>
            </a>

            <hr>

            <a href="./Processing/logout.php">
                <div class="dashboardHome dashboard-link">
                    <i class="fa-solid fa-person-walking-arrow-right"></i>
                    <span>LogOut</span>
                </div>
            </a>

        </div>
        <div class="dashboard-stats">
            <div class="cards d-flex flex-column trim-margin">
                <div class="card-container flex-50  mb-20 d-flex text-center">
                    <div class="car mr-20 h-100 w-100">
                        <div class="dashboardCards h-100 d-flex flex-column">
                            <div class="dashboard-card d-flex justiify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-comments mr-10"></i>
                                    <h2>Total Books:</h2>
                                </div>
                                <h3 id="totalCommentsCounter"><?= is_array($books) ? count($books) : '0' ?></h3>
                            </div>
                            <div class="options d-flex mt-10 p-15 border-default mb-10">
                                <div class="results text-left">
                                    <?php
                                    if ($searchStatus && !empty($searchResults)) {
                                        echo "<p class='m-0'>Showing results for: " . $keyword . "</p>
                                              <p>Search returned: " . count($books) . " books and " . count($authors) . " authors</p>";
                                    } else if (isset($searchResults) && empty($searchResults)) {
                                        echo "<p class='m-0'>NO results found for: " . $keyword . "</p>";
                                    } else {
                                        echo "<p class='m-0 invisible'></p>";
                                    }
                                    ?>

                                </div>
                                <div class="searchBar">
                                    <form action="" method="POST" class="m-0">
                                        <input type="text" id="searchBox" name="search"
                                               placeholder="Search by book or author">
                                        <input type="submit" class="btn btn-approve">
                                    </form>
                                </div>
                            </div>
                            <div class="d-flex border-default border-radius-15 p-20 mb-10 flex-column">
                                <div class="newBook mb-20 self-end">
                                    <button id="BTN-NewBook" class=" btn btn-approve">Add New Book</button>
                                </div>
                                <div class="flex-100">

                                    <div class="table">
                                        <table class="table w-100 text-left">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Cover Image</th>
                                                <th scope="col">Book Name:</th>
                                                <th scope="col">Author</th>
                                                <th scope="col">Release Year</th>
                                                <th scope="col">Pages</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($books as $index => $book) : ?>
                                                <tr class="inputRow" id="comment<?= $index ?>"
                                                    data-id="<?= $book->getBookID() ?>">
                                                    <td class="counterCell"></td>
                                                    <td class="coverImage">
                                                        <img src="<?= $book->getImgURL() ?>" onerror="this.src='./Imgs/errorLoad.jpg';" alt="">
                                                    </td>
                                                    <td class="nameOfBook"><?= $book->getTitle() ?></td>
                                                    <?php
                                                    $authorValidate = getAuthorByID($authors, $book->getAuthorID());
                                                    ?>
                                                    <td class="authorOfBook"><?= ($authorValidate) ? $authorValidate->getFullName() : 'Author data missing!' ?></td>
                                                    <td class="bookReleaseYear"><?= $book->getReleaseYear() ?></td>
                                                    <td class="booksPages"><?= $book->getPages() ?></td>
                                                    <?php
                                                    $categoryValidate = getCategoryByID($categories, $book->getCategoryID());
                                                    ?>
                                                    <td class="bookCategoryName"><?= ($categoryValidate) ? $categoryValidate->getCategoryName() : 'noCategory' ?></td>
                                                    <td>
                                                        <div class="actions d-flex">
                                                            <div class="btn btn-edit mr-10 BTN-ModifyBook"
                                                                 data-id="<?= $book->getBookID() ?>"
                                                                 id="<?= $index ?>">
                                                                Modify
                                                            </div>

                                                            <form action="Processing/deleteBook.php" method="POST"
                                                                  class="mr-10">
                                                                <input type="text"
                                                                       value="<?= $book->getBookID() ?>"
                                                                       name="commentID" hidden="">
                                                                <input type="text" value="books"
                                                                       name="callFrom" hidden>
                                                                <button class="BTN-DeleteBook btn btn-danger"
                                                                        type="submit">Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<footer class="text-center abs-bottom">
    <div class="w-80">
        <p id="quote"></p>
    </div>
</footer>

<!--WHEN SEARCH IS ACTIVE CAUSING ERRORS, BUTTONS NOT WORKS.
MODALS NEEDS TO FULLY UPDATE DATA-->
<?php
if (isset($searchStatus)) {
    $books = updateBooks();
    $authors = updateAuthors();
    $comments = updateComments();
    $categories = updateCategories();
    $users = updateUsers();
}
?>

<div id="notificationWindow" class="invisible hideScrollbar">
    <div class="d-flex flex-column">
        <?php if ((count($commentsForApprove) - count($declinedComments)) > 0) : ?>
            <?php foreach ($commentsForApprove as $comment) : ?>
                <?php if ($comment->isDeclined()) continue ?>
                <?php $commentID = $comment->getCommentID() ?>
                <div class="notification p-15 ">
                    <div class="description mb-10">
                        <h3>Comment for: <span><?= getBookByID($books, $comment->getBookID())->getTitle() ?></span>
                        </h3>
                        <h3>Posted by: <span><?= getUserByID($users, $comment->getUserID())->getUsername() ?></span></h3>
                        <h3>Comment: <span><?= $comment->getComment() ?></span></h3>
                        <h3>Posted Date: <span><?= $comment->getDateCreated() ?></span></h3>
                    </div>
                    <div class="action-buttons d-flex">
                        <form action="Processing/approveComment.php" method="POST" class="mr-20">
                            <input type="text" value="<?= $commentID ?>" name="commentID" hidden>
                            <input type="text" value="books" name="callFrom" hidden>
                            <button type="submit" class="btn btn-approve">Approve</button>
                        </form>
                        <form action="Processing/declineComment.php" method="POST">
                            <input type="text" value="<?= $commentID ?>" name="commentID" hidden>
                            <input type="text" value="books" name="callFrom" hidden>
                            <button type="submit" class="btn btn-danger">Decline</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="notification p-15 ">
                <div class="description mb-10 text-center">
                    <h3>No new comments posted :)</h3>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<div id="editWindow" class="pos-fixed abs-full d-flex align-items-center justify-content-center hide">
    <div class="ModalWindowForm p-15">
        <h2>Modify Book</h2>
        <div class="d-flex">
            <div class="mr-30">
                <img class="bookCoverIMG"
                     src="./Imgs/ImgPrev.jpg"
                     alt="">
            </div>
            <form action="./Processing/editBook.php" method="POST" id="modifyBookForm"
                  class="flex-50  d-flex flex-column justiify-content-between">
                <div class="form-container">
                    <div class="form-group d-flex flex-column">
                        <label for="bookName">Book Name</label>
                        <input type="text" class="bookName" name="bookName" value="">
                    </div>

                    <div class="form-group d-flex flex-column">
                        <label for="bookImageURL">Book image URL</label>
                        <textarea name="bookImageURL" class="bookImageURL" cols="30" rows="3"
                        "></textarea>
                    </div>
                    <div class="form-group d-flex flex-column">
                        <label for="authorID">Book Author</label>
                        <select name="authorID" class="authorID">
                        </select>
                    </div>
                    <div class="form-group d-flex flex-column">
                        <label for="bookReleaseYear">Release Year</label>
                        <input type="number" class="bookReleaseYear" name="bookReleaseYear"
                               value="">
                    </div>
                    <div class="form-group d-flex flex-column">
                        <label for="bookPages">Book Pages:</label>
                        <input type="number" class="bookPages" name="bookPages"
                               value="">
                    </div>
                    <div class="form-group d-flex flex-column mb-30">
                        <label for="bookCategory">Book Category</label>
                        <select name="bookCategory" class="bookCategory">
                        </select>
                    </div>
                    <input class="selectedBookID" type="text" name="bookID" value="" hidden="">
                </div>
                <div class="form-group d-flex justify-content-center">
                    <button type="submit" class="btn btn-approve mr-20">Save Changes</button>
                    <div class="btn btn-danger btnCancel">Cancel</div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="newBookWindow" class="pos-fixed abs-full d-flex align-items-center justify-content-center hide">
    <div class="ModalWindowForm p-15">
        <h2>Add New Book</h2>
        <div class="d-flex">
            <div class=" mr-30">
                <img class="bookCoverIMG"
                     src="./Imgs/ImgPrev.jpg"
                     alt="">
            </div>
            <form action="./Processing/addNewBook.php" method="POST" id="newBookForm"
                  class="flex-50  d-flex flex-column justiify-content-between">
                <div class="">
                    <div class="form-group d-flex flex-column">
                        <label for="bookName">Book Name</label>
                        <input type="text" class="bookName" name="bookName" value="">
                    </div>

                    <div class="form-group d-flex flex-column">
                        <label for="bookImageURL">Book image URL</label>
                        <textarea name="bookImageURL" class="bookImageURL" cols="30" rows="3"
                        "></textarea>
                    </div>
                    <div class="form-group d-flex flex-column">
                        <label for="authorID">Book Author</label>
                        <select name="authorID" class="authorID">
                            <option name="author_id" value="0">Please Select</option>

                            <?php foreach ($authors as $author) : ?>
                                echo `
                                <option name="author_id"
                                        value="<?= $author->getID() ?>"><?= $author->getFullName() ?>
                                </option>`
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group d-flex flex-column">
                        <label for="bookReleaseYear">Release Year</label>
                        <input type="number" class="bookReleaseYear" name="bookReleaseYear"
                               value="">
                    </div>
                    <div class="form-group d-flex flex-column">
                        <label for="bookPages">Book Pages:</label>
                        <input type="number" class="bookPages" name="bookPages"
                               value="">
                    </div>
                    <div class="form-group d-flex flex-column mb-30">
                        <label for="bookCategory">Book Category</label>
                        <select name="bookCategory" class="bookCategory">
                            <option name="category_id" value="0">Please Select</option>
                            <?php foreach ($categories as $category) : ?>
                                echo `
                                <option name="category_id"
                                        value="<?= $category->getCategoryID() ?>"><?= $category->getCategoryName() ?>
                                </option>`
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group d-flex justify-content-center">
                    <button type="submit" class="btn btn-approve mr-20">Add New Book</button>
                    <div class="btn btn-danger btnCancel">Cancel</div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="./Script/sweetalert2.all.js"></script>
<script src="./Script/main.js"></script>
<script src="./Script/sweetAlert.js"></script>
</body>
</html>


