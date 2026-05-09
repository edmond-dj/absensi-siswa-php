<?php
$host = 'localhost';
$db   = 'u419848668_absen';
$user = 'u419848668_absen2';
$pass = 'Umy4HZ?g6';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>