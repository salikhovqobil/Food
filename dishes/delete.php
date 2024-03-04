<?php
if (isset($_GET['id'])) {
    try {
        $id = $_GET['id'];

        $sql = "DELETE FROM dishes WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        header('Location: read.php');
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    echo "Something went wrong!";
    exit;
}
?>