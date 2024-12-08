<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Produit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Détails du Produit</h1>
    <div class="card">
        <div class="row g-0">
            <div class="col-md-5">
                <img src="<?= htmlspecialchars($product['image']); ?>" class="product-image img-fluid rounded-start" alt="<?= htmlspecialchars($product['name']); ?>">
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($product['name']); ?></h5>
                    <p class="card-text"><strong>Description : </strong><?= htmlspecialchars($product['description']); ?></p>
                    <p class="card-text"><strong>Prix : </strong>€<?= htmlspecialchars($product['price']); ?></p>
                    
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') : ?>
                        <a href="index.php?action=edit_product_form&id=<?= $product['product_id']; ?>" class="btn btn-warning mb-2">Modifier</a>
                        <form action="index.php?action=delete_product" method="POST" style="display:inline;">
                            <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id']); ?>">
                            <a href="index.php?action=view_products" class="btn btn-secondary mb-2">liste de tout les produits</a>

                            <button type="submit" class="btn btn-danger mb-2" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">Supprimer</button>
                        </form>
                    <?php else : ?>
                        <form action="index.php?action=add_to_cart" method="POST" style="display:inline;">
                            <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id']); ?>">
                            <button type="submit" class="btn btn-success mb-2">Ajouter au Panier</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<br/><br/><br/>
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
