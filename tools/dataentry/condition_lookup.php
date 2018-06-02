<?php
require_once(__DIR__.'/../lib/lib.php');
require_once('dao/condition_dao.php');

$term = strtolower($_GET['term']);
$data = ConditionDAO::lookup($term);

echo json_encode($data);

?>