<?php
require_once("bootstrap.php");
$contatti = $dbh->getAuthors();

header('Content-Type: application/json');
echo json_encode($contatti);
?>