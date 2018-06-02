<?php

require_once(__DIR__.'/../../lib/lib.php');

class ConditionGroupMemberDAO {

    public static function for($id) {
        $db = getDatabase();
        $stmt = $db->prepare("SELECT id, name FROM condition_group_member cgm JOIN condition_group cg ON cgm.condition_group_id = cg.id WHERE condition_id = ? ORDER BY 2");
        $stmt->execute(array($id));
        $data = $stmt->fetchAll(PDO::FETCH_NUM);
        return $data;
    }

}

?>