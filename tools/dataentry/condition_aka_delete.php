<?php

require_once('zheader.php');
require_once('dao/condition_aka_dao.php');

ConditionAkaDAO::delete($_GET['condition_aka_id']);
echo "<script>window.location.replace('{$_GET['redirect']}');</script>";

require_once('zfooter.php'); 
?>