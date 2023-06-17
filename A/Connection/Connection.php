<?php

$servername = 'localhost';
$email = 'root';
$password = '';

//Connecting to Database.
try{
    $conn = new PDO ("mysql:host=$servername;dbname=tentian", $email, $password);
    //set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
}   catch (Exception $e) {
    $error_message = $e->getMessage();
}

?>