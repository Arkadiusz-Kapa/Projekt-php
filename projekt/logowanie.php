<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Arkadiusz Kapa">
    <meta name="description" content="Logowanie">
    <meta name="keywords" content="księgarnia, logowanie">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="css/logForm.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <main>
        <form method="post" action="logowanie.php">
            <legend class="center"><h1>Zaloguj się</h1></legend>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Hasło:</label>
            <input type="password" id="password" name="password" required>
            <div class="center"><button class="buttonB" type="submit">Zaloguj</button></div>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            include 'includes/db_connect.php';

            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql = "SELECT Id_klienta, role FROM klient WHERE email = '$email' AND haslo = '$password'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                session_start();
                $user = $result->fetch_assoc();
                $_SESSION['user_id'] = $user['Id_klienta'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['logged_in'] = true;

                header("Location: index.php");
                exit();
            } else {
                echo "<p>Błędny email lub hasło</p>";
            }
        }
        ?>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
