<?php
include_once "../inc/dbconfig.php";

if ($_GET['a'] == "add" || $_GET['a'] == "edit") {
  $array = [
    gremlins($_POST['title']),
    gremlins($_POST['tab']),
    gremlins($_POST['name']),
    gremlins($_POST['email'])
  ];
}

switch ($_GET['a']) {
  case "add":
    $sql = "INSERT INTO tabs (title, tab, name, email) VALUES (?,?,?,?)";
    break;
  case "edit":
    $sql = "UPDATE tabs SET title = ?, tab = ?, name = ?, email = ? WHERE id = ?";
    $array[] = $_POST['id'];
    break;
  case "delete":
    $sql = "DELETE FROM tabs WHERE id = ?";
    $array = [$_GET['id']];
    break;
}

$mysqli->execute_query($sql, $array);

$mysqli->close();

header("Location: tabsindex.php");
?>