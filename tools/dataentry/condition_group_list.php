<?php require_once('zheader.php');

echo '<h1>Condition Groups List</h1>'.PHP_EOL;

$db = getDatabase();
$stmt = $db->prepare('SELECT id, name FROM condition_group ORDER BY 1');
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_NUM);
tabulate('condition_group', $data, array('Id', 'Name'));

require_once('zfooter.php'); ?>