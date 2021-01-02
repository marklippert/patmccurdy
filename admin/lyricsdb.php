<?php
include("../inc/dbconfig.php");

switch ($_GET['a']) {
  case "add":
    $query = "INSERT INTO lyrics (title,lyrics,album,album_track,band,approved) VALUES ('" . $mysqli->real_escape_string($_POST['title']) . "','" . $mysqli->real_escape_string($_POST['lyrics']) . "','" . $_POST['album'] . "','" . $_POST['album_track'] . "','" . $_POST['band'] . "', 'yes')";
    break;
  case "edit":
    $query = "UPDATE lyrics SET title = '" . $mysqli->real_escape_string($_POST['title']) . "', lyrics = '" . $mysqli->real_escape_string($_POST['lyrics']) . "', album = '" . $_POST['album'] . "', album_track = '" . $_POST['album_track'] . "', band = '" . $_POST['band'] . "', approved = 'yes' WHERE id = '" . $_POST['id'] . "'";
    break;
  case "delete":
    $table = ($_GET['l'] == "holding") ? "lyrics_holding" : "lyrics";
    $query = "DELETE FROM $table WHERE id = '" . $_GET['id'] . "'";
    break;
}

$mysqli->query($query) or die($mysqli->error);

$go = (isset($_REQUEST['l'])) ? "lyricsindex.php?filter=" . $_REQUEST['l'] : "lyricsindex.php";

header("Location: ".$go);
?>