<?php require_once('zheader.php');

$db = getDatabase();
if (isset($_GET['cid'])) {
    $cid = $_GET['cid'];
    $cgname = $_GET['cgname'];
    $stmt = $db->prepare("INSERT INTO condition_group_member (condition_group_id, condition_id) VALUES ((SELECT id FROM condition_group WHERE name = ?), ?) ");
    $stmt->execute(array($cgname,$cid));    
} elseif (isset($_GET['cgid'])) {
    $cgid = $_GET['cgid'];
    $cname = $_GET['cname'];
    $stmt = $db->prepare("INSERT INTO condition_group_member (condition_id, condition_group_id) VALUES ((SELECT id FROM condition WHERE name = ?), ?) ");
    $stmt->execute(array($cname,$cgid));   
}

$redirect = $_GET['redirect'];

echo "<script>window.location.replace('$redirect');</script>";

require_once('zfooter.php'); ?>