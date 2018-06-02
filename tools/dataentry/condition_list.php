<?php

require_once('zheader.php');
require_once('dao/condition_dao.php');

$search = isset($_GET['search']) ? $_GET['search'] : '';

?>

<h1>Conditions List <a href="condition_new.php" class="btn btn-primary ml-3">New</a></h1>

<div class="row">
    <div class="col-12">
        <form action="condition_list.php" method="get" class="form-horizontal">
        <div class="form-group row">
            <div class="col-sm-9 col-sm-offset-1">
                <input type="text" class="form-control" name="search" id="search" value="<?= $search ?>" placeholder="Condition name"></input>
            </div>
            <div class="col-sm-1">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
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