<?php
include("../inc/dbconfig.php");

switch ($_GET['a']) {
  case "add":
    $query = "INSERT INTO tabs (
              title,
              tab,
              name,
              email
              ) VALUES (
              '" . mysql_real_escape_string($_POST['title']) . "',
              '" . mysql_real_escape_string($_POST['tab']) . "',
              '" . mysql_real_escape_string($_POST['name']) . "',
              '" . $_POST['email'] . "'
              )";
    break;
  case "edit":
    $query = "UPDATE tabs SET
              title = '" . mysql_real_escape_string($_POST['title']) . "',
              tab = '" . mysql_real_escape_string($_POST['tab']) . "',
              name = '" . mysql_real_escape_string($_POST['name']) . "',
              email = '" . $_POST['email'] . "'
              WHERE id = '" . $_POST['id'] . "'";
    break;
  case "delete":
    $query = "DELETE FROM tabs WHERE id = '" . $_GET['id'] . "'";
    break;
}

$mysqli->query($query);

$mysqli->close();

header( "Location: tabsindex.php" );
?>