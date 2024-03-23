<?php
include_once '../../config/db.php';
include_once '../../models/projects/projects.php';
include_once '../../models/tasks/tasks.php';

class ProjectController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function addProject()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["project_name"]) && !empty($_POST["project_name"])) {

                $projectManager = new Project($this->pdo);
                $projectName = $_POST["project_name"];

                if ($projectManager->createProject($projectName)) {
                    header('Location: ../index.php');
                    exit;
                } else {
                    echo "<script>alert('Failed to add project');</script>";
                }
            } else {
                echo "<script>alert('Please provide a project name');</script>";
            }
        }
    }

    public function deleteProject()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["project_id"]) && !empty($_POST["project_id"])) {

            $projectManager = new Project($this->pdo);
            $projectId = $_POST["project_id"];

            if ($projectManager->deleteProject($projectId)) {
                header('Location: ../index.php');
            } else {
                echo "<script>alert('Failed to delete project');</script>";
            }
        } else {
            echo "<script>alert('Project ID not provided');</script>";
        }
    }

    public function updateProject()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = [];

            if (!isset($_POST['project_id']) || empty($_POST['project_id'])) {
                $errors[] = "Project ID is required.";
            }

            if (!isset($_POST['new_project_name']) || empty($_POST['new_project_name'])) {
                $errors[] = "New project name is required.";
            }

            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo $error . "<br>";
                }
                return;
            }

            $projectId = $_POST['project_id'];
            $newProjectName = $_POST['new_project_name'];

            $projectManager = new Project($this->pdo);
            $updated = $projectManager->updateProject($projectId, $newProjectName);

            if ($updated) {
                header('Location: ../index.php');
                exit();
            } else {
                echo "Failed to update project!";
            }
        }
    }

}
