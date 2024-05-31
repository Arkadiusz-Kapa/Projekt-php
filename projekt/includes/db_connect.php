<?php

$conn = new mysqli("localhost", "root", "", "ksiegarnia_internetowa");

if ($conn->connect_error) {
    die("Połączenie nieudane: " . $conn->connect_error);
}
?>
