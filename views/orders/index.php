<?php include 'views/shared/navbar.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Commandes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Commandes</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Commande</th>
                    <th>Client</th>
                    <th>Date</th>
                    <th>Montant</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['order_id']); ?></td>
                        <td><?= htmlspecialchars($order['customer_name']); ?></td>
                        <td><?= htmlspecialchars($order['order_date']); ?></td>
                        <td>€<?= htmlspecialchars($order['total_amount']); ?></td>
                        <td>
                            <a href="index.php?action=view_order&order_id=<?= $order['order_id']; ?>" class="btn btn-info">Détails</a>
                            <form method="POST" action="index.php?action=delete_order" class="d-inline">
                                <input type="hidden" name="order_id" value="<?= $order['order_id']; ?>">
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
