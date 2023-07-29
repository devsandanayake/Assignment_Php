<!DOCTYPE html>
<html>
<head>
    <title>Item Registration</title>
    <style>
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        h2 {
            margin-bottom: 20px;
        }
        form {
            display: inline-block;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: inline-block;
            width: 150px;
            text-align: right;
            margin-right: 10px;
        }
        input[type="text"],
        select {
            width: 200px;
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Item Registration</h2>
    <form action="item_insert.php" method="POST">
        <!-- Input fields for customer data -->
        <label>Item Code:</label>
        <input type="text" name="item_code" required><br><br>
        <label>Item Name:</label>
        <input type="text" name="item_name" required><br><br>
        <label>Item Category:</label>
        <select name="item_category">
            <?php
                 // database connection
                 $conn = mysqli_connect("localhost", "root", "", "assignment");
                 if (!$conn) {
                     die("Connection failed: " . mysqli_connect_error());
                 }
 
                 
                 $sql = "SELECT * FROM item_category";
                 $result = mysqli_query($conn, $sql);
                 while ($row = mysqli_fetch_assoc($result)) {
                     echo "<option value='" . $row['id'] . "'>" . $row['category'] . "</option>";
                 }
 
                 
                 mysqli_close($conn);
            ?>
        </select><br><br>
        <label>Item Subcategory:</label>
        <select name="item_subcategory">
        <?php
    

            $conn = mysqli_connect("localhost", "root", "", "assignment");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT * FROM item_subcategory";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['id'] . "'>" . $row['sub_category'] . "</option>";
            }

            mysqli_close($conn);
        
    ?>
        </select><br><br>
        <label>Quantity:</label>
        <input type="text" name="quantity" required><br><br>
        <label>Unit Price:</label>
        <input type="text" name="unit_price" required><br><br>
        <input type="submit" value="Register Item">
    </form>
</body>
</html>
