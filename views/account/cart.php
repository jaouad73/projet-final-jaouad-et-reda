<?php
session_start();?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'views/shared/navbar.php'; ?>

    <div class="container mt-5">
        <h2>Mon Panier</h2>
        <div class="row">
            <?php if (!empty($cartItems)): ?>
                <?php foreach ($cartItems as $item): ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="<?= htmlspecialchars($item['image']); ?>" class="card-img-top" alt="<?= htmlspecialchars($item['name']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($item['name']); ?></h5>
                                <p class="card-text"><?= htmlspecialchars($item['description']); ?></p>
                                <p class="card-text">Prix: <?= htmlspecialchars($item['price']); ?> € x <?= htmlspecialchars($item['quantity']); ?></p>
                                <form method="post" action="index.php?action=remove_from_cart">
                                    <input type="hidden" name="product_id" value="<?= $item['product_id']; ?>">
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Votre panier est vide.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php include 'views/shared/footer.php'; ?>
</body>
</html>
