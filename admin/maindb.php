<?php
include("../inc/dbconfig.php");

switch ($_GET['a']) {
  case "add":
    $query = "INSERT INTO main (date, enddate, title, text, appears) VALUES ('" . time() . "', '" . strtotime($_POST['enddate']) . "', '" . $mysqli->real_escape_string($_POST['title']) . "', '" . $mysqli->real_escape_string($_POST['text']) . "', '" . $_POST['appears'] . "')";
    break;
  case "edit":
    $query = "UPDATE main SET enddate = '" . strtotime($_POST['enddate']) . "', title = '" . $mysqli->real_escape_string($_POST['title']) . "', text = '" . $mysqli->real_escape_string($_POST['text']) . "', appears = '" . $_POST['appears'] . "' WHERE id = '" . $_POST['id'] . "'";
    break;
  case "delete":
    $query = "DELETE FROM main WHERE id = '" . $_GET['id'] . "'";
    break;
}

$mysqli->query($query);

header("Location: mainindex.php");
?>