<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Produit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Ajouter un Produit</h2>
    <form action="index.php?action=add_product" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="product_name">Nom du produit</label>
        <input type="text" name="product_name" id="product_name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="product_description">Description</label>
        <textarea name="product_description" id="product_description" class="form-control" required></textarea>
    </div>
    <div class="form-group">
        <label for="product_price">Prix (€)</label>
        <input type="number" step="0.01" name="product_price" id="product_price" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="category_id">Catégorie</label>
        <select name="category_id" id="category_id" class="form-control" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?= htmlspecialchars($category['category_id']); ?>">
                    <?= htmlspecialchars($category['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="product_image">Image</label>
        <input type="file" name="product_image" id="product_image" class="form-control-file" required>
    </div>
    <button type="submit" class="btn btn-primary">Ajouter le produit</button>
</form>
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