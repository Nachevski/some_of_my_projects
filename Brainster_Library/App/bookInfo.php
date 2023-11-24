<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brainster Library</title>
    <link rel="stylesheet" href="./Styles/style.css">

</head>
<body class="dark-theme">
<nav class="main-nav justiify-content-between">
    <div class="title-logo">
        <a href="">Brainster Library</a>
    </div>
    <div class="login-btns">
        <span class="loggedUser">Logged As: </span>

        <!--        <a href="./signup.php" class="btn btn-blue mr-10">Sign Up</a>-->
        <a href="Processing/login.php" class="btn btn-orange">Log In</a>
    </div>
</nav>

<div class="wraper">
    <section>
        <div class="book-description info d-flex justify-content-center">
            <div class="cover">
                <img src="./Imgs/books/1.jpg" alt="">
            </div>
            <div class="description">
                <h2 id="title">The King of Drugs</h2>
                <h3>Author: <span>Vladimir Nachevski</span></h3>
                <h3>Published on: <span>21.02.1895</span></h3>
                <h3>Pages: <span>565</span></h3>
                <h3>Description: <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nemo eius ut praesentium similique aspernatur, quaerat, sequi, perferendis quos optio hic quo tenetur itaque ad vitae?</span>
                </h3>
            </div>

        </div>
    </section>

    <section id="comments" class=" d-flex">
        <div class="newComment cover">
            <h3>Leave comment</h3>
            <form action="" id="newCommentForm">
                <input type="text" name="username">
                <textarea name="" id="" cols="30" rows="10"></textarea>
                <button type="submit" class="btn">Submit Comment</button>
            </form>
        </div>
        <div class="actualComments">
            <h3>Comments</h3>
            <div class="comments-container">
                <div class="comment">
                    <div class="userInfo d-flex justiify-content-between">
                        <p><span id="commentUser">User: Vladimir Nachevski</span></p>
                        <p class="text-right"><span class="timeCreated">Time created: 22:04:06</span></p>
                    </div>
                    <p id="commentText">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt dignissimos
                        eius
                        fugiat
                        fugit officia velit!</p>
                </div>

                <div class="comment">
                    <div class="userInfo d-flex justiify-content-between">
                        <p><span id="commentUser">User: Vladimir Nachevski</span></p>
                        <p class="text-right"><span class="timeCreated">Time created: 22:04:06</span></p>
                    </div>
                    <p id="commentText">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt dignissimos
                        eius
                        fugiat
                        fugit officia velit!</p>
                </div>

                <div class="comment">
                    <div class="userInfo d-flex justiify-content-between">
                        <p><span id="commentUser">User: Vladimir Nachevski</span></p>
                        <p class="text-right"><span class="timeCreated">Time created: 22:04:06</span></p>
                    </div>
                    <p id="commentText">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt dignissimos
                        eius
                        fugiat
                        fugit officia velit!</p>
                </div>
                <div class="comment">
                    <div class="userInfo d-flex justiify-content-between">
                        <p><span id="commentUser">User: Vladimir Nachevski</span></p>
                        <p class="text-right"><span class="timeCreated">Time created: 22:04:06</span></p>
                    </div>
                    <p id="commentText">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt dignissimos
                        eius
                        fugiat
                        fugit officia velit!</p>
                </div>
                <div class="comment">
                    <div class="userInfo d-flex justiify-content-between">
                        <p><span id="commentUser">User: Vladimir Nachevski</span></p>
                        <p class="text-right"><span class="timeCreated">Time created: 22:04:06</span></p>
                    </div>
                    <p id="commentText">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt dignissimos
                        eius
                        fugiat
                        fugit officia velit!</p>
                </div>
            </div>
        </div>
    </section>
</div>


<footer class="text-center abs-bottom">
    <div class="w-80">
        <p id="quote"></p>
    </div>
</footer>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="./Script/main.js"></script>
</body>
</html>