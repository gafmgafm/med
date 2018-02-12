<?php require_once('zheader.php');

$id = $_GET['id'];
$redirect = $_GET['redirect'];

$db = getDatabase();
$stmt = $db->prepare("DELETE FROM condition_relation WHERE id = ?");
$stmt->execute(array($id));

echo "<script>window.location.replace('$redirect');</script>";

require_once('zfooter.php'); ?>