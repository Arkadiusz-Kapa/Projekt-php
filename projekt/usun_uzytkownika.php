<?php
session_start();
include 'includes/db_connect.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Location: logowanie.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = intval($_POST['user_id']);
    
    $sql = "DELETE FROM klient WHERE Id_klienta = $user_id";
    if ($conn->query($sql)===TRUE) {
        echo "<p>Użytkownik został usunięty!</p>";
    } else {
        echo "<p>Błąd podczas usuwania użytkownika: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Arkadiusz Kappa">
    <meta name="description" content="Usuwanie użytkownika">
    <meta name="keywords" content="księgarnia, usuwanie użytkownika">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuwanie użytkownika</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <main class="center-div">
        <div>
            <h1>Usuwanie użytkownika</h1>
            <form method="post" action="usun_uzytkownika.php">
                <label for="user_id">ID użytkownika do usunięcia:</label>
                <input type="number" id="user_id" name="user_id" required>
                <button type="submit">Usuń użytkownika</button>
            </form>
            <h2>Lista użytkowników</h2>
            <?php
            $sql = "SELECT Id_klienta, Imie, Nazwisko, Email FROM klient";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<div class='table-container'>";
                echo "<table>";
                echo "<tr><th>ID</th><th>Imię</th><th>Nazwisko</th><th>Email</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['Id_klienta'] . "</td>";
                    echo "<td>" . $row['Imie'] . "</td>";
                    echo "<td>" . $row['Nazwisko'] . "</td>";
                    echo "<td>" . $row['Email'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
            } else {
                echo "<p>Brak użytkowników w bazie danych</p>";
            }
            ?>
        </div>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
