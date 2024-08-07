<?php
include_once "../inc/dbconfig.php";
include "login.php";
$PageTitle = "Edit Guitar Tab";
include "header.php";

$tabs = $mysqli->execute_query("SELECT * FROM tabs WHERE id = ?", [$_GET['id']]);
$tab = $tabs->fetch_assoc();
?>

<form action="tabsdb.php?a=edit" method="POST">
  <div>
    <label>Title
      <select name="title">
        <option value="">Select title...</option>
        <?php
        $lyrics = $mysqli->execute_query("SELECT * FROM lyrics ORDER BY title ASC");

        foreach ($lyrics as $lyric) {
          echo '<option value="'.$lyric['title'].'"';
          if ($tab['title'] == $lyric['title']) echo " selected";
          echo ">".$lyric['title']."</option>\n";
        }
        ?>
      </select>
    </label>

    <label>
      Tabs
      <textarea name="tab" style="height: 25em; white-space: pre;"><?php echo $tab['tab']; ?></textarea>
    </label>
    
    <label>
      Name
      <input type="text" name="name" value="<?php echo $tab['name']; ?>">
    </label>
    
    <label>
      Email
      <input type="email" name="email" value="<?php echo $tab['email']; ?>">
    </label>

    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

    <input type="submit" name="submit" value="Update">
  </div>
</form>

<?php include "footer.php"; ?>