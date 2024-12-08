
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrateur</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .dashboard-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
        }
        .card-text {
            font-size: 1rem;
            color: #555;
        }
        .btn-group {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="dashboard-header">
            <h2 class="mb-4">Tableau de Bord Administrateur</h2>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Catégories</h5>
                        <p class="card-text"><?= $dashboardData['categories']['total_categories'] ?? 0; ?> catégories</p>
                        <div class="btn-group">
                            <a href="index.php?action=view_categories" class="btn btn-outline-primary">Voir et Modifier</a>
                            <a href="index.php?action=add_category_form" class="btn btn-outline-success">Ajouter</a>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-success">Produits</h5>
                        <p class="card-text"><?= $dashboardData['products']['total_products'] ?? 0; ?> produits</p>
                        <div class="btn-group">
                            <a href="index.php?action=view_products" class="btn btn-outline-primary">Voir et Modifier</a>
                            <a href="index.php?action=add_product_form" class="btn btn-outline-success">Ajouter</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-warning">Commandes</h5>
                        <p class="card-text"><?= $dashboardData['orders']['total_orders'] ?? 0; ?> commandes</p>
                        <div class="btn-group">
                        <a href="index.php?action=view_orders" class="btn btn-outline-primary">Voir</a>
                        </div>
                    </div>
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
