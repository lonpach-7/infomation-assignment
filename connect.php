<?php
// connect.php

$servername = "localhost";
$username = "username";
$password = "";
$database = "contact_details";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Register User
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO contacts (name, email, password, phone) VALUES ('$fullName', '$email', '$hashed_password', '$phone')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Login Functionality (Uncomment and implement your actual logic)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM contacts WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            echo "Login successful!";
        } else {
            echo "Invalid email or password";
        }
    } else {
        echo "Invalid email or password";
    }
}


$conn->close();
?>
