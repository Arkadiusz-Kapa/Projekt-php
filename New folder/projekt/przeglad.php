<?php
session_start();
include 'includes/db_connect.php';

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: logowanie.php");
    exit();
}

$role = $_SESSION['role'];
$userId = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Arkadiusz Kapa">
    <meta name="description" content="Przegląd zasobów">
    <meta name="keywords" content="księgarnia, książki, przegląd">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Przegląd zasobów</title>
    <link rel="stylesheet" href="css/przeglad.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <main>
        <div class='center-div'><h1> Przegląd zasobów</h1></div>
        <form method="get">
            <label for="search">Wyszukaj książkę:</label>
            <input type="text" id="search" name="search">
            <button class = 'buttonB' type="submit">Szukaj</button>
        </form>
        <?php
        $search = $_GET['search'] ?? '';
        $search_term = "%$search%";
        $sql = "SELECT * FROM ksiazka WHERE tytul LIKE ? AND ilosc > 0";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $search_term);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<div class='book-container'>";
            while ($row = $result->fetch_assoc()) {
                echo "<div class='book-card'>";
                echo "<h2>{$row['tytul']}</h2>";
                echo "<p><strong>Autor:</strong> {$row['autor']}</p>";
                echo "<p><strong>Cena:</strong> {$row['cena']} zł</p>";
                echo "<p><strong>Opis:</strong> {$row['opis']}</p>";
                if ($role === 'client') {
                    echo "<button class ='buttonB'  onclick=\"window.location.href='zamowienie.php?id={$row['Id_ksiazki']}'\">Kup teraz</button>";
                } elseif ($role === 'admin') {
                    echo "<button  class ='buttonB' onclick=\"window.location.href='ksiazka_edycja.php?id={$row['Id_ksiazki']}'\">Edytuj</button>";
                    echo "<button  class ='buttonB' onclick=\"window.location.href='usun_ksiazke.php?id={$row['Id_ksiazki']}'\">Usuń</button>";
                }
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<p>Nie znaleziono książek</p>";
        }
        ?>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
