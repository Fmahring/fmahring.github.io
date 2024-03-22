<?php

// Create database connection
const DB_SERVER = 'home.cdomes.at';
const DB_USERNAME = 'fynn';
const DB_PASSWORD = 'm-c7g14V74Mn=Di9';
const DB_DATABASE = 'wahlsystem';


// use mysqli to connect to the mariadb database (the port is 3334)
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, 3334);

// check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

