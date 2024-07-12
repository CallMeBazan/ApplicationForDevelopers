<?php
session_start();
$servername = "localhost";
$username = "appuser";   
$password = "#Zaq12wsx";  
$dbname = "ApplicationForDevelopers";
$dbtable = "users";


$mysqli = new mysqli($servername, $username, $password, $dbname);


if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT id, username, password, plan FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($userId, $dbUsername, $dbPassword, $userPlan);
        $stmt->fetch();

        if (password_verify($password, $dbPassword)) {
            
            $_SESSION['user_id'] = $userId;
            $_SESSION['username'] = $dbUsername;
            $_SESSION['plan'] = $userPlan;
            
            header("Location: http://localhost/ApplicationForDevelopers/dashboard.php");
            exit();  
        } else {
            echo "Incorrect password. Please try again.";
        }
    } else {
        echo "User not found. Please check your username.";
    }

    $stmt->close();
}

$mysqli->close();
?>
