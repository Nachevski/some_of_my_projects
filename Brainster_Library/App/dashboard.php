<?php
require_once("./importAll.php");
if (!isAdmin()) {
    header('LOCATION: ../index.php');
}
$books = updateBooks();
$authors = updateAuthors();
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


    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="./Styles/style.css">
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
                <div class="dashboard-link active">
                    <i class="fa-solid fa-list-check"></i>
                    <span>Dashboard</span>
                </div>
            </a>

            <a href="./commentsReview.php">
                <div class="dashboard-link pos-rel ">
                    <i class="fa-regular fa-bell "></i>
                    <span>Unpublished comments:</span>
                    <small class="notifications pos-abs text-center"><?= count($commentsForApprove) ?></small>
                </div>
            </a>

            <hr>

            <a href="./books.php">
                <div class="dashboard-link ">
                    <i class="fa-solid fa-book"></i>
                    <span>Books</span>
                </div>
            </a>

            <a href="./authors.php">
                <div class="dashboard-link">
                    <i class="fa-solid fa-user-pen"></i>
                    <span>Authors</span>
                </div>
            </a>

            <a href="./categories.php">
                <div class="dashboard-link">
                    <i class="fa-solid fa-code-branch fa-rotate-90"></i>
                    <span>Categories</span>
                </div>
            </a>

            <a href="./comments.php">
                <div class="dashboard-link">
                    <i class="fa-solid fa-comments"></i>
                    <span>Comments</span>
                </div>
            </a>

            <hr>

            <a href="./Processing/logout.php">
                <div class="dashboard-link">
                    <i class="fa-solid fa-person-walking-arrow-right"></i>
                    <span>LogOut</span>
                </div>
            </a>

        </div>
        <div class="dashboard-stats">
            <div class="cards d-flex flex-wrap trim-margin">


                <div class="card-container height-limit  flex-50  mb-20 d-flex text-center">
                    <div class="car mr-20 h-100 w-100">
                        <div class="dashboardCards border-default h-100 d-flex flex-column">
                            <div class="dashboard-card d-flex justiify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-book mr-10"></i>
                                    <h2>Total books:</h2>
                                </div>
                                <h3 id="totalBooksCounter"><?= count($books) ?></h3>
                            </div>
                            <div class="table overflow-auto hideScrollbar">
                                <table class="w-100 text-left">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Book Name</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Pages</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($books as $book) : ?>
                                        <?php
                                        $authorValidate = getAuthorByID($authors, $book->getAuthorID());
                                        ?>
                                        <tr>
                                            <td class="counterCell"></td>
                                            <td><?= $book->getTitle() ?></td>
                                            <td><?= ($authorValidate) ? $authorValidate->getFullName() : 'Author data missing!' ?>
                                            </td>
                                            <td><?= $book->getPages() ?></td>
                                        </tr>
                                    <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card-container height-limit  flex-50  mb-20 d-flex text-center">
                    <div class="car mr-20 h-100 w-100">
                        <div class="dashboardCards border-default h-100 d-flex flex-column">
                            <div class="dashboard-card d-flex justiify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-user-pen mr-10"></i>
                                    <h2>Total book authors:</h2>
                                </div>
                                <h3 id="totalBookAuthorsCounter"><?= count(getActiveData($authors)) ?></h3>
                            </div>
                            <div class="table overflow-auto hideScrollbar">
                                <table class="w-100 text-left">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Number of books</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($authors as $author) : ?>
                                        <?php if ($author->IsDeleted()) continue ?>
                                        <tr>
                                            <td class="counterCell"></td>
                                            <td><?= $author->getFirstName() ?></td>
                                            <td><?= $author->getLastName() ?></td>
                                            <td><?= count(getBooksByAuthor($books, $author->getID())) ?></td>
                                        </tr>
                                    <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card-container height-limit  flex-50  mb-20 d-flex text-center">
                    <div class="car mr-20 h-100 w-100">
                        <div class="dashboardCards border-default h-100 d-flex flex-column">
                            <div class="dashboard-card d-flex justiify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-code-branch fa-rotate-90 mr-10"></i>
                                    <h2>Total book categories:</h2>
                                </div>
                                <h3 id="totalBookCategoriesCounter"><?= count(getActiveData($categories)) ?></h3>
                            </div>
                            <div class="table overflow-auto hideScrollbar">
                                <table class="w-100 text-left">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Number of books</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($categories as $category) : ?>
                                        <!--                                        --><?php //if ($category->IsDeleted()) continue ?>
                                        <tr>
                                            <td class="counterCell"></td>
                                            <td><?= $category->getCategoryName() ?></td>
                                            <td><?= count(getBooksByCategory($books, $category->getCategoryID())) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card-container height-limit  flex-50  mb-20 d-flex text-center">
                    <div class="car mr-20 h-100 w-100">
                        <div class="dashboardCards border-default h-100 d-flex flex-column">
                            <div class="dashboard-card d-flex justiify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-comments mr-10"></i>
                                    <h2>Total comments:</h2>
                                </div>
                                <h3 id="totalCommentsCounter"><?= count($comments) - count($commentsForApprove) ?></h3>
                            </div>
                            <div class="table overflow-auto hideScrollbar">
                                <table class="w-100 text-left">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Book Name</th>
                                        <th scope="col">Posted by:</th>
                                        <th scope="col">Comment</th>
                                        <th scope="col">Date Created</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($comments as $comment) : ?>
                                        <?php if (!$comment->isApproved()) continue ?>

                                        <tr>
                                            <td class="counterCell"></td>
                                            <td><?= getBookByID($books, $comment->getBookID())->getTitle() ?></td>
                                            <td><?= getUserByID($users, $comment->getUserID())->getUsername() ?></td>
                                            <td><?= $comment->getComment() ?></td>
                                            <td><?= $comment->getDateCreated() ?></td>
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
</main>

<footer class="text-center abs-bottom">
    <div class="w-80">
        <p id="quote"></p>
    </div>
</footer>


<div id="notificationWindow" class="invisible hideScrollbar">
    <div class="d-flex flex-column">
        <?php if ((count($commentsForApprove) - count($declinedComments)) > 0) : ?>
            <?php foreach ($commentsForApprove as $comment) : ?>
                <?php if ($comment->isDeclined()) continue ?>
                <?php $commentID = $comment->getCommentID() ?>
                <div class="notification p-15 ">
                    <div class="description mb-10">
                        <h3>Comment for: <span><?= getBookByID($books, $comment->getBookID())->getTitle() ?></span></h3>
                        <h3>Posted by: <span><?= getUserByID($users, $comment->getUserID())->getUsername() ?></span></h3>
                        <h3>Comment: <span><?= $comment->getComment() ?></span></h3>
                        <h3>Posted Date: <span><?= $comment->getDateCreated() ?></span></h3>
                    </div>
                    <div class="action-buttons d-flex">
                        <form action="Processing/approveComment.php" method="POST" class="mr-20">
                            <input type="text" value="<?= $commentID ?>" name="commentID" hidden>
                            <input type="text" value="dashboard" name="callFrom" hidden>
                            <button type="submit" class="btn btn-approve">Approve</button>
                        </form>
                        <form action="Processing/declineComment.php" method="POST">
                            <input type="text" value="<?= $commentID ?>" name="commentID" hidden>
                            <input type="text" value="dashboard" name="callFrom" hidden>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="./Script/main.js"></script>
</body>
</html>
