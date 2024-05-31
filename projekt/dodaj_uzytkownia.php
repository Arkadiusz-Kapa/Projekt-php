<?php
session_start();
include 'includes/db_connect.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Location: logowanie.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    $sql = "INSERT INTO klient (Nazwisko, Imie, Telefon, Email, haslo, role) VALUES ('$nazwisko', '$imie', '$telefon', '$email', '$password', '$role')";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Nowy użytkownik został utworzony!</p>";
    } else {
        echo "<p>Błąd podczas tworzenia użytkownika: " . $conn->error . "</p>";
    }
    #ctrl c ctrl v z dodawania  ksiazki
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Arkadiusz Kapa">
    <meta name="description" content="Tworzenie użytkownika">
    <meta name="keywords" content="księgarnia, tworzenie użytkownika">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tworzenie użytkownika</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <main>
        <form method="post" action="create_user.php">
            <legend class="center"><h1>Twórz użytkownika</h1></legend>
            <label for="imie">Imię:</label>
            <input type="text" id="imie" name="imie" required>
            <label for="nazwisko">Nazwisko:</label>
            <input type="text" id="nazwisko" name="nazwisko" required>
            <label for="telefon">Telefon:</label>
            <input type="text" id="telefon" name="telefon">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Hasło:</label>
            <input type="password" id="password" name="password" required>
            <label for="role">Rola:</label>
            <select id="role" name="role">
                <option value="client">Klient</option>
                <option value="admin">Admin</option>
            </select>
            <div class="center"><button class="buttonB" type="submit">Stwórz użytkownika</button></div>
        </form>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
