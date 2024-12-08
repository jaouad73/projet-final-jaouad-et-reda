<?php

class AdminController {
    private $db;
    private $adminModel;

    public function __construct($db) {
        $this->db = $db;
        require_once 'models/AdminModel.php';
        $this->adminModel = new AdminModel($this->db);
    }

    public function dashboard() {
        require_once 'models/Category.php';
        require_once 'models/Product.php';
        require_once 'models/OrderModel.php';

        $categoryModel = new Category($this->db);
        $productModel = new Product($this->db);
        $orderModel = new OrderModel($this->db);

        $dashboardData = [
            'categories' => ['total_categories' => count($categoryModel->getAllCategories())],
            'products' => ['total_products' => count($productModel->getAllProducts())],
            'orders' => ['total_orders' => count($orderModel->getAllOrders())]
        ];

        require 'views/admin/dashboard.php';
    }

    public function addCategoryForm() {
        require 'views/forms/add_category.php';
    }

    public function addCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            $imagePath = $this->uploadFile($_FILES['image']);

            if ($this->adminModel->addCategory($name, $description, $imagePath)) {
                header('Location: index.php?action=admin_dashboard');
            } else {
                echo "Erreur lors de l'ajout de la catégorie.";
            }
        }
    }

    public function addProductForm() {
        require_once 'models/Category.php';
        $categoryModel = new Category($this->db);
        $categories = $categoryModel->getAllCategories();
        require 'views/forms/add_product.php';
    }

    public function addProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['product_name'] ?? '');
            $description = trim($_POST['product_description'] ?? '');
            $price = floatval($_POST['product_price'] ?? 0);
            $categoryId = intval($_POST['category_id'] ?? 0);
            $imagePath = $this->uploadFile($_FILES['product_image']);

            if (empty($name) || empty($description) || $price <= 0 || $categoryId <= 0) {
                echo "Veuillez remplir tous les champs obligatoires.";
                include 'views/forms/add_product.php';
                return;
            }

            if ($this->adminModel->addProduct($name, $description, $price, $categoryId, $imagePath)) {
                header('Location: index.php?action=admin_dashboard');
                exit();
            } else {
                echo "Erreur lors de l'ajout du produit.";
            }
        }

        include 'views/forms/add_product.php';
    }

    public function editCategoryForm($categoryId) {
        require_once 'models/Category.php';
        $categoryModel = new Category($this->db);
        $category = $categoryModel->getCategoryById($categoryId);

        if (!$category) {
            echo "Catégorie introuvable.";
            return;
        }

        include 'views/forms/edit_category.php';
    }

    public function editCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once 'models/Category.php';
            $categoryModel = new Category($this->db);

            $categoryId = intval($_POST['category_id']);
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            $imagePath = $this->uploadFile($_FILES['image']) ?: $_POST['existing_image'];

            if ($categoryModel->updateCategory($categoryId, $name, $description, $imagePath)) {
                header('Location: index.php?action=view_categories');
            } else {
                echo "Erreur lors de la mise à jour de la catégorie.";
            }
        }
    }

    public function editProductForm($productId) {
        require_once 'models/Product.php';
        require_once 'models/Category.php';

        $productModel = new Product($this->db);
        $categoryModel = new Category($this->db);

        $product = $productModel->getProductById($productId);
        $categories = $categoryModel->getAllCategories();

        if ($product) {
            require 'views/forms/edit_product.php';
        } else {
            echo "Produit introuvable.";
        }
    }

    public function editProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = intval($_POST['product_id']);
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            $price = floatval($_POST['price']);
            $categoryId = intval($_POST['category_id']);
            $imagePath = $this->uploadFile($_FILES['image']) ?? $_POST['existing_image'];

            if ($this->adminModel->updateProduct($productId, $name, $description, $price, $categoryId, $imagePath)) {
                header('Location: index.php?action=view_products');
                exit();
            } else {
                echo "Erreur lors de la modification du produit.";
            }
        }
    }

    public function viewProducts() {
        require_once 'models/Product.php';
        $productModel = new Product($this->db);
        $products = $productModel->getAllProducts();
        require 'views/admin/products_list.php';
    }

    public function viewCategories() {
        require_once 'models/Category.php';
        $categoryModel = new Category($this->db);
        $categories = $categoryModel->getAllCategories();
        require 'views/admin/categories_list.php';
    }

    public function deleteCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once 'models/Category.php';
            $categoryModel = new Category($this->db);
            $categoryId = intval($_POST['category_id']);

            if ($categoryModel->deleteCategory($categoryId)) {
                header('Location: index.php?action=view_categories');
                exit();
            } else {
                echo "Erreur lors de la suppression de la catégorie.";
            }
        }
    }

    public function deleteProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once 'models/Product.php';
            $productModel = new Product($this->db);
            $productId = intval($_POST['product_id']);

            if ($productModel->deleteProduct($productId)) {
                header('Location: index.php?action=view_products');
                exit();
            } else {
                echo "Erreur lors de la suppression du produit.";
            }
        }
    }

    private function uploadFile($file) {
        if (!empty($file['name'])) {
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($file["name"]);
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                return $targetFile;
            }
        }
        return null;
    }
}
?>
