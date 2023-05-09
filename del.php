<?php
require_once "connection.php";

$database = new Connection();
$database->del(2);
