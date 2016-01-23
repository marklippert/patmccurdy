<?php
include("../inc/dbconfig.php");
include "login.php";
$PageTitle = "Edit Guitar Tab";
include "header.php";

$result = $mysqli->query("SELECT * FROM tabs WHERE id = '" . $_GET['id'] . "'");
$row = $result->fetch_array(MYSQLI_BOTH);
?>

<form action="tabsdb.php?a=edit" method="POST">
  <div class="sub-center">
    <strong>Title</strong><br>
    <select name="title">
      <option value="">Select title...</option>
      <?php
      $lresult = $mysqli->query("SELECT * FROM lyrics ORDER BY title ASC");

      while($lrow = $lresult->fetch_array(MYSQLI_BOTH)) {
        echo "<option value=\"" . $lrow['title'] . "\"";
        if ($row['title'] == $lrow['title']) echo " selected";
        echo ">" . $lrow['title'] . "</option>\n";
      }

      $lresult->free();
      ?>
    </select><br>
    <br>
    
    <strong>Tabs</strong><br> 
    <textarea name="tab" style="height: 25em;"><?php echo $row['tab']; ?></textarea><br> 
    <br>
    
    <strong>Name</strong><br>
    <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
    <br>
    
    <strong>Email</strong><br>
    <input type="text" name="email" value="<?php echo $row['email']; ?>"><br>
    <br>
    
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

    <input type="submit" value="Add">
  </div>
</form>

<?php
$result->free();
$mysqli->close();

include "footer.php";
?>