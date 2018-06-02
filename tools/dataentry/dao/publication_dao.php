<?php

require_once(__DIR__.'/../../lib/lib.php');

class PublicationDAO {

    public static function all() {
        $db = getDatabase();
        $stmt = $db->prepare("SELECT id, name FROM publication ORDER BY 1");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_NUM);
        return $data;
    }

    public static function update($id, $name, $publication_type_id) {
        $db = getDatabase();
        $stmt = $db->prepare('UPDATE publication SET name = ?, date_modified = ?, publication_type_id = ? where id = ?');
        $stmt->execute(array($name, dbTimestamp(), $publication_type_id, $id));
    }

    public static function get($id) {
        $db = getDatabase();
        $stmt = $db->prepare("SELECT id, name, publication_type_id FROM publication WHERE id = ?");
        $stmt->execute(array($id));
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $data = $data[0];
        return $data;
    }

}

?>