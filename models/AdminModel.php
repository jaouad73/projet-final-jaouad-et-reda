<?php
class AdminModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getDashboardData() {
        $categoriesQuery = "SELECT COUNT(*) AS total_categories FROM categories";
        $productsQuery = "SELECT COUNT(*) AS total_products FROM products";
        $ordersQuery = "SELECT COUNT(*) AS total_orders FROM orders";

        $data = [
            'categories' => $this->db->query($categoriesQuery)->fetch(PDO::FETCH_ASSOC),
            'products' => $this->db->query($productsQuery)->fetch(PDO::FETCH_ASSOC),
            'orders' => $this->db->query($ordersQuery)->fetch(PDO::FETCH_ASSOC),
        ];

        return $data;
    }

    public function addCategory($name, $description, $imagePath) {
        $query = "INSERT INTO categories (name, description, image) VALUES (:name, :description, :image)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':image', $imagePath, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function getCategoryById($categoryId) {
        $query = "SELECT * FROM categories WHERE category_id = :category_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
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

    public function getProductById($productId) {
        $query = "SELECT * FROM products WHERE product_id = :product_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProduct($productId, $name, $description, $price, $categoryId, $imagePath) {
        $query = "UPDATE products 
                  SET name = :name, description = :description, price = :price, category_id = :category_id, image = :image 
                  WHERE product_id = :product_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->bindParam(':image', $imagePath, PDO::PARAM_STR);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getAllCategories() {
        $query = "SELECT * FROM categories";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addProduct($name, $description, $price, $categoryId, $imagePath) {
        $query = "INSERT INTO products (name, description, price, category_id, image) VALUES (:name, :description, :price, :category_id, :image)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->bindParam(':image', $imagePath, PDO::PARAM_STR);
        return $stmt->execute();
    }
}
?>
