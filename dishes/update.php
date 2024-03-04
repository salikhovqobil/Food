<?php
if (isset($_GET['id'])) {
    try {
        $id = $_GET['id'];

        $sql = "SELECT * FROM dishes WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $dishes = $statement->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    echo "Something went wrong!";
    exit;
}

// Form for updating the dish
echo '
<form method="post">
  <label for="name">Name:</label>
  <input type="text" name="name" id="name" value="' . $dishes['name'] . '" required>

  <label for="ingredients">Ingredients:</label>
  <input type="text" name="ingredients" id="ingredients" value="' . $dishes['ingredients'] . '" required>

  <input type="hidden" name="id" value="' . $dishes['id'] . '">

  <input type="submit" name="submit" value="Update">
</form>
';

// Process the form submission
if (isset($_POST['submit'])) {
    try {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $ingredients = $_POST['ingredients'];

        $sql = "UPDATE dishes SET name = :name, ingredients = :ingredients WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':ingredients', $ingredients);
        $statement->execute();

        header('Location: read.php');
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}