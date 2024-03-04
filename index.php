<?php
require_once 'config.php';
require_once 'functions.php';

$conn = getDBConnection();

$dishes = getAllDishes($conn);
$ingredients = getAllIngredients($conn);

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
    <?php foreach ($dishes as $dish): ?>
        <tr>
            <td><?= htmlspecialchars($dish['name']) ?></td>
            <td><?= htmlspecialchars(getIngredientsForDish($conn, $dish['id'])) ?></td>
            <td>
                <a href="update.php?id=<?= $dish['id'] ?>">Edit</a>
                <a href="delete.php?id=<?= $dish['id'] ?>" onclick="return confirm('Are you sure you want to delete this dish?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<p><a href="create.php">Create new dish</a></p>
</body>
</html>