<?php
include("../inc/dbconfig.php");
include "login.php";
$PageTitle = "Lyrics";
include "header.php";
?>

<div class="toggle-box">
  <div class="toggle-control" data-text="Add Lyrics" data-expanded-text="Hide form">Add Lyrics</div>
  <div id="admin-left">
    <h3>Add Lyrics</h3>

    <form action="lyricsdb.php?a=add&l=<?php echo $_REQUEST['filter']; ?>" method="POST">
      <div>
        <strong>Title</strong><br>
        <input type="text" name="title"><br>
        <br>
        
        <strong>Lyrics</strong><br>
        <textarea name="lyrics" style="height: 25em;"></textarea><br>
        <br>
        
        <strong>Album</strong>
        <select name="album" id="album-select">
          <option value="">none</option>
          <?php
          $result = $mysqli->query("SELECT * FROM albums ORDER BY title ASC");

          while($row = $result->fetch_array(MYSQLI_BOTH)) {
            echo "<option value=\"" . $row['id'] . "\">" . $row['title'] . "</option>\n";
          }

          $result->free();
          ?>
        </select><br>
        <br>
        
        <div class="sub-left" style="width: 30%;">
          <strong>Track #</strong> <input type="text" name="album_track" style="width: 25%;"><br>
          <br>
        </div>
        
        <div class="sub-right" style="width: 66%;">
          <strong>Band</strong>
          <select name="band" style="width: 75%; margin-right: 3%;">
            <option value="">Solo</option>
            <option value="Confidentials">Confidentials</option>
            <option value="Mankind">Mankind</option>
            <option value="Men About Town">Men About Town</option>
            <option value="Yipes!">Yipes!</option>
          </select><br>
          <br>
        </div>
        
        <div style="clear: both;"></div>

        <input type="submit" value="Add">
      </div>
    </form>

    <div class="spacer-height"></div>
  </div>
</div>

<div id="admin-right">
  <?php $f = "none"; ?>
  <form name="frmFilter" method="POST" action="<?php echo "lyricsindex.php"; ?>">
    <div>
      <br>
      <span style="font-size: 120%; font-weight: bold;">Lyrics</span> 
      <select name="filter" onchange="document.frmFilter.submit()" id="filter-select">
        <option value="none"<?php if ($_REQUEST['filter'] == "none") { echo " selected"; $f = "none"; } ?>>Select...</option>
        <option value="#"<?php if ($_REQUEST['filter'] == "#") { echo " selected"; $f = "^[0-9(]"; } ?>>#</option>
        <option value="a"<?php if ($_REQUEST['filter'] == "a") { echo " selected"; $f = "^a"; } ?>>A</option>
        <option value="b"<?php if ($_REQUEST['filter'] == "b") { echo " selected"; $f = "^b"; } ?>>B</option>
        <option value="c"<?php if ($_REQUEST['filter'] == "c") { echo " selected"; $f = "^c"; } ?>>C</option>
        <option value="d"<?php if ($_REQUEST['filter'] == "d") { echo " selected"; $f = "^d"; } ?>>D</option>
        <option value="e"<?php if ($_REQUEST['filter'] == "e") { echo " selected"; $f = "^e"; } ?>>E</option>
        <option value="f"<?php if ($_REQUEST['filter'] == "f") { echo " selected"; $f = "^f"; } ?>>F</option>
        <option value="g"<?php if ($_REQUEST['filter'] == "g") { echo " selected"; $f = "^g"; } ?>>G</option>
        <option value="h"<?php if ($_REQUEST['filter'] == "h") { echo " selected"; $f = "^h"; } ?>>H</option>
        <option value="i"<?php if ($_REQUEST['filter'] == "i") { echo " selected"; $f = "^i"; } ?>>I</option>
        <option value="j"<?php if ($_REQUEST['filter'] == "j") { echo " selected"; $f = "^j"; } ?>>J</option>
        <option value="k"<?php if ($_REQUEST['filter'] == "k") { echo " selected"; $f = "^k"; } ?>>K</option>
        <option value="l"<?php if ($_REQUEST['filter'] == "l") { echo " selected"; $f = "^l"; } ?>>L</option>
        <option value="m"<?php if ($_REQUEST['filter'] == "m") { echo " selected"; $f = "^m"; } ?>>M</option>
        <option value="n"<?php if ($_REQUEST['filter'] == "n") { echo " selected"; $f = "^n"; } ?>>N</option>
        <option value="o"<?php if ($_REQUEST['filter'] == "o") { echo " selected"; $f = "^o"; } ?>>O</option>
        <option value="p"<?php if ($_REQUEST['filter'] == "p") { echo " selected"; $f = "^p"; } ?>>P</option>
        <option value="q"<?php if ($_REQUEST['filter'] == "q") { echo " selected"; $f = "^q"; } ?>>Q</option>
        <option value="r"<?php if ($_REQUEST['filter'] == "r") { echo " selected"; $f = "^r"; } ?>>R</option>
        <option value="s"<?php if ($_REQUEST['filter'] == "s") { echo " selected"; $f = "^s"; } ?>>S</option>
        <option value="t"<?php if ($_REQUEST['filter'] == "t") { echo " selected"; $f = "^t"; } ?>>T</option>
        <option value="u"<?php if ($_REQUEST['filter'] == "u") { echo " selected"; $f = "^u"; } ?>>U</option>
        <option value="v"<?php if ($_REQUEST['filter'] == "v") { echo " selected"; $f = "^v"; } ?>>V</option>
        <option value="w"<?php if ($_REQUEST['filter'] == "w") { echo " selected"; $f = "^w"; } ?>>W</option>
        <option value="x"<?php if ($_REQUEST['filter'] == "x") { echo " selected"; $f = "^x"; } ?>>X</option>
        <option value="y"<?php if ($_REQUEST['filter'] == "y") { echo " selected"; $f = "^y"; } ?>>Y</option>
        <option value="z"<?php if ($_REQUEST['filter'] == "z") { echo " selected"; $f = "^z"; } ?>>Z</option>
        <?php
        $result = $mysqli->query("SELECT * FROM albums ORDER BY id ASC");

        while($row = $result->fetch_array(MYSQLI_BOTH)) {
          echo "<option value=\"" . $row['id'] . "\"";
          if ($_REQUEST['filter'] == "" . $row['id'] . "") { echo " selected"; $f = "" . $row['id'] . ""; $a = "yes"; };
          echo ">" . $row['title'] . "</option>\n";
        }

        $result->free();
        ?>
        <option value="holding"<?php if ($_REQUEST['filter'] == "holding") { echo " selected"; $f = "holding"; } ?>>~Holding Pen~</option>
      </select>
    </div>
  </form>
  
  <br>
  
  <?php
  if ($a != "yes") {
    $query = "SELECT * FROM lyrics WHERE album = '0' AND title REGEXP '" . $f . "' ORDER BY band,title ASC";
  } else {
    $query = "SELECT * FROM lyrics WHERE album = '" . $f . "' ORDER BY album_track ASC";
  }
  
  if ($f == "holding") $query = "SELECT * FROM lyrics_holding ORDER BY title ASC";
  
  $result = $mysqli->query($query);
  
  while($row = $result->fetch_array(MYSQLI_BOTH)) {
    ?>
    <div class="c2">
      <div class="controls">
        <a href="lyricsdb.php?a=delete&id=<?php echo $row['id']; ?>&l=<?php echo $_REQUEST['filter']; ?>" onClick="return(confirm('Are you sure you want to delete this record?'));"><img src="images/delete.png" alt="Delete" title="Delete"></a>
        <a href="lyricsedit.php?id=<?php echo $row['id']; ?>&l=<?php echo $_REQUEST['filter']; ?>"><img src="images/edit.png" alt="Edit" title="Edit"></a>
      </div>
      
      <div class="info">
        <?php echo $row['title']; ?> <em style="color: #888888; font-size: 80%;"><?php echo $row['band']; ?></em>
      </div>
      
      <div class="spacer-height"></div>
    </div>
    <?php
  }
  ?>
</div>

<div style="clear: both;"></div>

<?php include "footer.php"; ?>