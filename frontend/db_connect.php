<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "miniproject";

$db = mysqli_connect($server , $username , $password , $database);

if(!$db)
{
    die("Error" . mysqli_connect_error());
}
?>