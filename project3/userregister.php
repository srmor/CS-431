<?php
$pageTitle = "Register";
$needsToBeLoggedIn = false;
include('helpers/base.php');
include('helpers/header.php');
?>
<h2>Welcome to our incredibly insecure system!</h2>
<form method="post" action="userregistersubmit.php">
Name: <input type="text" required name="name"><br>
Password: <input type="password" required name="password"><br>
Email: <input type="email" required name="email"><br>
Department:<br>
<?php
try
{
	$db->makeQuery("SELECT Id, FullName FROM departments;");
}
catch(Exception $e)
{
	echo $e->getMessage();
}
if($db->numRows == 0)
{
	print "There are no departments at this school<br>";
}
foreach($db->result as $row)
{
	print "<input type='radio' name='department' value='" . $row['Id'] . "' required>" . $row['FullName'] . "<br>";
}
?>
Role: <select name="role">
<option value="student">Student</option>
<option value="faculty">Faculty</option>
<option value="staff">Staff</option>
<option value="executive">Executive</option>
<select>
<br>
What permissions would you like?<br>
<input type="checkbox" name="givegrade"> Give Grades<br>
<input type="checkbox" name="viewall"> View All Grades<br>
<input type="checkbox" name="changeall"> Change All Grades<br>
<input type="checkbox" name="addcourse"> Add Courses<br>
<button type="submit">Register</button>
</form>
<?php
include('helpers/footer.php');
?>