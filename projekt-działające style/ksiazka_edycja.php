<?php
session_start();
include 'includes/db_connect.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
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
    $title = $conn->$_POST['title'];
    $author = $conn->$_POST['author'];
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);
    $description = $conn->$_POST['description'];

    $sql = "UPDATE ksiazka SET tytul = $title, autor = $author, cena = $price, ilosc = $quantity, opis = $description WHERE Id_ksiazki = $book_id";

    if ($conn->query($sql)===TRUE) {
        echo "<p>Książka została zaktualizowana!</p>";
        header("Location: przeglad.php");
    } else {
        echo "<p>Błąd podczas aktualizacji książki: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Arkadiusz Kapa">
    <meta name="description" content="Edytuj Książkę">
    <meta name="keywords" content="księgarnia, edytuj książkę">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj Książkę</title>
    <link rel="stylesheet" href="css/logForm.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <main>
        
        <div class='center-div'><h1>Edytuj Książkę</h1></div>
        <form method="post" action="ksiazka_edycja.php?id=<?php echo ($book_id); ?>">
            <label for="title">Tytuł:</label>
            <input type="text" id="title" name="title" value="<?php echo ($book['tytul']); ?>" required>
            <label for="author">Autor:</label>
            <input type="text" id="author" name="author" value="<?php echo ($book['autor']); ?>" required>
            <label for="price">Cena:</label>
            <input type="number" id="price" name="price" step="0.01" value="<?php echo ($book['cena']); ?>" required>
            <label for="quantity">Ilość:</label>
            <input type="number" id="quantity" name="quantity" value="<?php echo($book['ilosc']); ?>" required>
            <label for="description">Opis:</label>
            <textarea id="description" name="description" required><?php echo ($book['opis']); ?></textarea>
            <br>
            <button class="buttonB" type="submit" onclick="window.location.href='przeglad.php'">Zaktualizuj Książkę</button>
        </form>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
