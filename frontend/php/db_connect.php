<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "spesa";

$db = mysqli_connect($server , $username , $password , $database);

if(!$db)
{
    die("Error" . mysqli_connect_error());
}
?>