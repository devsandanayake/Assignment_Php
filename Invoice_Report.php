<!DOCTYPE html>
<html>
<head>
    <title>Invoice Report</title>
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
    <h2>Invoice Report</h2>
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
            <th>Date</th>
            <th>Customer</th>
            <th>Customer District</th>
            <th>Item Count</th>
            <th>Invoice Amount</th>
        </tr>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];

                $conn = mysqli_connect("localhost", "root", "", "assignment");
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $sql = "SELECT invoice_no, date, first_name, last_name, district, item_count, amount 
                        FROM invoice
                        INNER JOIN customer ON invoice.customer = customer.id
                        WHERE date BETWEEN '$start_date' AND '$end_date'";
                
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['invoice_no'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
                    echo "<td>" . $row['district'] . "</td>";
                    echo "<td>" . $row['item_count'] . "</td>";
                    echo "<td>" . $row['amount'] . "</td>";
                    echo "</tr>";
                }

                mysqli_close($conn);
            }
        ?>
    </table>
</body>
</html>
