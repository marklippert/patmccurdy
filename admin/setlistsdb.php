<?php
include("../inc/dbconfig.php");

switch ($_GET['a']) {
  case "add":
    // Format the date
    $date = date("Ymd", strtotime($_POST['date']));
    
    $query = "INSERT INTO setlists (
              date,
              venue,
              city,
              state,
              set1,
              set2,
              set3,
              approved
              ) VALUES (
              '" . $date . "',
              '" . mysql_real_escape_string($_POST['venue']) . "',
              '" . mysql_real_escape_string($_POST['city']) . "',
              '" . mysql_real_escape_string($_POST['state']) . "',
              '" . mysql_real_escape_string($_POST['set1']) . "',
              '" . mysql_real_escape_string($_POST['set2']) . "',
              '" . mysql_real_escape_string($_POST['set3']) . "',
              '" . $_POST['approved'] . "'
              )";
    break;
  case "edit":
    // Format the date
    $date = date("Ymd", strtotime($_POST['date']));
    
    $query = "UPDATE setlists SET
              date = '" . $date . "',
              venue = '" . mysql_real_escape_string($_POST['venue']) . "',
              city = '" . mysql_real_escape_string($_POST['city']) . "',
              state = '" . mysql_real_escape_string($_POST['state']) . "',
              set1 = '" . mysql_real_escape_string($_POST['set1']) . "',
              set2 = '" . mysql_real_escape_string($_POST['set2']) . "',
              set3 = '" . mysql_real_escape_string($_POST['set3']) . "',
              approved = '" . $_POST['approved'] . "'
              WHERE id = '" . $_POST['id'] . "'";
    break;
  case "delete":
    $query = "DELETE FROM setlists WHERE id = '" . $_GET['id'] . "'";
    break;
  case "approve":
    // Get the current approve state and toggle it
    $result = $mysqli->query("SELECT * FROM setlists WHERE id = '" . $_GET['id'] . "'");
    $row = $result->fetch_array(MYSQLI_BOTH);
    $approved = (empty($row['approved'])) ? "on" : "";
    
    $query = "UPDATE setlists SET approved = '" . $approved . "' WHERE id = '" . $_GET['id'] . "'";

    $result->free();
    break;
}

$mysqli->query($query);

$mysqli->close();

header( "Location: setlistsindex.php" );
?>