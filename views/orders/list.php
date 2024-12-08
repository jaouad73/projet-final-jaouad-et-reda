<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Commandes</title>
</head>
<body>
    <h1>Commandes</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Montant</th>
            <th>Action</th>
        </tr>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= $order['order_id']; ?></td>
                <td><?= $order['order_date']; ?></td>
                <td><?= $order['total_amount']; ?> €</td>
                <td>
                    <a href="index.php?action=view_order&id=<?= $order['order_id']; ?>">Voir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
