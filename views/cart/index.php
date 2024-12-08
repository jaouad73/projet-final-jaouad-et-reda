<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://www.paypal.com/sdk/js?client-id=Votre_Client_ID&currency=EUR"></script>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Votre Panier</h1>

    <?php if (!empty($items)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><img src="<?= htmlspecialchars($item['image']); ?>" alt="<?= htmlspecialchars($item['name']); ?>" width="50"></td>
                        <td><?= htmlspecialchars($item['name']); ?></td>
                        <td>€<?= htmlspecialchars($item['price']); ?></td>
                        <td>
                            <form action="index.php?action=update_quantity" method="POST" class="d-inline">
                                <input type="hidden" name="product_id" value="<?= htmlspecialchars($item['product_id']); ?>">
                                <div class="input-group">
                                    <button type="submit" name="change" value="decrease" class="btn btn-outline btn-sm">-</button>
                                    <input type="text" name="quantity" value="<?= htmlspecialchars($item['quantity']); ?>" class="form-control text-center" style="width: 50px;" readonly>
                                    <button type="submit" name="change" value="increase" class="btn btn-outline btn-sm">+</button>
                                </div>
                            </form>
                        </td>
                        <td>€<?= htmlspecialchars($item['price'] * $item['quantity']); ?></td>
                        <td>
                            <form action="index.php?action=remove_from_cart" method="POST">
                                <input type="hidden" name="product_id" value="<?= htmlspecialchars($item['product_id']); ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Retirer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php $totalPrice = $totalPrice ?? 0; ?>
        <div class="d-flex justify-content-between mt-4">
            <h4>Total Général : €<?= htmlspecialchars($totalPrice); ?></h4>
            <div>
                <form action="index.php?action=pay_with_checkout" method="POST" class="d-inline">
                    <button type="submit" class="btn btn-success btn-lg">Payer par Carte</button>
                </form>
                <form action="index.php?action=pay_with_paypal" method="POST" class="d-inline">
           
        </form>
                <div id="paypal-button-container" style="display: inline-block;"></div>
            </div>
        </div>
    <?php else: ?>
        <p>Votre panier est vide.</p>
    <?php endif; ?>
</div>

<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?= htmlspecialchars($totalPrice); ?>' // Montant total en euros
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                alert('Paiement réussi pour ' + details.payer.name.given_name + '!');
                window.location.href = "index.php?action=payment_success";
            });
        },
        onCancel: function(data) {
            alert("Paiement annulé.");
        },
        onError: function(err) {
            console.error(err);
            alert("Une erreur est survenue lors du paiement.");
        }
    }).render('#paypal-button-container');
</script>
</body>
</html>
