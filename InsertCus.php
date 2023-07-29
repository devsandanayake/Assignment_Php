<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $title = $_POST['title'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $contact_no = $_POST['contact_no'];
    $district_id = $_POST['district'];

     // Validate title (required field)
     if (empty($title)) {
        $errors['title'] = "Title is required.";
    }

    // Validate first name (required field)
    if (empty($first_name)) {
        $errors['first_name'] = "First name is required.";
    }

    // Validate last name (required field)
    if (empty($last_name)) {
        $errors['last_name'] = "Last name is required.";
    }

    // Validate contact number (required field and numeric)
    if (empty($contact_no)) {
        $errors['contact_no'] = "Contact number is required.";
    } elseif (!is_numeric($contact_no)) {
        $errors['contact_no'] = "Contact number must be numeric.";
    }

    // Validate district (required field)
    if (empty($district_id)) {
        $errors['district'] = "District is required.";
    }

    // database connection
    $conn = mysqli_connect("localhost", "root","", "assignment");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert customer data 
    $sql = "INSERT INTO customer (title, first_name, last_name, contact_no, district) 
            VALUES ('$title', '$first_name', '$last_name', '$contact_no', '$district_id')";

    if (mysqli_query($conn, $sql)) {
        echo "Customer registered successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
