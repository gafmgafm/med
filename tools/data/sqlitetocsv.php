<?php

require_once(__DIR__.'/../lib/lib.php');
require_once(__DIR__.'/ddl.php');

$sqliteFile = DEFAULT_DB_PATH;

logmsg('Converting CSV to SQLite');
logmsg("Database=$sqliteFile");

logmsg('Writing files');
$db = getDatabase($sqliteFile);

foreach ($ddlFiles as $ddl) {
    logmsg("Writing file=$ddl");
    $content = file(__DIR__."/ddl/{$ddl}_table.sql");
    $line = array_shift($content);
    $line = trim(substr($line, 2));
    $sql = "SELECT $line FROM $ddl";
    $content = str_replace(',', "\t", $line).PHP_EOL;
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_NUM);
    foreach ($data as $row) {
        $content .= implode("\t", $row).PHP_EOL;
    }
    file_put_contents(__DIR__."/../../data/$ddl.csv", $content);
}

logmsg('Finished');
logmsg('BYE');

?>