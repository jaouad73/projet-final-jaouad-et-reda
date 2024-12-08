<?php
class Product {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllProducts() {
        $query = "
            SELECT 
                p.product_id, 
                p.name AS name, 
                p.description AS description, 
                p.price AS price, 
                p.image AS image, 
                c.name AS category_name 
            FROM products p
            JOIN categories c ON p.category_id = c.category_id
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteProduct($productId) {
        $query = "DELETE FROM products WHERE product_id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$productId]);
    }

    public function getProductById($productId) {
        $query = "SELECT * FROM products WHERE product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$productId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getRecentProducts() {
        $query = "SELECT * FROM products ORDER BY product_id DESC LIMIT 6";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductsByCategory($categoryId) {
        $query = "
            SELECT 
                p.product_id, 
                p.name AS product_name, 
                p.description AS product_description, 
                p.price AS product_price, 
                p.image AS product_image, 
                c.name AS category_name 
            FROM products p
            JOIN categories c ON p.category_id = c.category_id
            WHERE c.category_id = ?
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryName($categoryId) {
        $query = "SELECT name FROM categories WHERE category_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$categoryId]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);
        return $category ? $category['name'] : null;
    }

    public function addProduct($name, $description, $price, $categoryId, $imagePath) {
        $query = "INSERT INTO products (name, description, price, category_id, image) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$name, $description, $price, $categoryId, $imagePath]);
    }
}
?>
