<?php
include "inc/dbconfig.php";
$PageTitle = "Add A Set List";
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
    $date = date("Ymd", strtotime($_POST[md5('month' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "/" . $_POST[md5('day' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "/" . $_POST[md5('year' . $_POST['ip'] . $salt . $_POST['timestamp'])]));
    
    // Insert into database
    $mysqli->query("INSERT INTO setlists (date,venue,city,state,set1,set2,set3,approved) VALUES (
      '" . $date . "',
      '" . $mysqli->real_escape_string($_POST[md5('venue' . $_POST['ip'] . $salt . $_POST['timestamp'])]) . "',
      '" . $mysqli->real_escape_string($_POST[md5('city' . $_POST['ip'] . $salt . $_POST['timestamp'])]) . "',
      '" . $mysqli->real_escape_string($_POST[md5('state' . $_POST['ip'] . $salt . $_POST['timestamp'])]) . "',
      '" . $mysqli->real_escape_string($_POST[md5('set1' . $_POST['ip'] . $salt . $_POST['timestamp'])]) . "',
      '" . $mysqli->real_escape_string($_POST[md5('set2' . $_POST['ip'] . $salt . $_POST['timestamp'])]) . "',
      '" . $mysqli->real_escape_string($_POST[md5('set3' . $_POST['ip'] . $salt . $_POST['timestamp'])]) . "',
      '')"
    );
    
    // Notify me
    $Message = 'Set List submitted for ' . $_POST[md5('month' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "/" . $_POST[md5('day' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "/" . $_POST[md5('year' . $_POST['ip'] . $salt . $_POST['timestamp'])];
    mail("webmaster@patmccurdy.com", "Set List Submitted", "Set List submitted for \"" . $_POST[md5('month' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "/" . $_POST[md5('day' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "/" . $_POST[md5('year' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "\"", "From: donotreply@patmccurdy.com");
    
    // Thank the submitter
    echo "<h2>Thanks for your set list addition</h2>
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

<form action="add-set-list.php" method="POST" id="addsetlist" onsubmit="return checkform(this)">
  <div>
    <label>Date <span style="font-weight: 400;">(mm/dd/yyyy) <span style="color: #5F2E1F;">* required</span></span><br>
      <input type="number" pattern="[0-9]*" name="<?php echo md5("month" . $ip . $salt . $timestamp); ?>" id="month"> / 
      <input type="number" pattern="[0-9]*" name="<?php echo md5("day" . $ip . $salt . $timestamp); ?>" id="day"> / 
      <input type="number" pattern="[0-9]*" name="<?php echo md5("year" . $ip . $salt . $timestamp); ?>" id="year">
    </label>
    
    <label>Venue
      <input type="text" name="<?php echo md5("venue" . $ip . $salt . $timestamp); ?>">
    </label>
    
    <div id="citystate">
      <label id="city">City
        <input type="text" name="<?php echo md5("city" . $ip . $salt . $timestamp); ?>">
      </label>

      <label id="state">State
        <input type="text" name="<?php echo md5("state" . $ip . $salt . $timestamp); ?>">
      </label>
    </div>

    <label>Set 1
      <textarea name="<?php echo md5("set1" . $ip . $salt . $timestamp); ?>"></textarea>
    </label>
    
    <label>Set 2
    <textarea name="<?php echo md5("set2" . $ip . $salt . $timestamp); ?>"></textarea>
    </label>
    
    <label>Set 3
    <textarea name="<?php echo md5("set3" . $ip . $salt . $timestamp); ?>"></textarea>
    </label>

    <input type="text" name="confirmationCAP" style="display: none;"> <?php // Non-displaying field as a sort of invisible CAPTCHA. ?>
      
    <input type="hidden" name="ip" value="<?php echo $ip; ?>">
    <input type="hidden" name="timestamp" value="<?php echo $timestamp; ?>">
    
    <input type="submit" name="submit" value="Add">
  </div>
</form>

<?php } ?>

<?php include "footer.php"; ?>