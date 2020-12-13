<?php
include("../inc/dbconfig.php");

switch ($_GET['a']) {
  case "add":
    $query = "INSERT INTO albums (
              title,
              cover_image,
              year,
              itunes,
              amazon,
              liner_notes
              ) VALUES (
              '" . $mysqli->real_escape_string($_POST['title']) . "',
              '" . $mysqli->real_escape_string($_POST['cover_image']) . "',
              '" . $_POST['year'] . "',
              '" . $mysqli->real_escape_string($_POST['itunes']) . "',
              '" . $mysqli->real_escape_string($_POST['amazon']) . "',
              '" . $mysqli->real_escape_string($_POST['liner_notes']) . "'
              )";
    break;
  case "edit":
    $query = "UPDATE albums SET 
              title = '" . $mysqli->real_escape_string($_POST['title']) . "', 
              cover_image = '" . $mysqli->real_escape_string($_POST['cover_image']) . "', 
              year = '" . $_POST['year'] . "', 
              itunes = '" . $mysqli->real_escape_string($_POST['itunes']) . "',
              amazon = '" . $mysqli->real_escape_string($_POST['amazon']) . "', 
              liner_notes = '" . $mysqli->real_escape_string($_POST['liner_notes']) . "' 
              WHERE 
              id = '" . $_POST['id'] . "'";
    break;
  case "delete":
    $query = "DELETE FROM albums WHERE id = '" . $_GET['id'] . "'";
    break;
}

$mysqli->query($query);

$mysqli->close();

header("Location: albumindex.php");
?>