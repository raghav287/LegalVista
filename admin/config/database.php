<?php

$host = "127.0.0.1";
$user = "root";
$pass = "";
$db = "legalvista";
$port = 3306;

function getSashDBConnection()
{
    global $host, $user, $pass, $db, $port;

    $conn = @new mysqli($host, $user, $pass, $db, $port);

    if ($conn->connect_error) {
        error_log("Database Connection Failed: " . $conn->connect_error);
        return null;
    }

    return $conn;
}
