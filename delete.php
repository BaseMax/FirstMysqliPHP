<?php
require "core.php";

if(isset($_GET["id"])) {
	$stu_id = $_GET["id"];
	$sql = "DELETE FROM `student` WHERE `stu_id` = " . $stu_id;

	if($mysqli->query($sql)) {
		printf("insert successfully.<br>\n");
	}
	if($mysqli->errno) {
		printf("Could not insert: %s<br>\n", $mysqli->error);
	}
}

header("Location: index.php");
exit();
