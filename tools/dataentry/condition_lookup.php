<?php
require_once(__DIR__.'/../lib/lib.php');

$term = strtolower($_GET['term']);

$db = getDatabase();
$stmt = $db->prepare("SELECT name FROM condition WHERE lower(name) like '%' || ? || '%'");
$stmt->execute(array($term));
$data = $stmt->fetchAll(PDO::FETCH_NUM);

echo json_encode(array_column($data,0));

?>