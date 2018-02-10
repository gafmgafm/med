<?php

require_once(__DIR__.'/../../lib/lib.php');

$db = getDatabase();

$filecontent = file_get_contents('claml.xml');
$xml = new SimpleXMLElement($filecontent);

$codeLookup = array();
$dateCreated = dbTimestamp();
$dateModified = dbTimestamp();

$db->beginTransaction();

logmsg('Step 1');
foreach ($xml->Class as $class) {
    if ($class['kind'] == 'chapter') {
        $code = trim($class['code']);
        $name = getClassName($class);
        $db->exec("INSERT INTO condition_group (name) VALUES ('$name')");
        $id = $db->lastInsertId();
        $codeLookup[$code] = $id;
    }
}

logmsg('Step 2');
foreach ($xml->Class as $class) {
    if ($class['kind'] == 'block') {
        $code = trim($class['code']);
        $name = getClassName($class);
        $parent = trim($class->SuperClass['code']);
        $parent = $codeLookup[$parent];
        $db->exec("INSERT INTO condition_group (name, parent_condition_group_id) VALUES ('$name', $parent)");
        $id = $db->lastInsertId();
        $codeLookup[$code] = $id;
    }
}

logmsg('Step 3');
foreach ($xml->Class as $class) {
    if ($class['kind'] == 'category' && strpos(trim($class['code']), '.') === false) {
        $code = trim($class['code']);
        $name = sanitize(getClassName($class));
        $parent = trim($class->SuperClass['code']);
        $parent = $codeLookup[$parent];
        $db->exec("INSERT INTO condition_group (name, parent_condition_group_id) VALUES ('$name', $parent)");
        $id = $db->lastInsertId();
        $codeLookup[$code] = $id;
    }
}

logmsg('Step 4');
foreach ($xml->Class as $class) {
    if ($class['kind'] == 'category' && strpos(trim($class['code']), '.') !== false) {
        $name = sanitize(getClassName($class));
        $parent = trim($class->SuperClass['code']);
        $parent = $codeLookup[$parent];
        $db->exec("INSERT INTO condition (name) VALUES ('$name')");
        $id = $db->lastInsertId();
        $db->exec("INSERT INTO condition_group_member (condition_group_id, condition_id) VALUES ($parent, $id)");
    }
}

$db->commit();

logmsg('Finished');
logmsg('BYE');

function getClassName($class) {
    $long = null;
    $short = null;
    foreach($class->Rubric as $rubric) {
        if ($rubric['kind'] == 'preferred') $short = $rubric->Label;
        if ($rubric['kind'] == 'preferredLong') $long = $rubric->Label;
    }
    return trim(($long != null) ? $long : $short);
}

function sanitize($str) {
    return str_replace("'", "''", $str);
}

?>