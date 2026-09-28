<?php
$dbHost = "CHANGE_ME";
$dbPort = "CHANGE_ME";
$dbName = "CHANGE_ME";
$dbUser = "CHANGE_ME";
$dbPass = "CHANGE_ME";

try {
    $pdo = new PDO(
        "mysql:host=$dbHost;port=$dbPort;dbname=$dbName;charset=utf8mb4",
        $dbUser,
        $dbPass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    error_log($e->getMessage());
    die("Database connection failed.");
}