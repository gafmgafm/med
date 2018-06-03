<?php

require_once('zheader.php');
require_once('dao/publication_type_dao.php');

echo '<h1>Publication Types List</h1>'.PHP_EOL;

$data = PublicationTypeDAO::all();

HtmlHelper::tableHeader(array('Id', 'Name'));
foreach ($data as $row) {
    HtmlHelper::tableRow($row);
}
HtmlHelper::tableFooter();

require_once('zfooter.php');

?>