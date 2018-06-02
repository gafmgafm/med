<?php

require_once(__DIR__.'/../../lib/lib.php');

class ConditionDAO {

    public static function update($id, $name, $condition_type_id) {
        $db = getDatabase();
        $stmt = $db->prepare('UPDATE condition SET name = ?, condition_type_id = ?, date_modified = ? where id = ?');
        $stmt->execute(array($name, $condition_type_id, dbTimestamp(), $id));
    }
    
    public static function get($id) {
        $db = getDatabase();
        $stmt = $db->prepare("SELECT id, name, condition_type_id FROM condition WHERE id = ?");
        $stmt->execute(array($id));
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data[0];
    }

    public static function searchName($search = null) {
        $db = getDatabase();
        $search = $search == null? '' : strtolower(trim($search));
        $where = ($search == '') ? '' : " WHERE lower(name) LIKE '%$search%' ";
        $stmt = $db->prepare("SELECT id, name FROM condition $where ORDER BY 1");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_NUM);
        return $data;
    }

}