<?php
   $hostName = "localhost";
   $userName = "root";
   $password = "password";
   $databaseName = "brainster_db";
   $conn = new mysqli($hostName, $userName, $password, $databaseName);
   $db = $conn;

   if ($conn->connect_error) { 
      die("Connection failed: " . $conn->connect_error);
   }  
    
   function fetch_data($db, $query_Fetch){
      $result = $db->query($query_Fetch);
      if($result == true){ 
         if ($result->num_rows > 0) {
            $rows= $result -> fetch_all(MYSQLI_ASSOC);
            return $rows;
         } else {
         $logMsg  = "No Data Found"; 
         }
      }else{
         $logMsg  = mysqli_error($db);
      }
      $db->close();
      return $logMsg ;
   }

   function insert_data($db, $query_Insert){
      $result = $db->query($query_Insert);
      if ($result == true) {
         $logMsg = "New record created successfully";
      } else {
         $logMsg = "Error: " . $sql . "<br>" . $conn->error;
      }
      $db->close();
      return $logMsg ;
   } 
   ?>
    
