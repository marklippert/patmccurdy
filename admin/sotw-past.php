<?php
include_once "../inc/dbconfig.php";
include "login.php";
$PageTitle = "Past Songs of the Week";
include "header.php";

function ShowSongs($band) {
  global $mysqli;

  echo "<strong>".$band."</strong><br>\n";
  echo '<div style="columns: 2;">'."\n";

  $result = $mysqli->execute_query("SELECT title, MAX(startdate) FROM sotw WHERE startdate >= 1000000000 AND band LIKE ? GROUP BY title ORDER BY MAX(startdate) ASC", ["%{$band}%"]);

  foreach ($result as $row) {
    echo date("m/d/y", $row['MAX(startdate)'])." <strong>".$row['title']."</strong><br>\n";
  }

  $result->free();

  echo "</div>\n<br><br>\n";
}

echo "<h3>Past Songs of the Week</h3>\n";

ShowSongs("Yipes");
ShowSongs("Men About Town");
ShowSongs("Confidentials");

$mysqli->close();

include "footer.php";
?>