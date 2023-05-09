<?php
require_once "connection.php";

$database = new Connection();
$results = $database->get("personen");
print_r($results);
