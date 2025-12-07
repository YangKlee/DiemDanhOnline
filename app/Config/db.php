<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pdo = new PDO(
    "mysql:host=localhost;dbname=diemdanhonline;charset=utf8mb4",
    "root",
    ""
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

return $pdo;
