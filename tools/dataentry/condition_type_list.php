<?php

require_once('zheader.php');
require_once('dao/condition_type_dao.php');

echo '<h1>Condition Types List</h1>'.PHP_EOL;

$data = ConditionTypeDAO::all();

HtmlHelper::tableHeader(array('Id', 'Name'));
foreach ($data as $row) {
    HtmlHelper::tableRow($row);
}
HtmlHelper::tableFooter();

require_once('zfooter.php');

?>