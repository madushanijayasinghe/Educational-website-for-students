<?php
// Old configs
// $db_name = 'mysql:host=localhost;dbname=course_db';
// $user_name = 'root';
// $user_password = 'root123';

// $conn = new PDO($db_name, $user_name, $user_password);


// New Configs
$serverName = 'localhost';
$db_user_name = 'root';
$db_user_pass = '';
try {
   // First connect without database selected
   $conn = new PDO("mysql:host=$serverName", $db_user_name, $db_user_pass);
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   // Create database if it doesn't exist
   $conn->exec("CREATE DATABASE IF NOT EXISTS course_db");

   // Connect to the database
   $conn = new PDO("mysql:host=$serverName;dbname=course_db", $db_user_name, $db_user_pass);
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   // Import tables if they don't exist
   $sql = file_get_contents(__DIR__ . '/../database/tables.sql');
   $conn->exec($sql);

} catch (PDOException $e) {
   die("Connection failed: " . $e->getMessage());
}

function unique_id()
{
   $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
   $rand = array();
   $length = strlen($str) - 1;
   for ($i = 0; $i < 20; $i++) {
      $n = mt_rand(0, $length);
      $rand[] = $str[$n];
   }
   return implode($rand);
}

?>