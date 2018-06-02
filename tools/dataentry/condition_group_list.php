<?php

require_once('zheader.php');
require_once('dao/condition_group_dao.php');

echo '<h1>Condition Groups List</h1>'.PHP_EOL;

$data = ConditionGroupDAO::all();

HtmlHelper::tableHeader(array('Id', 'Name', 'Actions'));
foreach ($data as $row) {
    $row[] = "<a href=condition_group_delete.php?id={$row[0]}>Delete</a>";
    $row[0] = "<a href=condition_edit.php?id={$row[0]}>{$row[0]}</a>";
    HtmlHelper::tableRow($row);
}
HtmlHelper::tableFooter();

require_once('zfooter.php');

?>