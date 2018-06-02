<?php

require_once(__DIR__.'/../../lib/lib.php');

class PublicationTypeDAO {

    public static function all() {
        $db = getDatabase();
        $stmt = $db->prepare("SELECT id, name FROM publication_type ORDER BY 2");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_NUM);
        return $data;
    }

}