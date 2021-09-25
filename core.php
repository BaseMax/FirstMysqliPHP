<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '01';
$dbname = 'student';
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if($mysqli->connect_errno) {
   printf("Connection error: %s<br>\n", $mysqli->connect_error);
   exit();
}

// printf("Connected successfully.<br>\n");
