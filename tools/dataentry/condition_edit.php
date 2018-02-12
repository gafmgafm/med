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

$stmt = $db->prepare("SELECT id, name FROM relation_type ORDER BY 1,2");
$stmt->execute();
$relations = $stmt->fetchAll(PDO::FETCH_NUM);
$conditionName = $data['name'];
?>

<h1>Condition Edit 
<a href="https://en.wikipedia.org/wiki/Special:Search/<?= urlencode($conditionName) ?>" target="_blank"><img src="ziconwikipedia.png" height="16" width="16"/></a>
<a href="https://google.com/search?q=<?= urlencode($conditionName) ?>" target="_blank"><img src="zicongoogle.png" height="16" width="16"/></a>
<a href="https://google.com/search?tbm=isch&q=<?= urlencode($conditionName) ?>" target="_blank"><img src="zicongoogle.png" height="16" width="16"/></a>
</h1>

<form action="condition_edit.php" method="get">
<div class="form-group">
    <label for="id">Id</label>
    <input type="number" class="form-control" name="id" id="id" value="<?= $data['id'] ?>" readonly=readonly></input>
</div>
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name" value="<?= $conditionName ?>" required=required></input>
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

<h2>Relations</h2>

<div class="row">
    <div class="col-12">
        <form class="" action="condition_relation_add.php" method="get">
        <input type="hidden" name="cid" value="<?= $id ?>"/>
        <input type="hidden" name="redirect" value="<?= currentPage() ?>" />
        <div class="input-group">`
            <select name="direction" class="form-control m-2">
                <option value="fromto">From this to other</option>
                <option value="tofrom">From other to this</option>
            </select>
            <?php formSelect($relations, "relation", 1); ?>
            <input type="text" class="form-control m-2" name="otherid" id="" value="" required=required placeholder="Condition Name"></input>
            <button type="submit" class="btn btn-primary m-2">Add</button>
        </div>
        </form>
    </div>
</div>
<?php
$stmt = $db->prepare("SELECT cr.id, '$conditionName', rt.name, cto.id, cto.name  FROM condition_relation cr JOIN condition cto ON cr.to_condition_id = cto.id JOIN relation_type rt ON cr.relation_type_id = rt.id WHERE from_condition_id = ? ORDER BY 1");
$stmt->execute(array($id));
$data = $stmt->fetchAll(PDO::FETCH_NUM);
if (sizeof($data) == 0) {
    echo '<p>No relation from this condition to other conditions found</p>'.PHP_EOL;
} else {
    tableHeader(array('Id', 'This Condition', 'Relation', 'Condition Id', 'Condition Name', 'Action'));
    foreach ($data as $row) {
        $row[] = "<a href=condition_relation_delete.php?id={$row[0]}&redirect=$PAGE>Delete Relation</a>";
        $row[3] = "<a href=condition_edit.php?id={$row[3]}>{$row[3]}</a>";
        tableRow($row);
    }
    tableFooter();
}
?>
<?php
$stmt = $db->prepare("SELECT cr.id, cto.id, cto.name, rt.name, '$conditionName' FROM condition_relation cr JOIN condition cto ON cr.from_condition_id = cto.id JOIN relation_type rt ON cr.relation_type_id = rt.id WHERE to_condition_id = ? ORDER BY 1");
$stmt->execute(array($id));
$data = $stmt->fetchAll(PDO::FETCH_NUM);
if (sizeof($data) == 0) {
    echo '<p>No relation from other conditions to this condition found</p>'.PHP_EOL;
} else {
    tableHeader(array('Id', 'Condition Id', 'Condition Name', 'Relation', 'This Condition', 'Action'));
    foreach ($data as $row) {
        $row[] = "<a href=condition_relation_delete.php?id={$row[0]}&redirect=$PAGE>Delete Relation</a>";
        $row[1] = "<a href=condition_edit.php?id={$row[1]}>{$row[1]}</a>";
        tableRow($row);
    }
    tableFooter();
}
?>


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
new autoComplete({
    selector: 'input[name="toname"]',
    source: function(term, response){
        ajaxGet('/condition_lookup.php?term='+encodeURI(term), 
            function(data){ response(data);},
            function() {response([]);} 
        );
    }
});
</script>
<?php require_once('zfooter.php'); ?>