<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Only run the rest if the form was submitted using POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Check if 'name' and 'email' are set in POST
    if (isset($_POST['name']) && isset($_POST['email'])) {
        
        // Get and sanitize user input
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);

        // Validate input
        if (empty($name)) {
            die("Error: Name is required.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Error: Invalid email format.");
        }

        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        // Bind parameters and execute
        $stmt->bind_param("ss", $name, $email);

        if ($stmt->execute()) {
            echo "New record created successfully.";
        } else {
            echo "Error executing statement: " . $stmt->error;
        }

        $stmt->close();

    } else {
        echo "Error: Required fields are missing.";
    }

} else {
    echo "Error: Invalid request method.";
}

// Close the connection
$conn->close();
?>
