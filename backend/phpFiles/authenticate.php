<?php
use PhpMyAdmin\Server\Select;

session_start();

$db_table = "login_panel";

require_once "connect.php";

$connect = @new mysqli($host, $db_user, $db_password, $db_name);

if ($connect->connect_errno != 0) {
    echo "error: " . $connect->errno;
} else {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM login_panel WHERE username='$login' AND password='$password'";

    if ($result = @$connect->query($sql)) {
        $numbers_of_users = $result->num_rows;
        if ($numbers_of_users >= 1) {
            $_SESSION['logged-on'] = true;
            $row_in_table = $result->fetch_assoc();
            $_SESSION['id'] = $row_in_table['id'];
            $_SESSION['user'] = $row_in_table['username'];
            $_SESSION['password'] = $row_in_table['password'];
            $_SESSION['mail'] = $row_in_table['mail'];

            unset($_SESSION['blad']);
            $result->close();
            header('Location: http://localhost/ApplicationForDevelopers/dashboard.html');

        } else {
            $_SESSION['blad'] = '<span style="red">Wrong login or password!</span>';

            if (isset($_SESSION['blad'])) {
                echo $_SESSION['blad'];
            }

        }


    }
    $connect->close();
}



?>