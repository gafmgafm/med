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

}

?>