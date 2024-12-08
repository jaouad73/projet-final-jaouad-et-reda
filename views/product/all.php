<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tous les Produits</title>
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
        <h1 class="mb-4">Tous les Produits</h1>
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?= htmlspecialchars($product['image']); ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($product['name']); ?></h5>
                            <p class="card-text">
                                <?= htmlspecialchars(strlen($product['description']) > 100 
                                    ? substr($product['description'], 0, 100) . '...' 
                                    : $product['description']); ?>
                            </p>
                            <p class="card-text"><strong>Prix : </strong><?= htmlspecialchars($product['price']); ?> €</p>
                            <a href="index.php?action=view_product&id=<?= $product['product_id']; ?>" class="btn btn-primary">Voir les détails</a>
                            <?php if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'): ?>
                                <form action="index.php?action=add_to_cart" method="POST" class="d-inline">
                                    <input type="hidden" name="product_id" value="<?= $product['product_id']; ?>">
                                    <button type="submit" class="btn btn-success">Ajouter au panier</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
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
