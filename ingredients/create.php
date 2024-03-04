<?php

require 'config.php';
require 'functions.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];

    $stmt = $pdo->prepare('INSERT INTO dishes (name, quantity) VALUES (?, ?)');
    $stmt->execute([$name, $quantity]);

    header('Location: read.php');
}
?>

<form method="post">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>

    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" id="quantity" required>

    <input type="submit" name="submit" value="Create">
</form>