<?php

$conn = new \PDO('sqlite::memory:');
$conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
$sql = "CREATE TABLE products(
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name VARCHAR(255)
        )";
$conn->exec($sql);

$products = ["computer", "mobile phone", "tv", "kettle"];

// BEGIN (write your solution here)
$sql1 = "INSERT INTO products (name) VALUES (:name)";
$stmt = $conn->prepare($sql1);
$stmt->bindParam(':name', $name);

for ($i=0, $count=count($products); $i < $count; $i++) {
    $name = $products[$i];
    $stmt->execute();
}
// END

$sql2 = "SELECT * FROM products";
$stmt = $conn->query($sql2);
print_r($stmt->fetchColumn(0));