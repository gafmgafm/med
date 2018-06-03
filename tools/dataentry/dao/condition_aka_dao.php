<?php

require_once(__DIR__.'/../../lib/lib.php');

class ConditionAkaDAO {

    public static function getByConditionId($condition_id) {
        $db = getDatabase();
        $stmt = $db->prepare("SELECT id, name, is_simple FROM condition_aka WHERE condition_id = ?");
        $stmt->execute(array($condition_id));
        $data = $stmt->fetchAll(PDO::FETCH_NUM);
        return $data;
    }

    public static function add($condition_id, $name, $is_simple) {
        $db = getDatabase();
        $stmt = $db->prepare("INSERT INTO condition_aka (condition_id, name, is_simple) VALUES (?,?,?)");
        $stmt->execute(array($condition_id, $name, $is_simple));
    }

    public static function delete($id) {
        $db = getDatabase();
        $stmt = $db->prepare("DELETE FROM condition_aka WHERE id = ?");
        $stmt->execute(array($id));
    }

}

?>