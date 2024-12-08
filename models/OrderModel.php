<?php
class OrderModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllOrders() {
        $query = "SELECT o.order_id, u.username AS customer_name, o.total_amount, o.order_date 
                  FROM orders o 
                  JOIN users u ON o.user_id = u.user_id 
                  ORDER BY o.order_date DESC";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderById($orderId) {
        $query = "SELECT o.order_id, o.order_date, o.total_amount, u.username AS customer_name 
                  FROM orders o 
                  JOIN users u ON o.user_id = u.user_id 
                  WHERE o.order_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$orderId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOrderItems($orderId) {
        $query = "SELECT p.name, oi.quantity, oi.price 
                  FROM order_items oi 
                  JOIN products p ON oi.product_id = p.product_id 
                  WHERE oi.order_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteOrder($orderId) {
        $query = "DELETE FROM orders WHERE order_id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$orderId]);
    }
}
?>
