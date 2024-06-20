<?php
include("../inc/dbconfig.php");

if ($_GET['a'] == "add" || $_GET['a'] == "edit") $array = [gremlins($_POST['title']), gremlins($_POST['lyrics']), $_POST['album'], gremlins($_POST['album_track']), $_POST['band'], gremlins($_POST['apple']), gremlins($_POST['amazon']), "yes"];

switch ($_GET['a']) {
  case "add":
    $sql = "INSERT INTO lyrics (title, lyrics, album, album_track, band, apple, amazon, approved) VALUES (?,?,?,?,?,?,?,?)";

    break;
  case "edit":
    $sql = "UPDATE lyrics SET title = ?, lyrics = ?, album = ?, album_track = ?, band = ?, apple = ?, amazon = ?, approved = ? WHERE id = ?";
    $array[] = $_POST['id'];

    break;
  case "delete":
    $table = ($_GET['l'] == "holding") ? "lyrics_holding" : "lyrics";
    $sql = "DELETE FROM $table WHERE id = ?";
    $array = [$_GET['id']];
    
    break;
}

$mysqli->execute_query($sql, $array);

$mysqli->close();

$go = (isset($_REQUEST['l'])) ? "lyricsindex.php?filter=" . $_REQUEST['l'] : "lyricsindex.php";

header("Location: ".$go);
?>