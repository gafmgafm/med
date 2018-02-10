<?php require_once('zheader.php');

echo '<h1>Relation Types List</h1>'.PHP_EOL;

$db = getDatabase();
$stmt = $db->prepare('SELECT id, name FROM relation_type ORDER BY 1');
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_NUM);
tabulate('relation_type', $data, array('Id', 'Name'));

require_once('zfooter.php'); ?>