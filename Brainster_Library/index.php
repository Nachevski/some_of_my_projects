<?php
require_once("./App/importAll.php");

$books = updateBooks();
$authors = updateAuthors();
$categories = updateCategories();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brainster Library</title>
    <link rel="stylesheet" href="./App/Styles/style.css">

</head>
<body class="dark-theme">

<nav class="main-nav pos-abs abs-top justiify-content-between">
    <div class="title-logo">
        <a href="">Brainster Library</a>
    </div>
    <div class="loginStatus">
        <?= getLoginInfo() ?>
    </div>
</nav>

<section class="cover-img">
    <header class="text-center">
        <h1 id="main-header" class="text-center">Welcome to Brainster Library!</h1>
        <a href="#books" class="btn btn-orange">View All books</a>
    </header>
</section>

<main>
    <div class="w-80">
        <div id="books" class="section d-flex">
            <aside id="">
                <h4 class="filter-title">Filters</h4><br>
                <div id="categories" class="d-flex flex-column">
                    <label for="cat0">
                        <input type="checkbox" id="cat0" class="categoryOption mr-10"
                               data-categoryname="noCategory">No category</label>

                    <?php foreach ($categories as $index => $category) : ?>
                        <?php $categoryName = $category->getCategoryName() ?>
                        <label for="cat<?= ++$index ?>">
                            <input type="checkbox" id="cat<?= $index ?>" class="categoryOption mr-10"
                                   data-categoryname="<?= $categoryName ?>"><?= $categoryName ?></label>
                    <?php endforeach; ?>
            </aside>

            <div class="ml-30 trim-margin d-flex flex-wrap flex-auto">

                <?php foreach ($books as $book) : ?>
                    <?php
                    $categoryValidate = getCategoryByID($categories, $book->getCategoryID());
                    $categoryName = ($categoryValidate) ? $categoryValidate->getCategoryName() : 'noCategory'
                    ?>
                    <div class="card-container flex-25 mb-30"
                         data-category="<?= $categoryName ?>">
                        <div class="h-100 mr-30">
                            <div class="card">
                                <a href="bookInfo.php?bookID=<?= $book->getBookID() ?>">
                                    <div class="h-100 pos-rel d-flex flex-column">
                                        <div class="book-img side front-side">
                                            <img src="<?= $book->getImgURL() ?>" onerror="this.src='./App/Imgs/errorImg.jpg';" alt="">
                                        </div>
                                        <div class="book-description description bg-default h-100 d-flew-100 w-100  pos-abs x flex-column justify-content-between side back-side">
                                            <h2 class="book-title"><?= $book->getTitle() ?></h2>

                                            <?php
                                            $authorValidate = getAuthorByID($authors, $book->getAuthorID());
                                            ?>
                                            <h3>Author:
                                                <span><?= ($authorValidate) ? $authorValidate->getFullName() : 'Author data missing!' ?></span>
                                            </h3>
                                            <h3>Published on: <span><?= $book->getReleaseYear() ?></span></h3>
                                            <h3>Pages: <span><?= $book->getPages() ?></span></h3>
                                            <h3>Category Name: <span><?= $categoryName ?></span></h3>

                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>

<footer class="text-center abs-bottom">
    <div class="w-80">
        <p id="quote"></p>
    </div>
</footer>

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
<script src="./App/Script/main.js"></script>
</body>
</html>
