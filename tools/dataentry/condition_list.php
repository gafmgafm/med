<?php

require_once('zheader.php');

$search = isset($_GET['search']) ? strtolower($_GET['search']) : '';

$db = getDatabase();
$where = ($search == '') ? '' : " WHERE lower(name) LIKE '%$search%' ";
$stmt = $db->prepare("SELECT id, name FROM condition $where ORDER BY 1");
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_NUM);

?>

<h1>Conditions List <a href="condition_new.php" class="btn btn-primary ml-5">New</a></h1>

<div class="row">
    <div class="col-12">
        <form class="" action="condition_list.php" method="get">
        <div class="input-group">
            <input type="text" class="form-control m-2" name="search" id="search" value="<?= $search ?>" placeholder="Condition name"></input>
            <button type="submit" class="btn btn-primary m-2">Search</button>
        </div>
        </form>
    </div>
</div>

<?php
tabulate('condition', $data, array('Id', 'Name'));
require_once('zfooter.php'); 
?>