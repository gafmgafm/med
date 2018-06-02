<?php 

require_once('zheader.php');
require_once('dao/condition_dao.php');
require_once('dao/condition_type_dao.php');

if (isset($_GET['xaction']) && $_GET['xaction'] == 'add') {
    $id = ConditionDAO::add($_GET['name'], $_GET['condition_type_id']);
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
    <?php HtmlHelper::formSelect(ConditionTypeDAO::all('name'), "condition_type_id"); ?>
</div>
<input type="hidden" name="xaction" value="add" />
<button type="submit" class="btn btn-primary">Add</button>
</form>

<?php

}

require_once('zfooter.php'); 

?>