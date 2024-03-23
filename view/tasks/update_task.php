<?php
    include_once('../../controllers/tasks/TaskController.php');
    $projectController = new TasksController($pdo);
    $projectController->updateTask();
    ?>