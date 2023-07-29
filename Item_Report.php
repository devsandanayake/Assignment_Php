<!DOCTYPE html>
<html>
<head>
    <title>Item Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 20px;
            cursor: pointer;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h2>Item Report</h2>
    <table>
        <tr>
            <th>Item Name</th>
            <th>Item Category</th>
            <th>Item Subcategory</th>
            <th>Item Quantity</th>
        </tr>
        <?php
            $conn = mysqli_connect("localhost", "root", "", "assignment");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT DISTINCT item.item_name, item_category.category, item_subcategory.sub_category, item.quantity
                    FROM item
                    INNER JOIN item_category ON item.item_category = item_category.id
                    INNER JOIN item_subcategory ON item.item_subcategory = item_subcategory.id";
            
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['item_name'] . "</td>";
                echo "<td>" . $row['category'] . "</td>";
                echo "<td>" . $row['sub_category'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "</tr>";
            }

            mysqli_close($conn);
        ?>
    </table>
</body>
</html>
