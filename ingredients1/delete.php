<?php

require 'config.php';
require 'functions.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    if (isset($_POST['submit'])) {
        $stmt = $pdo->prepare('DELETE FROM dishes WHERE id = ?');
        $stmt->execute([$id]);

        header('Location: read.php');
    }

    echo '<p>Are you sure you want to delete this ingredient?</p>';
    echo '<form method="post">';
    echo '<input type="submit" name="submit" value="Delete">';
    echo '</form>';
} else {
    exit('Invalid ingredient ID');
}