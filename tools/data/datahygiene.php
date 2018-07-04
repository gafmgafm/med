<?php

require_once(__DIR__.'/../lib/lib.php');

logmsg('Checking Data Quality');

$sqliteFile = DEFAULT_DB_PATH;

$db = getDatabase($sqliteFile);

$errorCount = 0;

$fields = array(
    "condition_aka.name",
    "condition_group.name",
    "condition.name",
    "condition_type.name",
    "publication.name",
    "publication_type.name",
    "relation_type.name"
);

$fields = breakdown($fields);

logmsg('Data Quality - Trimming');

foreach ($fields as $table) {
    $db->exec("UPDATE {$table[0]} SET {$table[1]} = trim({$table[1]})");
    $db->exec("UPDATE {$table[0]} SET {$table[1]} = replace({$table[1]}, '  ', ' ')");
    $db->exec("UPDATE {$table[0]} SET {$table[1]} = replace({$table[1]}, '  ', ' ')");
    $db->exec("UPDATE {$table[0]} SET {$table[1]} = replace({$table[1]}, '  ', ' ')");
}

logmsg('Data Quality - Check Non Characters');

foreach ($fields as $table) {
    foreach($db->query("select id, {$table[1]} FROM {$table[0]}") as $row) {
        if (preg_match('/^[\x20-\x7e]*$/', $row[1]) != 1) {
            $errorCount++;
            logmsg("ERROR: Non Char Found: {$table[0]}.{$table[1]} [{$row[0]}] = {$row[1]}");
        }
    }
}

logmsg('Data Quality - Check Camel Casing');
foreach ($fields as $table) {
    foreach($db->query("select id, {$table[1]} FROM {$table[0]}") as $row) {
        $original = removeStopWords($row[1]);
        $camelCased = ucwords($original);
        if ($original != $camelCased) {
            $errorCount++;
            logmsg("ERROR: Wrong Casing: {$table[0]}.{$table[1]} [{$row[0]}] = {$row[1]} [$original / $camelCased]");
        }
    }
}

if ($errorCount > 0) die(0);

function breakdown($fields) {
    for ($i=0; $i < sizeof($fields); $i++) {
        $fields[$i] = explode('.', $fields[$i]);
    }
    return $fields;
}

function removeStopWords($string) {
    $stopWords = array('the', 'of', 'and', 'in', 'at', 'from');
    $string = explode(' ', $string);
    $clean = array();
    foreach ($string as $word) {
        if (!in_array($word, $stopWords)) {
            $clean[] = $word;
        }
    }
    return implode(' ', $clean);
}

?>