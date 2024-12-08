<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toutes les Catégories</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Toutes les Catégories</h1>
        <div class="row">
            <?php foreach ($categories as $category): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?= htmlspecialchars($category['image']); ?>" class="card-img-top" alt="<?= htmlspecialchars($category['name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($category['name']); ?></h5>
                            <a href="index.php?action=view_products_by_category&category_id=<?= $category['category_id']; ?>" class="btn btn-primary">Voir les produits</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <br/>
    </div>
    <?php include 'views/shared/footer.php'; ?>
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
