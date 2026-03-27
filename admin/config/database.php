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


// for live 

// <?php
// $host = "127.0.0.1";
// $user = "u586615155_legal_vista";
// $pass = "K1>hDKTvi";
// $db   = "u586615155_legal_vista";
// $port = 3306;

// function getSashDBConnection()
// {
//     global $host, $user, $pass, $db, $port;

//     $conn = new mysqli($host, $user, $pass, $db, $port);

//     if ($conn->connect_error) {
//         die("Database Connection Failed: " . $conn->connect_error);
//     }

//     // ✅ Set charset + collation properly (important)
//     $conn->set_charset("utf8mb4");
//     $conn->query("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");

//     return $conn;
// }
// ?>