<?php
include "../inc/dbconfig.php";
include "login.php";
$PageTitle = "Past Songs of the Week";
include "header.php";
?>

<h3>Past Songs of the Week</h3>

<strong>Yipes!</strong><br>
<div style="-webkit-columns: 2; -moz-columns: 2; columns: 2;">
  <?php
  $result = $mysqli->query("SELECT title, MAX(startdate) FROM `sotw` WHERE `startdate` >= 1000000000 AND `band` LIKE '%Yipes%' GROUP BY `title` ORDER BY MAX(startdate) ASC");

  while($row = $result->fetch_array(MYSQLI_BOTH)) {
    echo date("m/d/y", $row['MAX(startdate)']) . " <strong>" . $row['title'] . "</strong><br>\n";
  }

  $result->free();
  ?>
</div>

<br><br>

<strong>Men About Town</strong><br>
<div style="-webkit-columns: 2; -moz-columns: 2; columns: 2;">
  <?php
  $result = $mysqli->query("SELECT title, MAX(startdate) FROM `sotw` WHERE `startdate` >= 1000000000 AND `band` LIKE '%Men About Town%' GROUP BY `title` ORDER BY MAX(startdate) ASC");

  while($row = $result->fetch_array(MYSQLI_BOTH)) {
    echo date("m/d/y", $row['MAX(startdate)']) . " <strong>" . $row['title'] . "</strong><br>\n";
  }

  $result->free();
  ?>
</div>

<br><br>

<strong>Confidentials</strong><br>
<div style="-webkit-columns: 2; -moz-columns: 2; columns: 2;">
  <?php
  $result = $mysqli->query("SELECT title, MAX(startdate) FROM `sotw` WHERE `startdate` >= 1000000000 AND `band` LIKE '%Confidentials%' GROUP BY `title` ORDER BY MAX(startdate) ASC");

  while($row = $result->fetch_array(MYSQLI_BOTH)) {
    echo date("m/d/y", $row['MAX(startdate)']) . " <strong>" . $row['title'] . "</strong><br>\n";
  }

  $result->free();
  ?>
</div>

<br>

<?php
$mysqli->close();

include "footer.php";
?>