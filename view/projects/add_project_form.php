<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project</title>
    <link rel="stylesheet" href="../css/add_project.css">
</head>
<body>
    <h1>Add Project</h1>
    <?php
    include_once('../../controllers/projects/ProjectsController.php');
    $projectController = new ProjectController($pdo);
    $projectController->addProject();
    ?>
    <div class="projects-container">
        <form action="" method="POST">
            <label for="project_name">Project Name:</label><br>
            <input type="text" id="project_name" name="project_name"><br>
            <button type="submit">Add Project</button>
        </form>
    </div>
</body>
</html>
