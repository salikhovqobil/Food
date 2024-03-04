<?php

require 'config.php';
require 'functions.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 5;
$start_from = ($page - 1) * $records_per_page;

$stmt = $pdo->prepare('SELECT * FROM dishes ORDER BY id LIMIT :start_from, :records_per_page');
$stmt->bindValue(':start_from', $start_from, PDO::PARAM_INT);
$stmt->bindValue(':records_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();

$ingredients = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($ingredients as $ingredient) {
    echo '<p>' . $ingredient['name'] . ' - ' . $ingredient['quantity'] . '</p>';
}

// Pagination
$stmt = $pdo->prepare('SELECT COUNT(*) as total_ingredients FROM dishes');
$stmt->execute();
$ingredient_count = $stmt->fetchColumn();

$total_pages = ceil($ingredient_count / $records_per_page);

for ($i = 1; $i <= $total_pages; $i++) {
    echo '<a href="read.php?page=' . $i . '">' . $i . '</a>';
}