<?php
require_once('load_all.php');

use App\Database\SQLQuery as SQLQuery;

$query = new SQLQuery();
$typeOfGoods = $query->getTypesOfGoods();

if (isset($_GET['validationStatus'])) {
    session_start();
    if (isset($_SESSION['validationErrors'])) {
        $validationError = $_SESSION['validationErrors'] ?? '';
        $validatedFields = $_SESSION['validatedFields'] ?? '';
        session_destroy();
    } else {
        session_destroy();
        header('LOCATION: ../index.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Lets Start...</title>
    <link rel="stylesheet" href="./styles/style.css"/>
    <link rel="stylesheet" href="./styles/custom-select.css"/>
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>
<div class="banner">
    <div class="bg-image">
        <!--        <img src="./imgs/test.png">-->
    </div>
</div>

<?php
if (!empty($validationError)) {
    echo '<div class="validationError">';
    echo "<p>VALIDATION FAIL ON: " . count($validationError) . " INPUTS</p>";
    echo "</div>";
}
?>

<section class="infoInputs">
    <form action="validating.php" method="POST">
        <h2 class="steps-counter">Step 1 / 3</h2>
        <!--        STEP 1 -->
        <div class="steps step1 active">
            <div class="group">
                <div class="group1">
                    <label for="companyName">Company Name (used as template logo link)</label>
                    <input type="text" name="companyName" id="companyName"
                        <?= (isset($validatedFields['companyName'])) ? ('class="validatePass" value="' . $validatedFields['companyName'] . '"') : '' ?>
                        <?= (isset($validationError['companyName'])) ? ('class="validateError" placeholder="' . $validationError['companyName'] . '"') : '' ?>>


                    <label for="coverImgURL">Cover Image URL</label>
                    <input type="text" name="coverImgURL" id="coverImgURL"
                        <?= (isset($validatedFields['coverImgURL'])) ? ('class="validatePass" value="' . $validatedFields['coverImgURL'] . '"') : '' ?>
                        <?= (isset($validationError['coverImgURL'])) ? ('class="validateError" placeholder="' . $validationError['coverImgURL'] . '"') : '' ?>>

                    <label for="pageTitle">Main Title of Page</label>
                    <input type="text" name="pageTitle" id="pageTitle"
                        <?= (isset($validatedFields['pageTitle'])) ? ('class="validatePass" value="' . $validatedFields['pageTitle'] . '"') : '' ?>
                        <?= (isset($validationError['pageTitle'])) ? ('class="validateError" placeholder="' . $validationError['pageTitle'] . '"') : '' ?>>

                    <label for="pageSubTitle">Subtitle of Page</label>
                    <input type="text" name="pageSubTitle" id="pageSubTitle"
                        <?= (isset($validatedFields['pageSubTitle'])) ? ('class="validatePass" value="' . $validatedFields['pageSubTitle'] . '"') : '' ?>
                        <?= (isset($validationError['pageSubTitle'])) ? ('class="validateError" placeholder="' . $validationError['pageSubTitle'] . '"') : '' ?>>
                </div>
                <div class="group2">
                    <label for="phoneNumber">Your telephone number</label>
                    <input type="text" name="phoneNumber" id="phoneNumber"
                        <?= (isset($validatedFields['phoneNumber'])) ? ('class="validatePass" value="' . $validatedFields['phoneNumber'] . '"') : '' ?>
                        <?= (isset($validationError['phoneNumber'])) ? ('class="validateError" placeholder="' . $validationError['phoneNumber'] . '"') : '' ?>>

                    <label for="location">Location</label>
                    <input type="text" name="location" id="location"
                        <?= (isset($validatedFields['location'])) ? ('class="validatePass" value="' . $validatedFields['location'] . '"') : '' ?>
                        <?= (isset($validationError['location'])) ? ('class="validateError" placeholder="' . $validationError['location'] . '"') : '' ?>>

                    <label for="aboutYou">Something about you</label>
                    <textarea name="aboutYou" id="aboutYou" cols="30" rows="7"
                    <?php
                    if (isset($validationError['aboutYou'])) {
                        echo 'class="validateError" placeholder="' . $validationError['aboutYou'] . '"></textarea>';
                    } elseif (isset($validatedFields['aboutYou'])) {
                        echo 'class="validatePass">' . $validatedFields['aboutYou'] . '</textarea>';
                    } else {
                        echo '></textarea>';
                    }
                    ?>
                </div>
            </div>
        </div>

        <!--        STEP 2-->
        <div class="steps step2">
            <div class="group">
                <div class="group1">
                    <label for="typeOfGoods">Do you provide services or products?</label>
                    <div class="custom-select ">
                        <select name="typeOfGoods"
                                id="typeOfGoods" <?= (isset($validatedFields)) ? 'class="validatePass"' : '' ?>>
                            <?php
                            echo "<option value=" . $typeOfGoods[0]['id'] . ">" . $typeOfGoods[0]['type_of'] . "</option>";
                            foreach ($typeOfGoods as $type) {
                                if (isset($validatedFields['typeOfGoods']) && $validatedFields['typeOfGoods'] == $type['id']) {
                                    echo "<option value='" . $type['id'] . "' selected>" . $type['type_of'] . "</option>";
                                } else {
                                    echo "<option value='" . $type['id'] . "'>" . $type['type_of'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <label for="card1ImgURL" class="exception">Image of product/service</label>
                    <input type="text" name="card1ImgURL" id="card1ImgURL"
                        <?= (isset($validatedFields['card1ImgURL'])) ? ('class="validatePass" value="' . $validatedFields['card1ImgURL'] . '"') : '' ?>
                        <?= (isset($validationError['card1ImgURL'])) ? ('class="validateError" placeholder="' . $validationError['card1ImgURL'] . '"') : '' ?>>

                    <label for="card1Description">Description of product/service</label>
                    <textarea name="card1Description" id="card1Description" cols="30" rows="5"
                    <?php
                    if (isset($validationError['card1Description'])) {
                        echo 'class="validateError" placeholder="' . $validationError['card1Description'] . '"></textarea>';
                    } elseif (isset($validatedFields['card1Description'])) {
                        echo 'class="validatePass">' . $validatedFields['card1Description'] . '></textarea>';
                    } else {
                        echo '></textarea>';
                    }
                    ?>
                </div>

                <div class="group2">

                    <label for="card2ImgURL">Image of product/service</label>
                    <input type="text" name="card2ImgURL" id="card2ImgURL"
                        <?= (isset($validatedFields['card2ImgURL'])) ? ('class="validatePass" value="' . $validatedFields['card2ImgURL'] . '"') : '' ?>
                        <?= (isset($validationError['card2ImgURL'])) ? ('class="validateError" placeholder="' . $validationError['card2ImgURL'] . '"') : '' ?>>

                    <label for="card2Description">Description of product/service</label>
                    <textarea name="card2Description" id="card2Description" cols="30" rows="5"
                    <?php
                    if (isset($validationError['card2Description'])) {
                        echo 'class="validateError" placeholder="' . $validationError['card2Description'] . '"></textarea>';
                    } elseif (isset($validatedFields['card2Description'])) {
                        echo 'class="validatePass" >' . $validatedFields['card2Description'] . '</textarea>';
                    } else {
                        echo '></textarea>';
                    }
                    ?>

                    <label for="card3ImgURL">Image of product/service</label>
                    <input type="text" name="card3ImgURL" id="card3ImgURL"
                        <?= (isset($validatedFields['card3ImgURL'])) ? ('class="validatePass" value="' . $validatedFields['card3ImgURL'] . '"') : '' ?>
                        <?= (isset($validationError['card3ImgURL'])) ? ('class="validateError" placeholder="' . $validationError['card3ImgURL'] . '"') : '' ?>>

                    <label for="card3Description">Description of product/service</label>
                    <textarea name="card3Description" id="card3Description" cols="30" rows="5"
                    <?php
                    if (isset($validationError['card3Description'])) {
                        echo 'class="validateError" placeholder="' . $validationError['card3Description'] . '"></textarea>';
                    } elseif (isset($validatedFields['card3Description'])) {
                        echo 'class="validatePass">' . $validatedFields['card3Description'] . '</textarea>';
                    } else {
                        echo '></textarea>';
                    }
                    ?>
                </div>
            </div>
        </div>

        <!--        STEP 3-->
        <div class="steps step3">
            <div class="group">
                <div class="group1">
                    <label for="companyInfo">Please provide a description of your company, something people should be
                        awere of before they contacted you: </label>
                    <textarea name="companyInfo" id="companyInfo" cols="30" rows="10"
                    <?php
                    if (isset($validationError['companyInfo'])) {
                        echo 'class="validateError" placeholder="' . $validationError['companyInfo'] . '"></textarea>';
                    } elseif (isset($validatedFields['companyInfo'])) {
                        echo 'class="validatePass">' . $validatedFields['companyInfo'] . '</textarea>';
                    } else {
                        echo '></textarea>';
                    }
                    ?>

                    <label for="theme">Which color theme you prefer?</label>
                    <div class="custom-select ">
                        <select name="theme" id="theme" <?= (isset($validatedFields)) ? 'class="validatePass"' : '' ?>>
                            <option value="default">Light Theme (Default)</option>
                            <option value="default">Light Theme (Default)</option>
                            <?php
                            if (isset($validatedFields['theme']) && $validatedFields['theme'] != 'default') {
                                echo '<option value="theme-dark" selected>Dark Theme</option>';
                            } else {
                                echo '<option value="theme-dark" >Dark Theme</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="group2">
                    <label for="linkedInSocial">LinkedIn</label>
                    <input type="text" name="linkedInSocial" id="linkedInSocial"
                        <?= (isset($validatedFields['linkedInSocial'])) ? ('class="validatePass" value="' . $validatedFields['linkedInSocial'] . '"') : '' ?>
                        <?= (isset($validationError['linkedInSocial'])) ? ('class="validateError" placeholder="' . $validationError['linkedInSocial'] . '"') : '' ?>>

                    <label for="facebookSocial">Facebook</label>
                    <input type="text" name="facebookSocial" id="facebookSocial"
                        <?= (isset($validatedFields['facebookSocial'])) ? ('class="validatePass" value="' . $validatedFields['facebookSocial'] . '"') : '' ?>
                        <?= (isset($validationError['facebookSocial'])) ? ('class="validateError" placeholder="' . $validationError['facebookSocial'] . '"') : '' ?>>

                    <label for="twitterSocial">Twitter</label>
                    <input type="text" name="twitterSocial" id="twitterSocial"
                        <?= (isset($validatedFields['twitterSocial'])) ? ('class="validatePass" value="' . $validatedFields['twitterSocial'] . '"') : '' ?>
                        <?= (isset($validationError['twitterSocial'])) ? ('class="validateError" placeholder="' . $validationError['twitterSocial'] . '"') : '' ?>>

                    <label for="googleSocial">Google+</label>
                    <input type="text" name="googleSocial" id="googleSocial"
                        <?= (isset($validatedFields['googleSocial'])) ? ('class="validatePass" value="' . $validatedFields['googleSocial'] . '"') : '' ?>
                        <?= (isset($validationError['googleSocial'])) ? ('class="validateError" placeholder="' . $validationError['googleSocial'] . '"') : '' ?>>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-submit disabled">Submit</button>
    </form>
    <button class="btn btn-next-step">Next Step ></button>
    <button class="btn btn-prev-step disabled">< Prev Step</button>

    <div class="statusBar"></div>
</section>

<div class="screenNotSupported">
    <h2>NOT SUPPORTED FOR SCREENS SMALLER THAN 1024PX</h2>
</div>

<script src="./script/custom-select.js"></script>
<script src="./script/script.js"></script>
</body>
</html>
