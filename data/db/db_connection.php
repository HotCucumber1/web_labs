<?php
require_once './data/config/config.php';


function createDBConnection(): mysqli {
    $connect = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
    if ($connect->connect_error) {
        echo "Connection failed: " . $connect->connect_error;
    }
    return $connect;
}



function closeDBConnection(mysqli $connect): void {
    $connect->close();
}
