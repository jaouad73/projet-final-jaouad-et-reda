<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .marketing-text {
            text-align: center;
            margin-top: 2rem;
        }
        .marketing-text strong {
            font-size: 1.5rem; 
            display: block;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Bienvenue sur notre Boutique</h1>
        <br/>
        <?php include 'views/shared/carousel.php'; ?>
        <br/><br/><br/><br/><br/><br/>
        <div class="marketing-text">
            <p><strong>Découvrez une expérience d'achat unique et personnalisée !</strong></p>
            <p>
                Bienvenue dans notre boutique en ligne, votre destination privilégiée pour des produits de qualité supérieure. 
                Nous nous engageons à vous offrir une sélection diversifiée adaptée à vos besoins, que vous recherchiez des produits du quotidien, 
                des articles de luxe ou des nouveautés innovantes. Avec notre interface intuitive, naviguer et trouver ce dont vous avez besoin n'a jamais été aussi simple. 
                Nous valorisons la satisfaction de nos clients grâce à des prix compétitifs, des offres exclusives, et un service après-vente réactif. 
                Faites vos achats en toute confiance avec la garantie d'un service fiable et rapide.
            </p>
        </div>
        <br/><br/><br/><br/><br/><br/>
        <h2 style="display: flex; justify-content: space-between; align-items: center;">
            Catégories en Vedette 
            <a href="index.php?action=view_all_categories" class="btn btn-link" style="font-size: 16px;">Voir toutes les catégories</a>
        </h2>
        <br/>
        <div class="row">
            <?php 
            $displayedCategories = array_slice($categories, 0, 3); 
            foreach ($displayedCategories as $category): 
            ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?= htmlspecialchars($category['image']); ?>" class="card-img-top" alt="<?= htmlspecialchars($category['name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($category['name']); ?></h5>
                            <a class="btn btn-primary" href="index.php?action=view_products_by_category&category_id=<?= $category['category_id']; ?>">
                            Voir les produits</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <br/><br/>
        <h2 style="display: flex; justify-content: space-between; align-items: center;">
            Produits Récents
            <a href="index.php?action=view_all_products" class="btn btn-link" style="font-size: 16px;">Voir tous les produits</a>
        </h2>
        <br/>
        <div class="row">
            <?php 
           $displayedProducts = array_slice($products, 0, 3);
           foreach ($displayedProducts as $product):  ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?= htmlspecialchars($product['image']); ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($product['name']); ?></h5>
                            <p class="card-text">€<?= htmlspecialchars($product['price']); ?></p>
                            <a href="index.php?action=view_product&id=<?= $product['product_id']; ?>" class="btn btn-primary">Détails</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
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
