<?php
include("./config.php");

if (isset($_POST["submit"])) {
    // Get form data and sanitize it
    $name = htmlspecialchars(trim($_POST["name"]));
    $password = htmlspecialchars(trim($_POST["password"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $agreeTerms = isset($_POST['terms']) ? $_POST['terms'] : '';

    // Escape input for SQL injection prevention
    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        die("Email already exits: ");
    }

    // Hash the password
    $hash_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert user into the database
    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $hash_password);

    if ($stmt->execute()) {
        echo "Registration Succesful";
    } else {
        echo "Error " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
