<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h2>Bienvenue, <?= htmlspecialchars($_SESSION['username']); ?> !</h2>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Rôle :</strong> 
                        <span class="badge <?= ($_SESSION['role'] === 'admin') ? 'badge-warning' : 'badge-info'; ?>">
                            <?= htmlspecialchars($_SESSION['role']); ?>
                        </span>
                    </p>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <?php if ($_SESSION['role'] !== 'admin'): ?>
                    <a href="index.php?action=view_cart" class="btn btn-primary btn-lg mx-2">
                        <i class="fas fa-shopping-cart"></i> Voir mon panier
                    </a>
                <?php endif; ?>

                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <a href="index.php?action=admin_dashboard" class="btn btn-warning btn-lg mx-2">
                        <i class="fas fa-tools"></i> Dashboard Admin
                    </a>
                <?php endif; ?>

                <a href="index.php?action=logout" class="btn btn-danger btn-lg mx-2">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var dropdowns = document.querySelectorAll('.dropdown-toggle');

        dropdowns.forEach(function (dropdown) {
            dropdown.addEventListener('mouseover', function (e) {
                e.preventDefault();

                let dropdownMenu = dropdown.nextElementSibling;
                if (dropdownMenu.classList.contains('show')) {
                    dropdownMenu.classList.remove('show');
                } else {
                    document.querySelectorAll('.dropdown-menu').forEach(function (menu) {
                        menu.classList.remove('show');
                    });

                    dropdownMenu.classList.add('show');
                }
            });
        });

        document.addEventListener('mouseout', function (e) {
            if (!e.target.closest('.dropdown')) {
                document.querySelectorAll('.dropdown-menu').forEach(function (menu) {
                    menu.classList.remove('show');
                });
            }
        });
    });
</script>

</body>
</html>
