<?php

require_once(__DIR__.'/../../lib/lib.php');

class ConditionRelationDAO {

    public static function from($id) {
        $db = getDatabase();
        logmsg($id);
        $stmt = $db->prepare("SELECT cr.id, cfrom.name, rt.name, cto.id, cto.name  FROM condition_relation cr JOIN condition cto ON cr.to_condition_id = cto.id JOIN condition cfrom ON cfrom.id = cr.from_condition_id JOIN relation_type rt ON cr.relation_type_id = rt.id WHERE from_condition_id = ? ORDER BY 1");
        $stmt->execute(array($id));
        $data = $stmt->fetchAll(PDO::FETCH_NUM);
        return $data;
    }

    public static function to($id) {
        $db = getDatabase();
        $stmt = $db->prepare("SELECT cr.id, cfrom.id, cfrom.name, rt.name, cto.name FROM condition_relation cr JOIN condition cto ON cr.to_condition_id = cto.id JOIN condition cfrom ON cfrom.id = cr.from_condition_id JOIN relation_type rt ON cr.relation_type_id = rt.id WHERE to_condition_id = ? ORDER BY 1");
        $stmt->execute(array($id));
        $data = $stmt->fetchAll(PDO::FETCH_NUM);
        return $data;
    }

    public static function getByPublication($publication_id) {
        $db = getDatabase();
        $stmt = $db->prepare("SELECT cr.id, cfrom.id, cfrom.name, rt.name, cto.id, cto.name FROM condition_relation cr JOIN condition cto ON cr.to_condition_id = cto.id JOIN condition cfrom ON cfrom.id = cr.from_condition_id JOIN relation_type rt ON cr.relation_type_id = rt.id WHERE publication_id = ? ORDER BY 3,4,6");
        $stmt->execute(array($publication_id));
        $data = $stmt->fetchAll(PDO::FETCH_NUM);
        return $data;
    }

    public static function add($from_condition_id, $to_condition_id, $relation_type_id, $publication_id) {
        $db = getDatabase();
        $stmt = $db->prepare('INSERT INTO condition_relation (from_condition_id,to_condition_id,relation_type_id,publication_id) VALUES (?,?,?,?)');
        $stmt->execute(array($from_condition_id, $to_condition_id, $relation_type_id, $publication_id));
    }

}

?>