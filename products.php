<?php
include 'db.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

echo "<div style='font-family: Arial, sans-serif; text-align: center;'>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div style='display: inline-block; width: 30%; margin: 10px; padding: 20px; border: 1px solid #ddd; border-radius: 8px;'>
                <h3>" . $row['name'] . "</h3>
                <img src='" . $row['picture'] . "' alt='" . $row['name'] . "' style='width: 100%; height: auto;'>
                <p>" . $row['detail'] . "</p>
                <p><strong>$" . $row['price'] . "</strong></p>
                <form method='POST' action='add_to_cart.php'>
                    <input type='hidden' name='product_id' value='" . $row['id'] . "'>
                    <button type='submit'>Add to Cart</button>
                </form>
              </div>";
    }
} else {
    echo "<p>No products available!</p>";
}

echo "</div>";
?>
