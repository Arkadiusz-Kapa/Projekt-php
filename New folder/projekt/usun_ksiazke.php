<?php
session_start();
include 'includes/db_connect.php';

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || $_SESSION['role'] !== 'admin') {
    header("Location: logowanie.php");
    exit();
}

$book_id = $_GET['id'];

$sql = "DELETE FROM ksiazka WHERE Id_ksiazki = $book_id";
if ($conn->query($sql) === TRUE) {
    echo "<p>Książka została usunięta!</p>";
    header("Location: przeglad.php");
} else {
    echo "<p>Błąd podczas usuwania książki: " . $conn->error . "</p>";
}
?>
