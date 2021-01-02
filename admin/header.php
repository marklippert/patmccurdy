<?php
include_once("../inc/dbconfig.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pat McCurdy Administration<?php if (isset($PageTitle)) echo " | " . $PageTitle; ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
    <link rel="apple-touch-icon" href="../images/apple-touch-icon.png">

    <link rel="stylesheet" href="../inc/main.css?<?php echo filemtime('../inc/main.css'); ?>">
    <link rel="stylesheet" href="inc/admin.css?<?php echo filemtime('inc/admin.css'); ?>">

    <script type="text/javascript" src="../inc/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="inc/bootstrap-datepicker.css" type="text/css" media="screen,print">
    <script type="text/javascript" src="inc/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" href="inc/jquery.timepicker.css" type="text/css" media="screen,print">
    <script type="text/javascript" src="inc/jquery.timepicker.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("a[href^='http']").not("[href*='" + window.location.host + "']").prop('target','new');
        $("a[href$='.pdf']").prop('target', 'new');

        $("#date").datepicker({format: "m/d/yyyy"}).on('changeDate', function(ev){$("#date").datepicker('hide');});
        $("#enddate").datepicker({format: "m/d/yyyy"}).on('changeDate', function(ev){$("#enddate").datepicker('hide');});
        $(".mytimepicker").timepicker({'step': 30, 'scrollDefaultTime': "7:00pm"});
      });
    </script>
  </head>
  <body>

    <header<?php if (!isset($PageTitle)) echo ' class="home-header"'; ?>>
      <div class="site-width">
        <a href="."><img src="../images/logo.png" alt="" id="logo"></a>
        
        <?php if (!isset($PageTitle) || $PageTitle != "Login") { ?>
        <input type="checkbox" id="toggle-menu" role="button">
        <label for="toggle-menu"><div></div></label>
        <ul id="menu">
          <li><a href="mainindex.php">Main</a></li>
          <li><a href="pressindex.php">Press</a></li>
          <li><a href="scheduleindex.php">Schedule</a></li>
          <li><a href="sotwindex.php">SotW</a></li>
          <li>
            <a href="#">And The Rest</a>
            <ul>
              <li><a href="lyricsindex.php">Lyrics</a></li>
              <li><a href="albumindex.php">Albums</a></li>
              <li><a href="tabsindex.php">Tabs</a></li>
              <li><a href="setlistsindex.php">Set Lists</a></li>
            </ul>
          </li>
        </ul>
        <?php } ?>
      </div> <!-- /.site-width -->
    </header>

    <div id="content" class="site-width<?php if (isset($ContentClass)) echo " ".$ContentClass; ?>">
      <h1><?php if (isset($PageTitle)) echo $PageTitle; ?></h1>