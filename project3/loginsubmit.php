<?php
  include('helpers/base.php');

  $userEmail = $_POST['email'];
  $userPassword = $_POST['password'];

  $query = "SELECT Id, Name FROM Users WHERE Email=? AND Password=SHA1(?) LIMIT 1";

  try {
    $db->makeQuery($query, $userEmail, $userPassword);
  }
  catch (Exception $e) {
    die("Error: " . $e);
  }

  $numRows = $db->numRows;

  if($numRows == 1) {
    foreach ($db->result as &$row) {
      $userId = $row['Id'];
      $userName = $row['Name'];
      $_SESSION["Id"] = $userId;
    }
  }
  else {
    die("User does not exist");
  }

  header("Location: " . BASE_URL . "main.php");
  exit();
?>