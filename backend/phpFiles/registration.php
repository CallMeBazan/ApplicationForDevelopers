<?php

$servername = "localhost";
$username = "appuser";
$password = "#Zaq12wsx";
$dbname = "ApplicationForDevelopers";


$mysqli = new mysqli($servername, $username, $password, $dbname);


if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $checkUserQuery = $mysqli->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $checkUserQuery->bind_param("ss", $username, $email);
    $checkUserQuery->execute();
    $checkUserQuery->store_result();

    if ($checkUserQuery->num_rows > 0) {
        echo "Username or email already taken. Please choose a different one.";
    } else {


        $hashed_password = password_hash($password, PASSWORD_DEFAULT);


        $stmt = $mysqli->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);


        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$checkUserQuery->close();
$mysqli->close();
