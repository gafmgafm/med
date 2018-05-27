<?php 

require_once('zheader.php');
require_once('dao/condition_type_dao.php');

if (isset($_GET['xaction']) && $_GET['xaction'] == 'add') {
    $db = getDatabase();
    $stmt = $db->prepare('INSERT INTO condition (name,condition_type_id,date_created,date_modified) VALUES (?, ?, ?, ?)');
    $stmt->execute(array($_GET['name'], $_GET['condition_type_id'],dbTimestamp(), dbTimestamp()));
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
<div class="form-group">
    <label for="condition_type_id">Type</label>
    <?php formSelect(getConditionTypeList(), "condition_type_id"); ?>
</div>
<input type="hidden" name="xaction" value="add" />
<button type="submit" class="btn btn-primary">Add</button>
</form>

<?php

}

require_once('zfooter.php'); 

?>