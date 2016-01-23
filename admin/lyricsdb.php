<?php
include("../inc/dbconfig.php");

switch ($_GET['a']) {
  case "add":
    $query = "INSERT INTO lyrics (title,lyrics,album,album_track,band,approved) VALUES ('" . mysql_real_escape_string($_POST['title']) . "','" . mysql_real_escape_string($_POST['lyrics']) . "','" . mysql_real_escape_string($_POST['album']) . "','" . $_POST['album_track'] . "','" . $_POST['band'] . "', 'yes')";
    break;
  case "edit":
    $query = "UPDATE lyrics SET title = '" . mysql_real_escape_string($_POST['title']) . "', lyrics = '" . mysql_real_escape_string($_POST['lyrics']) . "', album = '" . mysql_real_escape_string($_POST['album']) . "', album_track = '" . $_POST['album_track'] . "', band = '" . $_POST['band'] . "', approved = '" . $_POST['approved'] . "' WHERE id = '" . $_POST['id'] . "'";
    break;
  case "delete":
    $table = ($_GET['l'] == "holding") ? "lyrics_holding" : "lyrics";
    $query = "DELETE FROM $table WHERE id = '" . $_GET['id'] . "'";
    break;
}

$mysqli->query($query);

$mysqli->close();

if (isset($_REQUEST['l'])) {
  $go = "lyricsindex.php?filter=" . $_REQUEST['l'];
} else {
  $go = "lyricsindex.php";
}

header( "Location: $go" );
?>