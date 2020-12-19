<?php
$ContentClass = "songlist";
$PageTitle = (isset($_POST['search'])) ? "Search Results for \"" . $_POST['search'] . "\"" : "Search";
include "header.php";
?>

<input type="checkbox" id="toggle-search" role="button">
<label for="toggle-search" title="Search"></label>
<form action="search.php" method="POST" id="lyric-search">
  <div>
    <input type="text" name="search" placeholder="Find a song title or lyrics"><input type="submit" name="submit" value="Search">
  </div>
</form>

<?php
if (isset($_POST['search'])) {
  $search = $mysqli->query("SELECT * FROM lyrics WHERE title LIKE '%" . $_POST['search'] . "%' OR lyrics LIKE '%" . $_POST['search'] . "%' ORDER BY title ASC");

  if (!empty($search) && $search->num_rows > 0) {
    while($row = $search->fetch_array(MYSQLI_ASSOC)) {
      echo "<a href=\"song.php?" . $row['id']. "\">" . $row['title'] . "</a><br>\n";
    }
  } else {
    echo 'Sorry, no results for "' . $_POST['search'] . '". Try searching for something else or <a href="songlist.php">return to the Song List</a>.';
  }
}

include "footer.php";
?>