<html class="no-js" lang="">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Data Entry</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="z.css">
<script src="z.js"></script>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-default">
        <a class="navbar-brand" href="/index.php">Data Entry</a>
        <ul class="nav navbar-nav">
            <li><a class="nav-link" href="/condition_list.php">Condition</a></li>
            <li><a class="nav-link" href="/condition_group_list.php">Condition Group</a></li>
            <li><a class="nav-link" href="/publication_list.php">Publication</a></li>
            <li><a class="nav-link">&nbsp;|&nbsp;</a></li>
            <li><a class="nav-link" href="/condition_type_list.php">Condition Type</a></li>
            <li><a class="nav-link" href="/relation_type_list.php">Relation Type</a></li>
            <li><a class="nav-link" href="/publication_type_list.php">Publication Type</a></li>
        </ul>
    </nav>
<?php
error_reporting(-1);
require_once(__DIR__.'/../lib/lib.php');
require_once(__DIR__.'/zutil.php');
$PAGE = currentPage(true);
?>