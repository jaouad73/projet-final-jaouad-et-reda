<?php
class CategoryController {
    private $categoryModel;

    public function __construct($db) {
        $this->categoryModel = new Category($db);
    }

    public function index() {
        $categories = $this->categoryModel->getAllCategories();
        include 'views/categories/index.php';
    }

    public function viewProductsByCategory($categoryId) {
        $categoryName = $this->categoryModel->getCategoryName($categoryId);
        $products = $this->categoryModel->getProductsByCategory($categoryId);
        include 'views/product/category_products.php';
    }

    public function viewAllCategories() {
        $categories = $this->categoryModel->getAllCategories();
        include 'views/categories/all.php';
    }

    public function addCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['category_name'] ?? '';
            $description = $_POST['category_description'] ?? '';
            $imagePath = $this->uploadFile($_FILES['category_image']);

            if ($this->categoryModel->addCategory($name, $description, $imagePath)) {
                header('Location: index.php?action=view_categories');
                exit();
            } else {
                echo "Erreur lors de l'ajout de la catégorie.";
            }
        } else {
            include 'views/forms/add_category.php';
        }
    }

    public function editCategoryForm($categoryId) {
        $category = $this->categoryModel->getCategoryById($categoryId);
        if (!$category) {
            echo "Catégorie introuvable.";
            return;
        }
        include 'views/forms/edit_category.php';
    }

    public function updateCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryId = $_POST['category_id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $imagePath = $_POST['existing_image'];

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imagePath = $this->uploadFile($_FILES['image']);
            }

            if ($this->categoryModel->updateCategory($categoryId, $name, $description, $imagePath)) {
                header('Location: index.php?action=view_categories');
                exit();
            } else {
                echo "Erreur lors de la mise à jour de la catégorie.";
            }
        }
    }

    public function deleteCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryId = intval($_POST['category_id']);
            if ($this->categoryModel->deleteCategory($categoryId)) {
                header('Location: index.php?action=view_categories');
                exit();
            } else {
                echo "Erreur lors de la suppression de la catégorie.";
            }
        }
    }

    private function uploadFile($file) {
        if (!empty($file['name'])) {
            $uploadDir = 'uploads/';
            $targetFile = $uploadDir . basename($file['name']);
            if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                return $targetFile;
            }
        }
        return null;
    }
}
?>
