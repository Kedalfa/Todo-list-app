<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['user_id'])) {
    $task = $_POST['task'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO tasks (user_id, task) VALUES (?, ?)");
    $stmt->execute([$user_id, $task]);

    header("Location: dashboard.html");
    exit();
}
?>
