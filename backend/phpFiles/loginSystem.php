<?php
$servername = "localhost";
$username = "appuser";   
$password = "#Zaq12wsx";  
$dbname = "ApplicationForDevelopers";
$dbtable = "users";

// Tworzenie połączenia
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Sprawdzenie połączenia
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Pobranie danych z formularza logowania
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Przygotowanie zapytania SQL do pobrania hasła dla podanego użytkownika
    $stmt = $mysqli->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        // Znaleziono użytkownika, sprawdź hasło
        $stmt->bind_result($userId, $dbUsername, $dbPassword);
        $stmt->fetch();

        if (password_verify($password, $dbPassword)) {
          
            session_start();
            $_SESSION['user_id'] = $userId;
            $_SESSION['username'] = $dbUsername;
            
            echo "Login successful! Welcome, " . $dbUsername;

        } else {
            echo "Incorrect password. Please try again.";
        }
    } else {
        echo "User not found. Please check your username.";
    }

    // Zamknięcie zapytania
    $stmt->close();
}

// Zamknięcie połączenia
$mysqli->close();
?>
