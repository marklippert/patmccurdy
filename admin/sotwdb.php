<?php
include_once "../inc/dbconfig.php";

if ($_GET['a'] == "add" || $_GET['a'] == "edit") {
  $enddate = ($_POST['enddate'] != "") ? strtotime($_POST['enddate'])+86399 : "";

  $array = [
    strtotime($_POST['startdate']),
    $enddate,
    gremlins($_POST['title']),
    gremlins($_POST['file']),
    gremlins($_POST['recat']),
    gremlins($_POST['band'])
  ];
}



switch ($_GET['a']) {
  case "add":
    $sql = "INSERT INTO sotw (startdate, enddate, title, file, recat, band ) VALUES (?,?,?,?,?,?)";
    break;
  case "edit":
    $sql = "UPDATE sotw SET startdate = ?, enddate = ?, title = ?, file = ?, recat = ?, band = ? WHERE id = ?";
    $array[] = $_POST['id'];
    break;
  case "delete":
    $sql = "DELETE FROM sotw WHERE id = ?";
    $array = [$_GET['id']];
    break;
}

$mysqli->execute_query($sql, $array);

$mysqli->close();

header("Location: sotwindex.php");
?>