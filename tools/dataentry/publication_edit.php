<?php require_once('zheader.php');

$db = getDatabase();
$id = $_GET['id'];

if (isset($_GET['xaction']) && $_GET['xaction'] == 'save') {
    $stmt = $db->prepare('UPDATE publication SET name = ?, date_modified = ?, publication_type_id = ? where id = ?');
    $stmt->execute(array($_GET['name'], dbTimestamp(), $_GET['publication_type_id'], $id));
}

$stmt = $db->prepare("SELECT id, name, publication_type_id FROM publication WHERE id = ?");
$stmt->execute(array($id));
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$data = $data[0];

$stmt = $db->prepare("SELECT id, name FROM publication_type ORDER BY 2");
$stmt->execute();
$publicationTypes = $stmt->fetchAll(PDO::FETCH_NUM);

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
    <?php formSelect($publicationTypes, 'publication_type_id', $data['publication_type_id'], true); ?>
</div>
<input type="hidden" name="xaction" value="save" />
<button type="submit" class="btn btn-primary">Save</button>
</form>