<?php
include_once('../config/db.php');
include_once('../tasks/tasks.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if project_id, task_name, and due_date are set and not empty
    if (isset($_POST["project_id"]) && isset($_POST["task_name"]) && isset($_POST["due_date"]) && !empty($_POST["project_id"]) && !empty($_POST["task_name"]) && !empty($_POST["due_date"])) {
        // Create a new Task instance
        $taskManager = new Task($pdo); 
        
        // Retrieve project_id, task_name, and due_date from POST data
        $projectId = $_POST["project_id"];
        $taskName = $_POST["task_name"];
        $dueDate = $_POST["due_date"];
        
        // Call createTask method to add the task to the database
        if ($taskManager->createTask($projectId, $taskName, $dueDate)) {
            // Task added successfully
            echo "<script>alert('Task added successfully');</script>";
            // Redirect to the main page or any other desired location
            echo "<script>window.location.href = 'index.php';</script>";
            exit;
        } else {
            // Failed to add task
            echo "<script>alert('Failed to add task');</script>";
        }
    } else {
        // Missing required fields
        echo "<script>alert('Please fill in all required fields');</script>";
    }
}
?>
