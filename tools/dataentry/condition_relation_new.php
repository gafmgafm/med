<?php

require_once('zheader.php');
require_once('dao/condition_dao.php');
require_once('dao/relation_type_dao.php');

$id = $_GET['id'];

$condition = ConditionDAO::get($id);

?>

<h1>New Condition Relation</h1>

<form action="condition_relation_add.php" method="get" class="form-horizontal">
    <div class="form-group">
        <label for="from_condition_id" class="col-md-2 control-label">From Condition</label>
        <div class="col-md-1">
            <input type="number" class="form-control" name="from_condition_id" id="from_condition_id" value="<?= $condition['id'] ?>" readonly=readonly></input>
        </div>
        <div class="col-md-9">
            <input type="text" class="form-control" name="from_condition_name" id="from_condition_name" value="<?= $condition['name'] ?>" required=required onclick="this.focus();this.select()"></input>
        </div>
    </div>
    <div class="form-group">
        <label for="relation_type_id" class="col-md-2 control-label">Relation Type</label>
        <div class="col-md-offset-1 col-md-9">
            <?php HtmlHelper::formSelect(RelationTypeDAO::all(), 'relation_type_id'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="to_condition_id" class="col-md-2 control-label">To Condition</label>
        <div class="col-md-1">
            <input type="number" class="form-control" name="to_condition_id" id="to_condition_id" value="<?= $condition['id'] ?>" readonly=readonly></input>
        </div>
        <div class="col-md-9">
            <input type="text" class="form-control" name="to_condition_name" id="to_condition_name" value="<?= $condition['name'] ?>" required=required onclick="this.focus();this.select()"></input>
        </div>
    </div>
    <input type="hidden" name="publication_id" value="1"/>
    <input type="hidden" name="redirect" value="<?= $_GET['redirect'] ?>"/>
    <button type="submit" class="btn btn-primary pull-right">Save</button>
</form>

<script>
new autoComplete({
    selector: 'input[name="from_condition_name"]',
    source: function(term, response){
        ajaxGet('/condition_lookup.php?term='+encodeURI(term), 
            function(data){ 
                var names = data.map(function(value,index) { return value[1]; });
                document.from_condition = data;
                response(names);
            },
            function() {response([]);} 
        );
    },
    onSelect: function(e, term, item) {
        document.getElementById('from_condition_id').value = keyFromValue(document.from_condition, term);
    }
});
new autoComplete({
    selector: 'input[name="to_condition_name"]',
    source: function(term, response){
        ajaxGet('/condition_lookup.php?term='+encodeURI(term), 
            function(data){ 
                var names = data.map(function(value,index) { return value[1]; });
                document.to_condition = data;
                response(names);
            },
            function() {response([]);} 
        );
    },
    onSelect: function(e, term, item) {
        document.getElementById('to_condition_id').value = keyFromValue(document.to_condition, term);
    }
});
</script>


<?php
require_once('zheader.php');
?>