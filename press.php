<?php
include_once "inc/dbconfig.php";

$Sep = "";
$Title = "";

if ($_SERVER['QUERY_STRING'] != "") {
  $articles = $mysqli->execute_query("SELECT * FROM press WHERE id = ?", [$_SERVER['QUERY_STRING']]);
  $article = $articles->fetch_assoc();
  $Sep = " | ";
  $Title = strip_tags(htmlspecialchars_decode($article['title'], ENT_QUOTES)) . " (" . $article['date'] . ")";
}

$PageTitle = "Press".$Sep.$Title;
$Description = ($_SERVER['QUERY_STRING'] == "") ? "A collection of news articles written about Pat throughout the years." : "";
include "header.php";

if ($_SERVER['QUERY_STRING'] != "") {
  // Display single article
  echo "<strong>";
  
  if ($article['source_url'] != "") { echo '<a href="'.$article['source_url'].'">'; }
  echo $article['source'];
  if ($article['source_url'] != "") { echo "</a>"; }
  
  echo " ".$article['date']."\n";
  
  if ($article['title'] != "") { echo "<br>\n<br>\n<big>".htmlspecialchars_decode($article['title'], ENT_QUOTES) . "</big>"; }
  
  if ($article['subtitle'] != "") { echo "<br>\n".htmlspecialchars_decode($article['subtitle'], ENT_QUOTES); }
  
  echo "</strong><br>\n";
  
  if ($article['author'] != "") { echo "by ".$article['author']."<br>\n"; }
  
  echo "<br>\n" . htmlspecialchars_decode(str_replace("\r", "<br>", $article['text']), ENT_QUOTES);
} else {
  // Display main index
  $articles = $mysqli->execute_query("SELECT * FROM press ORDER BY sort_date DESC");
  
  foreach ($articles as $article) {
    echo '<a href="press.php?'.$article['id'].'"><strong>'.$article['source']."</strong> ".$article['date'];
    if ($article['title'] != "") { echo "<br>\n<em>".htmlspecialchars_decode($article['title'], ENT_QUOTES)."</em>"; }
    echo "</a><br><br>\n";
  }
  
  ?>
  Have you stumbled across an interview or article about Pat?  Send it to <?php echo email("webmaster@patmccurdy.com"); ?> or at least let me know about it.  Try to include the publication, author, date, etc.; basically, everything.  (Pretend you're back in school and writing a research paper.)  Thanks.
  <?php
}

include "footer.php";