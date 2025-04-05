<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['username'] ?? 'User';

// Fetch tasks for this user
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="script.js"></script>
</head>
<body class="bg-light">

<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Welcome, <span class="text-primary"><?php echo htmlspecialchars($user_name); ?></span>!</h2>
    <a href="logout.php" class="btn btn-outline-danger">Logout</a>
  </div>

  <div class="card mb-4">
    <div class="card-body">
      <h4 class="card-title">Add a New Task</h4>
      <form action="add_task.php" method="POST" class="d-flex gap-3">
        <input type="text" name="task" class="form-control" placeholder="Enter task..." required>
        <button type="submit" class="btn btn-success">Add Task</button>
      </form>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Your Tasks</h4>
      <ul class="list-group">
        <?php if (empty($tasks)): ?>
          <li class="list-group-item text-muted">No tasks yet.</li>
        <?php else: ?>
          <?php foreach ($tasks as $task): ?>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold <?php echo $task['is_completed'] ? 'text-decoration-line-through text-success' : ''; ?>">
                  <?php echo htmlspecialchars($task['task']); ?>
                </div>
                <small class="text-muted"><?php echo date("F j, Y, g:i a", strtotime($task['created_at'])); ?></small>
              </div>
              <div class="d-flex gap-2 align-items-center">
                <input type="checkbox" onclick="markCompleted(<?php echo $task['id']; ?>, this.checked)" <?php echo $task['is_completed'] ? 'checked' : ''; ?>>
                <button class="btn btn-sm btn-danger" onclick="deleteTask(<?php echo $task['id']; ?>)">Delete</button>
              </div>
            </li>
          <?php endforeach; ?>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</div>

</body>
</html>
