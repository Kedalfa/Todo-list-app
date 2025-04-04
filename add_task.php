<?php
session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['user_id'])) {
    $task = trim($_POST['task']);
    $user_id = $_SESSION['user_id'];

    if (!empty($task)) {
        $stmt = $pdo->prepare("INSERT INTO tasks (user_id, task) VALUES (?, ?)");
        $stmt->execute([$user_id, $task]);
    }
}

header("Location: dashboard.php");
exit();
?>
