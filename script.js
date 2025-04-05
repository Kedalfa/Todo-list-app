function deleteTask(id) {
    if (confirm("Are you sure you want to delete this task?")) {
        fetch('delete_task.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `id=${id}`
        }).then(() => location.reload());
    }
}

function markCompleted(id, status) {
    fetch('mark_completed.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id=${id}&completed=${status ? 1 : 0}`
    }).then(() => location.reload());
}
