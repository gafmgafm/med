<?php

require_once(__DIR__.'/../../lib/lib.php');

class ConditionTypeDAO {

    public static function all($order = 'id') {
        $db = getDatabase();
        $stmt = $db->prepare("SELECT id, name FROM condition_type ORDER BY $order");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_NUM);
        return $data;
    }

}

?>