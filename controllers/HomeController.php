<?php
require_once 'models/Product.php';

class HomeController {
    private $categoryModel;
    private $productModel;

    public function __construct($db) {
        $this->categoryModel = new Category($db);
        $this->productModel = new Product($db);
    }

    public function index() {
        $categories = $this->categoryModel->getAllCategories();
        $products = $this->productModel->getRecentProducts(); 
        $title = "Accueil";
        require 'views/home/index.php';
    }
}

?>
