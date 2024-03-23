<?php
include_once('../config/db.php');
include_once('../projects/projects.php');
include_once('../tasks/tasks.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management Tool</title>
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <h1>Project Management Tool</h1>

    <a href="add_project_form.php"><button>Create Project</button></a>
    <a href="add_task_form.php"><button>Add Task</button></a>
    <div class="projects-container">
        <?php

        $projectManager = new Project($pdo); 
        $projectsList = $projectManager->getAllProjects(); 

        foreach ($projectsList as $project) {
            echo "<div class='project'>";
            echo "<h3>{$project['name']}</h3>";
            // Update and delete project buttons
            echo "<div class='button-group'>";
            echo "<form action='update_project_form.php' method='POST'>";
            echo "<input type='hidden' name='project_id' value='{$project['id']}'>";
            echo "<button type='submit'>Update Project</button>";
            echo "</form>";
            echo "<form action='delete_project.php' method='POST'>";
            echo "<input type='hidden' name='project_id' value='{$project['id']}'>";
            echo "<button type='submit'>Delete Project</button>";
            echo "</form>";
            echo "</div>";
            $taskManager = new Task($pdo); 
            $tasksList = $taskManager->getTasksByProject($project['id']); 
            echo "<ul>";
            foreach ($tasksList as $task) {
                echo "<li>{$task['task_name']} - Due Date: {$task['due_date']}";
                // Update and delete task buttons
                echo "<div class='button-group'>";
                echo "<form action='update_task_form.php' method='POST'>";
                echo "<input type='hidden' name='task_id' value='{$task['id']}'>";
                echo "<button type='submit'>Update Task</button>";
                echo "</form>";
                echo "<form action='delete_task.php' method='POST'>";
                echo "<input type='hidden' name='task_id' value='{$task['id']}'>";
                echo "<button type='submit'>Delete Task</button>";
                echo "</form>";
                echo "</div>";
                echo "</li>";
            }
            echo "</ul>";
            echo "</div>";
        }
        ?>
        
    </div>
</body>
</html>
