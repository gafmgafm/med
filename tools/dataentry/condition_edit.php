<?php 

require_once('zheader.php');
require_once('dao/condition_dao.php');
require_once('dao/condition_type_dao.php');
require_once('dao/condition_group_member_dao.php');
require_once('dao/condition_relation_dao.php');
require_once('dao/relation_type_dao.php');

$id = $_GET['id'];

if (isset($_GET['xaction']) && $_GET['xaction'] == 'save') {
    ConditionDAO::update($id, $_GET['name'], $_GET['condition_type_id']);
}

$data = ConditionDAO::get($id);

$conditionNameEncoded = urlencode($data['name']);
?>

<h1>Condition Edit 
<a href="https://en.wikipedia.org/wiki/Special:Search/<?= $conditionNameEncoded ?>" target="_blank"><img src="ziconwikipedia.png" height="16" width="16"/></a>
<a href="https://google.com/search?q=<?= $conditionNameEncoded ?>" target="_blank"><img src="zicongoogle.png" height="16" width="16"/></a>
<a href="https://google.com/search?tbm=isch&q=<?= $conditionNameEncoded ?>" target="_blank"><img src="zicongoogle.png" height="16" width="16"/></a>
</h1>

<form action="condition_edit.php" method="get">
    <div class="form-group">
        <label for="id">Id</label>
        <input type="number" class="form-control" name="id" id="id" value="<?= $data['id'] ?>" readonly=readonly></input>
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="<?= $data['name'] ?>" required=required></input>
    </div>
    <div class="form-group">
        <label for="condition_type_id">Type</label>
        <?php HtmlHelper::formSelect(ConditionTypeDAO::all(), "condition_type_id", $data['condition_type_id']); ?>
    </div>
    <input type="hidden" name="xaction" value="save" />
    <button type="submit" class="btn btn-primary">Save</button>
</form>

<h2>Group</h2>
<?php
$data = ConditionGroupMemberDAO::for($id);
if (sizeof($data) == 0) {
    echo '<p>No Group Found</p>'.PHP_EOL;
} else {
    HtmlHelper::tableHeader(array('Id', 'Name', 'Action'));
    foreach ($data as $row) {
        $row[] = "<a href=condition_group_member_delete.php?cgid={$row[0]}&cid=$id&redirect=$PAGE>Delete Link</a>";
        $row[0] = "<a href=condition_group_edit.php?id={$row[0]}>{$row[0]}</a>";
        HtmlHelper::tableRow($row);
    }
    HtmlHelper::tableFooter();
}
?>

<h2>Relations</h2>

<?php
$data = ConditionRelationDAO::from($id);
if (sizeof($data) == 0) {
    echo '<p>No relation from this condition to other conditions found</p>'.PHP_EOL;
} else {
    HtmlHelper::tableHeader(array('Id', 'This Condition', 'Relation', 'Condition Id', 'Condition Name', 'Action'));
    foreach ($data as $row) {
        $row[] = "<a href=condition_relation_delete.php?id={$row[0]}&redirect=$PAGE>Delete Relation</a>";
        $row[3] = "<a href=condition_edit.php?id={$row[3]}>{$row[3]}</a>";
        $row[0] = "<a href=condition_relation_edit.php?id={$row[0]}>{$row[0]}</a>";
        HtmlHelper::tableRow($row);
    }
    HtmlHelper::tableFooter();
}

$data = ConditionRelationDAO::to($id);
if (sizeof($data) == 0) {
    echo '<p>No relation from other conditions to this condition found</p>'.PHP_EOL;
} else {
    HtmlHelper::tableHeader(array('Id', 'Condition Id', 'Condition Name', 'Relation', 'This Condition', 'Action'));
    foreach ($data as $row) {
        $row[] = "<a href=condition_relation_delete.php?id={$row[0]}&redirect=$PAGE>Delete Relation</a>";
        $row[1] = "<a href=condition_edit.php?id={$row[1]}>{$row[1]}</a>";
        $row[0] = "<a href=condition_relation_edit.php?id={$row[0]}>{$row[0]}</a>";
        HtmlHelper::tableRow($row);
    }
    HtmlHelper::tableFooter();
}
?>

<?php require_once('zfooter.php'); ?>