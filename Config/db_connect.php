<?php

//connect to database through mysqli or PDO. we'll use mysql1
$conn = mysqli_connect('localhost', 'SA', 'password15', 'amirahpizzahut');

//check connection
if(!$conn){//if connection is false or not worked
    echo 'Database connection error:' .mysqli_connect_error();
   }
   
?>


