<?php
$pageTitle = "Register";
$needsToBeLoggedIn = false;
include('helpers/header.php');
include('helpers/base.php');
?>
<h2>Welcome to our incredibly insecure system!</h2>
<form method="post" submit="registersubmit.php">
Name: <input type="text" required name="name"><br>
Password: <input type="password" required name="password"><br>
Email: <input type="email" required name="email"><br>
Department:
<?php
try
{
	$db->makeQuery("select Id, FullName from Departments");
}
catch(Exception $e)
{
	echo $e->getMessage();
}
foreach($db->$result as $row)
{
	print "<input type='radio' name='department' value='" . $row['$Id'] . "' required>" . $row['FullName'] . "<br>";
}
?>
Permissions:
<input type="checkbox" name="givegrade"> Give Grades<br>
<input type="checkbox" name="viewall"> View All Grades<br>
<input type="checkbox" name="changeall"> Change Grades<br>
<input type="checkbox" name="addcourse"> Add Courses<br>
<button type="submit">Register</button>
</form>