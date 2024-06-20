<?php
include("../inc/dbconfig.php");
include "login.php";
$PageTitle = "Lyrics";
include "header.php";
?>

<div id="admin-lyrics" class="flex main-cols">
  <div>
    <h3>Add Lyrics</h3>

    <form action="lyricsdb.php?a=add&l=<?php if (isset($_REQUEST['filter'])) echo $_REQUEST['filter']; ?>" method="POST">
      <div>
        <label>Title
          <input type="text" name="title">
        </label>
        
        <label>Lyrics
          <textarea name="lyrics" style="height: 25em;"></textarea>
        </label>
        
        <label>Album
          <select name="album" id="album-select">
            <option value="0">none</option>
            <?php
            $albums = $mysqli->query("SELECT * FROM albums ORDER BY title ASC");

            while($album = $albums->fetch_array(MYSQLI_BOTH)) {
              echo '<option value="' . $album['id'] . '">' . $album['title'] . "</option>\n";
            }
            ?>
          </select>
        </label>
        
        <div class="admin-two-col flex">
          <label>Track #
            <input type="text" name="album_track" value="0">
          </label>

          <label>Band
            <select name="band">
              <option value="">Solo</option>
              <option value="Confidentials">Confidentials</option>
              <option value="Mankind">Mankind</option>
              <option value="Men About Town">Men About Town</option>
              <option value="Yipes!">Yipes!</option>
              <option value="Slick">Slick</option>
            </select>
          </label>
        </div>

        <label>Apple Music
          <input type="text" name="apple">
        </label>

        <label>Amazon
          <input type="text" name="amazon">
        </label>

        <input type="submit" name="submit" value="Add">
      </div>
    </form>
  </div>

  <div>
    <h3>Lyrics</h3>
    <br>

    <?php $f = "none"; ?>
    <form name="frmFilter" method="POST" action="<?php echo "lyricsindex.php"; ?>">
      <div>
        <select name="filter" onchange="document.frmFilter.submit()" id="filter-select">
          <option value="none"<?php if (!isset($_REQUEST['filter']) || $_REQUEST['filter'] == "none") { echo " selected"; $f = "none"; } ?>>Select...</option>
          <option value="#"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "#") { echo " selected"; $f = "^[0-9(]"; } ?>>#</option>
          <option value="a"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "a") { echo " selected"; $f = "^a"; } ?>>A</option>
          <option value="b"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "b") { echo " selected"; $f = "^b"; } ?>>B</option>
          <option value="c"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "c") { echo " selected"; $f = "^c"; } ?>>C</option>
          <option value="d"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "d") { echo " selected"; $f = "^d"; } ?>>D</option>
          <option value="e"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "e") { echo " selected"; $f = "^e"; } ?>>E</option>
          <option value="f"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "f") { echo " selected"; $f = "^f"; } ?>>F</option>
          <option value="g"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "g") { echo " selected"; $f = "^g"; } ?>>G</option>
          <option value="h"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "h") { echo " selected"; $f = "^h"; } ?>>H</option>
          <option value="i"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "i") { echo " selected"; $f = "^i"; } ?>>I</option>
          <option value="j"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "j") { echo " selected"; $f = "^j"; } ?>>J</option>
          <option value="k"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "k") { echo " selected"; $f = "^k"; } ?>>K</option>
          <option value="l"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "l") { echo " selected"; $f = "^l"; } ?>>L</option>
          <option value="m"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "m") { echo " selected"; $f = "^m"; } ?>>M</option>
          <option value="n"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "n") { echo " selected"; $f = "^n"; } ?>>N</option>
          <option value="o"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "o") { echo " selected"; $f = "^o"; } ?>>O</option>
          <option value="p"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "p") { echo " selected"; $f = "^p"; } ?>>P</option>
          <option value="q"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "q") { echo " selected"; $f = "^q"; } ?>>Q</option>
          <option value="r"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "r") { echo " selected"; $f = "^r"; } ?>>R</option>
          <option value="s"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "s") { echo " selected"; $f = "^s"; } ?>>S</option>
          <option value="t"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "t") { echo " selected"; $f = "^t"; } ?>>T</option>
          <option value="u"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "u") { echo " selected"; $f = "^u"; } ?>>U</option>
          <option value="v"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "v") { echo " selected"; $f = "^v"; } ?>>V</option>
          <option value="w"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "w") { echo " selected"; $f = "^w"; } ?>>W</option>
          <option value="x"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "x") { echo " selected"; $f = "^x"; } ?>>X</option>
          <option value="y"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "y") { echo " selected"; $f = "^y"; } ?>>Y</option>
          <option value="z"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "z") { echo " selected"; $f = "^z"; } ?>>Z</option>
          <?php
          $salbums = $mysqli->query("SELECT * FROM albums ORDER BY id ASC");

          while($salbum = $salbums->fetch_array(MYSQLI_BOTH)) {
            echo '<option value="' . $salbum['id'] . '"';
            if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "" . $salbum['id'] . "") { echo " selected"; $f = $salbum['id']; $a = "yes"; };
            echo ">" . $salbum['title'] . "</option>\n";
          }
          ?>
          <option value="holding"<?php if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == "holding") { echo " selected"; $f = "holding"; } ?>>~Holding Pen~</option>
        </select>
      </div>
    </form>
    
    <br>
    
    <?php
    // if ($a != "yes") {
    if (!isset($a)) {
      $query = "SELECT * FROM lyrics WHERE album = '0' AND title REGEXP '" . $f . "' ORDER BY band,title ASC";
    } else {
      $query = "SELECT * FROM lyrics WHERE album = '" . $f . "' ORDER BY album_track ASC";
    }
    
    if ($f == "holding") $query = "SELECT * FROM lyrics_holding ORDER BY title ASC";
    
    $songs = $mysqli->query($query);
    
    while($song = $songs->fetch_array(MYSQLI_BOTH)) {
      ?>
      <div class="lyric flex">
        <div class="controls">
          <a href="lyricsdb.php?a=delete&id=<?php echo $song['id']; ?>&l=<?php echo $_REQUEST['filter']; ?>" class="delete" onClick="return(confirm('Are you sure you want to delete this record?'));"></a>
          <a href="lyricsedit.php?a=edit&id=<?php echo $song['id']; ?>&l=<?php echo $_REQUEST['filter']; ?>" class="edit"></a>
        </div>
        
        <div class="info">
          <?php echo $song['title']; ?> <em style="color: #888888; font-size: 80%;"><?php echo $song['band']; ?></em>
        </div>
        
      </div>
    <?php } ?>
  </div>
</div>

<?php include "footer.php"; ?>