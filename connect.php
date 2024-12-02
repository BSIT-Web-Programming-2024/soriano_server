<?php
// Get form data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$password = $_POST['password'];
$number = $_POST['number'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'test');

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // Prepare the SQL query (make sure there are no syntax errors)
    $query = "INSERT INTO registration (firstName, lastName, gender, email, password, number) 
              VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    
    // Check if the prepare() method was successful
    if ($stmt === false) {
        // Display error message with more details
        die('Error preparing the query: ' . $conn->error);
    }

    // Bind the parameters (ensure the correct data types)
    $stmt->bind_param("ssssss", $firstName, $lastName, $gender, $email, $password, $number);
    
    // Execute the query
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>