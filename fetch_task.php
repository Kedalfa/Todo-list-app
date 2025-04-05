<?php
session_start();
require_once 'db.php';

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($tasks as $task) {
    $checked = $task['is_completed'] ? 'checked' : '';
    echo '<li class="list-group-item d-flex justify-content-between align-items-start">';
    echo '<div class="ms-2 me-auto">';
    echo '<div class="fw-bold">'.htmlspecialchars($task['task']).'</div>';
    echo '<small>'.htmlspecialchars($task['description']).'</small><br>';
    echo '<small class="text-muted">'.date("F j, Y, g:i a", strtotime($task['created_at'])).'</small>';
    echo '</div>';
    echo '<div class="d-flex gap-2 align-items-center">';
    echo '<input type="checkbox" '. $checked .' onclick="markCompleted('.$task['id'].', this.checked)">'; 
    echo '<button class="btn btn-sm btn-danger" onclick="deleteTask('.$task['id'].')">Delete</button>';
    echo '</div>';
    echo '</li>';
}
?>
