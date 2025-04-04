document.getElementById('task-form').addEventListener('submit', function (event) {
    event.preventDefault();

    const taskInput = document.getElementById('task');
    const taskName = taskInput.value.trim();

    if (taskName) {
        // Call function to add task to the database
        addTaskToDB(taskName);
        taskInput.value = ''; // Clear input field
    }
});

// Function to add a task to the database (PHP request will go here later)
function addTaskToDB(taskName) {
    // Placeholder: log the task to console for now
    console.log('Task added:', taskName);
    // Add task to the UI list
    addTaskToUI(taskName);
}

// Function to add task to the UI (without reloading)
function addTaskToUI(taskName) {
    const taskList = document.getElementById('task-list');
    const li = document.createElement('li');
    li.textContent = taskName;

    const deleteButton = document.createElement('button');
    deleteButton.textContent = 'Delete';
    deleteButton.onclick = function () {
        li.remove();
        // Call function to delete task from database
    };

    li.appendChild(deleteButton);
    taskList.appendChild(li);
}
