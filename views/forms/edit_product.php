<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Produit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Modifier un Produit</h2>
    <form method="post" action="index.php?action=edit_product" enctype="multipart/form-data">
        <input type="hidden" name="product_id" value="<?= $product['product_id']; ?>">
        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($product['name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea id="description" name="description" class="form-control" required><?= htmlspecialchars($product['description']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="price">Prix :</label>
            <input type="number" id="price" name="price" class="form-control" value="<?= $product['price']; ?>" required>
        </div>
        <div class="form-group">
            <label for="category_id">Catégorie :</label>
            <select id="category_id" name="category_id" class="form-control">
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['category_id']; ?>" <?= $product['category_id'] == $category['category_id'] ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($category['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="image">Image :</label>
            <input type="file" id="image" name="image" class="form-control">
            <input type="hidden" name="existing_image" value="<?= $product['image']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
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
