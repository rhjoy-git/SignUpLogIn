<?php
// Database connection
include("./config.php");

if (isset($_POST["submit"])) {
    // Get form data and sanitize it
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $remember_me = isset($_POST['remember-me']) ? $_POST['remember-me'] : '';
    // Escape input for SQL injection prevention
    $email = $conn->real_escape_string($email);
    // Check if the user exists
    $sql = "SELECT id, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();
        // Verify the password
        if (password_verify($password, $hashed_password)) {
            session_start();
            $_SESSION["id"] = $user_id;
            $_SESSION["email"] = $email;

            // Set remember me cookie if checked
            if (!empty($remember_me)) {
                $cookie_value = base64_encode(json_encode(['user_id' => $user_id, 'email' => $email]));
                setcookie('remember_me', $cookie_value, time() + (86400 * 30), "/"); // 30 days
            }

            echo "Login successful! Welcome, " . $email;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Mail not match";
    }
}
$stmt->close();
$conn->close();
