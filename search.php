<?php
$PageTitle = (isset($_POST['search'])) ? "Search Results for \"" . $_POST['search'] . "\"" : "Search";
include "header.php";

$sresults = "no";

if (isset($_POST['search'])) {
  if (isset($_POST['lyrics'])) {
    // Searching lyrics so tap into the database
    include_once "inc/dbconfig.php";
    $result = $mysqli->query("SELECT * FROM lyrics WHERE title LIKE '%" . $_POST['search'] . "%' OR lyrics LIKE '%" . $_POST['search'] . "%' ORDER BY title ASC");
    
    if (!empty($result) && $result->num_rows > 0) {
      // Found something.  Flip the "no results" switch.
      $sresults = "yes";
      
      // Display the results
      while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        echo "<a href=\"song.php?" . $row['id']. "\">" . $row['title'] . "</a><br>\n";
      }
      
      echo "<br>\n";
    }
  } else {
    $dir = opendir(".");
    while (false != ($file = readdir($dir))) {
      if ((substr(strrchr($file, "."), 1) == "php") && ($file != "header.php") && ($file != "footer.php") && ($file != "search.php") && ($file != "album.php") && ($file != "song.php")) {
        $files[] = $file;
      }
    }
    closedir($dir);
    natcasesort($files);
    
    foreach ($files as $file) {
      $contents = file_get_contents($file);
      
      if (preg_match("/" . $_POST['search'] . "/i", $contents, $oresult)) {
        // Found something.  Flip the "no results" switch.
        $sresults = "yes";
        
        // Extract the page title
        preg_match("/PageTitle = \"(.*?)\"/", $contents, $matches);
        
        // Set variable to display page title or file name if no title
        $stitle = ($matches[1] != "") ? $matches[1] : $file;
        
        // Display the results
        echo "<a href=\"$file\" style=\"font-size: 120%;\">$stitle</a><br>\n";
        
        // Get position of search term to create a result snippet
        $pos = stripos(trim(strip_tags($contents)), $_POST['search']);
        $start = ($pos-20 < 0) ? 0 : $pos-20;
        
        // Build the snippet
        if ($start > 0) echo "...";
        $snippet = substr(trim(strip_tags($contents)), $start, 90) . "...<br><br>\n";
        
        // Bold the search term in the snippet and display it
        echo preg_replace("/" . $_POST['search'] . "/i", "<strong>" . $oresult[0] . "</strong>", $snippet);
      }
    }
  }
  
  // If nothing is found, man up and apologize.
  if ($sresults != "yes") echo "<div style=\"text-align: center; font-weight: bold;\">Sorry, no results for \"" . $_POST['search'] . "\".</div><br>\n";
}
?>

<form action="search.php" method="POST" class="search" style="margin: 0 auto;">
  <div>
    <input type="text" name="search" value="Search" onClick="if(this.value=='Search')this.value='';" onBlur="if(this.value=='')this.value='Search';">
    <input type="checkbox" name="lyrics"<?php if (isset($_POST['lyrics'])) echo " checked"; ?>> Search lyrics
  </div>
</form>

<?php include "footer.php"; ?>