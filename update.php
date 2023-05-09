<?php
require_once "connection.php";

$database = new Connection();
$database->update(['id' => 1, 'voornaam' => 'John', 'achternaam' => 'Doe', 'postcode' => '1234AB', 'wachtwoord' => 'newpassword']);
