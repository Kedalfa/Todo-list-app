<?php
session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'], $_POST['completed'], $_SESSION['user_id'])) {
    $stmt = $pdo->prepare("UPDATE tasks SET is_completed = ? WHERE id = ? AND user_id = ?");
    $stmt->execute([$_POST['completed'], $_POST['id'], $_SESSION['user_id']]);
}
?>
