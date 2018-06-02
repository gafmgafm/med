<?php

require_once('zheader.php');
require_once('dao/condition_dao.php');

$search = isset($_GET['search']) ? $_GET['search'] : '';

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

$data = ConditionDAO::searchName($search);

HtmlHelper::tableHeader(array('Id', 'Name', 'Actions'));
foreach ($data as $row) {
    $row[] = "<a href=condition_delete.php?id={$row[0]}>Delete</a>";
    $row[0] = "<a href=condition_edit.php?id={$row[0]}>{$row[0]}</a>";
    HtmlHelper::tableRow($row);
}
HtmlHelper::tableFooter();

require_once('zfooter.php'); 
?>