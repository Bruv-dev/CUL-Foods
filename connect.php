<?php
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "customers_db";

    $conn = new mysqli($host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error){
        die("Connection failed: " .  $conn->connect_error);
    }else{
        $stmt = $conn->prepare("insert into customers_info(firstname, lastname, gender, email, password)
            values(?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstname, $lastname, $gender, $email, $password);
        $stmt->execute();
        echo "registration successful...";
        $stmt->close();
        $conn->close();
    }
?>