<?php

require_once('zheader.php');
require_once('dao/publication_dao.php');

echo '<h1>Publications List</h1>'.PHP_EOL;

$data = PublicationDAO::all();

HtmlHelper::tableHeader(array('Id', 'Name', 'Actions'));
foreach ($data as $row) {
    $row[] = "<a href=publication_delete.php?id={$row[0]}>Delete</a>";
    $row[0] = "<a href=publication_edit.php?id={$row[0]}>{$row[0]}</a>";
    HtmlHelper::tableRow($row);
}
HtmlHelper::tableFooter();

require_once('zfooter.php'); ?>