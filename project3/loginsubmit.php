<html>
<head>
</head>
<body>
<h2>hello</h2>

<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);

session_start();

print "hellooo";

$userEmail = $_POST['email'];
$userPassword = $_POST['password'];

include('../account.php');

$mysql = mysql_connect($hostname, $username, $password);

if (!$mysql) {
  die('Not connected: ' . mysql_error());
}

$db = mysql_select_db($database, $mysql);

if (!$db) {
  die("Can't use database: " . mysql_error());
}

print("hola");

$query = sprintf("SELECT Id, Name FROM Users WHERE Email='%s' AND Password=SHA1('%s') LIMIT 1", mysql_real_escape_string($userEmail), mysql_real_escape_string($userPassword));

$result = mysql_query($query);

if (!$result) {
  die("Invalid Query: " . mysql_error());
}

print("helloojisjdofjdiso");

$numRows = mysql_num_rows($result);

if($numRows == 1) {
  while ($row = mysql_fetch_assoc($result)) {
    $userId = $row['Id'];
    $userName = $row['Name'];
    $_SESSION["Id"] = $userId;
  }
}
else {
  die("User does not exist");
}

print "me";
print "Welcome $userName";

mysql_free_result($result);
?>

</body>
</html>
