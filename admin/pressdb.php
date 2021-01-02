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
              '" . $mysqli->real_escape_string($_POST['source']) . "',
              '" . $_POST['source_url'] . "',
              '" . $mysqli->real_escape_string($_POST['title']) . "',
              '" . $mysqli->real_escape_string($_POST['subtitle']) . "',
              '" . $mysqli->real_escape_string($_POST['author']) . "',
              '" . $mysqli->real_escape_string($_POST['text']) . "'
              )";
    break;
  case "edit":
    $query = "UPDATE press SET
              sort_date = '" . strtotime($_POST['date']) . "',
              date = '" . $_POST['date'] . "',
              source = '" . $mysqli->real_escape_string($_POST['source']) . "',
              source_url = '" . $_POST['source_url'] . "',
              title = '" . $mysqli->real_escape_string($_POST['title']) . "',
              subtitle = '" . $mysqli->real_escape_string($_POST['subtitle']) . "',
              author = '" . $mysqli->real_escape_string($_POST['author']) . "',
              text = '" . $mysqli->real_escape_string($_POST['text']) . "'
              WHERE id = '" . $_POST['id'] . "'";
    break;
  case "delete":
    $query = "DELETE FROM press WHERE id = '" . $_GET['id'] . "'";
    break;
}

$mysqli->query($query);

header("Location: pressindex.php");
?>