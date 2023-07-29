<!DOCTYPE html>
<html>
<head>
    <title>Customer Registration</title>
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
    <h2>Customer Registration</h2>
    <form action="insertCus.php" method="POST">
        <!-- Input fields for customer data -->
        <label>Title:</label>
        <select name="title">
            <option value="Mr">Mr</option>
            <option value="Mrs">Mrs</option>
            <option value="Miss">Miss</option>
            <option value="Dr">Dr</option>
        </select><br><br>
        <label>First Name:</label>
        <input type="text" name="first_name" required><br><br>
        <label>Last Name:</label>
        <input type="text" name="last_name" required><br><br>
        <label>Contact Number:</label>
        <input type="text" name="contact_no" required><br><br>
        <label>District:</label>
        <select name="district">
            <?php
                // database connection
                $conn = mysqli_connect("localhost", "root", "", "assignment");
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Fetch and display districts from the 'district' table
                $sql = "SELECT * FROM district";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['id'] . "'>" . $row['district'] . "</option>";
                }

                
                mysqli_close($conn);
            ?>
        </select><br><br>
        <input type="submit" value="Register Customer">
    </form>
</body>
</html>
