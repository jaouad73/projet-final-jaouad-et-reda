<?php
class HomeModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getFeaturedCategories() {
        $query = "SELECT * FROM categories ORDER BY RAND() LIMIT 3";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRecentProducts() {
        $query = "SELECT * FROM products ORDER BY created_at DESC LIMIT 6";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
