<?php

require_once(__DIR__.'/../../lib/lib.php');

class PublicationTypeDAO {

    public static function all($order = 'id') {
        $db = getDatabase();
        $stmt = $db->prepare("SELECT id, name FROM publication_type ORDER BY $order");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_NUM);
        return $data;
    }

    public static function add($name) {
        $db = getDatabase();
        $stmt = $db->prepare("INSERT INTO publication_type (name) VALUES (?)");
        $stmt->execute(array($name));
    }

    public static function delete($id) {
        $db = getDatabase();
        $stmt = $db->prepare("DELETE FROM publication_type WHERE id = ?");
        $stmt->execute(array($id));
    }

}