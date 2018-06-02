<?php 

require_once('zheader.php');
require_once('dao/condition_relation_dao.php');

$redirect = $_GET['redirect'];

ConditionRelationDAO::add($_GET['from_condition_id'], $_GET['to_condition_id'], $_GET['relation_type_id'], $_GET['publication_id']);

echo "<script>window.location.replace('$redirect');</script>";

require_once('zfooter.php'); 

?>