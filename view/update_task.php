<?php
include_once('../config/db.php');
include_once('../tasks/tasks.php');


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    // Check if task_id, task_name, and due_date are set and not empty
    if (isset($_POST["task_id"]) && isset($_POST["task_name"]) && isset($_POST["due_date"]) 
    && !empty($_POST["task_id"]) && !empty($_POST["task_name"]) && !empty($_POST["due_date"])) {

        $taskManager = new Task($pdo); 
        
        // Retrieve task_id, task_name, and due_date from POST data
        $taskId = $_POST["task_id"];
        $taskName = $_POST["task_name"];
        $dueDate = $_POST["due_date"];
        
        // Call updateTask method to update the task in the database
        if ($taskManager->updateTask($taskId, $taskName, $dueDate)) {
            // Task updated successfully
            echo "<script>alert('Task updated successfully');</script>";
        } else {
            // Failed to update task
            echo "<script>alert('Failed to update task');</script>";
        }
    } else {
        // Missing required fields
        echo "<script>alert('Please fill in all required fields');</script>";
    }
}

// Redirect to the main page or any other desired location
echo "<script>window.location.href = 'index.php';</script>";
?>
