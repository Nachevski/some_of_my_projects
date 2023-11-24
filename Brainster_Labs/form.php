
<!DOCTYPE html>
<html lang="en">
  <?php
       include("./config/database.php"); 
       include("./config/queries.php"); 

       ?>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Brainster Labs</title>
    <!-- PAGE ICON  -->
    <link rel="icon" href="./imgs/Brainster/favicon.png" />
    <!-- LOCAL CSS -->
    <link rel="stylesheet" href="./css/main.css" />

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>

  <body>


    <!-- NAVBAR -->
    <nav class="navbar">
      <div class="logo">
        <a href="https://brainster.co" target="_blank">
          <img class="logo-img" src="./imgs/Brainster/Logo.png" alt="Brainster Logo" />
          <span class="logo-caption">brainster</span>
        </a>
      </div>
      <menu class="menu">
        <ul class="menu-list">
          <li class="menu-item">
            <a class="link-item" href="https://brainster.co/marketing/" target="_blank">Академија за Mаркетинг </a>
          </li>

          <li class="menu-item">
            <a class="link-item" href="https://brainster.co/full-stack/" target="_blank">Академија за Програмирање </a>
          </li>

          <li class="menu-item">
            <a class="link-item" href="https://brainster.co/data-science/" target="_blank">Академија за Data&nbsp;Science</a>
          </li>
          <li class="menu-item">
            <a class="link-item" href="https://brainster.co/graphic-design/" target="_blank">Академија за Дизајн </a>
          </li>
        </ul>
        <div class="form-btn">
          <a href="form.php" class="btn">Вработи наш студент</a>
        </div>
      </menu>

      <div class="hamburger-menu">
        <div class="custom-icon">
          <span class="hm-top"></span>
          <span class="hm-middle"></span>
          <span class="hm-bottom"></span>
        </div>
      </div>
    </nav>
    
    <!-- MAIN CONTENT -->
    <main class="form-content">
      <div class="form-header">
        <h1>Вработи студенти</h1>
      </div>

      <form method="POST" action="post.php">
        <div class="form-group icon-status">
          <label for="name">Име и презиме</label>
          <input type="text" id="name" name="fullname" placeholder="Вашето име и презиме" />
          <span class="error-message">Внесете валидно име и презиме</span>
          <i class="fa-solid fa-circle-check show-icon"></i>
        </div>

        <div class="form-group icon-status">
          <label for="companyName">Име на компанија</label>
          <input type="text" id="companyName" name="companyName" placeholder="Име на вашата компанија" />
          <span class="error-message">Внесете валидно име на компанија</span>
          <i class="fa-solid fa-circle-check show-icon"></i>
        </div>

        <div class="form-group icon-status">
          <label for="email">Контакт е-мајл</label>
          <input type="email" id="email" name="email" placeholder="Контакт имејл од вашата компанија" />
          <span class="error-message">Внесете валидна емаил адреса</span>
          <i class="fa-solid fa-circle-check show-icon"></i>
        </div>

        <div class="form-group icon-status">
          <label for="phoneNumber">Контакт</label>
          <input type="tel" id="phoneNumber" name="phone" placeholder="Контакт телефон од вашата компанија" />
          <span class="error-message">Внесете валиден контакт број</span>
          <i class="fa-solid fa-circle-check show-icon"></i>
        </div>

        <div class="form-group icon-status">
          <label for="academyType">Тип на студент</label>
          <div class="custom-select">
            <select name="academy-type" id="academy-type">
              <option value="" >Изберете тип на студент</option>
              <?php
                     $fetchData= fetch_data($db, $query_AcademiesFetch);
                     $counter=1;
                    if(is_array($fetchData)){      
                        foreach($fetchData as $data){
                            echo "<option value=" . $counter++ . ">" . $data["academy_name"] . "</option>";
                        }
                    } ?>
            </select>
          </div>
          <span class="error-message">Одберете тип на студент</span>
        </div>
        <div class="form-group">
          <input type="submit" value="Испрати" id="submit" class="btn" />
        </div>
      </form>
    </main>

    <div class="backToMain">
      <a href="index.html">
        <i class="fa-solid fa-angle-down"></i>
      </a>
    </div>

    <!-- FOOTER -->
    <footer>
      <span>Изработено со &nbsp;<i class="fa-solid fa-heart"></i>&nbsp; од Владимир Начевски</span>
    </footer>
    <script src="./script/burger-menu.js"></script>
    <script src="./script/custom-select.js"></script>
    <script src="./script/form.js"></script>
  </body>
</html>
