<?php
const HOST = 'localhost';
const USERNAME = 'hotcucumber';
const PASSWORD = 'Boks2005';
const DATABASE = 'blog';


function createDBConnection(): mysqli {
    $connect = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
    if ($connect -> connect_error) {
        echo "Connection failed: " . $connect -> connect_error;
    }
    # echo "Connection successful <br>";
    return $connect;
}


function closeDBConnection(mysqli $connect): void {
    $connect -> close();
}
