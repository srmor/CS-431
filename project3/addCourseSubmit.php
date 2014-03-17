<?php
  include("helpers/header.php");

  if (isset($_POST['department'])) {
    $department = intval($_POST['department']);
  }
  else {
    die("Need to specify a department");
  }

  if (isset($_POST['title'])) {
    $title = $_POST['title'];
  }
  else {
    die("Need to specify a course title");
  }

  if (isset($_POST['number'])) {
    $courseNumber = $_POST['number'];
  }
  else {
    die("Need to specify a course number");
  }

  if (isset($_POST['description'])) {
    $description = $_POST['description'];
  }
  else {
    $description = NULL;
  }

  if (isset($_POST['creditNumber'])) {
    $creditNumber = intval($_POST['creditNumber']);
  }
  else {
    die("Need to specify a credit number");
  }

  try {
    $db->makeQuery("INSERT INTO Courses(Title, DeptId, CourseNumber, Description, CreditValue) VALUES (?, ?, ?, ?, ?)", $title, $department, $courseNumber, $description, $creditNumber);
  }
  catch (Exception $e) {
    die($e->getMessage());
  }

  header("Location: http://jj431.herokuapp.com/project3/registered.php");
  exit();

  include("helpers/footer.php");
?>