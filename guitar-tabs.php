<?php
include "inc/dbconfig.php";
$PageTitle = "Guitar Tabs";

if ($_SERVER['QUERY_STRING'] != "") {
  $tabs = $mysqli->query("SELECT * FROM tabs WHERE id ='" . $_SERVER['QUERY_STRING'] . "'");
  $tab = $tabs->fetch_array(MYSQLI_ASSOC);
  $PageTitle .= " | " . $tab['title'];
}

include "header.php";

if ($_SERVER['QUERY_STRING'] != "") {
  echo "<h2>" . $tab['title'] . "</h2>\n";
  
  if ($tab['name'] != "" || $tab['email'] != "") {
    echo "Tabbed by ";
    if ($tab['email'] != "") {
      email($tab['email'], $tab['name']);
    } else {
      echo $tab['name'];
    }
  }
  
  echo "<br>\n<pre>" . $tab['tab'] . "</pre>";
} else {
  $tabs = $mysqli->query("SELECT * FROM tabs ORDER BY title ASC");
  
  while($tab = $tabs->fetch_array(MYSQLI_ASSOC)) {
    ?>
    <a href="guitar-tabs.php?<?php echo $tab['id']; ?>"><?php echo $tab['title']; ?></a><br>
    <?php
  }
}

include "footer.php";
?>