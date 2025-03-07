<?php>
	$pageTitle="Register for Courses";
	include('helpers/base.php');
	include('helpers/header.php');
?>
<h3>Courses you are in</h3>
<table>
<tr>
	<th>Course Number</th>
	<th>Course Title</th>
	<th>Credits</th>
	<th>Drop</th>
	<?php
		$courses = "SELECT CourseInstances.Id AS Id, Abbreviation, CourseNumber, SectionNumber, Title, CreditValue FROM Courses " .
									"JOIN Departments ON Departments.Id = Courses.DeptId " .
									"JOIN CourseInstances ON CourseInstances.CourseId = Courses.Id " .
									"JOIN Registration ON Registration.CourseInstanceId = CourseInstances.Id " .
									"WHERE UserId = ? ORDER BY (SELECT Year FROM Semesters WHERE Id=SemesterId), Abbreviation, CourseNumber";
		$db->makeQuery($courses, $userId);
		foreach($db->result as $row)
		{
			print "<tr><td>".$row['Abbreviation'] . ' ' . $row['CourseNumber']. '-' . $row['SectionNumber'] . "</td><td>".$row['Title']."</td><td>".$row['CreditValue']."</td>";
	?>
			<td><button type='button' onclick='window.location.assign("dropsubmit.php?courseId=<?php echo $row['Id']?>")'>Drop</button></td></tr>
	<?php
		}
	?>
</table>
<h3>Register</h3>
Enter new courses by id:
<form method='post' action='registersubmit.php'>
	<input type='text' name='c1' required>
	<input type='text' name='c2'>
	<input type='text' name='c3'>
	<input type='text' name='c4'>
	<input type='text' name='c5'>
	<input type='text' name='c6'>
	<button type="submit">Submit</button>
</form><br>
<a href='courselookup.php'>Course Lookup</a>
<?php
	include('helpers/footer.php');
?>