<!-- update_task_form.php -->
<?php
include_once('../../models/projects/projects.php');
include_once('../../models/tasks/tasks.php');
include_once('../../config/db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Project</title>
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <h2>Update Project</h2>
    <?php
    if(isset($_POST['project_id'])) {
        $project_id = $_POST['project_id'];

        $projectManager = new Project($pdo); 
        $project = $projectManager->getProjectById($project_id);
        
        if ($project) {
            ?>
            <form action="update_project.php" method="POST">
                <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                <label for="new_project_name">New Task Name:</label>
                <input type="text" id="new_project_name" name="new_project_name" value="<?php echo $project['name']; ?>"><br>
                <button type="submit">Update Task</button>
            </form>
            <?php
        } else {
            echo "Task not found!";
        }
    } else {
        echo "Invalid Request!";
    }
    ?>
</body>
</html>
