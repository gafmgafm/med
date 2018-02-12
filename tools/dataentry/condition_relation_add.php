<?php require_once('zheader.php');

$db = getDatabase();

$cid = $_GET['cid'];
$redirect = $_GET['redirect'];
$direction = $_GET['direction'];
$relation = $_GET['relation'];
$otherid = $_GET['otherid'];

$stmt = $db->prepare('SELECT id FROM condition WHERE name = ?');
$stmt->execute(array($otherid));
$otherid = $stmt->fetchAll(PDO::FETCH_NUM);
$otherid = $otherid[0][0];

$fromid = $cid;
$toid = $otherid;
if ($direction == 'tofrom') {
    $fromid = $otherid;
    $toid = $cid;
}

$stmt = $db->prepare('INSERT INTO condition_relation (from_condition_id,to_condition_id,relation_type_id,publication_id) VALUES (?,?,?,?)');
$stmt->execute(array($fromid, $toid, $relation, 1));

echo "<script>window.location.replace('$redirect');</script>";

require_once('zfooter.php'); ?>