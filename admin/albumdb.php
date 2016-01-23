<?php
include("../inc/dbconfig.php");

switch ($_GET['a']) {
  case "add":
    $query = "INSERT INTO albums (
              title,
              cover_image,
              year,
              itunes,
              amazon
              ) VALUES (
              '" . mysql_real_escape_string($_POST['title']) . "',
              '" . mysql_real_escape_string($_POST['cover_image']) . "',
              '" . $_POST['year'] . "',
              '" . mysql_real_escape_string($_POST['itunes']) . "',
              '" . mysql_real_escape_string($_POST['amazon']) . "'
              )";
    break;
  case "edit":
    $query = "UPDATE albums SET 
              title = '" . mysql_real_escape_string($_POST['title']) . "', 
              cover_image = '" . mysql_real_escape_string($_POST['cover_image']) . "', 
              year = '" . $_POST['year'] . "', 
              itunes = '" . mysql_real_escape_string($_POST['itunes']) . "', 
              amazon = '" . mysql_real_escape_string($_POST['amazon']) . "' 
              WHERE 
              id = '" . $_POST['id'] . "'";
    break;
  case "delete":
    $query = "DELETE FROM albums WHERE id = '" . $_GET['id'] . "'";
    break;
}

$mysqli->query($query);

$mysqli->close();

header( "Location: albumindex.php" );
?>