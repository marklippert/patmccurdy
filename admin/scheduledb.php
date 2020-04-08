<?php
include("../inc/dbconfig.php");

if ($_GET['a'] != "delete") {
  $displaytime = (isset($_POST['displaytime'])) ? "yes" : "";
  $donttweet = (isset($_POST['donttweet'])) ? "yes" : "";
}

switch ($_GET['a']) {
  case "add":
    $TheDate = strtotime($_POST['date'] . " " . $_POST['time']);
    $query = "INSERT INTO schedule (
              date,
              displaytime,
              donttweet,
              venue,
              location,
              url,
              stage,
              additional,
              event,
              status
              ) VALUES (
              '" . $TheDate . "',
              '" . $displaytime . "',
              '" . $donttweet . "',
              '" . $mysqli->real_escape_string($_POST['venue']) . "',
              '" . $mysqli->real_escape_string($_POST['location']) . "',
              '" . $_POST['url'] . "',
              '" . $mysqli->real_escape_string($_POST['stage']) . "',
              '" . $mysqli->real_escape_string($_POST['additional']) . "',
              '',
              ''
              )";
    break;
  case "edit":
    $TheDate = strtotime($_POST['date'] . " " . $_POST['time']);
    $query = "UPDATE schedule SET 
              date = '" . $TheDate . "',
              displaytime = '" . $displaytime . "',
              donttweet = '" . $donttweet . "',
              venue = '" . $mysqli->real_escape_string($_POST['venue']) . "',
              location = '" . $mysqli->real_escape_string($_POST['location']) . "',
              url = '" . $_POST['url'] . "',
              stage = '" . $mysqli->real_escape_string($_POST['stage']) . "',
              additional = '" . $mysqli->real_escape_string($_POST['additional']) . "',
              event = '" . $_POST['event'] . "',
              status = '" . $_POST['status'] . "'
              WHERE id = '" . $_POST['id'] . "'";
    break;
  case "delete":
    $query = "DELETE FROM schedule WHERE id = '" . $_GET['id'] . "'";
    break;
}

$mysqli->query($query);

$mysqli->close();

$go = (isset($_GET['b'])) ? "?b=" . $_GET['b'] : "";

header( "Location: scheduleindex.php$go" );
?>