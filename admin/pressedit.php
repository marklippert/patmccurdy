<?php
include "../inc/dbconfig.php";
include "login.php";
$PageTitle = "Press | Edit Article";
include "header.php";

$articles = $mysqli->query("SELECT * FROM press WHERE id = '" . $_GET['id'] . "'");
$article = $articles->fetch_array(MYSQLI_BOTH);
?>

<form action="pressdb.php?a=edit" method="POST">
  <div>
    <label>Date
      <input type="text" name="date" value="<?php echo $article['date']; ?>">
    </label>

    <label>Source
      <input type="text" name="source" value="<?php echo $article['source']; ?>">
    </label>

    <label>Source URL
      <input type="text" name="source_url" value="<?php echo $article['source_url']; ?>">
    </label>

    <label>Title
      <input type="text" name="title" value="<?php echo $article['title']; ?>">
    </label>

    <label>Subtitle
      <input type="text" name="subtitle" value="<?php echo $article['subtitle']; ?>">
    </label>

    <label>Author
      <input type="text" name="author" value="<?php echo $article['author']; ?>">
    </label>

    <label>Text
      <textarea name="text"><?php echo $article['text']; ?></textarea>
    </label>

    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

    <input type="submit" name="submit" value="Update">
  </div>
</form>
  
<?php include "footer.php"; ?>