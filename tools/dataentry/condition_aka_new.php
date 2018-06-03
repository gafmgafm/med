<?php 

require_once('zheader.php');
require_once('dao/condition_aka_dao.php');

if (isset($_GET['xaction']) && $_GET['xaction'] == 'add') {
    ConditionAkaDAO::add($_GET['condition_id'], $_GET['name'], $_GET['is_simple']);
    echo "<script>window.location.replace('condition_edit.php?id={$_GET['condition_id']}');</script>";
} else {
?>

<h1>New Condition Alias</h1>

<form action="condition_aka_new.php" method="get">
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name" value="" required=required></input>
</div>
<div class="form-group radio">
    <label>
        <input type="radio" name="is_simple" value="Y"/>Simple
    </label>
    <label>
        <input type="radio" name="is_simple" value="N" checked=checked/>Not Simple
    </label>
</div>
<input type="hidden" name="condition_id" value="<?= $_GET['condition_id'] ?>"/>
<input type="hidden" name="xaction" value="add" />
<button type="submit" class="btn btn-primary">Add</button>
</form>

<?php

}

require_once('zfooter.php'); 

?>