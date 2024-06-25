<?php
include_once "inc/dbconfig.php";

if ($_POST['date'] != "") {
  if ($_POST['username'] == "") {
    // Insert into database
    $sql = "INSERT INTO setlists (date, venue, city, state, set1, set2, set3, approved) VALUES (?,?,?,?,?,?,?,?)";

    $array = [
      preg_replace("/[^0-9]/", "", $_POST['date']),
      gremlins($_POST['venue']),
      gremlins($_POST['city']),
      gremlins($_POST['state']),
      gremlins($_POST['set1']),
      gremlins($_POST['set2']),
      gremlins($_POST['set3']),
      ""
    ];

    $mysqli->execute_query($sql, $array);

    // Send email
    $SendTo = "webmaster@patmccurdy.com";
    $Subject = "Set List Submitted";
    $Headers = "From: PatBot <donotreply@patmccurdy.com>\r\n";

    $Message = "Set List submitted for ".$_POST['date'];

    $Message .= "\n\n";

    $Message = stripslashes($Message);

    mail($SendTo, $Subject, $Message, $Headers);

    $feedback = "<h3>Thanks for your set list</h3>However, thanks to spammers, your addition will have to be approved by the webmaster before it is displayed here. He has been notified and it should show up soon (assuming you're not some scumbag posting crap). Have a nice day.";
  } // Honeypot
} else {
  $feedback = "<strong>Some required information is missing! Please go back and make sure all required fields are filled.</strong><br><br>";
} // Required fields

echo $feedback;
?>