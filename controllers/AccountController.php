<?php
require_once 'models/CartModel.php';
require_once 'models/UserModel.php';

class AccountController {
    private $db;
    private $userModel;
    private $cartModel;

    public function __construct($db) {
        $this->db = $db;
        $this->userModel = new UserModel($db);
        $this->cartModel = new CartModel($db);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            $user = $this->userModel->getUserByUsername($username);

            if ($user && password_verify($password, $user['passworde'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['rolee'];

                $redirectUrl = $user['rolee'] === 'admin' 
                    ? 'index.php?action=admin_dashboard' 
                    : 'index.php?action=home';

                header('Location: ' . $redirectUrl);
                exit();
            } else {
                $_SESSION['error_message'] = "Nom d'utilisateur ou mot de passe incorrect.";
                header('Location: index.php?action=login');
                exit();
            }
        } else {
            include 'views/account/login.php';
        }
    }

    public function account() {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error_message'] = "Veuillez vous connecter pour accéder à votre compte.";
            header('Location: index.php?action=login');
            exit();
        }

        $userId = $_SESSION['user_id'];
        $user = $this->userModel->getUserById($userId);

        include 'views/account/dashboard.php';
    }

    public function cart() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit();
        }

        $userId = $_SESSION['user_id'];
        $cartItems = $this->cartModel->getCartItems($userId);

        $totalPrice = array_reduce($cartItems, function ($sum, $item) {
            return $sum + $item['price'] * $item['quantity'];
        }, 0);

        include 'views/account/cart.php';
    }
}
?>
