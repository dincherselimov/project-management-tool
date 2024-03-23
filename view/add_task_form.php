<?php
// Include necessary files
include_once('../config/db.php');
include_once('../projects/projects.php');

// Create a new Project instance
$projectManager = new Project($pdo);

// Fetch all projects
$projectsList = $projectManager->getAllProjects();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>
    <h1>Add Task</h1>

    <div class="tasks-container">
        <form action="add_task.php" method="POST">
            <label for="project_id">Project:</label><br>
            <select id="project_id" name="project_id">
                <!-- Options will be dynamically populated with project names -->
                <?php foreach ($projectsList as $project): ?>
                    <option value="<?php echo $project['id']; ?>"><?php echo $project['name']; ?></option>
                <?php endforeach; ?>
            </select><br>
            <label for="task_name">Task Name:</label><br>
            <input type="text" id="task_name" name="task_name"><br>
            <label for="due_date">Due Date:</label><br>
            <input type="date" id="due_date" name="due_date"><br>
            <button type="submit">Add Task</button>
        </form>
    </div>
</body>
</html>
