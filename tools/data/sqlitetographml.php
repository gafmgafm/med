<?php

require_once(__DIR__.'/../lib/lib.php');

$outputFile = DEFAULT_GRAPHML_OUTPUT;

writeHeader();
writeNodes();
writeEdges();
writeFooter();

function writeHeader() {
    global $outputFile;
    $header = <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<graphml xmlns="http://graphml.graphdrawing.org/xmlns">
    <graph id="G" edgedefault="directed">
EOT;
    file_put_contents($outputFile, $header);
}

function writeNodes() {
    global $outputFile;
    $content = '';
    $db = getDatabase();
    foreach ($db->query('SELECT name FROM condition', PDO::FETCH_NUM) as $row) {
        $content .= "\t\t<node id=\"{$row[0]}\"/>".PHP_EOL;
    }
    file_put_contents($outputFile, $content, FILE_APPEND);
}

function writeEdges() {
    global $outputFile;
    $content = '';
    $db = getDatabase();
    $sql = "select cfrom.name, cto.name from condition_relation cr JOIN condition cfrom on cr.from_condition_id = cfrom.id JOIN condition cto ON cr.to_condition_id = cto.id";
    foreach ($db->query($sql, PDO::FETCH_NUM) as $row) {
        $content .= "\t\t<edge source=\"{$row[0]}\" target=\"{$row[1]}\" />".PHP_EOL;
    }
    file_put_contents($outputFile, $content, FILE_APPEND);
}

function writeFooter() {
    global $outputFile;
    $footer = <<<EOT
    </graph>
</graphml>
EOT;
    file_put_contents($outputFile, $footer, FILE_APPEND);
}


?>