<?php
include_once "../inc/dbconfig.php";
include "login.php";
$PageTitle = "Never Have Been Song of the Week";
include "header.php";

echo "<h3>Never Have Been Song of the Week</h3>\n";

$songs = $mysqli->execute_query("SELECT lyrics.album,lyrics.title FROM lyrics LEFT OUTER JOIN sotw ON lyrics.title = sotw.title WHERE sotw.title is null AND lyrics.album = '0' ORDER BY lyrics.title ASC");

foreach($songs as $song) {
  echo '<a href="../set-lists.php?search='.$song['title'].'" target="new">'.$song['title']."</a><br>\n";
}

$songs->free();

$mysqli->close();

include "footer.php";
?>