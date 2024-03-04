<?php
$stmt = $connection->prepare('SELECT * FROM dishes');
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['name'] . ' - ' . $row['ingredients'] . '<br>';
}
?>