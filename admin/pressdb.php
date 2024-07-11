<?php
include_once "../inc/dbconfig.php";

if ($_GET['a'] == "add" || $_GET['a'] == "edit") {
  $array = [
    strtotime($_POST['date']),
    gremlins($_POST['date']),
    gremlins($_POST['source']),
    gremlins($_POST['source_url']),
    gremlins($_POST['title']),
    gremlins($_POST['subtitle']),
    gremlins($_POST['author']),
    gremlins($_POST['text'])
  ];
}

switch ($_GET['a']) {
  case "add":
    $sql = "INSERT INTO press (sort_date, date, source, source_url, title, subtitle, author, text) VALUES (?,?,?,?,?,?,?,?)";
    break;
  case "edit":
    $sql = "UPDATE press SET sort_date = ?, date = ?, source = ?, source_url = ?, title = ?, subtitle = ?, author = ?, text = ? WHERE id = ?";
    $array[] = $_POST['id'];
    break;
  case "delete":
    $sql = "DELETE FROM press WHERE id = ?";
    $array = [$_GET['id']];
    break;
}

$mysqli->execute_query($sql, $array);

$mysqli->close();

header("Location: pressindex.php");
?>