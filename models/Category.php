<?php
class Category {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllCategories() {
        $query = "SELECT * FROM categories";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryById($categoryId) {
        $query = "SELECT * FROM categories WHERE category_id = :category_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCategoryName($categoryId) {
        $query = "SELECT name FROM categories WHERE category_id = :category_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        $category = $stmt->fetch(PDO::FETCH_ASSOC);
        return $category ? $category['name'] : null;
    }

    public function getProductsByCategory($categoryId) {
        $query = "
            SELECT 
                p.product_id, 
                p.name AS product_name, 
                p.price AS product_price, 
                p.image AS product_image
            FROM products p
            WHERE p.category_id = :category_id
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCategory($name, $description, $imagePath) {
        $query = "INSERT INTO categories (name, description, image) VALUES (:name, :description, :image)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':image', $imagePath, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateCategory($categoryId, $name, $description, $imagePath) {
        $query = "UPDATE categories SET name = :name, description = :description, image = :image WHERE category_id = :category_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':image', $imagePath, PDO::PARAM_STR);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteCategory($categoryId) {
        $query = "DELETE FROM categories WHERE category_id = :category_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
