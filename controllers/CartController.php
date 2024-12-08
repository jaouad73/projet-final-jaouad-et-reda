<?php
require_once 'models/CartModel.php';

class CartController {
    private $cartModel;

    public function __construct($db) {
        $this->cartModel = new CartModel($db);
    }

    public function cart() {
        $this->ensureLoggedIn();
        $userId = $_SESSION['user_id'];
        $items = $this->cartModel->getCartItems($userId);
        $totalPrice = $this->cartModel->calculateTotalPrice($userId);
        require 'views/cart/index.php';
    }

    public function viewCart() {
        $this->ensureLoggedIn();
        $userId = $_SESSION['user_id'];
        $items = $this->cartModel->getCartItems($userId);
        $totalPrice = $this->cartModel->calculateTotalPrice($userId);
        require 'views/cart/index.php';
    }

    public function updateQuantity() {
        $this->ensureLoggedIn();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = intval($_POST['product_id']);
            $change = $_POST['change'];
            $userId = $_SESSION['user_id'];

            if ($change === 'increase') {
                $this->cartModel->incrementProductQuantity($userId, $productId);
            } elseif ($change === 'decrease') {
                $this->cartModel->decrementProductQuantity($userId, $productId);
            }

            header('Location: index.php?action=view_cart');
            exit();
        }
    }

    public function addToCart() {
        $this->ensureLoggedIn();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
            $userId = $_SESSION['user_id'];
            $productId = $_POST['product_id'];

            if ($this->cartModel->productExistsInCart($userId, $productId)) {
                $this->cartModel->incrementProductQuantity($userId, $productId);
            } else {
                $this->cartModel->addProductToCart($userId, $productId);
            }

            header('Location: index.php?action=view_cart');
            exit();
        }
    }

    public function removeFromCart() {
        $this->ensureLoggedIn();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
            $userId = $_SESSION['user_id'];
            $productId = intval($_POST['product_id']);
            $this->cartModel->removeProductFromCart($userId, $productId);
            header('Location: index.php?action=cart');
            exit();
        }
    }

    public function pay() {
        $this->ensureLoggedIn();
        $userId = $_SESSION['user_id'];
        $items = $this->cartModel->getCartItems($userId);
        $totalPrice = $this->cartModel->calculateTotalPrice($userId);
        require 'views/cart/payment.php';
    }

    public function payWithCheckout() {
        require_once 'vendor/autoload.php';

        \Stripe\Stripe::setApiKey('sk_test_51QQhd7GHTGeXuBC22VzcIOwlliSYSw2HS7tvJV7lWGenz8u5EIjYnNipHRHVadVksmuJ8OQP5u4pOtQFPEpwtHUj00AW7GfHvT');
        $this->ensureLoggedIn();

        $userId = $_SESSION['user_id'];
        $items = $this->cartModel->getCartItems($userId);
        $lineItems = [];

        foreach ($items as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                    'unit_amount' => $item['price'] * 100,
                ],
                'quantity' => $item['quantity'],
            ];
        }

        try {
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => 'http://localhost/mili/index.php?action=payment_success',
                'cancel_url' => 'http://localhost/mili/index.php?action=payment_failed',
            ]);

            header("Location: " . $session->url);
            exit();
        } catch (\Stripe\Exception\ApiErrorException $e) {
            echo "Erreur Stripe : " . $e->getMessage();
        }
    }

    public function paymentSuccess() {
        $this->ensureLoggedIn();
        $userId = $_SESSION['user_id'];

        require_once 'controllers/OrderController.php';
        $orderController = new OrderController($this->cartModel->getDb());

        $orderController->placeOrder($userId);
        $this->cartModel->clearCart($userId);

        require 'views/payment_success.php';
    }

    private function ensureLoggedIn() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit();
        }
    }
}
?>
