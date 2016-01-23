<?php
include "inc/dbconfig.php";

$result = $mysqli->query("SELECT * FROM lyrics WHERE id = '" . $_SERVER['QUERY_STRING'] . "'");
$row = $result->fetch_array(MYSQLI_BOTH);
$PageTitle = stripslashes($row['title']);

include "header.php";

$tresult = $mysqli->query("SELECT * FROM tabs WHERE title = \"" . stripslashes($row['title']) . "\"");

if ($tresult->num_rows > 0) {
  $trow = $tresult->fetch_array(MYSQLI_BOTH);
  echo "<a href=\"guitar-tabs.php?" . $trow['id'] . "\"><img src=\"images/guitar.gif\" alt=\"guitar tab\" style=\"vertical-align: middle; float: right;\"></a>";
}

$tresult->free();

$lyrics = str_replace("\n", "<br>", stripslashes($row['lyrics']));
$lyrics = str_replace("<br>", "<br>\n      ", $lyrics);
echo $lyrics . "\n";

$result->free();
$mysqli->close();

include "footer.php";
?>