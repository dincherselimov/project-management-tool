<?php

class Project
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     * Create a new project
     *
     * @param [type] $name
     * @return void
     */
    public function createProject($name)
    {
        $sql = "INSERT INTO projects (name) VALUES (:name)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get project by id
     *
     * @param [type] $project_id
     * @return void
     */
    public function getProjectById($project_id)
    {
        try {
            $sql = "SELECT * FROM projects WHERE id = :project_id";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':project_id', $project_id);
            $stmt->execute();
            $task = $stmt->fetch(PDO::FETCH_ASSOC);
            return $task;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Fetch all projects
     *
     * @return data as associative array
     */
    public function getAllProjects()
    {
        $sql = "SELECT * FROM projects";
        $stmt = $this->conn->query($sql);

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return array();
        }
    }

    /**
     * Update project
     *
     * @param [type] $id
     * @param [type] $name
     * @return void
     */
    public function updateProject($id, $name)
    {
        $sql = "UPDATE projects SET name = :name WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete project
     *
     * @param [type] $id
     * @return void
     */
    public function deleteProject($id)
    {
        $sql = "DELETE FROM projects WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
