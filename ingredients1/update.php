<?php
require 'config.php';
require 'functions.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $quantity = $_POST['quantity'];

        $stmt = $pdo->prepare('UPDATE dishes SET name = ?, quantity = ? WHERE id = ?');
        $stmt->execute([$name, $quantity, $id]);

        header('Location: read.php');
    }

    $stmt = $pdo->prepare('SELECT * FROM dishes WHERE id = ?');
    $stmt->execute([$id]);
    $ingredient = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    exit('Invalid ingredient ID');
}
?>

<form method="post">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="<?php echo escape($ingredient['name']); ?>" required>

    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" id="quantity" value="<?php echo escape($ingredient['quantity']); ?>" required>

    <input type="submit" name="submit" value="Update">
</form>