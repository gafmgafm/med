<?php

require_once(__DIR__.'/../lib/lib.php');
require_once(__DIR__.'/ddl.php');

$sqliteFile = DEFAULT_DB_PATH;

logmsg('Converting CSV to SQLite');
logmsg("Database=$sqliteFile");

if (file_exists($sqliteFile)) {
    if (unlink($sqliteFile)) {
        logmsg('Deleted original file');
    } else {
        logmsg('FATAL ERROR: Not able to delete original file');
        logmsg('BYE');
        return;
    }
}

logmsg('Creating database objects');
$db = getDatabase($sqliteFile);
foreach ($ddlFiles as $ddl) {
    $db->exec(file_get_contents(__DIR__."/ddl/{$ddl}_table.sql"));
}

logmsg('Loading data');
foreach ($ddlFiles as $table) {
    $filename = __DIR__."/../../data/$table.csv";
    if (!file_exists($filename)) continue;
    logmsg("Loading table=$table");
    $lines = file($filename);
    $stmt = $db->prepare(generateInsertSql($table, array_shift($lines)));
    foreach ($lines as $line) {
        $stmt->execute(explode("\t", trim($line)));
    }
}

logmsg('Finished');
logmsg('BYE');

function generateInsertSql($table, $header) {
    $header = trim($header);
    $marks = substr(str_repeat("?,", substr_count($header,"\t")+1), 0, -1); 
    return "INSERT INTO $table VALUES ($marks)";
}

?>