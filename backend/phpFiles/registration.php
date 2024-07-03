<?php
session_start();

$db_table = "users";
require_once "connect.php";

// Tworzenie połączenia z bazą danych
$mysqli = new mysqli($host, $db_user, $db_password, $db_name);

// Sprawdzenie połączenia
if ($mysqli->connect_error) {
    die("Error: " . $mysqli->connect_error);
}

if (isset($_POST['registration'])) {
    $email = $_POST['email'];
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Przygotowanie zapytania SQL
    $sql = "SELECT login FROM users WHERE login = ?";

    // Przygotowanie i wykonanie zapytania
    $stmt = $mysqli->prepare($sql);
    if (!$stmt) {
        die("Error: " . $mysqli->error);
    }
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $stmt->store_result();

    // Sprawdzenie, czy login istnieje
    if ($stmt->num_rows > 0) {
        echo "Login is used";
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Przygotowanie zapytania do dodania nowego użytkownika
        $insert_sql = "INSERT INTO users (email, login, haslo) VALUES (?, ?, ?)";
        $insert_stmt = $mysqli->prepare($insert_sql);
        if (!$insert_stmt) {
            die("Error: " . $mysqli->error);
        }
        $insert_stmt->bind_param("sss", $email, $login, $hashed_password);

        if ($insert_stmt->execute()) {
            echo "Registration successful";
        } else {
            echo "Error: " . $insert_stmt->error;
        }

        $insert_stmt->close();
    }

    $stmt->close();
    $mysqli->close();
}
?>