<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de la Catégorie</title>
</head>
<body>
    <h1><?= htmlspecialchars($category['name']); ?></h1>
    <p><?= htmlspecialchars($category['description']); ?></p>
    <a href="index.php?action=view_products&category_id=<?= $category['category_id']; ?>">Voir les produits</a>
</body>
</html>
