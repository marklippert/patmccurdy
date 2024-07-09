<?php
include "inc/dbconfig.php";
$PageTitle = "Guitar Tabs";
$Description = "Learn to play many of Pat's songs.";

if ($_SERVER['QUERY_STRING'] != "") {
  $tabs = $mysqli->execute_query("SELECT * FROM tabs WHERE id = ?", [$_SERVER['QUERY_STRING']]);
  $tab = $tabs->fetch_assoc();
  $PageTitle .= " | ".$tab['title'];
}

include "header.php";

if ($_SERVER['QUERY_STRING'] != "") {
  echo "<h2>".$tab['title']."</h2>\n";
  
  if ($tab['name'] != "" || $tab['email'] != "") {
    echo "Tabbed by ";
    if ($tab['email'] != "") {
      email($tab['email'], $tab['name']);
    } else {
      echo $tab['name'];
    }
    echo "<br>\n";
  }
  
  echo "<pre>".$tab['tab']."</pre>\n";
} else {
  $tabs = $mysqli->execute_query("SELECT * FROM tabs ORDER BY title ASC");
  
  foreach ($tabs as $tab) {
    ?>
    <a href="guitar-tabs.php?<?php echo $tab['id']; ?>"><?php echo $tab['title']; ?></a><br>
    <?php
  }
}

include "footer.php";
?>