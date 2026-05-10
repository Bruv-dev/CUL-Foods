<?php
    // 1. Capture the data from the form
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone_number = $_POST['phone_number'];

    // 2. Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // 3. Database connection details
    $host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "cul_users_db";

    // 4. Create the connection (This defines $conn)
    $conn = new mysqli($host, $db_user, $db_pass, $db_name);

    // 5. Check the connection
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    } else {
        // 6. Prepare and bind
        $stmt = $conn->prepare("insert into users_info(first_name, last_name, gender, email, password, phone_number) values(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $first_name, $last_name, $gender, $email, $hashed_password, $phone_number);
        
        if ($stmt->execute()) {
            // SHOW SUCCESS HTML
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <link rel="icon" href="assets/images/favicon.png">
                <title>Success</title>
                <script>
                    setTimeout(() => { window.location.href = "index.html"; }, 3000);
                </script>
                <style>
                    body { display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100vh; background-color: #f5f5f5; font-family: Arial; }
                    h1 { color: #1b5e20; }
                    p { color: #ff8f00; }
                </style>
            </head>
            <body>
                <h1>Registration Successful!</h1>
                <p>Redirecting to homepage...</p>
            </body>
            </html>
            <?php
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
?>