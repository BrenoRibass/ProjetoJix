<?php
session_start();
error_reporting(0);

date_default_timezone_set('America/Sao_Paulo');
$server = "localhost";
$user = "root";
$pass = ""; 
$db   = "jix";


$sqli = new mysqli($server, $user, $pass, $db);

$sqli->query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

?>
