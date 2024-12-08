<?php
require_once 'models/Product.php';

class ProductController {
    private $productModel;

    public function __construct($db) {
        $this->productModel = new Product($db);
    }

    public function viewProductDetails($productId) {
        $product = $this->productModel->getProductById($productId);

        if (!$product) {
            echo "Produit introuvable.";
            return;
        }

        include 'views/product/details.php';
    }

    public function viewAllProducts() {
        $products = $this->productModel->getAllProducts();
        $categoryName = "Tous les produits";
        include 'views/product/all.php';
    }

    public function viewProductsByCategory($categoryId) {
        $products = $this->productModel->getProductsByCategory($categoryId);
        $categoryName = $this->productModel->getCategoryName($categoryId);

        include 'views/admin/products_list.php';
    }

    public function addProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['product_name'] ?? '';
            $description = $_POST['product_description'] ?? '';
            $price = $_POST['product_price'] ?? 0;
            $categoryId = $_POST['category_id'] ?? 0;
            $imagePath = $this->uploadFile($_FILES['product_image']);

            $isAdded = $this->productModel->addProduct($name, $description, $price, $categoryId, $imagePath);

            if ($isAdded) {
                header('Location: index.php?action=view_products');
                exit();
            } else {
                echo "Erreur lors de l'ajout du produit.";
            }
        }

        include 'views/forms/add_product.php';
    }

    public function updateProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'];
            $name = $_POST['product_name'];
            $description = $_POST['product_description'];
            $price = $_POST['product_price'];
            $categoryId = $_POST['category_id'];
            $imagePath = $this->uploadFile($_FILES['product_image']) ?: $_POST['existing_image'];

            $this->productModel->updateProduct($productId, $name, $description, $price, $categoryId, $imagePath);

            header('Location: index.php?action=view_products');
        }
    }

    public function deleteProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'];
            $this->productModel->deleteProduct($productId);

            header('Location: index.php?action=view_products');
        }
    }

    private function uploadFile($file) {
        if (!empty($file['name'])) {
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($file["name"]);
            move_uploaded_file($file["tmp_name"], $targetFile);
            return $targetFile;
        }
        return null;
    }
}
?>
