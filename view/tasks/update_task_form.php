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
    <title>Update Task</title>
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <h2>Update Task</h2>
    <?php
    if(isset($_POST['task_id'])) {
        $taskId = $_POST['task_id'];
       
        $taskManager = new Task($pdo); 
        $task = $taskManager->getTaskById($taskId);
        
        if ($task) {
            ?>
            <form action="update_task.php" method="POST">
                <input type="hidden" name="task_id" value="<?php echo $taskId; ?>">
                <label for="new_task_name">New Task Name:</label>
                <input type="text" id="new_task_name" name="new_task_name" value="<?php echo $task['task_name']; ?>"><br>
                <label for="new_due_date">New Due Date:</label>
                <input type="date" id="new_due_date" name="new_due_date" value="<?php echo $task['due_date']; ?>"><br>
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
