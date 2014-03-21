<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $pageTitle; ?></title>
  </head>
  <body>
<?php if ($userId) { ?>
	<a href="<?php echo BASE_URL ?>main.php">Home</a>
    <a href="<?php echo BASE_URL ?>logout.php">Log Out</a>
<?php
  } else if (!$userId && $needsToBeLoggedIn) {
    die("You need to be <a href='".BASE_URL."login.php'>logged in</a> to view this");
  }
?>