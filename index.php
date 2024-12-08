<?php
ob_start();
session_start();
require_once 'config/Database.php';
require_once 'controllers/HomeController.php';
require_once 'controllers/AdminController.php';
require_once 'controllers/AccountController.php';
require_once 'controllers/CartController.php';
require_once 'controllers/OrderController.php';
require_once 'controllers/CategoryController.php';
require_once 'controllers/ProductController.php';
require_once 'controllers/RegisterController.php';
require_once 'controllers/LogoutController.php';
include 'views/shared/navbar.php';

$db = new Database();
$connection = $db->connect();

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'home':
        $controller = new HomeController($connection);
        $controller->index();
        break;

    case 'admin_dashboard':
        $controller = new AdminController($connection);
        $controller->dashboard();
        break;

    case 'add_category_form':
    case 'view_categories':
        $controller = new AdminController($connection);
        if ($action === 'add_category_form') $controller->addCategoryForm();
        if ($action === 'view_categories') $controller->viewCategories();
        break;

    case 'add_category':
    case 'delete_category':
        $controller = new AdminController($connection);
        if ($action === 'add_category') $controller->addCategory();
        if ($action === 'delete_category') $controller->deleteCategory();
        break;

    case 'edit_category_form':
        if (isset($_GET['id'])) {
            $controller = new CategoryController($connection);
            $controller->editCategoryForm((int)$_GET['id']);
        } else {
            echo "ID de catégorie non spécifié.";
        }
        break;

    case 'edit_category':
        $controller = new CategoryController($connection);
        $controller->updateCategory();
        break;

    case 'update_quantity':
        $controller = new CartController($connection);
        $controller->updateQuantity();
        break;

    case 'view_products_by_category':
        if (isset($_GET['category_id'])) {
            $controller = new CategoryController($connection);
            $controller->viewProductsByCategory((int)$_GET['category_id']);
        } else {
            echo "ID de catégorie non spécifié.";
        }
        break;

    case 'view_products':
        $controller = new AdminController($connection);
        $controller->viewProducts();
        break;

    case 'view_product':
        if (isset($_GET['id'])) {
            $controller = new ProductController($connection);
            $controller->viewProductDetails($_GET['id']);
        } else {
            echo "ID du produit non spécifié.";
        }
        break;

    case 'view_all_products':
        $productController = new ProductController($connection);
        $productController->viewAllProducts();
        break;

    case 'add_product_form':
        $controller = new AdminController($connection);
        $controller->addProductForm();
        break;

    case 'edit_product_form':
        if (isset($_GET['id'])) {
            $controller = new AdminController($connection);
            $controller->editProductForm($_GET['id']);
        } else {
            echo "ID du produit non spécifié.";
        }
        break;

    case 'add_product':
    case 'edit_product':
    case 'delete_product':
        $controller = new AdminController($connection);
        if ($action === 'add_product') $controller->addProduct();
        if ($action === 'edit_product') $controller->editProduct();
        if ($action === 'delete_product') $controller->deleteProduct();
        break;

    case 'view_orders':
        $orderController = new OrderController($connection);
        $orderController->viewOrders();
        break;

    case 'delete_order':
        $orderController = new OrderController($connection);
        $orderController->deleteOrder();
        break;

    case 'cart':
        $controller = new CartController($connection);
        $controller->cart();
        break;

    case 'view_cart':
        $controller = new CartController($connection);
        $controller->viewCart();
        break;

    case 'add_to_cart':
    case 'remove_from_cart':
        $controller = new CartController($connection);
        if ($action === 'add_to_cart') $controller->addToCart();
        if ($action === 'remove_from_cart') $controller->removeFromCart();
        break;

    case 'placeOrder':
        if (isset($_SESSION['user_id'])) {
            $controller = new OrderController($connection);
            $controller->placeOrder($_SESSION['user_id']);
        } else {
            header('Location: index.php?action=login');
        }
        break;

    case 'login':
        $controller = new AccountController($connection);
        $controller->login();
        break;

    case 'register':
        $controller = new RegisterController($connection);
        $controller->register();
        break;

    case 'logout':
        $controller = new LogoutController($connection);
        $controller->logout();
        break;

    case 'account':
        $controller = new AccountController($connection);
        $controller->account();
        break;

    case 'view_all_categories':
        $categoryController = new CategoryController($connection);
        $categoryController->viewAllCategories();
        break;

    case 'pay':
        $cartController = new CartController($connection);
        $cartController->pay();
        break;

    case 'process_payment':
        $cartController = new CartController($connection);
        $cartController->processPayment();
        break;

    case 'pay_with_checkout':
        $cartController = new CartController($connection);
        $cartController->payWithCheckout();
        break;

    case 'payment_success':
        $cartController = new CartController($connection);
        $cartController->paymentSuccess();
        break;
        

    case 'payment_failed':
        include 'views/payment_failed.php';
        break;

    default:
        echo "Action non définie.";
        break;
}
ob_end_flush();
?>
