<?php
class Task {
    private $conn;

    function __construct($db) {
        $this->conn = $db;
    }

    // Create a new task for a specific project
    public function createTask($project_id, $task_name, $due_date) {
        $sql = "INSERT INTO tasks (project_id, task_name, due_date) VALUES (:project_id, :task_name, :due_date)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':project_id', $project_id, PDO::PARAM_INT);
        $stmt->bindParam(':task_name', $task_name, PDO::PARAM_STR);
        $stmt->bindParam(':due_date', $due_date, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            return true; // Task created successfully
        } else {
            return false; // Failed to create task
        }
    }

    // Read all tasks for a specific project
    public function getTasksByProject($project_id) {
        $sql = "SELECT * FROM tasks WHERE project_id=:project_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":project_id", $project_id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Fetch all rows as associative arrays
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update task by ID
    public function updateTask($task_id, $task_name, $due_date) {
        $sql = "UPDATE tasks SET task_name = :task_name, due_date = :due_date WHERE id = :task_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);
        $stmt->bindParam(':task_name', $task_name, PDO::PARAM_STR);
        $stmt->bindParam(':due_date', $due_date, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            return true; // Task updated successfully
        } else {
            return false; // Failed to update task
        }
    }

    // Delete task by ID
    public function deleteTask($task_id) {
        $sql = "DELETE FROM tasks WHERE id = :task_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            return true; // Task deleted successfully
        } else {
            return false; // Failed to delete task
        }
    }
}
?>
