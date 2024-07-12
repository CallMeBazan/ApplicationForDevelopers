<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="frontend/css/dashboard.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Dashboard</title>
</head>

<body>
    <div class="top-bar">

        <?php
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }
        
        $user_id = $_SESSION['user_id'];
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Użytkownik';
        $_SESSION['plan'] = 'Free';
        $plan = isset($_SESSION['plan']) ? $_SESSION['plan'] : 'free';

        echo "<h1>Welcome  $username</h1>";
        ?>

    </div>

    <div class="container">
        <div class="box box-messages">
            <li><a href="chat.html"><i class='bx bx-message-dots'></i></a></li>
            <h1>Chat</h1>
        </div>

        <div class="box box-buildings">
            <li><a href="#"><i class='bx bx-building-house'></i></a></li>
            <h1>Announcements</h1>
        </div>
        <div class="box box-wallet">
            <li><a href="#"><i class='bx bx-wallet'></i></a></li>
            <h1>Your Plan: <?php echo $plan ?></h1>
        </div>
        <div class="box box-cog">
            <li><a href="#"><i class='bx bx-cog'></i></a></li>
            <h1>Settings</h1>
        </div>

        <div class="box box-account">
            <li><a href="#"><i class='bx bxs-user-account'></i></a></li>
            <h1>Account</h1>
        </div>

        <div class="box box-logOut">
            <li><a href="backend/phpFiles/logout.php"><i class='bx bx-log-out'></i></a></li>
            <h1>Logout</h1>
        </div>
    </div>

    <!--JS-->
    <script src="dashboard.js"></script>
</body>
</html>
