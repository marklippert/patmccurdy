<?php
include("../inc/dbconfig.php");
include "login.php";
$PageTitle = "Never Have Been Song of the Week";
include "header.php";
?>

<h3>Never Have Been Song of the Week</h3>

<?php
$result = $mysqli->query("SELECT lyrics.album,lyrics.title FROM lyrics LEFT OUTER JOIN sotw ON lyrics.title = sotw.title WHERE sotw.title is null AND lyrics.album = '0' ORDER BY lyrics.title ASC");

while($row = $result->fetch_array(MYSQLI_BOTH)) {
  echo "<a href=\"../set-lists.php?search=" . $row['title'] . "\" target=\"new\">" . $row['title'] . "</a><br>\n";
}

$result->free();
?>

<?php
$mysqli->close();

include "footer.php";
?>