<?php require_once('zheader.php');

$cid = $_GET['cid'];
$cgid = $_GET['cgid'];
$redirect = $_GET['redirect'];

$db = getDatabase();
$stmt = $db->prepare("DELETE FROM condition_group_member WHERE condition_group_id = ? AND condition_id = ?");
$stmt->execute(array($cgid,$cid));

echo "<script>window.location.replace('$redirect');</script>";

require_once('zfooter.php'); ?>