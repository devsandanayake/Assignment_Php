<!DOCTYPE html>
<html>
<head>
    <title>Invoice Item Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        form label {
            font-weight: bold;
        }

        form input[type="date"] {
            padding: 5px;
        }

        form input[type="submit"] {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
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
    <h2>Invoice Item Report</h2>
    <form action="" method="POST">
        <label>Start Date:</label>
        <input type="date" name="start_date">
        <label>End Date:</label>
        <input type="date" name="end_date">
        <input type="submit" value="Search">
    </form>
    <table>
        <tr>
            <th>Invoice Number</th>
            <th>Invoiced Date</th>
            <th>Customer Name</th>
            <th>Item Name with Item Code</th>
            <th>Item Category</th>
            <th>Item Unit Price</th>
        </tr>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];

                $conn = mysqli_connect("localhost", "root", "", "assignment");
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $sql = "SELECT invoice.invoice_no, invoice.date, CONCAT(customer.first_name, ' ', customer.last_name) AS customer_name,
                        CONCAT(item.item_name, ' (', item.item_code, ')') AS item_with_code, item_category.category, item.unit_price
                        FROM invoice
                        INNER JOIN customer ON invoice.customer = customer.id
                        INNER JOIN invoice_master ON invoice.invoice_no = invoice_master.invoice_no
                        INNER JOIN item ON invoice_master.item_id = item.id
                        INNER JOIN item_category ON item.item_category = item_category.id
                        WHERE invoice.date BETWEEN '$start_date' AND '$end_date'";
                
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['invoice_no'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['customer_name'] . "</td>";
                    echo "<td>" . $row['item_with_code'] . "</td>";
                    echo "<td>" . $row['category'] . "</td>";
                    echo "<td>" . $row['unit_price'] . "</td>";
                    echo "</tr>";
                }

                mysqli_close($conn);
            }
        ?>
    </table>
</body>
</html>
