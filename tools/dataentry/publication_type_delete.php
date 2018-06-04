<?php

require_once('zheader.php');
require_once('dao/publication_type_dao.php');

PublicationTypeDAO::delete($_GET['id']);
echo "<script>window.location.replace('publication_type_list.php');</script>";

require_once('zfooter.php'); 
?>