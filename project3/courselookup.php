<?php
  $pageTitle = "Course Search";
  $needsToBeLoggedIn = false;
  include('helpers/base.php');
  include('helpers/header.php');

  try {
    $db->makeQuery("SELECT Id, Abbreviation FROM Departments");
  }
  catch(Exception $e) {
    die($e->getMessage());
  }

  $departments = array();

  if($db->numRows > 0) {
    $departments = $db->result;
  }
  else {
    die("<br>No courses exist.");
  }
?>

<h2>Search Courses</h2>

<form method="get" action="courselookup.php">
  <select id="department" name="department">
    <option value="" selected>Choose a Department</option>
    <?php
      foreach($departments as $department) {
        echo '<option value="' . $department['Id'] . '">' . $department['Abbreviation'] . '</option>';
      }
    ?>
  </select>
  <input type="text" placeholder="Search text" name="query">
  <button type="submit">Search</button>
</form>

<?php
  if(isset($_GET['query']) && isset($_GET['department'])) {
    $query = "%" . $_GET["query"] . "%";
    try {
      $db->makeQuery("SELECT Courses.Id, Title, Abbreviation, CourseNumber, Description FROM Courses JOIN Departments ON Departments.Id = DeptId WHERE DeptId = ? AND (Title LIKE ? OR CourseNumber LIKE ?) ORDER BY CourseNumber", $_GET['department'], $query, $query);
    }
    catch(Exception $e) {
      die($e->getMessage());
    }
	if($db->numRows == 1)
	{
		foreach($db->result as $row)
		{
			header("Location: coursedetail.php?id=".$row["Id"]);
		}
	}
?>
  <table>
    <tr>
      <th>Course Number</th>
      <th>Title</th>
      <th>Description</th>
	  <th></th>
    </tr>
    <?php
        foreach($db->result as $row)
        {
    ?>
            <tr>
              <td><?php echo $row["Abbreviation"] . " " . $row["CourseNumber"] ?></td>
              <td><?php echo $row["Title"] ?></td>
              <td><?php echo $row["Description"] ?></td>
              <td>
                <a href="coursedetail.php?id=<?php echo $row['Id'] ?>">See sections</a>
              </td>
            </tr>
    <?php
        }
    ?>
  </table>
<?php
  }
?>