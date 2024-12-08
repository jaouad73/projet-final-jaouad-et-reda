<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Catégories</title>
</head>
<body>
    <h1>Catégories</h1>
    <ul>
        <?php foreach ($categories as $category): ?>
            <li>
                <a href="index.php?action=view_category&id=<?= $category['category_id']; ?>">
                    <?= htmlspecialchars($category['name']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
