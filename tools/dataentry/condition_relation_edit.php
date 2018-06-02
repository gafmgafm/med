<?php 

require_once('zheader.php');

$db = getDatabase();
$id = $_GET['id'];

$stmt = $db->prepare("SELECT cr.id,from_condition_id,cfrom.name cfromname,to_condition_id,cto.name ctoname,relation_type_id,rt.name rtname,publication_id,pub.name pubname FROM condition_relation cr JOIN condition cto on to_condition_id = cto.id JOIN condition cfrom ON from_condition_id = cfrom.id JOIN relation_type rt ON rt.id = cr.relation_type_id JOIN publication pub ON pub.id = cr.publication_id WHERE cr.id = ?");
$stmt->execute(array($id));
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$data = $data[0];
?>

<h1>Condition Relation Edit</h1>

<form action="condition_relation_edit.php" method="get">
<div class="form-group">
    <label for="id">Id</label>
    <input type="number" class="form-control" name="id" id="id" value="<?= $data['id'] ?>" readonly=readonly></input>
</div>
<div class="form-group">
    <label for="name">Condition From Id</label>
    <input type="text" class="form-control id" name="name" id="name" value="<?= $data['from_condition_id']  ?>" required=required  readonly=readonly></input>
</div>
<div class="form-group">
    <label for="name">Condition From Name</label>
    <input type="text" class="form-control" name="name" id="name" value="<?= $data['cfromname']  ?>" required=required></input>
</div>
<div class="form-group">
    <label for="name">Relation Id</label>
    <input type="text" class="form-control id" name="name" id="name" value="<?= $data['relation_type_id']  ?>" required=required  readonly=readonly></input>
</div>
<div class="form-group">
    <label for="name">Relation Name</label>
    <input type="text" class="form-control" name="name" id="name" value="<?= $data['rtname']  ?>" required=required></input>
</div>
<div class="form-group">
    <label for="name">Condition To Id</label>
    <input type="text" class="form-control id" name="name" id="name" value="<?= $data['to_condition_id']  ?>" required=required  readonly=readonly></input>
</div>
<div class="form-group">
    <label for="name">Condition To Name</label>
    <input type="text" class="form-control" name="name" id="name" value="<?= $data['ctoname']  ?>" required=required></input>
</div>
<div class="form-group">
    <label for="name">Publication Id</label>
    <input type="text" class="form-control id" name="name" id="name" value="<?= $data['publication_id']  ?>" required=required  readonly=readonly></input>
</div>
<div class="form-group">
    <label for="name">Publication Name</label>
    <input type="text" class="form-control" name="name" id="name" value="<?= $data['pubname']  ?>" required=required></input>
</div>
<input type="hidden" name="xaction" value="save" />
</form>

<script>
new autoComplete({
    selector: 'input[name="otherid"]',
    source: function(term, response){
        ajaxGet('/condition_lookup.php?term='+encodeURI(term), 
            function(data){ response(data);},
            function() {response([]);} 
        );
    }
});
</script>