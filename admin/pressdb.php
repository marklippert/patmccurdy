<?php
include("../inc/dbconfig.php");

switch ($_GET['a']) {
  case "add":
    $query = "INSERT INTO press (
              sort_date,
              date,
              source,
              source_url,
              title,
              subtitle,
              author,
              text
              ) VALUES (
              '" . strtotime($_POST['date']) . "',
              '" . $_POST['date'] . "',
              '" . mysql_real_escape_string($_POST['source']) . "',
              '" . $_POST['source_url'] . "',
              '" . mysql_real_escape_string($_POST['title']) . "',
              '" . mysql_real_escape_string($_POST['subtitle']) . "',
              '" . mysql_real_escape_string($_POST['author']) . "',
              '" . mysql_real_escape_string($_POST['text']) . "'
              )";
    break;
  case "edit":
    $query = "UPDATE press SET
              sort_date = '" . strtotime($_POST['date']) . "',
              date = '" . $_POST['date'] . "',
              source = '" . mysql_real_escape_string($_POST['source']) . "',
              source_url = '" . $_POST['source_url'] . "',
              title = '" . mysql_real_escape_string($_POST['title']) . "',
              subtitle = '" . mysql_real_escape_string($_POST['subtitle']) . "',
              author = '" . mysql_real_escape_string($_POST['author']) . "',
              text = '" . mysql_real_escape_string($_POST['text']) . "'
              WHERE id = '" . $_POST['id'] . "'";
    break;
  case "delete":
    $query = "DELETE FROM press WHERE id = '" . $_GET['id'] . "'";
    break;
}

$mysqli->query($query);

$mysqli->close();

header( "Location: pressindex.php" );
?>