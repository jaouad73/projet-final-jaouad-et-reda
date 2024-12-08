<?php
require_once 'config/Database.php';
require_once 'models/Category.php';
$db = new Database();
$connection = $db->connect();
$categoryModel = new Category($connection);
$categories = $categoryModel->getAllCategories();

$action = $_GET['action'] ?? '';
?>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
    <div class="container">
        <a href="index.php" class="navbar-brand d-flex align-items-center">
            <img src="views/shared/uploads/aaa.png" alt="a" style="width: 70px; height: 70px; padding-top: 10px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-dark" href="index.php?action=home">Accueil</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold text-dark" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Catégories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                        <?php foreach ($categories as $category): ?>
                            <li>
                                <a class="dropdown-item" href="index.php?action=view_products_by_category&category_id=<?= $category['category_id']; ?>">
                                    <?= htmlspecialchars($category['name']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if ($_SESSION['role'] !== 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold text-dark" href="index.php?action=view_cart">
                                <i class="bi bi-cart-fill"></i> Panier
                            </a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold text-dark d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i> <?= htmlspecialchars($_SESSION['username']); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="index.php?action=account"><i class="bi bi-person"></i> Mon compte</a></li>
                            <li><a class="dropdown-item text-danger" href="index.php?action=logout"><i class="bi bi-box-arrow-right"></i> Déconnexion</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <?php if ($action !== 'login'): ?>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold text-dark" href="index.php?action=login"><i class="bi bi-box-arrow-in-right"></i> Connexion</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($action !== 'register'): ?>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold text-dark" href="index.php?action=register"><i class="bi bi-person-plus"></i> Inscription</a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
