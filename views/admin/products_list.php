<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produits</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<h1 class="my-4">
    Liste des Produits
</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Catégorie</th>
                <th>Image</th> 
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)) : ?>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?= htmlspecialchars($product['name']); ?></td>
                        <td><?= htmlspecialchars($product['description']); ?></td>
                        <td><?= htmlspecialchars($product['price']); ?> €</td>
                        <td><?= htmlspecialchars($product['category_name'] ?? 'Non spécifiée'); ?></td>
                        <td>
                            <?php if (!empty($product['image'])) : ?>
                                <img src="<?= htmlspecialchars($product['image']); ?>" alt="Produit" style="width: 100px; height: auto;">
                            <?php else : ?>
                                <span>Aucune image</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') : ?>
                                <a href="index.php?action=edit_product_form&id=<?= $product['product_id']; ?>" class="btn btn-warning">Modifier</a>
                                <form action="index.php?action=delete_product" method="POST" style="display:inline;">
                                    <input type="hidden" name="product_id" value="<?= $product['product_id']; ?>">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">Supprimer</button>
                                </form>
                            <?php else : ?>
                                <a href="index.php?action=view_product&id=<?= $product['product_id']; ?>" class="btn btn-primary">Détails</a>
                                <form action="index.php?action=add_to_cart" method="POST" style="display:inline;">
                                    <input type="hidden" name="product_id" value="<?= $product['product_id']; ?>">
                                    <button type="submit" class="btn btn-success">Ajouter au panier</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7" class="text-center">Aucun produit trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
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
