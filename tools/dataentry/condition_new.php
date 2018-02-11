<?php 

require_once('zheader.php');

if (isset($_GET['xaction']) && $_GET['xaction'] == 'add') {
    $db = getDatabase();
    $stmt = $db->prepare('INSERT INTO condition (name,date_created,date_modified) VALUES (?, ?, ?)');
    $stmt->execute(array($_GET['name'], dbTimestamp(), dbTimestamp()));
    $id = $db->lastInsertId();
    echo "<script>window.location.replace('condition_edit.php?id=$id');</script>";
} else {
?>

<h1>New Condition</h1>

<form action="condition_new.php" method="get">
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name" value="" required=required></input>
</div>
<input type="hidden" name="xaction" value="add" />
<button type="submit" class="btn btn-primary">Add</button>
</form>

<?php

}

require_once('zfooter.php'); 

?>