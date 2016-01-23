<?php
include "inc/dbconfig.php";
$PageTitle = "Add Set List";
include "header.php";

// Settings for randomizing the field names
$ip = $_SERVER['REMOTE_ADDR'];
$timestamp = time();
$salt = "Lippert";
?>

<?php
if (isset($_POST['submit']) && $_POST['confirmationCAP'] == "") {
  if (
      $_POST[md5('month' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
      $_POST[md5('day' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
      $_POST[md5('year' . $_POST['ip'] . $salt . $_POST['timestamp'])] != ""
    ) {
    // All required fields have been filled, so construct the message
    // Cleanse the date because I just don't trust users
    $date = date("Ymd", strtotime($_POST['month'] . "/" . $_POST['day'] . "/" . $_POST['year']));
    
    // Insert into database
    mysql_query("INSERT INTO setlists (date,venue,city,state,set1,set2,set3) VALUES ('" . $date . "','" . mysql_real_escape_string($_POST['venue']) . "','" . mysql_real_escape_string($_POST['city']) . "','" . mysql_real_escape_string($_POST['state']) . "','" . mysql_real_escape_string($_POST['set1']) . "','" . mysql_real_escape_string($_POST['set2']) . "','" . mysql_real_escape_string($_POST['set3']) . "')");
    
    // Notify me
    mail("webmaster@patmccurdy.com", "Set List Submitted", "Set List submitted for \"" . $_POST['date'] . "\"", "From: donotreply@patmccurdy.com");
    
    // Thank the submitter
    echo "<strong>Thanks for your set list addition</strong><br>
    However, thanks to spammers, your addition will have to be approved by the webmaster before it is displayed here.  He has been notified and it should show up soon (assuming you're not some scumbag posting crap).  Have a nice day.<br>
    <br>
    <center><a href=\"add-set-list.php\">Add another set list!</a>  (If you have one.  No pressure.)</center>\n";
  } else {
    echo "<strong>Some required information is missing! Please go back and make sure all required fields are filled.</strong>";
  }
} else {
?>

<script type="text/javascript">
  function checkform (form) {
    if (document.getElementById('month').value == "") { alert('Month required.'); document.getElementById('month').focus(); return false ; }
    if (document.getElementById('day').value == "") { alert('Day required.'); document.getElementById('day').focus(); return false ; }
    if (document.getElementById('year').value == "") { alert('Year required.'); document.getElementById('year').focus(); return false ; }
    return true ;
  }
</script>

<form action="add-set-list.php" method="POST" onsubmit="return checkform(this)">
  <div>
    <strong>Date</strong> (mm/dd/yyyy) <span style="color: #5F2E1F;">* required</span><br>
    <input type="text" name="<?php echo md5("month" . $ip . $salt . $timestamp); ?>" id="month" style="width: 2em;"> / 
    <input type="text" name="<?php echo md5("day" . $ip . $salt . $timestamp); ?>" id="day" style="width: 2em;"> / 
    <input type="text" name="<?php echo md5("year" . $ip . $salt . $timestamp); ?>" id="year" style="width: 4em;"><br>
    <br>
    
    <strong>Venue</strong><br>
    <input type="text" name="<?php echo md5("venue" . $ip . $salt . $timestamp); ?>" id="venue" style="width: 100%;"><br>
    <br>
    
    <div class="three-fourth-left">
      <strong>City</strong><br>
      <input type="text" name="<?php echo md5("city" . $ip . $salt . $timestamp); ?>" id="city" style="width: 100%;"><br>
      <br>
    </div>
    
    <div class="one-fourth-right">
      <strong>State</strong><br>
      <input type="text" name="<?php echo md5("state" . $ip . $salt . $timestamp); ?>" id="state" style="width: 100%;"><br>
      <br>
    </div>
    
    <div style="clear: both;"></div>
    
    <strong>Set 1</strong><br>
    <textarea name="<?php echo md5("set1" . $ip . $salt . $timestamp); ?>" id="set1" cols="20" rows="20" style="width: 100%; height: 15em;"></textarea><br>
    <br>
    
    <strong>Set 2</strong><br>
    <textarea name="<?php echo md5("set2" . $ip . $salt . $timestamp); ?>" id="set2" cols="20" rows="20" style="width: 100%; height: 15em;"></textarea><br>
    <br>
    
    <strong>Set 3</strong><br>
    <textarea name="<?php echo md5("set3" . $ip . $salt . $timestamp); ?>" id="set3" cols="20" rows="20" style="width: 100%; height: 15em;"></textarea><br>
    <br>

    <input type="text" name="confirmationCAP" style="display: none;"> <?php // Non-displaying field as a sort of invisible CAPTCHA. ?>
      
    <input type="hidden" name="ip" value="<?php echo $ip; ?>">
    <input type="hidden" name="timestamp" value="<?php echo $timestamp; ?>">
    
    <input type="submit" name="submit" value="Add" style="display: block; margin: 0 auto;">
  </div>
</form>

<?php } ?>

<?php include "footer.php"; ?>