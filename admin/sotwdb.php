<?php
include("../inc/dbconfig.php");

$enddate = ($_POST['enddate'] != "") ? strtotime($_POST['enddate'])+86399 : "";

switch ($_GET['a']) {
  case "add":
    $query = "INSERT INTO sotw (
              startdate,
              enddate,
              title,
              file,
              recat,
              band
              ) VALUES (
              '" . strtotime($_POST['startdate']) . "',
              '" . $enddate . "',
              '" . $mysqli->real_escape_string($_POST['title']) . "',
              \"" . $_POST['file'] . "\",
              '" . $mysqli->real_escape_string($_POST['recat']) . "',
              '" . $mysqli->real_escape_string($_POST['band']) . "'
              )";
    break;
  case "edit":
    $query = "UPDATE sotw SET
              startdate = '" . strtotime($_POST['startdate']) . "',
              enddate = '" . $enddate . "',
              title = '" . $mysqli->real_escape_string($_POST['title']) . "',
              file = \"" . $_POST['file'] . "\",
              recat = '" . $mysqli->real_escape_string($_POST['recat']) . "',
              band = '" . $mysqli->real_escape_string($_POST['band']) . "'
              WHERE id = '" . $_POST['id'] . "'";
    break;
  case "delete":
    $query = "DELETE FROM sotw WHERE id = '" . $_GET['id'] . "'";
    break;
}

$mysqli->query($query);

$mysqli->close();

header("Location: sotwindex.php");
?>