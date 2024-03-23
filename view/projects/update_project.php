<?php
    include_once('../../controllers/projects/ProjectsController.php');
    $projectController = new ProjectController($pdo);
    $projectController->updateProject();
    ?>