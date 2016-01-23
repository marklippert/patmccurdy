<?php
include "inc/dbconfig.php";
$PageTitle = "Guitar Tabs";

if ($_SERVER['QUERY_STRING'] != "") {
  $result = mysql_query("SELECT * FROM tabs WHERE id ='" . $_SERVER['QUERY_STRING'] . "'");
  $row = mysql_fetch_array($result);
  $PageTitle .= " | " . $row['title'];
}

include "header.php";

if ($_SERVER['QUERY_STRING'] != "") {
  echo "<h2>" . $row['title'] . "</h2>\n";
  
  if ($row['name'] != "" || $row['email'] != "") {
    echo "Tabbed by ";
    if ($row['email'] != "") {
      email($row['email'], $row['name']);
    } else {
      echo $row['name'];
    }
  }
  
  echo "<br>\n<pre>" . $row['tab'] . "</pre>";
} else {
  $result = mysql_query("SELECT * FROM tabs ORDER BY title ASC");
  
  while($row = mysql_fetch_array($result)) {
    ?>
    <a href="guitar-tabs.php?<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a><br>
    <?php
  }
}

include "footer.php";
?>