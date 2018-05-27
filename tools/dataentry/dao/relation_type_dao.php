<?php

require_once(__DIR__.'/../../lib/lib.php');

function getRelationTypeList() {
    $db = getDatabase();
    $stmt = $db->prepare('SELECT id, name FROM relation_type ORDER BY 2');
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_NUM);
    return $data;
}

?>