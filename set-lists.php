<?php
include "inc/dbconfig.php";
$PageTitle = "Set Lists";

if ($_SERVER['QUERY_STRING'] != "" && $_REQUEST['search'] == "") {
  $result = mysql_query("SELECT * FROM setlists WHERE id ='" . $_SERVER['QUERY_STRING'] . "'");
  $row = mysql_fetch_array($result);
  $PageTitle .= " | " . date("F j, Y", strtotime($row['date'])) . " - " . $row['venue'];
}

include "header.php";

if ($_SERVER['QUERY_STRING'] != "" && $_REQUEST['search'] == "") {
  // Single show
  echo "<strong>" . date("F j, Y", strtotime($row['date'])) . "</strong><br>\n<strong>" . $row['venue'] . "</strong> ";
  
  if ($row['city'] != "") echo $row['city'];
  if ($row['city'] != "" && $row['state'] != "") echo ", ";
  if ($row['state'] != "") echo $row['state'];
  
  echo "<br><br>\n";
  
  if ($row['set1'] != "") echo "<strong>Set 1</strong><br>\n" . str_replace("\n", "<br>\n", $row['set1']) . "\n";
  if ($row['set2'] != "") echo "<br><br>\n<strong>Set 2</strong><br>\n" . str_replace("\n", "<br>\n", $row['set2']) . "\n";
  if ($row['set3'] != "") echo "<br><br>\n<strong>Set 3</strong><br>\n" . str_replace("\n", "<br>\n", $row['set3']) . "\n";
} else {
  if ($_REQUEST['search'] != "") {
    // Search results (part 1)
    $result = mysql_query("SELECT * FROM setlists WHERE approved = 'on' AND set1 LIKE '%" . $_REQUEST['search'] . "%' OR set2 LIKE '%" . $_REQUEST['search'] . "%' OR set3 LIKE '%" . $_REQUEST['search'] . "%' ORDER BY date DESC");
    
    $message = (mysql_num_rows($result) > 0) ? "The following shows matched your search:" : "Sorry, nothing found for \"" . $_REQUEST['search'] . "\"";
    echo "<h2>$message</h2><br>\n";
  } else {
    // Index page
    // Get last time the setlists table was updated
    $result = mysql_query("SHOW TABLE STATUS LIKE 'setlists'");
    $row = mysql_fetch_array($result);
    $lastupdate = date("F j, Y", strtotime($row['Update_time']));
    
    // Now get the actual data
    $result = mysql_query("SELECT * FROM setlists WHERE approved = 'on' ORDER BY date DESC");
    ?>
    
    For the completely obsessive only! This is a collection of set lists from random shows over the years that has been compiled by myself and others. Yes, we're all terribly sick. But if you're like us, you may be wondering what songs Pat played on October 18, 1998. If you're even more like us, you may even want to <a href="add-set-list.php">add a set list</a> yourself. Keep checking back, as this section will grow (we're sick, remember) as long as Pat keeps playing shows.<br>
    <br>
    
    <div class="half-left centered">
      <strong><?php echo mysql_num_rows($result); ?> shows currently available.</strong>
    </div>
    <div class="half-right centered">
      <strong>Last updated: <?php echo $lastupdate; ?></strong>
    </div>
    <div style="clear: both;"></div><br>
    
    <form action="set-lists.php" method="POST" class="search">
      <div>
        <input type="text" name="search" value="Search set lists" onClick="if(this.value=='Search set lists')this.value='';" onBlur="if(this.value=='')this.value='Search set lists';">
      </div>
    </form>
    <?php
  }
  
  while($row = mysql_fetch_array($result)) {
    ?>
    <a href="set-lists.php?<?php echo $row['id']; ?>"><?php echo date("F j, Y", strtotime($row['date'])) . " - " . $row['venue']; ?></a><br>
  <?php } ?>
  
  <br>
  <?php if ($_REQUEST['search'] != "") { ?>
    <form action="set-lists.php" method="POST" class="search">
      <div>
        <input type="text" name="search" value="Search again" onClick="if(this.value=='Search again')this.value='';" onBlur="if(this.value=='')this.value='Search again';">
      </div>
    </form>
  <?php
  }
}
?>

<?php include "footer.php"; ?>