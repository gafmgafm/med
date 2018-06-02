new autoComplete({
    selector: 'input[name="cgname"]',
    source: function(term, response){
        ajaxGet('/condition_group_lookup.php?term='+encodeURI(term), 
            function(data){ response(data);},
            function() {response([]);} 
        );
    }
});

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