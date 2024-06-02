<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Arkadiusz Kapa">
    <meta name="description" content="Rejestracja">
    <meta name="keywords" content="księgarnia, rejestracja">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="css/logForm.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <main>
        
        <form method="post" action="rejestracja.php">
            <legend class="center"><h1>Rejestracja</h1></legend>

            <label for="nazwisko">Nazwisko:</label>
            <input type="text" id="nazwisko" name="nazwisko" required>

            <label for="imie">Imię:</label>
            <input type="text" id="imie" name="imie" required>

            <label for="telefon">Telefon:</label>
            <input type="text" id="telefon" name="telefon" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Hasło:</label>
            <input type="password" id="password" name="password" required>

            <div class="center"><button class="buttonB" type="submit">Zarejestruj</button></div>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            include 'includes/db_connect.php';

            $nazwisko = $_POST['nazwisko'];
            $imie = $_POST['imie'];
            $telefon = $_POST['telefon'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql = "INSERT INTO klient (Nazwisko, Imie, Telefon, Email, haslo) VALUES ('$nazwisko', '$imie', '$telefon', '$email', '$password')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Rejestracja udana! Możesz się teraz <a href='logowanie.php'>zalogować</a>.</p>";
            } else {
                echo "<p>Błąd podczas rejestracji: " . $conn->error . "</p>";
            }
        }
        ?>
    </main>

    <?php include 'includes/footer.php'; ?>
    
</body>
</html>
