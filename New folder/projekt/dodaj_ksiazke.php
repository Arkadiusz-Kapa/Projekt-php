<?php
session_start();
include 'includes/db_connect.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Location: logowanie.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tytul = $conn->$_POST['tytul'];
    $autor = $conn->$_POST['autor'];
    $cena = floatval($_POST['cena']);
    $ilosc = intval($_POST['ilosc']);
    $opis = $conn->$_POST['opis'];

    $sql = "INSERT INTO ksiazka (tytul, autor, cena, ilosc, opis) VALUES ('$tytul', '$autor', '$cena', '$ilosc', '$opis')";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Książka została dodana!</p>";
    } else {
        echo "<p>Błąd podczas dodawania książki: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Arkadiusz Kpa">
    <meta name="description" content="Dodaj książkę">
    <meta name="keywords" content="księgarnia, dodaj książkę">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj książkę</title>
    <link rel="stylesheet" href="css/logForm.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <main>
        <div class="center"><h1>Dodaj książkę</h1></div>
        <form method="post" action="dodaj_ksiazke.php">
            <label for="tytul">Tytuł:</label>
            <input type="text" id="tytul" name="tytul" required>
            <label for="autor">Autor:</label>
            <input type="text" id="autor" name="autor" required>
            <label for="cena">Cena:</label>
            <input type="number" step="0.01" id="cena" name="cena" required>
            <label for="ilosc">Ilość:</label>
            <input type="number" id="ilosc" name="ilosc" required>
            <label for="opis">Opis:</label>
            <textarea id="opis" name="opis" required></textarea>
            <br>
            <button class='buttonB'type="submit">Dodaj książkę</button>
        </form>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>
</html>