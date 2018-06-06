<?php
require_once(__DIR__.'/../lib/lib.php');
require_once('dao/condition_dao.php');
require_once('dao/condition_aka_dao.php');

$term = strtolower($_GET['term']);
$conditions = ConditionDAO::lookup($term);
$alias = ConditionAkaDAO::searchName($term);



echo json_encode(array_merge($conditions, $alias));

?>