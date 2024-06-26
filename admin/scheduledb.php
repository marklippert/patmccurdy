<?php
include_once "../inc/dbconfig.php";

if ($_GET['a'] == "add" || $_GET['a'] == "edit") {
  $TheDate = strtotime($_POST['date'] . " " . $_POST['time']);
  $displaytime = (isset($_POST['displaytime'])) ? "yes" : "";
  $donttweet = (isset($_POST['donttweet'])) ? "yes" : "";
  $status = (isset($_POST['status'])) ? $_POST['status'] : "";

  $array = [
    $TheDate,
    $displaytime,
    $donttweet,
    gremlins($_POST['venue']),
    gremlins($_POST['location']),
    gremlins($_POST['url']),
    gremlins($_POST['stage']),
    gremlins($_POST['additional']),
    "",
    $status
  ];
}

switch ($_GET['a']) {
  case "add":
    $sql = "INSERT INTO schedule (date, displaytime, donttweet, venue, location, url, stage, additional, event, status) VALUES (?,?,?,?,?,?,?,?,?,?)";

    break;
  case "edit":
    $sql = "UPDATE schedule SET date = ?, displaytime = ?, donttweet = ?, venue = ?, location = ?, url = ?, stage = ?, additional = ?, event = ?, status = ? WHERE id = ?";
    $array[] = $_POST['id'];

    break;
  case "delete":
    $sql = "DELETE FROM schedule WHERE id = ?";
    $array = [$_GET['id']];
    
    break;
}

$mysqli->execute_query($sql, $array);

$go = (isset($_GET['b'])) ? "?b=".$_GET['b'] : "";

header("Location: scheduleindex.php".$go);
?>