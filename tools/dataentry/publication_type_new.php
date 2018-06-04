<?php 

require_once('zheader.php');
require_once('dao/publication_type_dao.php');

if (isset($_GET['xaction']) && $_GET['xaction'] == 'add') {
    $id = PublicationTypeDAO::add($_GET['name']);
    echo "<script>window.location.replace('publication_type_list.php?');</script>";
} else {
?>

<h1>New Publication Type</h1>

<form action="publication_type_new.php" method="get" class="form-horizontal">
<div class="form-group">
    <label for="name" class="control-label col-md-1">Name</label>
    <div class="col-md-11">
        <input type="text" class="form-control" name="name" id="name" value="" required=required></input>
    </div>
</div>
<input type="hidden" name="xaction" value="add" />
<button type="submit" class="btn btn-primary pull-right">Add</button>
</form>

<?php

}

require_once('zfooter.php'); 

?>