<?php

require_once('zheader.php');
require_once('dao/relation_type_dao.php');

echo '<h1>Relation Types List</h1>'.PHP_EOL;

$data = RelationTypeDAO::all();

HtmlHelper::tableHeader(array('Id', 'Name', 'Actions'));
foreach ($data as $row) {
    $row[] = "<a href=relation_type_delete.php?id={$row[0]}>Delete</a>";
    $row[0] = "<a href=relation_type_edit.php?id={$row[0]}>{$row[0]}</a>";
    HtmlHelper::tableRow($row);
}
HtmlHelper::tableFooter();

require_once('zfooter.php'); ?>