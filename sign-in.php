<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $host = "localhost";
        $db_user = "root";
        $db_pass = "";
        $db_name = "cul_users_db";

        $conn = new mysqli($host, $db_user, $db_pass, $db_name);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            // Find the user by email
            $stmt = $conn->prepare("SELECT password FROM users_info WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($hashed_password);
            
            if ($stmt->fetch()) {
                // Verify the password
                if (password_verify($password, $hashed_password)) {
                    $_SESSION['email'] = $email;
                    header("Location: welcome.php");
                } else {
                    echo "Invalid email or password.";
                }
            } else {
                echo "Invalid email or password.";
            }

            $stmt->close();
            $conn->close();
        }
    }
?>