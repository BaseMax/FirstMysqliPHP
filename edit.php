<?php
require "core.php";

if(!isset($_GET["id"])) {
	header("Location: index.php");
	exit();
}
$stu_id = $_GET["id"];
$sql = "SELECT * FROM `student` WHERE `stu_id` = " . $stu_id . " LIMIT 1";
$result = $mysqli->query($sql);
if($result->num_rows > 0) {
	if(isset($_POST["edit"])) {
		$sql = "UPDATE `student` set stu_name = '". $_POST["stu_name"] ."',
							         stu_family = '". $_POST["stu_family"] ."',
							         stu_age = ". $_POST["stu_age"] .",
							         stu_birthdate = '". $_POST["stu_birthdate"] ."',
							         stu_address = '". $_POST["stu_address"] ."'
							         where stu_id = " . $stu_id;
		if($mysqli->query($sql)) {
			printf("Table student updated successfully.<br>\n");
		}
		if ($mysqli->errno) {
			printf("Could not update table: %s<br>\n", $mysqli->error);
		}
	}
	while($row = $result->fetch_assoc()) {
	?>
	<h1>Edit the student:</h1>
	<form action="" method="POST">
		<b>Name:</b>
		<input type="text" name="stu_name" value="<?= $row["stu_name"] ?>">
		<br>
		<b>Family:</b>
		<input type="text" name="stu_family" value="<?= $row["stu_family"] ?>">
		<br>
		<b>Age:</b>
		<input type="number" name="stu_age" value="<?= $row["stu_age"] ?>">
		<br>
		<b>Birthdate:</b>
		<input type="" name="stu_birthdate" value="<?= $row["stu_birthdate"] ?>">
		<br>
		<b>Address:</b>
		<input type="text" name="stu_address" value="<?= $row["stu_address"] ?>">
		<br>
		<button name="edit">Insert</button>
	</form>
	<?php
	}
} else {
	header("Location: index.php");
	exit();
}
