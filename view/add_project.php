<?php
include_once('../config/db.php');
include_once('../projects/projects.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if project_name is set and not empty
    if (isset($_POST["project_name"]) && !empty($_POST["project_name"])) {
        // Create a new Project instance
        $projectManager = new Project($pdo); 
        
        // Retrieve project_name from POST data
        $projectName = $_POST["project_name"];
        
        // Call createProject method to add the project to the database
        if ($projectManager->createProject($projectName)) {
            // Project added successfully
            echo "<script>alert('Project added successfully');</script>";
            // Redirect to the main page or any other desired location
            echo "<script>window.location.href = 'index.php';</script>";
            exit;
        } else {
            // Failed to add project
            echo "<script>alert('Failed to add project');</script>";
        }
    } else {
        // Project name not provided
        echo "<script>alert('Please provide a project name');</script>";
    }
}
?>
