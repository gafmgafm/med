<?php

define('DEFAULT_DB_PATH', __DIR__.'/../../data/data.sqlite');
define('CSV_DELIMITER', "\t");
define('TIMESTAMP_FORMAT', 'Y-m-d H:i:s');
define('DEFAULT_GRAPHML_OUTPUT', __DIR__.'/../../data/data.graphml');

error_reporting(E_ALL);

function logmsg($msg) {
    error_log(date('c').' '.$msg.PHP_EOL, 3, 'php://stdout');
}

function getDatabase($dbPath = DEFAULT_DB_PATH) {
    $db = new PDO("sqlite:$dbPath");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->query("PRAGMA foreign_keys = ON");
    return $db;
}

function dbTimestamp($timestamp = null) {
    return date(TIMESTAMP_FORMAT, $timestamp == null ? time() : $timestamp);
}

function currentPage($urlencoded = false) {
    $page = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if ($urlencoded) $page = urlencode($page);
    return $page;
}

?>