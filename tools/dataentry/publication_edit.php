<?php

require_once('zheader.php');
require_once('dao/condition_relation_dao.php');
require_once('dao/publication_dao.php');
require_once('dao/publication_type_dao.php');

$db = getDatabase();
$id = $_GET['id'];

if (isset($_GET['xaction']) && $_GET['xaction'] == 'save') {
    PublicationDAO::update($id, $_GET['name'], $_GET['publication_type_id']);
}

$data = PublicationDAO::get($id);

?>

<h1>Publication Edit</h1>

<form action="publication_edit.php" method="get">
    <div class="form-group">
        <label for="id">Id</label>
        <input type="number" class="form-control" name="id" id="id" value="<?= $data['id'] ?>" readonly=readonly></input>
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="<?= $data['name'] ?>" required=required></input>
    </div>
    <div class="form-group">
        <label for="publication_type_id">Publication Type</label>
        <?php HtmlHelper::formSelect(PublicationTypeDAO::all('name'), 'publication_type_id', $data['publication_type_id'], true); ?>
    </div>
    <input type="hidden" name="xaction" value="save" />
    <button type="submit" class="btn btn-primary">Save</button>
</form>

<h2>Relations</h2>

<?php

$data = ConditionRelationDAO::getByPublication($id);
if (sizeof($data) == 0) {
    echo '<p>No relation based on this publication found</p>'.PHP_EOL;
} else {
    HtmlHelper::tableHeader(array('Id', 'From Id', 'From Condition', 'Relation', 'To Id', 'To Condition', 'Actions'));
    foreach ($data as $row) {
        $row[] = "<a href=condition_relation_delete.php?id={$row[0]}&redirect=$PAGE>Delete Relation</a>";
        $row[0] = "<a href=condition_relation_edit.php?id={$row[0]}>{$row[0]}</a>";
        $row[1] = "<a href=condition_edit.php?id={$row[1]}>{$row[1]}</a>";
        $row[4] = "<a href=condition_edit.php?id={$row[4]}>{$row[4]}</a>";     
        HtmlHelper::tableRow($row);
    }
    HtmlHelper::tableFooter();
}

require_once('zfooter.php'); 

?>