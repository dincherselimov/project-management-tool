<?php
include_once('../config/db.php');
include_once('../models/projects/projects.php');
include_once('../models/tasks/tasks.php');

$projectFilter = isset($_GET['project_filter']) ? $_GET['project_filter'] : 'all'; 

// Fetch all projects
$projectManager = new Project($pdo);
$projectsList = $projectManager->getAllProjects();

// Fetch tasks based on the selected project filter if provided
$tasksList = [];
if (!empty($projectFilter) && $projectFilter !== 'all') {
    $taskManager = new Task($pdo);
    $tasksList = $taskManager->getTasksByProject($projectFilter);
} else {
    // Fetch tasks for all projects
    $taskManager = new Task($pdo);
    foreach ($projectsList as $project) {
        $tasksList[$project['id']] = $taskManager->getTasksByProject($project['id']);
    }
}
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

    <a href="../view/projects/add_project_form.php"><button>Create Project</button></a>
    <a href="../view/tasks/add_task_form.php"><button>Add Task</button></a>

    <form action="index.php" method="GET">
        <label for="project_filter">Filter by Project:</label>
        <select name="project_filter" id="project_filter">
            <option value="all" <?php echo ($projectFilter === 'all') ? 'selected' : ''; ?>>All Projects</option>
            <?php
            foreach ($projectsList as $project) {
                $selected = ($project['id'] == $projectFilter) ? 'selected' : '';
                echo "<option value='{$project['id']}' $selected>{$project['name']}</option>";
            }
            ?>
        </select>
        <button type="submit">Filter</button>
    </form>

    <div class="projects-container">
        <?php

        // Display all projects and their tasks if "All Projects" is selected
        if ($projectFilter === 'all') {
            foreach ($projectsList as $project) {
                echo "<div class='project'>";
                echo "<h3>{$project['name']}</h3>";
                // Update project button
                echo "<form action='./projects/update_project_form.php' method='POST'>";
                echo "<input type='hidden' name='project_id' value='{$project['id']}'>";
                echo "<button type='submit'>Update Project</button>";
                echo "</form>";

                // Delete project button
                echo "<form action='./projects/delete_project.php' method='POST'>";
                echo "<input type='hidden' name='project_id' value='{$project['id']}'>";
                echo "<button type='submit'>Delete Project</button>";
                echo "</form>";
                // Display tasks for the project
                echo "<ul>";
                foreach ($tasksList[$project['id']] as $task) {
                    echo "<li>{$task['task_name']} - Due Date: {$task['due_date']}";
                    // Update task button
                    echo "<form action='./tasks/update_task_form.php' method='POST'>";
                    echo "<input type='hidden' name='task_id' value='{$task['id']}'>";
                    echo "<button type='submit'>Update Task</button>";
                    echo "</form>";
                    // Delete task button
                    echo "<form action='./tasks/delete_task.php' method='POST'>";
                    echo "<input type='hidden' name='task_id' value='{$task['id']}'>";
                    echo "<button type='submit'>Delete Task</button>";
                    echo "</form>";
                    echo "</li>";
                }
                echo "</ul>";
                echo "</div>";
            }
        } else {
            // Display only the selected project and its tasks if a filter is applied
            $selectedProject = $projectManager->getProjectById($projectFilter); // Fetch selected project details
            if ($selectedProject) {
                echo "<div class='project'>";
                echo "<h3>{$selectedProject['name']}</h3>";
                // Update project button
                echo "<form action='update_project_form.php' method='POST'>";
                echo "<input type='hidden' name='project_id' value='{$selectedProject['id']}'>";
                echo "<button type='submit'>Update Project</button>";
                echo "</form>";
               
                // Delete project button
                echo "<form action='delete_project.php' method='POST'>";
                echo "<input type='hidden' name='project_id' value='{$selectedProject['id']}'>";
                echo "<button type='submit'>Delete Project</button>";
                echo "</form>";
                // Display tasks for the selected project
                echo "<ul>";
                foreach ($tasksList as $task) {
                    echo "<li>{$task['task_name']} - Due Date: {$task['due_date']}";
                    // Update task button
                    echo "<form action='update_task_form.php' method='POST'>";
                    echo "<input type='hidden' name='task_id' value='{$task['id']}'>";
                    echo "<button type='submit'>Update Task</button>";
                    echo "</form>";
                    // Delete task button
                    echo "<form action='delete_task.php' method='POST'>";
                    echo "<input type='hidden' name='task_id' value='{$task['id']}'>";
                    echo "<button type='submit'>Delete Task</button>";
                    echo "</form>";
                    echo "</li>";
                }
                echo "</ul>";
                echo "</div>";
            } else {
                echo "Project not found!";
            }
        }
        ?>
    </div>
</body>
</html>
