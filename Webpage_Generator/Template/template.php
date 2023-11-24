<?php
require_once('../App/load_all.php');

use App\Database\SQLQuery as SQLQuery;


session_start();
//
if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['ID'] == $_SESSION['userID']) {
    $query = new SQLQuery();
    $templateData = $query->getTemplateData($_GET['ID']);
    $templateItems = $query->getCardItems($_GET['ID']);
    $date_created = date_format(date_create($templateData['date_created']), "d-m-Y H:i");
} else {
    header('LOCATION:../index.php');
}

function getStringFromNumber($int): string
{
    switch ($int) {
        case 1:
            return ' One';
        case 2:
            return ' Two';
        case 3:
            return ' Three';
        case 4:
            return ' Four';
        case 5:
            return ' Five';
        case 6:
            return ' Six';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Web Page Generator</title>
    <link rel="stylesheet" href="./styles/style.css"/>
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>

<body class="<?= $templateData['theme'] ?>">
<nav class="d-flex">
    <menu>
        <ul class="list-items d-flex">
            <li class="logo">
                <a href=""><?= $templateData['company_name'] ?></a>
            </li>
            <li class="default-transition">
                <a href="#cover-section">Home</a>
            </li>
            <li class="default-transition">
                <a href="#about-us-section">About Us</a>
            </li>
            <li class="default-transition">
                <a href="#our-items-section"><?= $templateData['type_of_goods'] ?></a>
            </li>
            <li class="default-transition">
                <a href="#contact-us-section">Contact</a>
            </li>
        </ul>
    </menu>
    <div class="buttons">
        <a href="../App/generatedTemplates.php" class="btn default-transition history-btn">View History</a>
        <a href="../App/createNewPage.php" class="btn default-transition">Create New</a>
    </div>
</nav>

<div class="cover color-secondary d-flex flex-column" id="cover-section"
     style="background-image: url('<?= $templateData['cover_img'] ?>')">
    <header class="main-header">
        <h1><?= $templateData['main_title'] ?></h1>
    </header>
    <div class="sub-header">
        <h2><?= $templateData['sub_title'] ?></h2>
    </div>
</div>
<main class="main-content">
    <section class="about-us d-flex" id="about-us-section">
        <div class="about-info">
            <h3>About us</h3>
            <p><?= $templateData['about_info'] ?></p>
            <hr>
            <p><a href="tel:6556151">Phone Number: <?= $templateData['phone_number'] ?></a></p>
            <p>Location: <?= $templateData['location'] ?></p>
        </div>
    </section>

    <section id="our-items-section">
        <h3><?= $templateData['type_of_goods'] ?></h3>
        <div class="cards d-flex">
            <!--        CARDS-->
            <?php
            $counter = 1;
            foreach ($templateItems as $item) {
                echo '<div class="card-container">';
                echo '    <div class="inner-card">';
                echo '        <div class="card default-transition color-secondary bg-gray">';
                echo '          <a href="">';
                echo '            <div class="card-body d-flex flex-column flex-column">';
                echo '                <div class="card-img">';
                echo '                     <img src="' . $item['item_url'] . '" alt="">';
                echo '                </div>';
                echo '                <div class="card-description d-flex flex-column">';
                echo '                    <div class="description">';
                echo '                        <h4>' . $templateData['type_of_goods'] . getStringFromNumber($counter++) . ' Description</h4>';
                echo '                        <p>' . $item['item_description'] . '</p>';
                echo '                    </div>';
                echo '                    <div class="card-footer">';
                echo '                        <small>Created on: <strong>' . $date_created . '</strong></small>';
                echo '                 </div>';
                echo '                </div>';
                echo '            </div>';
                echo '          </a>';
                echo '        </div>';
                echo '    </div>';
                echo '</div>';
            }
            ?>
            <!--        CARDS-->
        </div>
    </section>
    <hr>

    <section class="contact-us d-flex">
        <div class="contact-description">
            <h3>Contact</h3>
            <div class="inner">
                <p><?= $templateData['company_description'] ?></p>
            </div>
        </div>

        <div class="contact-form" id="contact-us-section">
            <div class="inner">
                <form action="send-mail.php" method="POST">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name"/>

                    <label for="email">Email</label>
                    <input type="email" name="email" id="email"/>

                    <label for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="5"></textarea>
                    <button class="btn default-transition">Send</button>
                </form>
            </div>
        </div>

    </section>
</main>

<footer class="footer color-secondary bg-gray">
    <span>Copyright &copy; Vladimir Nachevski</span>
    <div class="social-media">
        <a href="<?= $templateData['linkedin_url'] ?>" class="default-transition" target="_blank"><i
                    class="fa-brands fa-linkedin-in"></i></a>
        <a href="<?= $templateData['facebook_url'] ?>" class="default-transition" target="_blank"><i
                    class="fa-brands fa-facebook"></i></a>
        <a href="<?= $templateData['twitter_url'] ?>" class="default-transition" target="_blank"><i
                    class="fa-brands fa-twitter"></i></a>
        <a href="<?= $templateData['google_plus_url'] ?>" class="default-transition" target="_blank"> <i
                    class="fa-brands fa-google-plus-g"></i></a>
    </div>
</footer>
</body>
</html>
