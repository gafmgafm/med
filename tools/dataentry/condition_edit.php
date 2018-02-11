<?php 

require_once('zheader.php');

$db = getDatabase();
$id = $_GET['id'];

if (isset($_GET['xaction']) && $_GET['xaction'] == 'save') {
    $stmt = $db->prepare('UPDATE condition SET name = ?, date_modified = ? where id = ?');
    $stmt->execute(array($_GET['name'], dbTimestamp(), $id));
}

$stmt = $db->prepare("SELECT id, name FROM condition WHERE id = ?");
$stmt->execute(array($id));
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$data = $data[0];
?>

<h1>Condition Edit</h1>

<form action="condition_edit.php" method="get">
<div class="form-group">
    <label for="id">Id</label>
    <input type="number" class="form-control" name="id" id="id" value="<?= $data['id'] ?>" readonly=readonly></input>
</div>
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name" value="<?= $data['name'] ?>" required=required></input>
</div>
<input type="hidden" name="xaction" value="save" />
<button type="submit" class="btn btn-primary">Save</button>
</form>

<h2>Group</h2>
<?php
$stmt = $db->prepare("SELECT id, name FROM condition_group_member cgm JOIN condition_group cg ON cgm.condition_group_id = cg.id WHERE condition_id = ? ORDER BY 2");
$stmt->execute(array($id));
$data = $stmt->fetchAll(PDO::FETCH_NUM);
if (sizeof($data) == 0) {
    echo '<p>No Group Found</p>'.PHP_EOL;
} else {
    tableHeader(array('Id', 'Name', 'Action'));
    foreach ($data as $row) {
        $row[] = "<a href=condition_group_member_delete.php?cgid={$row[0]}&cid=$id&redirect=$PAGE>Delete Link</a>";
        $row[0] = "<a href=condition_group_edit.php?id={$row[0]}>{$row[0]}</a>";
        tableRow($row);
    }
    tableFooter();
}
?>
<div class="row">
    <div class="col-12">
        <form class="" action="condition_group_member_add.php" method="get">
        <input type="hidden" name="cid" value="<?= $id ?>"/>
        <input type="hidden" name="redirect" value="<?= currentPage() ?>" />
        <div class="input-group">
            <label for="cgname" class="m-2">Group Name</label>
            <input type="text" class="form-control m-2" name="cgname" id="cgname" value=""></input>
            <button type="submit" class="btn btn-primary m-2">Add</button>
        </div>
        </form>
    </div>
</div>

<script>
new autoComplete({
    selector: 'input[name="cgname"]',
    source: function(term, response){
        ajaxGet('/condition_group_lookup.php?term='+encodeURI(term), 
            function(data){ response(data);},
            function() {response([]);} 
        );
    }
});
</script>
<?php require_once('zfooter.php'); ?>