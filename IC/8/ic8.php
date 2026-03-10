

<?php
// module 1
$animals = array('cat', 'mouse', 'dog', 'bird', 'ant');

echo "The $animals[0] was chasing the $animals[1], while the $animals[2] was stomping on the $animals[4].";


?>

<?php
// module 2
$grades = array(
    "Alice" => 85,
    "Bob" => 92,
    "Charlie" => 78,
    "Diana" => 88,
    "Ethan" => 95
);

echo "<h2>Grade Report</h2>";
foreach ($grades as $student => $grade) {
    echo "Student: $student - Grade: $grade<br>";
}
$average = 0;
foreach ($grades as $grade) {
    $average += $grade;
}
$classAverage = $average / count($grades);

echo "<br><strong>Class Average:</strong> " . number_format($classAverage, 2);
?>




<?php

//module 3

$products = array("Laptop", "Mouse", "Keyboard", "Monitor", "Headphones", "Webcam", "USB Drive");

echo "<h3>Original Product List:</h3>";
foreach ($products as $item) {
    echo $item . "<br>";
}

// user removes item from list
$itemToRemove = "Mouse";

$key = array_search($itemToRemove, $products);

// remove it using unset
if ($key !== false) {
    unset($products[$key]);
}

echo "<h3>After Removing One Item (Mouse):</h3>";
foreach ($products as $item) {
    echo $item . "<br>";
}


$removeMultiple = array("Keyboard", "Webcam");

$updatedProducts = array_diff($products, $removeMultiple);


echo "<h3>After Removing Multiple Items (Keyboard, Webcam):</h3>";
foreach ($updatedProducts as $item) {
    echo $item . "<br>";
}
?>


<?php
// module 4
// multidimensional array with name, price, and quantity
$products = [
    ["name" => "Laptop", "price" => 1000, "quantity" => 5],
    ["name" => "Mouse", "price" => 25, "quantity" => 50],
    ["name" => "Keyboard", "price" => 45, "quantity" => 30],
    ["name" => "Monitor", "price" => 200, "quantity" => 10],
    ["name" => "Headphones", "price" => 75, "quantity" => 20],
    ["name" => "Webcam", "price" => 50, "quantity" => 15],
];

// 
echo "<h3>Original Product List:</h3>";
foreach ($products as $product) {
    echo "Name: {$product['name']}, Price: \${$product['price']}, Quantity: {$product['quantity']}<br>";
}
echo "<br>";

// filter products above certain price
$priceThreshold = 100;
$filteredProducts = array_filter($products, function ($product) use ($priceThreshold) {
    return $product['price'] > $priceThreshold;
});
echo "<h3>Products Above \${$priceThreshold}:</h3>";
foreach ($filteredProducts as $product) {
    echo "Name: {$product['name']}, Price: \${$product['price']}, Quantity: {$product['quantity']}<br>";
}
echo "<br>";

// sort by price
usort($products, function ($a, $b) {
    return $a['price'] <=> $b['price'];
});
echo "<h3>Products Sorted by Price:</h3>";
foreach ($products as $product) {
    echo "Name: {$product['name']}, Price: \${$product['price']}, Quantity: {$product['quantity']}<br>";
}
echo "<br>";

// calculate total inventory value using array_reduce
$totalInventoryValue = array_reduce($products, function ($carry, $product) {
    return $carry + ($product['price'] * $product['quantity']);
}, 0);
echo "<h3>Total Inventory Value:</h3>";
echo "\${$totalInventoryValue}<br><br>";

// apply discount to all products using array_map
$discountRate = 0.10; // 10% discount
$discountedProducts = array_map(function ($product) use ($discountRate) {
    $product['price'] = $product['price'] - ($product['price'] * $discountRate);
    return $product;
}, $products);

$discountPercent = $discountRate * 100;
echo "<h3>Products After Applying {$discountPercent}% Discount:</h3>";foreach ($discountedProducts as $product) {
    echo "Name: {$product['name']}, Price: \${$product['price']}, Quantity: {$product['quantity']}<br>";
}
?>