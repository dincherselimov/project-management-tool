<?php
include_once('../config/db.php');
include_once('../projects/projects.php');

// Check if project_id is set and not empty
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["project_id"]) && !empty($_POST["project_id"])) {
    // Create a new Project instance
    $projectManager = new Project($pdo); 
    
    // Retrieve project_id from POST data
    $projectId = $_POST["project_id"];
    
    // Call deleteProject method to delete the project from the database
    if ($projectManager->deleteProject($projectId)) {
        // Project deleted successfully
        echo "<script>alert('Project deleted successfully');</script>";
    } else {
        // Failed to delete project
        echo "<script>alert('Failed to delete project');</script>";
    }
} else {
    // Project ID not provided
    echo "<script>alert('Project ID not provided');</script>";
}

// Redirect to the main page or any other desired location
echo "<script>window.location.href = 'index.php';</script>";
?>
