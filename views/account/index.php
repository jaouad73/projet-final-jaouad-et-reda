<?php
session_start();?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Bienvenue, <?= htmlspecialchars($_SESSION['username']); ?>!</h2>

        <h3>Votre Panier</h3>
        <?php if (empty($items)): ?>
            <p>Votre panier est vide.</p>
        <?php else: ?>
            <div class="row">
                <?php foreach ($items as $item): ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="<?= htmlspecialchars($item['image']); ?>" class="card-img-top" alt="<?= htmlspecialchars($item['name']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($item['name']); ?></h5>
                                <p class="card-text"><?= htmlspecialchars($item['description']); ?></p>
                                <p class="card-text">Prix: $<?= htmlspecialchars($item['price']); ?> x <?= htmlspecialchars($item['quantity']); ?></p>
                                <form method="post" action="index.php?action=remove_from_cart" class="d-inline">
                                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($item['product_id']); ?>">
                                    <button type="submit" class="btn btn-danger mb-2">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
