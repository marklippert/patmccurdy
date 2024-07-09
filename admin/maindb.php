<?php
include_once "../inc/dbconfig.php";

if ($_GET['a'] == "add" || $_GET['a'] == "edit") {
  $array = [
    strtotime($_POST['enddate']),
    gremlins($_POST['title']),
    gremlins($_POST['text']),
    gremlins($_POST['appears'])
  ];
}

switch ($_GET['a']) {
  case "add":
    $sql = "INSERT INTO main (enddate, title, text, appears, date) VALUES (?,?,?,?,?)";
    $array[] = time();
    break;
  case "edit":
    $sql = "UPDATE main SET enddate = ?, title = ?, text = ?, appears = ? WHERE id = ?";
    $array[] = $_POST['id'];
    break;
  case "delete":
    $sql = "DELETE FROM main WHERE id = ?";
    $array = [$_GET['id']];
    
    break;
}

$mysqli->execute_query($sql, $array);

$mysqli->close();

header("Location: mainindex.php");
?>