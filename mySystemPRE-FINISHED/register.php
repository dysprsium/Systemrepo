<?php

// Database connection details (replace with your own)
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "my_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data
$username = $_POST["username"];
$password = $_POST["password"]; // Hash password before storing
$id = $_POST["id"]; // Assuming you have a unique identifier
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$section = $_POST["section"];
$address = $_POST["address"];
$contact_number = $_POST["contact_number"];
$email = $_POST["email"];
$birthdate = $_POST["birthdate"];

// Hash password using a strong hashing algorithm (e.g., password_hash)
$hashed_password = password_hash($password, PASSWORD_DEFAULT); 

// Prepare SQL statement with placeholders
$sql = "INSERT INTO users (username, password, id, first_name, last_name, section, address, contact_number, email, birthdate) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// Bind values to placeholders
$stmt->bind_param("sssssssssss", $username, $hashed_password, $id, $first_name, $last_name, $section, $address, $contact_number, $email, $birthdate);

// Execute the statement
if ($stmt->execute()) {
  echo "Registration successful!";
} else {
  echo "Error: " . $sql .
