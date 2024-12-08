<?php
require_once 'models/OrderModel.php';

class OrderController {
    private $orderModel;

    public function __construct($db) {
        $this->db = $db;
        $this->orderModel = new OrderModel($db);
    }

    public function showOrders() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
            header('Location: signin.php');
            exit();
        }

        $orders = $this->orderModel->getAllOrders();
        require 'views/orders/index.php';
    }

    public function viewOrders() {
        $orderModel = new OrderModel($this->db);
        $orders = $orderModel->getAllOrders();
        require 'views/admin/orders_list.php';
    }

    public function placeOrder($userId) {
        require_once 'models/CartModel.php';
        $cartModel = new CartModel($this->db);
        $items = $cartModel->getCartItems($userId);

        if (empty($items)) {
            echo "<div class='container text-center mt-5'>";
            echo "<h1>Votre panier est vide. Impossible de passer la commande.</h1>";
            echo "<a href='index.php?action=cart' class='btn btn-primary mt-3'>Retour au panier</a>";
            echo "</div>";
            return;
        }

        $totalPrice = 0;
        foreach ($items as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        try {
            $this->db->beginTransaction();

            $query = "INSERT INTO orders (user_id, total_amount, order_date) VALUES (:user_id, :total_amount, NOW())";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':total_amount', $totalPrice, PDO::PARAM_STR);
            $stmt->execute();

            $orderId = $this->db->lastInsertId();

            $query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";
            $stmt = $this->db->prepare($query);

            foreach ($items as $item) {
                $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
                $stmt->bindParam(':product_id', $item['product_id'], PDO::PARAM_INT);
                $stmt->bindParam(':quantity', $item['quantity'], PDO::PARAM_INT);
                $stmt->bindParam(':price', $item['price'], PDO::PARAM_STR);
                $stmt->execute();
            }

            $this->db->commit();
            $cartModel->clearCart($userId);
        } catch (Exception $e) {
            $this->db->rollBack();
            echo "Erreur lors de la création de la commande : " . $e->getMessage();
        }
    }

    public function deleteOrder() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderId = intval($_POST['order_id']);

            if ($this->orderModel->deleteOrder($orderId)) {
                header('Location: index.php?action=view_orders');
                exit();
            } else {
                echo "Erreur lors de la suppression de la commande. ID : " . $orderId;
            }
        }
    }
}
?>
