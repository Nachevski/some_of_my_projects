<?php
require_once('../App/load_all.php');

use App\Database\SQLQuery as SQLQuery;

$query = new SQLQuery();
$templateData = $query->getAllTemplates();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Web Page Generator</title>
    <link rel="stylesheet" href="../Template/styles/style.css"/>
</head>
<body class="theme-dark">

<header class="main-header">
    <h5>Stored templates in Database: <?= count($templateData) ?></h5>
    <a href="../App/createNewPage.php" class="btn default-transition btn-exception">Create New</a>
</header>

<main class="main-content">
    <section>
        <div class="cards d-flex ">
            <!--        TEMPLATES-->
            <?php
            foreach ($templateData as $item) {
                echo '<div class="card-container generatedTemplates">';
                echo '    <div class="inner-card">';
                echo '        <div class="card default-transition color-secondary bg-gray">';
                echo '          <a href="./setUpHistoryTemplate.php?ID=' . $item['id'] . '" target="_blank">';
                echo '            <div class="card-body d-flex flex-column flex-column">';
                echo '                <div class="card-img">';
                echo '                     <img src="' . $item['cover_img'] . '" alt="">';
                echo '                </div>';
                echo '                <div class="card-description d-flex flex-column">';
                echo '                    <div class="description">';
                echo '                        <h4>' . $item['id'] . '. Company Name: ' . $item['company_name'] . '</h4>';
                echo '                        <p>Location: <strong>' . $item['location'] . '</strong></p>';
                echo '                        <p>Phone number: <strong>' . $item['phone_number'] . '</strong></p>';
                echo '                    </div>';
                echo '                    <div class="card-footer">';
                echo '                        <small>Created on: <strong>' . date_format(date_create($item["date_created"]), "d-m-Y H:i") . '</strong></small>';
                echo '                 </div>';
                echo '                </div>';
                echo '             </div>';
                echo '            </a>';
                echo '        </div>';
                echo '    </div>';
                echo '</div>';
            }
            ?>
            <!--        TEMPLATES-->
        </div>
    </section>
</main>
</body>
</html>

