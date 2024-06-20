<?php
include("../inc/dbconfig.php");

if ($_GET['a'] == "add" || $_GET['a'] == "edit") {
  $approved = (isset($row['approved'])) ? "on" : "";
  $array = [date("Ymd", strtotime($_POST['date'])), gremlins($_POST['venue']), gremlins($_POST['city']), gremlins($_POST['state']), gremlins($_POST['set1']), gremlins($_POST['set2']), gremlins($_POST['set3']), $approved];
}

switch ($_GET['a']) {
  case "add":
    $sql = "INSERT INTO setlists (date, venue, city, state, set1, set2, set3, approved) VALUES (?,?,?,?,?,?,?,?)";

    break;
  case "edit":
    $sql = "UPDATE setlists SET date = ?, venue = ?, city = ?, state = ?, set1 = ?, set2 = ?, set3 = ?, approved = ? WHERE id = ?";
    $array[] = $_POST['id'];

    break;
  case "delete":
    $sql = "DELETE FROM setlists WHERE id = ?";
    $array = [$_GET['id']];

    break;
  case "approve":
    $sql = "UPDATE setlists SET approved = IF(approved='on', '', 'on') WHERE id = ?";
    $array = [$_GET['id']];

    break;
}

$mysqli->execute_query($sql, $array);

$mysqli->close();

header("Location: setlistsindex.php");
?>