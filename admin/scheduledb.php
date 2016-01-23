<?php
include("../inc/dbconfig.php");

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
              event
              ) VALUES (
              '" . $TheDate . "',
              '" . $_POST['displaytime'] . "',
              '" . $_POST['donttweet'] . "',
              '" . mysql_real_escape_string($_POST['venue']) . "',
              '" . mysql_real_escape_string($_POST['location']) . "',
              '" . $_POST['url'] . "',
              '" . mysql_real_escape_string($_POST['stage']) . "',
              '" . mysql_real_escape_string($_POST['additional']) . "',
              '" . $_POST['event'] . "'
              )";
    break;
  case "edit":
    $TheDate = strtotime($_POST['date'] . " " . $_POST['time']);
    $query = "UPDATE schedule SET 
              date = '" . $TheDate . "',
              displaytime = '" . $_POST['displaytime'] . "',
              donttweet = '" . $_POST['donttweet'] . "',
              venue = '" . mysql_real_escape_string($_POST['venue']) . "',
              location = '" . mysql_real_escape_string($_POST['location']) . "',
              url = '" . $_POST['url'] . "',
              stage = '" . mysql_real_escape_string($_POST['stage']) . "',
              additional = '" . mysql_real_escape_string($_POST['additional']) . "',
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