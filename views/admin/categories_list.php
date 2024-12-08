<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Catégories</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
<h1 class="my-4">
    Liste des Categories
</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                
                <th>Nom</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                  
                    <td><?= htmlspecialchars($category['name']); ?></td>
                    <td><?= htmlspecialchars($category['description']); ?></td>
                    <td><img src="<?= htmlspecialchars($category['image']); ?>" alt="Image" width="100"></td>
                    <td>
                    <a href="index.php?action=edit_category_form&id=<?= htmlspecialchars($category['category_id']); ?>" class="btn btn-warning btn-sm">
        Modifier
    </a>                        
                        <form action="index.php?action=delete_category" method="POST" class="d-inline">
                            <input type="hidden" name="category_id" value="<?= htmlspecialchars($category['category_id']); ?>">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
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
