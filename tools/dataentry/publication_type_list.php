<?php

require_once('zheader.php');
require_once('dao/publication_type_dao.php');

echo '<h1>Publication Types List <a href="publication_type_new.php" class="btn btn-primary ml-3">Add</a></h1>'.PHP_EOL;

$data = PublicationTypeDAO::all();

HtmlHelper::tableHeader(array('Id', 'Name', 'Actions'));
foreach ($data as $row) {
    $row[] = "<a href=publication_type_delete.php?id={$row[0]}>Delete</a>";
    HtmlHelper::tableRow($row);
}
HtmlHelper::tableFooter();

require_once('zfooter.php');

?>