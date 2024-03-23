<?php
class Project {
    private $conn;

    function __construct($db) {
        $this->conn = $db;
    }

    // Create a new project
    public function createProject($name) {
        $sql = "INSERT INTO projects (name) VALUES (:name)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            return true; // Project created successfully
        } else {
            return false; // Failed to create project
        }
    }

    // Read all projects
    public function getAllProjects() {
        $sql = "SELECT * FROM projects";
        $stmt = $this->conn->query($sql);

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return array();
        }
    }

    // Update project by ID
    public function updateProject($id, $name) {
        $sql = "UPDATE projects SET name = :name WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            return true; // Project updated successfully
        } else {
            return false; // Failed to update project
        }
    }

    // Delete project by ID
    public function deleteProject($id) {
        $sql = "DELETE FROM projects WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            return true; // Project deleted successfully
        } else {
            return false; // Failed to delete project
        }
    }
}
?>
