<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <script>
        setTimeout(() => {
            window.location.href = "index.html";
        }, 3000);
    </script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f5f5f5;
            font-family: 'Arial', sans-serif;
        }
        h1 {
            color: #1b5e20;
            margin-bottom: 1rem;
        }
        p {
            color: #ff8f00;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <h1>User Signed In</h1>
    <p>Redirecting to homepage...</p>
    
</body>
</html>
<?php
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone_number = $_POST['phone_number'];

    $host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "customers_db";

    $conn = new mysqli($host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error){
        die("Connection failed: " .  $conn->connect_error);
    }else{
        $stmt = $conn->prepare("insert into customers_info(first_name, last_name, gender, email, password, phone_number)
            values(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $first_name, $last_name, $gender, $email, $password, $phone_number);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
?>