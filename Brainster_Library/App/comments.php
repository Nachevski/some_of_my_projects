<?php
require_once("./importAll.php");

if (!isAdmin()) {
    header('LOCATION: ../index.php');
}

$searchStatus = false;
$search = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['search'])) {
    $keyword = $_POST['search'];
    $searchResults = search($keyword, 'comments');
    $books = $searchResults['books'] ?? [];
    $comments = $searchResults['comments'] ?? [];
    $searchStatus = true;
} else {
    $books = updateBooks();
    $comments = updateComments();
}
$authors = updateAuthors();
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
                <div class="dashboard-link">
                    <i class="fa-solid fa-list-check"></i>
                    <span>Dashboard</span>
                </div>
            </a>

            <a href="./commentsReview.php">
                <div class="dashboardHome dashboard-link pos-rel">
                    <i class="fa-regular fa-bell "></i>
                    <span>Unpublished comments:</span>
                    <small class="notifications pos-abs text-center"><?= count($commentsForApprove) ?></small>
                </div>
            </a>

            <hr>

            <a href="./books.php">
                <div class="dashboardHome dashboard-link ">
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
                <div class="dashboardHome dashboard-link active">
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
                                    <h2>Total comments:</h2>
                                </div>
                                <h3 id="totalCommentsCounter"><?= (count($comments) - count($commentsForApprove)) ?></h3>
                            </div>
                            <div class="options d-flex mt-10 p-15 border-default mb-10">
                                <div class="results text-left">
                                    <?php
                                    if ($searchStatus && !empty($searchResults)) {
                                        echo "<p class='m-0'>Showing results for: " . $keyword . "</p>
                                              <p>Search returned: " . count($books) . " books and " . countApprovedComments($comments) . " authors</p>";
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
                                               placeholder="Search by book or username">
                                        <button type="submit" class="btn btn-approve">Search</button>
                                    </form>
                                </div>
                            </div>
                            <?php foreach ($books as $book) : ?>
                                <?php if (countCommentsByBookID($comments, $book->getBookID()) == 0) continue ?>
                                <div class="group d-flex border-default mb-10">
                                    <div class="bookIMG mr-20">
                                        <h2 class="mb-10"><?= $book->getTitle() ?></h2>
                                        <img src="<?= $book->getImgURL() ?>" alt="">
                                    </div>
                                    <div class="table-data hideScrollbar">
                                        <div class="table">
                                            <table class="table w-100 text-left">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Posted by:</th>
                                                    <th scope="col">Comment</th>
                                                    <th scope="col">Date Created</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($comments as $index => $comment) : ?>
                                                    <?php if (!$comment->isApproved() || $comment->getBookID() != $book->getBookID()) continue ?>
                                                    <tr class="inputRow">
                                                        <td class="counterCell"></td>
                                                        <td class="forBook hide"><?= getBookByID($books, $comment->getBookID())->getTitle() ?></td>
                                                        <td class="postedBy"><?= getUserByID($users, $comment->getUserID())->getUsername() ?></td>
                                                        <td class="postedComment"><?= $comment->getComment() ?></td>
                                                        <td class="postedOn"><?= $comment->getDateCreated() ?></td>
                                                        <td class="d-flex">
                                                            <div class="btn btn-edit BTN-CommentEdit mr-10"
                                                                 id="<?= $index ?>"
                                                                 data-id="<?= $comment->getCommentID() ?>">
                                                                Modify
                                                            </div>
                                                            <form action=" Processing/deleteComment.php" method="POST">
                                                                <input type="text"
                                                                       value="<?= $comment->getCommentID() ?>"
                                                                       name="commentID" hidden="">
                                                                <input type="text" value="comments.php"
                                                                       name="callFrom" hidden>
                                                                <button type="submit"
                                                                        class="BTN-DeleteComment btn btn-danger">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
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

<div id="editWindow" class="pos-fixed abs-full d-flex align-items-center justify-content-center hide">
    <div class="ModalWindowForm p-15">
        <h2>Edit comment</h2>
        <div class="d-flex">
            <form action="Processing/approveComment.php" method="POST" id="modifyCommentForm"
                  class="flex-50 d-flex flex-column justiify-content-between">
                <div class="form-container">
                    <div class="form-group d-flex flex-column">
                        <label>Book name: </label>
                        <input type="text" name="bookName" id="bookName" disabled>
                    </div>
                    <div class="form-group d-flex flex-column">
                        <label>Posted by: </label>
                        <input type="text" id="userName" name="userName" disabled>
                    </div>
                    <div class="form-group d-flex flex-column">
                        <label>Comment: </label>
                        <textarea id="newComment" name="newComment" cols="50" rows="10"></textarea>
                    </div>
                    <div class="form-group d-flex flex-column">
                        <label>Date Created: </label>
                        <input type="text" id="dateCreated" name="dateCreated" disabled>
                    </div>
                    <input id="commentForApprove" name="commentID" type="text" hidden="">
                    <input type="text" value="comments" name="callFrom" hidden>

                    <div class="form-group d-flex justify-content-center">
                        <button id="btnSubmit" type="submit" class="btn btn-approve mr-20">Save</button>
                        <div class="btn btn-danger btnCancel">Cancel</div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


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
                            <input type="text" value="comments" name="callFrom" hidden>
                            <button type="submit" class="btn btn-approve">Approve</button>
                        </form>
                        <form action="Processing/declineComment.php" method="POST">
                            <input type="text" value="<?= $commentID ?>" name="commentID" hidden>
                            <input type="text" value="comments" name="callFrom" hidden>
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
<script src="./Script/sweetalert2.all.js"></script>
<script src="./Script/sweetAlert.js"></script>
<script src="./Script/main.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>
</html>
