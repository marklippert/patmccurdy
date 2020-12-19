<?php
include "inc/dbconfig.php";

$ContentClass = "song";
$PageTitle = "Song not found";

$songs = $mysqli->query("SELECT * FROM lyrics WHERE id = '" . $_SERVER['QUERY_STRING'] . "'");
if (!empty($songs) && $songs->num_rows > 0) {
  $song = $songs->fetch_array(MYSQLI_ASSOC);
  $PageTitle = stripslashes($song['title']);
}

include "header.php";

if (!empty($songs) && $songs->num_rows > 0) {
  $tabs = $mysqli->query("SELECT * FROM tabs WHERE title = \"" . ($song['title']) . "\"");

  if (!empty($tabs) && $tabs->num_rows > 0) {
    $tab = $tabs->fetch_array(MYSQLI_ASSOC);
    echo '<a href="guitar-tabs.php?' . $tab['id'] . '" title="Guitar Tabs" class="tab"></a>';
  }

  $lyrics = str_replace("\n", "<br>", stripslashes($song['lyrics']));
  $lyrics = str_replace("<br>", "<br>\n      ", $lyrics);
  echo $lyrics . "\n";
} else {
  echo "Song not found";
}

include "footer.php";
?>