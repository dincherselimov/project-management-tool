<?php
class Task
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     * Create a new task for a specific project
     *
     * @param [type] $project_id
     * @param [type] $task_name
     * @param [type] $due_date
     * @return void
     */
    public function createTask($project_id, $task_name, $due_date)
    {
        $sql = "INSERT INTO tasks (project_id, task_name, due_date) VALUES (:project_id, :task_name, :due_date)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':project_id', $project_id, PDO::PARAM_INT);
        $stmt->bindParam(':task_name', $task_name, PDO::PARAM_STR);
        $stmt->bindParam(':due_date', $due_date, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get specific task by id
     *
     * @param [type] $taskId
     * @return void
     */
    public function getTaskById($taskId)
    {
        try {
            $sql = "SELECT * FROM tasks WHERE id = :task_id";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':task_id', $taskId);
            $stmt->execute();
            $task = $stmt->fetch(PDO::FETCH_ASSOC);
            return $task;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Fetch all tasks for a specific project
     *
     * @param [type] $project_id
     * @return data as associative array
     */
    public function getTasksByProject($project_id)
    {
        $sql = "SELECT * FROM tasks WHERE project_id=:project_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":project_id", $project_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Update Task
     *
     * @param [type] $task_id
     * @param [type] $task_name
     * @param [type] $due_date
     * @return void
     */
    public function updateTask($task_id, $task_name, $due_date)
    {
        $sql = "UPDATE tasks SET task_name = :task_name, due_date = :due_date WHERE id = :task_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);
        $stmt->bindParam(':task_name', $task_name, PDO::PARAM_STR);
        $stmt->bindParam(':due_date', $due_date, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete Task
     *
     * @param [type] $task_id
     * @return void
     */
    public function deleteTask($task_id)
    {
        $sql = "DELETE FROM tasks WHERE id = :task_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
