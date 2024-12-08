<?php
class CartModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getDb() {
        return $this->db; 
    }

    public function getCartItems($userId) {
        $query = "SELECT P.product_id, P.name, P.description, P.price, P.image, C.quantity 
                  FROM Cart C 
                  JOIN Products P ON C.product_id = P.product_id 
                  WHERE C.user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function calculateTotalPrice($userId) {
        $items = $this->getCartItems($userId);
        $totalPrice = 0;
        foreach ($items as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
        return $totalPrice;
    }

    public function clearCart($userId) {
        $query = "DELETE FROM cart WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function productExistsInCart($userId, $productId) {
        $query = "SELECT COUNT(*) FROM Cart WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function incrementProductQuantity($userId, $productId) {
        $query = "UPDATE Cart SET quantity = quantity + 1 WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function decrementProductQuantity($userId, $productId) {
        $query = "UPDATE cart SET quantity = quantity - 1 WHERE user_id = :user_id AND product_id = :product_id AND quantity > 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function addProductToCart($userId, $productId) {
        $query = "INSERT INTO Cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, 1)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function removeProductFromCart($userId, $productId) {
        $query = "DELETE FROM Cart WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
