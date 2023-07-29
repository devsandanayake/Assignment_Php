<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the user input
    $item_code = $_POST['item_code'];
    $item_name = $_POST['item_name'];
    $item_category_id = $_POST['item_category'];
    $item_subcategory_id = $_POST['item_subcategory'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];

    // Perform further form validation checks if required

    // Establish database connection
    $conn = mysqli_connect("localhost", "root", "", "assignment");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert item details into the 'item' table
    $sql = "INSERT INTO item (item_code, item_name, item_category, item_subcategory, quantity, unit_price) 
            VALUES ('$item_code', '$item_name', '$item_category_id', '$item_subcategory_id', '$quantity', '$unit_price')";

    if (mysqli_query($conn, $sql)) {
        echo "Item registered successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
