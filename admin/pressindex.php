<?php
include_once "../inc/dbconfig.php";
include "login.php";
$PageTitle = "Press";
include "header.php";
?>

<div id="admin-press" class="flex main-cols">
  <div>
    <h3>Add Article</h3>

    <form action="pressdb.php?a=add" method="POST">
      <label>Date
        <input type="text" name="date">
      </label>

      <label>Source
        <input type="text" name="source">
      </label>

      <label>Source URL
        <input type="text" name="source_url">
      </label>

      <label>Title
        <input type="text" name="title">
      </label>

      <label>Subtitle
        <input type="text" name="subtitle">
      </label>

      <label>Author
        <input type="text" name="author">
      </label>

      <label>Text
        <textarea name="text"></textarea>
      </label>

      <input type="submit" name="submit" value="Add">
    </form>
  </div>

  <div>
    <h3>Articles</h3>
    
    <?php
    $articles = $mysqli->execute_query("SELECT * FROM press ORDER BY sort_date DESC");
    
    foreach ($articles as $article) {
      ?>
      <div class="article flex">
        <div class="controls">
          <a href="pressdb.php?a=delete&id=<?php echo $article['id']; ?>" class="delete" onClick="return(confirm('Are you sure you want to delete this record?'));"></a>
          <a href="pressedit.php?a=edit&id=<?php echo $article['id']; ?>" class="edit"></a>
        </div>
        
        <div class="info">
          <strong><?php echo $article['date']; ?></strong> <em><?php echo $article['title']; ?></em>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<?php include "footer.php"; ?>