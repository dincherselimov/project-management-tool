<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Task</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>
    <h1>Update Task</h1>

    <div class="tasks-container">
        <form action="update_task.php" method="POST">
            <input type="hidden" id="task_id" name="task_id" value="<?php echo $task['id']; ?>">
            <label for="task_name">Task Name:</label><br>
            <input type="text" id="task_name" name="task_name" required ><br>
            <label for="due_date">Due Date:</label><br>
            <input type="date" id="due_date" name="due_date" required ><br>
            <button type="submit">Update Task</button>
        </form>
    </div>
</body>
</html>
