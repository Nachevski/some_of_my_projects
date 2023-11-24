<?php
require_once("./App/importAll.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['bookID'])) {
    $requestedBook = requestBookByID($_GET['bookID']);
}

$comments = getCommentsByBookID($_GET['bookID']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brainster Library</title>
    <link rel="stylesheet" href="App/Styles/style.css">

</head>
<body class="dark-theme">
<nav class="main-nav justiify-content-between">
    <div class="title-logo">
        <a href="./index.php">Brainster Library</a>
    </div>
    <div class="loginStatus">
        <?= getLoginInfo() ?>
    </div>
</nav>


<div class="w-65">
    <div class="book-description d-flex justify-content-center flex-1">
        <div class="cover">
            <img src="<?= $requestedBook['imgURL'] ?>" onerror="this.src='./App/Imgs/errorImg.jpg';" alt="">
        </div>
        <div class="description flex-auto">
            <h2 id="title"><?= $requestedBook['title'] ?></h2>

            <?php
            if (!$requestedBook['author_isDeleted']) {
                $author = $requestedBook['authorFirstName'] . ' ' . $requestedBook['authorLastName'];
            } else {
                $author = 'No author data found in database!';
            }
            ?>
            <h3>Author: <span><?= $author ?></span></h3>
            <h3>Published on: <span><?= $requestedBook['releaseYear'] ?></span></h3>
            <h3>Book Pages: <span><?= $requestedBook['pages'] ?></span></h3>
            <!--            <h3>Description: <span>--><?php //= $requestedBook['shortBiography'] ?><!--</span></h3>-->
            <?php
            if (!$requestedBook['category_isDeleted']) {
                $category = $requestedBook['categoryName'];
            } else {
                $category = 'No category selected for this book!';
            }
            ?>
            <h3>Category Name: <span><?= $category ?></span></h3>
            <div class="action-btns d-flex justiify-content-between mt-30">
                <div class="commentBtns">

                    <button class="btn btn-edit mb-10 BTN-ShowComments">Show comments</button>
                    <?php
                    $hasCommented = false;
                    if (isset($_SESSION['loggedUser'])) {
                        foreach ($comments as $comment) {
                            if ($comment['username'] == $_SESSION['loggedUser']) {
                                $hasCommented = true;
                                break;
                            }
                        }
                        if ($hasCommented) {
                            echo '<p class="commentInfo">**You already leaved comment for this book!</p>';
                        } else {
                            echo '<button id="BTN-newComment" type="button" class="btn btn-edit mr-10">Leave comment</button>';
                        }
                    }
                    ?>
                </div>
                <div class="personalNotes">
                    <?php
                    if (isset($_SESSION['loggedUser'])) : ?>
                        <button id="BTN-MyNotes" class="btn btn-approve">Show
                            Notes
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
    <section id="comments" class=" d-flex">

    </section>
</div>

<footer class="text-center abs-bottom">
    <div class="w-80">
        <p id="quote"></p>
    </div>
</footer>


<div id="commentsWindow" class="hide pos-fixed abs-full d-flex align-items-center justify-content-center">
    <div class="ModalWindowForm p-25 ">
        <h2>Showing comments for: <span><?= $requestedBook['title'] ?></span></h2>
        <div class="comments-container overflow-auto hideScrollbar">
            <?php if (!empty($comments)) : foreach ($comments as $comment) : ?>
                <?php if (isset($_SESSION['loggedUser']) && $comment['username'] != $_SESSION['loggedUser'] && $comment['is_approved'] == 0) continue ?>
                <div class="comment">
                    <div class="userInfo d-flex justiify-content-between mb-10">
                        <p><span id="commentUser">Posted by: <?= $comment['username'] ?></span></p>
                        <p class="text-right"><span class="timeCreated"><?= $comment['dateCreated'] ?></span></p>
                    </div>
                    <div class="commentPost">
                        <p><?= $comment['comment'] ?></p>
                    </div>
                    <?php
                    if (isset($_SESSION['loggedUser']) && $comment['username'] == $_SESSION['loggedUser']) {
                        echo "<form action='App/Processing/deleteComment.php' method='POST' class='m-0 text-right'>
                                 <input type='text' value='" . $comment['commentID'] . "' name='commentID' hidden>
                                 <input type='text' value='../bookInfo.php?bookID=" . $_GET['bookID'] . "' name='callFrom' hidden>
                                 <button type='submit' class='BTN-DeleteComment btn btn-danger'>Delete My Comment</button>
                                </form>";
                    }
                    ?>
                </div>
            <?php endforeach; ?>
            <?php else: ?>
                <div class="d-flex justify-content-center align-items-center h-100 bg-black">
                    <h2>No comments found for this book!</h2>
                </div>
            <?php endif; ?>
        </div>
        <div class="p-15 text-right">
            <button class="btn btn-danger btnCancel">Cancel</button>
        </div>
    </div>
</div>

<div id="newCommentWindow" class="pos-fixed abs-full d-flex align-items-center justify-content-center hide">
    <div class="ModalWindowForm p-15">
        <h2 class="text-center">Create New Comment</h2>
        <div class="d-flex">
            <form action="App/Processing/createNewComment.php" method="POST" id="createCommentForm"
                  class="flex-50  d-flex flex-column justiify-content-between">
                <div class="form-container">

                    <div class="form-group d-flex flex-column">
                        <label for="createComment">Comment</label>
                        <textarea id="createComment" name="comment" cols="50"
                                  rows="10"
                        "></textarea>
                    </div>
                    <input type="text" value="<?= ($_GET['bookID'] ?? '') ?>" name="bookID" hidden="">
                    <input type="text" value="bookInfo.php?bookID=<?= $_GET['bookID'] ?>" name="callFrom" hidden="">

                </div>
                <div class="form-group d-flex justify-content-center">
                    <button type="submit" class="btn btn-approve mr-20">Submit Comment</button>
                    <div class="btn btn-danger btnCancel">Cancel</div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="myNotes" class="hide pos-fixed abs-full d-flex align-items-center justify-content-center">
    <div class="ModalWindowForm p-25 ">
        <div class="d-flex justiify-content-between mb-20">
            <h2 class="m-0">My notes</span></h2>
            <button id="BTN-AddNewNote" class=" btn btn-approve">Add New</button>
        </div>

        <div class="comments-container overflow-auto hideScrollbar">

        </div>

        <div class="p-15 text-right">
            <button class="btn btn-danger btnCancel">Cancel</button>
        </div>
    </div>
</div>

<!--NEW NOTE-->
<div id="newNote" class="pos-fixed abs-full d-flex align-items-center justify-content-center hide">
    <div class="ModalWindowForm p-15">
        <h2 class="text-center">Create new note</h2>
        <div class="d-flex">
            <form action="" method="" id="createNewNote"
                  class="flex-50  d-flex flex-column justiify-content-between">
                <div class="form-container">

                    <div class="form-group d-flex flex-column">
                        <textarea id="createNote" name="createNote" cols="50"
                                  rows="10"
                        "></textarea>
                    </div>
                    <input id="activeBookID" type="text" value="<?= ($_GET['bookID'] ?? '') ?>" name="bookID" hidden="">
                </div>
                <div class="form-group d-flex justify-content-center">
                    <button type="submit" class="btn btn-approve mr-20">Submit Comment</button>
                    <div class="btn btn-danger btnCloseNewNote">Cancel</div>
                </div>
            </form>
        </div>
    </div>
</div>

<!--EDIT NOTE-->
<div id="EditNote" class="pos-fixed abs-full d-flex align-items-center justify-content-center hide">
    <div class="ModalWindowForm p-15">
        <h2 class="text-center">Edit Note</h2>
        <div class="d-flex">
            <form action="" method="" id="EditNoteForm"
                  class="flex-50  d-flex flex-column justiify-content-between">
                <div class="form-container">

                    <div class="form-group d-flex flex-column">
                        <textarea id="editNote" name="editNote" cols="50"
                                  rows="10"
                        "></textarea>
                    </div>
                    <input id="selectedNoteID" type="text" value="" name="noteID" hidden="">
                </div>
                <div class="form-group d-flex justify-content-center">
                    <button type="submit" class="btn btn-approve mr-20">Submit Comment</button>
                    <div class="btn btn-danger btnCloseNewNote">Cancel</div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="loginWindow" class="pos-fixed abs-full d-flex align-items-center justify-content-center hide">
    <div class="ModalWindowForm overflow-auto">
        <div class="loginOptions d-flex justify-content-center text-center">
            <div class="login btn flex-50 active">Login</div>
            <div class="signup btn flex-50 ">SignUp</div>
        </div>
        <div class="w-100">
            <form action="./App/Processing/login.php" method="POST" id="loginForm"
                  class="flex-50  d-flex flex-column justiify-content-between">
                <div class="form-container">
                    <div class="form-group flex-column">
                        <label for="username">Username</label>
                        <input type="text" class="username" name="username" value="">
                    </div>
                    <div class="form-group flex-column">
                        <label for="password">Password</label>
                        <input type="password" class="password" name="password" value=""
                               placeholder="At least 8 chars (1 UPPER, 1 lower, 1 number)">
                    </div>
                </div>
                <div class="form-group d-flex justify-content-center">
                    <button type="submit" class="btn btn-approve mr-20">Login</button>
                    <div class="btn btn-danger btnCancel">Cancel</div>
                </div>
            </form>

            <form action="./App/Processing/signup.php" method="POST" id="signupForm"
                  class="d-flex flex-column justiify-content-between hide">
                <div class="form-container">
                    <div class="form-group d-flex flex-column">
                        <label for="firstName">First Name</label>
                        <input type="text" class="firstName" name="firstName" value="">
                    </div>
                    <div class="form-group d-flex flex-column">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="lastName" name="lastName" value="">
                    </div>
                    <div class="form-group d-flex flex-column">
                        <label for="username">Username</label>
                        <input type="text" class="username" name="username" value="">
                    </div>
                    <div class="form-group d-flex flex-column">
                        <label for="password">Password</label>
                        <input type="password" class="password" name="password" value="">
                    </div>
                </div>
                <div class="form-group d-flex justify-content-center">
                    <button type="submit" class="btn btn-approve mr-20">SignUp</button>
                    <div class="btn btn-danger btnCancel">Cancel</div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="App/Script/sweetalert2.all.js"></script>
<script src="App/Script/sweetAlert.js"></script>
<script src="App/Script/main.js"></script>
</body>
</html>
