<?php
require_once 'config.php';
require_once 'functions.php';

$conn = getDBConnection();

if (isset($_POST['ingredient'])) {
    $ingredientId = (int)$_POST['ingredient'];
    $dishes = getDishesByIngredient($conn, $ingredientId);
} else {
    $dishes = getAllDishes($conn);
}

$conn = null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dish Manager</title>
</head>
<body>
<h1>Dishes</h1>
<form action="search.php" method="post">
    <label for="ingredient">Search by ingredient:</label>
    <select name="ingredient" id="ingredient">
        <option value="">Select an ingredient...</option>
        <?php foreach ($ingredients as $ingredient): ?>
            <option value="<?= $ingredient['id'] ?>"><?= htmlspecialchars($ingredient['name']) ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Search</button>
</form>
<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Ingredients</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($dishes as $dish); ?>