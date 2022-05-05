<?php
const SERVER_NAME = 'localhost';
const DB_NAME = 'qldoan';
const DB_USER = 'root';
const DB_PASS = '';

$connection = new mysqli(SERVER_NAME, DB_USER, DB_PASS, DB_NAME);
if ($connection->connect_error) {
    echo 'Connection failed: ' . $connection->connect_error;
}
$connection->set_charset('utf8');
