<?php

require_once('zheader.php');
require_once('dao/condition_dao.php');

$id = $_GET['id'];

$data = ConditionDAO::get($id);

if (isset($_GET['xaction']) && $_GET['xaction'] == 'delete') {
    ConditionDAO::delete($id);
    echo '<h3>Condition Deleted</h3><a href="condition_list.php">Condition List</a>';
} else {

?>
<h3>
Are you sure you want to delete condition [<?= $id.' - '.$data['name'] ?>] and all related information?
<br><br>
<a href="condition_delete.php?xaction=delete&id=<?= $id ?>"class="btn btn-primary mr-5">Yes</a>
<a href="javascript:history.back()" class="btn btn-primary mr-5">No</a>

<?php
}
require_once('zfooter.php'); 
?>