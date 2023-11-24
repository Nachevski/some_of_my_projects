<?php
   // QUERIES
    $query_AcademiesFetch = "SELECT academy_name FROM  academies";

    $query_FetchClients = 
       "SELECT full_name, 
               company_name, 
               email, phone, 
               AC.academy_name, 
               time
           FROM `clients`
               JOIN academies as AC
               ON clients.academies_id = AC.id
               ORDER BY time DESC;";
?>
