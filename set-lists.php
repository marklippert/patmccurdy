<?php
include "inc/dbconfig.php";
$PageTitle = "Set Lists";
$Description = "Want to know what was played on July 10, 1994? Find out here.";

if ($_SERVER['QUERY_STRING'] != "" && !isset($_REQUEST['search'])) {
  $setlists = $mysqli->query("SELECT * FROM setlists WHERE id ='" . $_SERVER['QUERY_STRING'] . "'");
  $setlist = $setlists->fetch_array(MYSQLI_ASSOC);
  $PageTitle .= " | " . date("F j, Y", strtotime($setlist['date'])) . " - " . $setlist['venue'];
}

include "header.php";

if ($_SERVER['QUERY_STRING'] != "" && !isset($_REQUEST['search'])) {
  // Single show
  echo "<h3>" . date("F j, Y", strtotime($setlist['date'])) . "</h3>\n<h4>" . $setlist['venue'] . "</h4>";
  
  if ($setlist['city'] != "") echo $setlist['city'];
  if ($setlist['city'] != "" && $setlist['state'] != "") echo ", ";
  if ($setlist['state'] != "") echo $setlist['state'];
  
  echo "<br><br>\n";
  
  if ($setlist['set1'] != "") echo "<h5>Set 1</h5>\n" . str_replace("\n", "<br>\n", $setlist['set1']) . "\n";
  if ($setlist['set2'] != "") echo "<br><br>\n<h5>Set 2</h5>\n" . str_replace("\n", "<br>\n", $setlist['set2']) . "\n";
  if ($setlist['set3'] != "") echo "<br><br>\n<h5>Set 3</h5>\n" . str_replace("\n", "<br>\n", $setlist['set3']) . "\n";
} else {
  if (isset($_REQUEST['search'])) {
    // Search results (part 1)
    $setlists = $mysqli->query("SELECT * FROM setlists WHERE approved = 'on' AND set1 LIKE \"%" . $_REQUEST['search'] . "%\" OR set2 LIKE \"%" . $_REQUEST['search'] . "%\" OR set3 LIKE \"%" . $_REQUEST['search'] . "%\" ORDER BY date DESC");
    
    $message = ($setlists->num_rows > 0) ? "The following shows matched your search:" : "Sorry, nothing found for \"" . $_REQUEST['search'] . "\"";
    echo "<h2>$message</h2>\n";
  } else {
    // Index page
    // Get last time the setlists table was updated
    $updates = $mysqli->query("SHOW TABLE STATUS LIKE 'setlists'");
    $update = $updates->fetch_array(MYSQLI_ASSOC);
    
    // Now get the actual data
    $setlists = $mysqli->query("SELECT * FROM setlists WHERE approved = 'on' ORDER BY date DESC");
    ?>
    
    For the completely obsessive only! This is a collection of set lists from random shows over the years that has been compiled by myself and others. Yes, we're all terribly sick. But if you're like us, you may be wondering what songs Pat played on October 19, 2007. If you're even more like us, you may even want to <a href="add-set-list.php">add a set list</a> yourself. Keep checking back, as this section will grow (we're sick, remember) as long as Pat keeps playing shows.<br>
    <br>
    
    <div id="setlists-data">
      <strong><?php echo $setlists->num_rows; ?> shows currently available.</strong>
      <strong>Last updated: <?php echo date("F j, Y", strtotime($update['Update_time'])); ?></strong>
    </div>
    <br>
    
    <form action="set-lists.php" method="POST" id="setlist-search">
      <div>
        <input type="text" name="search" placeholder="Search set lists"><input type="submit" name="submit" value="Search">
      </div>
    </form>
    <br>
    <?php
  }
  
  while($setlist = $setlists->fetch_array(MYSQLI_ASSOC)) {
    ?>
    <a href="set-lists.php?<?php echo $setlist['id']; ?>"><?php echo date("F j, Y", strtotime($setlist['date'])) . " - " . $setlist['venue']; ?></a><br>
  <?php } ?>
  <br>

  <?php if (isset($_REQUEST['search'])) { ?>
    <form action="set-lists.php" method="POST" id="setlist-search">
      <div>
        <input type="text" name="search" placeholder="Search again"><input type="submit" name="submit" value="Search">
      </div>
    </form>
  <?php
  }
}
?>

<?php include "footer.php"; ?>