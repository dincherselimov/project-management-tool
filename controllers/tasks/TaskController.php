<?php
include_once '../../config/db.php';
include_once '../../models/projects/projects.php';
include_once '../../models/tasks/tasks.php';

class TasksController
{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function addTask()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["project_id"]) && isset($_POST["task_name"]) && isset($_POST["due_date"])
                && !empty($_POST["project_id"]) && !empty($_POST["task_name"]) && !empty($_POST["due_date"])) {

                $taskManager = new Task($this->pdo);

                $projectId = $_POST["project_id"];
                $taskName = $_POST["task_name"];
                $dueDate = $_POST["due_date"];

                if ($taskManager->createTask($projectId, $taskName, $dueDate)) {
                    header('Location: ../index.php');
                    exit;
                } else {
                    echo "<script>alert('Failed to add task');</script>";
                }
            } else {
                echo "<script>alert('Please fill in all required fields');</script>";
            }
        }
    }

    public function deleteTask()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["task_id"]) && !empty($_POST["task_id"])) {

            $taskManager = new Task($this->pdo);

            $taskId = $_POST["task_id"];

            if ($taskManager->deleteTask($taskId)) {

                header('Location: ../index.php');

            } else {
                echo "<script>alert('Failed to delete task');</script>";
            }
        } else {
            echo "<script>alert('Task ID not provided');</script>";
        }
    }

    public function updateTask()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $errors = [];

            if (!isset($_POST['task_id']) || empty($_POST['task_id'])) {
                $errors[] = "Task ID is required.";
            }

            if (!isset($_POST['new_task_name']) || empty($_POST['new_task_name'])) {
                $errors[] = "New task name is required.";
            }

            if (!isset($_POST['new_due_date']) || empty($_POST['new_due_date'])) {
                $errors[] = "New due date is required.";
            }

            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo $error . "<br>";
                }
                return;
            }

            $taskId = $_POST['task_id'];
            $newTaskName = $_POST['new_task_name'];
            $newDueDate = $_POST['new_due_date'];

            $taskManager = new Task($this->pdo);
            $updated = $taskManager->updateTask($taskId, $newTaskName, $newDueDate);

            if ($updated) {
                header('Location: ../index.php');
                exit();
            } else {
                echo "Failed to update task!";
            }
        }
    }

}
