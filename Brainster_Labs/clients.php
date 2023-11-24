<!DOCTYPE html>
<html lang="en">
  <?php
       include("./config/database.php"); 
       include("./config/queries.php"); 
        $fetchData= fetch_data($db, $query_FetchClients);
    ?>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Clients</title>
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
    </nav>

    <!-- MAIN CONTENT -->
    <main class="main-content clients">
      <div class="content-title">
        <h2>Клиенти</h2>
      </div>
      <div class="table-data">
        <table>
            <tr>
                <th>Име и презиме</th>
                <th>Име на компанија</th>
                <th>Емаил</th>
                <th>Телефонски број</th>
                <th>Академија</th>
                <th>Датум на апликација</th>
            </tr>
      <?php
        if(is_array($fetchData)){      
          foreach($fetchData as $data){
              echo "<tr>
                      <td>$data[full_name]</td>
                      <td>$data[company_name]</td>
                      <td>$data[email]</td>
                      <td>$data[phone]</td>
                      <td>$data[academy_name]</td>
                      <td>$data[time]</td>
                  </tr>";
            }
          }
      ?>
     </table>
      </div>
            <div class="content-cards hide-data">
         <?php
            if(is_array($fetchData)){      
                foreach($fetchData as $data){
                    echo "<div class='card extend'>
                             <div class='card-inner'>
                                <div class='card-body'>
                                  <div class='card-content'>
                                  <h4>Име и презиме: <strong>$data[full_name]</strong> </h4>
                                  <h4>Име на компанија: <strong>$data[company_name]</strong></h4>
                                  <h4>Емаил: <strong>$data[email]</strong></h4>
                                  <h4>Телефонски број: <strong>$data[phone]</strong></h4>
                                  <h4>Академија: <strong>$data[academy_name]</strong></h4>
                                  <h4>Датум на аплицирање: <strong>$data[time]</strong> <h4>
                                 </div>
                             </div>
                         </div>
                     </div>";
                }
            } 
        ?>
     </div>
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
    <script src="./script/clients.js"></script>

  </body>
</html>