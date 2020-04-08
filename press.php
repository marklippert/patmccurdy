<?php
include "inc/dbconfig.php";

$Title = "";

if ($_SERVER['QUERY_STRING'] != "") {
  $result = $mysqli->query("SELECT * FROM press WHERE id = '" . $_SERVER['QUERY_STRING'] . "'");
  $row = $result->fetch_array(MYSQLI_ASSOC);
  $Title = " | " . strip_tags(htmlspecialchars_decode($row['title'], ENT_QUOTES)) . " (" . $row['date'] . ")";
}

$PageTitle = "Press" . $Title;
$HeaderTitle = ltrim($Title, " | ");
if (strlen($HeaderTitle) > 69) list($HeaderTitle, $junk) = explode(" (", $HeaderTitle);
include "header.php";

if ($_SERVER['QUERY_STRING'] != "") {
  // Display single article
  echo "<strong>";
  
  if ($row['source_url'] != "") { echo "<a href=\"" . $row['source_url'] . "\">"; }
  echo $row['source'];
  if ($row['source_url'] != "") { echo "</a>"; }
  
  echo " " . $row['date'];
  
  if ($row['title'] != "") { echo "<br>\n<br>\n<big>" . htmlspecialchars_decode($row['title'], ENT_QUOTES) . "</big>"; }
  
  if ($row['subtitle'] != "") { echo "<br>\n" . htmlspecialchars_decode($row['subtitle'], ENT_QUOTES); }
  
  echo "</strong><br>\n";
  
  if ($row['author'] != "") { echo "by " . $row['author'] . "<br>\n"; }
  
  echo "<br>\n" . htmlspecialchars_decode(str_replace("\r", "<br>", $row['text']), ENT_QUOTES);
} else {
  // Display main index
  $result = $mysqli->query("SELECT * FROM press ORDER BY sort_date DESC");
  
  while($row = $result->fetch_array(MYSQLI_ASSOC)) {
    echo "<a href=\"press.php?" . $row['id'] . "\"><strong>" . $row['source'] . "</strong> " . $row['date'];
    if ($row['title'] != "") { echo "<br>\n<em>" . htmlspecialchars_decode($row['title'], ENT_QUOTES) . "</em>"; }
    echo "</a><br>
    <br>\n";
  }
  
  ?>
  Have you stumbled across an interview or article about Pat?  Send it to <?php echo email("webmaster@patmccurdy.com"); ?> or at least let me know about it.  Try to include the publication, author, date, etc.; basically, everything.  (Pretend you're back in school and writing a research paper.)  Thanks.
  <?php
}

include "footer.php";