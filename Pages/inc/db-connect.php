<?php
try 
{
  $db = new PDO('mysql:host=localhost;dbname=APG;charset=utf8', 'root', 'APGwork123');
} 
catch(PDOException $e)
{
  die('خطأ:'. $e->getMessage());
}
// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Defuelt connection
$host = "127.0.0.1";
$user = "root";
$pass = "APGwork123";
$db1 = "APG";

// Rank connection
$db = "RANK";
// Ini2J&2%@
?>