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
$password = $_POST["password"];

// Prepare SQL statement
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);

// Bind value to prevent SQL injection
$stmt->bind_param("s", $username);

// Execute the statement
$stmt->execute();

$result = $stmt->get_result();

// Check if a user record is found
if ($result->num_rows > 0) {
  $user = $result->fetch_assoc();
  // Verify password using password_verify function
  if (password_verify($password, $user["password"])) {
    echo "Login successful!";
    // You can store relevant user information in a session for further use
    session_start();
    $_SESSION["user"] = $user;
  } else {
    echo "Invalid password.";
  }
} else {
  echo "Invalid username or password.";
}

$stmt->close();
$conn->close();

?>
