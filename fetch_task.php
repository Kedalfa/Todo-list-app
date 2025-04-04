<?php
session_start();
include 'db.php';

if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = ? ORDER BY id DESC");
    $stmt->execute([$_SESSION['user_id']]);
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tasks as $task) {
        echo "<li class='list-group-item'>" . htmlspecialchars($task['task']) . "</li>";
    }
}
?>
