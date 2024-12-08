<?php
class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserByUsername($username) {
        $query = "SELECT * FROM Users WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserById($userId) {
        $query = "SELECT * FROM Users WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($username, $email, $password, $role) {
        $query = "INSERT INTO Users (username, email, passworde, rolee) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$username, $email, $password, $role]);
    }

    public function userExists($username, $email) {
        $query = "SELECT * FROM Users WHERE username = ? OR email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$username, $email]);
        return $stmt->rowCount() > 0; 
    }
}
?>
