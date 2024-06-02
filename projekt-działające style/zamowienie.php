<?php
session_start();
include 'includes/db_connect.php';

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: logowanie.php");
    exit();
}

$book_id = $_GET['id'];

$sql = "SELECT * FROM ksiazka WHERE Id_ksiazki = $book_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $book = $result->fetch_assoc();
} else {
    echo "<p>Nie znaleziono książki</p>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $address = $conn->$_POST['address'];
    $quantity = intval($_POST['quantity']);
    $client_id = $_SESSION['user_id'];

    $total_price = $book['cena'] * $quantity;

    $sql = "INSERT INTO zamowienia (Id_klienta, Id_ksiazki, Ilosc, Adres_dostawy, Cena_calkowita) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiisd", $client_id, $book_id, $quantity, $address, $total_price);
    if ($stmt->execute()) {
        echo "<p>Zamówienie zostało złożone!</p>";
    } else {
        echo "<p>Błąd podczas składania zamówienia: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Arkadiusz Kapa">
    <meta name="description" content="Zamówienie">
    <meta name="keywords" content="księgarnia, zamówienie">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zamówienie</title>
    <link rel="stylesheet" href="css/przeglad.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <main>
        <div class="center-div">
        <br><br>
            <h1>Zamówienie</h1>
            <br>
        <div class="book-card">
            <h2><?php echo $book['tytul']; ?></h2>
            <p><strong>Autor:</strong> <?php echo $book['autor']; ?></p>
            <p><strong>Cena:</strong> <?php echo $book['cena']; ?> zł</p>
            <p><strong>Opis:</strong> <?php echo ($book['opis']); ?></p>
        </div></div>
        <br>
        <br>
        <br>
        <form method="post" action="zamowienie.php?id=<?php echo $book_id; ?>">
            <label for="quantity">Ilość:</label>
            <input type="number" id="quantity" name="quantity" value="1" min="1" max="<?php echo $book['ilosc']; ?>" required>
            <label for="address">Adres dostawy:</label>
            <input type="text" id="address" name="address" required>
            <button class="buttonB" type="submit">Złóż zamówienie</button>
        </form>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
