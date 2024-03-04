<?php

// Function for connecting to the database
function getDBConnection() {
    $host = 'localhost';
    $dbname = 'my_database';
    $user = 'my_username';
    $pass = 'my_password';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}

// Function for getting all dishes from the database
function getAllDishes($conn) {
    $sql = 'SELECT * FROM dishes';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function for getting all ingredients from the database
function getAllIngredients($conn) {
    $sql = 'SELECT * FROM ingredients';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>