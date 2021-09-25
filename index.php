<?php
require "core.php";

$sql = "CREATE TABLE `student` (
  `stu_id` int(10) NOT NULL,
  `stu_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stu_family` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stu_age` int(10) NOT NULL,
  `stu_birthdate` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
";

if($mysqli->query($sql)) {
	printf("Record inserted successfully.<br>\n");
	$sql = "ALTER TABLE `student` ADD PRIMARY KEY (`stu_id`);";
	$mysqli->query($sql);
	$sql = "ALTER TABLE `student` MODIFY `stu_id` int(10) NOT NULL AUTO_INCREMENT;";
	$mysqli->query($sql);
	printf("Record inserted successfully.<br>\n");
	$sql = "ALTER TABLE `student` ADD `stu_address` VARCHAR(50) NOT NULL AFTER `stu_birthdate`;";
	$mysqli->query($sql);
}

// insert
if(isset($_POST["insert"])) {
	$stu_name = $_POST["stu_name"];
	$stu_family = $_POST["stu_family"];
	$stu_age = $_POST["stu_age"];
	$stu_birthdate = $_POST["stu_birthdate"];
	$stu_address = $_POST["stu_address"];

	$sql = "INSERT INTO student (stu_name,stu_family,stu_age,stu_birthdate,stu_address) VALUES('$stu_name','$stu_family',$stu_age,'$stu_birthdate','$stu_address')";
	if($mysqli->query($sql)) {
		printf("insert successfully.<br>\n");
	}
	if($mysqli->errno) {
		printf("Could not insert: %s<br>\n", $mysqli->error);
	}
}
?>

<h1>Insert new student:</h1>
<form action="" method="POST">
	<b>Name:</b>
	<input type="text" name="stu_name">
	<br>
	<b>Family:</b>
	<input type="text" name="stu_family">
	<br>
	<b>Age:</b>
	<input type="number" name="stu_age">
	<br>
	<b>Birthdate:</b>
	<input type="" name="stu_birthdate">
	<br>
	<b>Address:</b>
	<input type="text" name="stu_address">
	<br>
	<button name="insert">Insert</button>
</form>

<h1>Students</h1>
<?php
$sql = "SELECT * FROM student";
$result = $mysqli->query($sql);
if($result->num_rows > 0) {
	?>
	<table width="100%">
		<tr>
			<td>#</td>
			<td>Name</td>
			<td>Age</td>
			<td>Birthdate</td>
			<td>Address</td>
			<td>Action</td>
		</tr>
	<?php
	while($row = $result->fetch_assoc()) {
	?>
		<tr>
			<td><?php echo $row["stu_id"]?></td>
			<td><?php echo $row["stu_name"]?> <?php echo $row["stu_family"]?></td>
			<td><?php echo $row["stu_age"]?></td>
			<td><?php echo $row["stu_birthdate"]?></td>
			<td><?php echo $row["stu_address"]?></td>
			<td>
				<a href="delete.php?id<?php echo $row["stu_id"]?>">Delete</a>
				&nbsp;
				<a href="edit.php?id=<?php echo $row["stu_id"]?>">Edit</a>
			</td>
		</tr>
	<?php
	}
	?>
	</table>
	<?php
} else {
	printf("No students found.<br>\n");
}
