<?php
include_once("../inc/dbconfig.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Pat McCurdy Administration<?php if ($PageTitle != "") echo " | " . $PageTitle; ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
    <link rel="apple-touch-icon" href="../images/apple-touch-icon.png">

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Mark Lippert">

    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="../inc/main.css">
    <link rel="stylesheet" href="inc/admin.css">

    <script type="text/javascript" src="../inc/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="../inc/bootstrap-collapse.js"></script>
    <link rel="stylesheet" href="inc/bootstrap-datepicker.css" type="text/css" media="screen,print">
    <script type="text/javascript" src="inc/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" href="inc/jquery.timepicker.css" type="text/css" media="screen,print">
    <script type="text/javascript" src="inc/jquery.timepicker.js"></script>
    <script type="text/javascript" src="inc/jquery-toggle-box.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("a[href^='http'], a[href$='.pdf']").not("[href*='" + window.location.host + "']").attr('target','_blank');
        $("#access_password").focus();
        $("#date").datepicker({format: "m/d/yyyy"}).on('changeDate', function(ev){$("#date").datepicker('hide');});
        $("#enddate").datepicker({format: "m/d/yyyy"}).on('changeDate', function(ev){$("#enddate").datepicker('hide');});
        $(".mytimepicker").timepicker({'step': 30, 'scrollDefaultTime': "8:00pm"});
      });
    </script>

    <?php echo $HeaderExtra; ?>
  </head>
  <body>

    <div id="outer-wrap">
      <div id="wrap">
        <header>
          <a href="."><img src="../images/logo.png" alt="Pat McCurdy" id="logo"></a>
          
          <?php if ($PageTitle != "Login") { ?>
          <a id="menu-toggle" data-toggle="collapse" data-target="#menu"></a>

          <nav id="menu" class="collapse">
            <ul class="clearfix">
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
          </nav>
          <?php } ?>
          <div style="clear: both;"></div>
        </header>

        <div id="content-wrap">
          <h1 class="title"><?php echo ($HeaderTitle != "") ? $HeaderTitle : $PageTitle; ?></h1>
          <article class="noside">
