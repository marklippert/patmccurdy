<?php
include "inc/dbconfig.php";

$PageTitle = "Song not found";

$result = $mysqli->query("SELECT * FROM lyrics WHERE id = '" . $_SERVER['QUERY_STRING'] . "'");
if (!empty($result) && $result->num_rows > 0) {
  $row = $result->fetch_array(MYSQLI_ASSOC);
  $PageTitle = stripslashes($row['title']);
}

include "header.php";

if (!empty($result) && $result->num_rows > 0) {
  $tresult = $mysqli->query("SELECT * FROM tabs WHERE title = \"" . stripslashes($row['title']) . "\"");

  if (!empty($tresult) && $tresult->num_rows > 0) {
    $trow = $tresult->fetch_array(MYSQLI_ASSOC);
    echo "<a href=\"guitar-tabs.php?" . $trow['id'] . "\"><img src=\"images/guitar.gif\" alt=\"guitar tab\" style=\"vertical-align: middle; float: right;\"></a>";
  }

  $tresult->free();

  $lyrics = str_replace("\n", "<br>", stripslashes($row['lyrics']));
  $lyrics = str_replace("<br>", "<br>\n      ", $lyrics);
  echo $lyrics . "\n";
} else {
  echo "Song not found";
}

$result->free();
$mysqli->close();

include "footer.php";
?>