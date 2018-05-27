<?php require_once('zheader.php');

$db = getDatabase();
$id = $_GET['id'];

if (isset($_GET['xaction']) && $_GET['xaction'] == 'save') {
    $stmt = $db->prepare('UPDATE relation_type SET name = ?, date_modified = ? where id = ?');
    $stmt->execute(array($_GET['name'], dbTimestamp(), $id));
}

$stmt = $db->prepare("SELECT id, name FROM relation_type WHERE id = ?");
$stmt->execute(array($id));
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$data = $data[0];
?>

<h1>Relation Type Edit</h1>

<form action="relation_type_edit.php" method="get">
<div class="form-group">
    <label for="id">Id</label>
    <input type="text" class="form-control" name="id" id="id" value="<?= $data['id'] ?>" readonly=readonly></input>
</div>
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name" value="<?= $data['name'] ?>" required=required></input>
</div>
<input type="hidden" name="xaction" value="save" />
<button type="submit" class="btn btn-primary">Save</button>
</form>