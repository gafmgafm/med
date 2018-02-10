<?php require_once('zheader.php');

$db = getDatabase();
$id = $_GET['id'];

if (isset($_GET['xaction']) && $_GET['xaction'] == 'save') {
    $stmt = $db->prepare('UPDATE condition_group SET name = ?, date_modified = ? where id = ?');
    $stmt->execute(array($_GET['name'], dbTimestamp(), $id));
}

$stmt = $db->prepare("SELECT id, name, parent_condition_group_id FROM condition_group WHERE id = ?");
$stmt->execute(array($id));
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$data = $data[0];

$tree = array();
$tree[] = $data;
$parent = $data['parent_condition_group_id'];
while ($parent != null) {
    echo $parent;
    $stmt->execute(array($parent));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $result = $result[0];
    $tree[] = $result;
    $parent = $result['parent_condition_group_id'];
}
$tree = array_reverse($tree);

?>

<h1>Condition Group Edit</h1>

<form action="condition_group_edit.php" method="get">
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

<h2>Hierarchy</h2>
<p>
<?php
for ($i=0; $i < sizeof($tree); $i++) {
    $line = $tree[$i];
    echo str_repeat('&nbsp;', $i*4);
    echo "{$line['id']} - {$line['name']}<br>".PHP_EOL;
}
?>
</p>

<h2>Member Conditions</h2>
<?php
$stmt = $db->prepare("SELECT id, name FROM condition_group_member JOIN condition ON condition.id = condition_group_member.condition_id WHERE condition_group_id = ?");
$stmt->execute(array($id));
$data = $stmt->fetchAll(PDO::FETCH_NUM);
if (sizeof($data) == 0) {
    echo '<p>No Members Found</p>'.PHP_EOL;
} else {
    tableHeader(array('Id', 'Name', 'Action'));
    foreach ($data as $row) {
        $row[] = "<a href=condition_group_member_delete.php?cid={$row[0]}&cgid=$id&redirect=$PAGE>Delete Link</a>";
        $row[0] = "<a href=condition_edit.php?id={$row[0]}>{$row[0]}</a>";
        tableRow($row);
    }
    tableFooter();
}
?>
<div class="row">
    <div class="col-12">
        <form class="" action="condition_group_member_add.php" method="get">
        <input type="hidden" name="cgid" value="<?= $id ?>"/>
        <input type="hidden" name="redirect" value="<?= currentPage() ?>" />
        <div class="input-group">
            <label for="cname" class="m-2">Condition Name</label>
            <input type="text" class="form-control m-2" name="cname" id="cname" value=""></input>
            <button type="submit" class="btn btn-primary m-2">Add</button>
        </div>
        </form>
    </div>
</div>

<script>
new autoComplete({
    selector: 'input[name="cgname"]',
    source: function(term, response){
        ajaxGet('/condition_lookup.php?term='+encodeURI(term), 
            function(data){ response(data);},
            function() {response([]);} 
        );
    }
});
</script>

<?php require_once('zfooter.php'); ?>