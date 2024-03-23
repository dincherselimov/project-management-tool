<?php
include_once('../config/db.php');
include_once('../tasks/tasks.php');

// Check if task_id is set and not empty
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["task_id"]) && !empty($_POST["task_id"])) {
    // Create a new Task instance
    $taskManager = new Task($pdo); 
    
    // Retrieve task_id from POST data
    $taskId = $_POST["task_id"];
    
    // Call deleteTask method to delete the task from the database
    if ($taskManager->deleteTask($taskId)) {
        // Task deleted successfully
        echo "<script>alert('Task deleted successfully');</script>";
    } else {
        // Failed to delete task
        echo "<script>alert('Failed to delete task');</script>";
    }
} else {
    // Task ID not provided
    echo "<script>alert('Task ID not provided');</script>";
}

// Redirect to the main page or any other desired location
echo "<script>window.location.href = 'index.php';</script>";
?>
