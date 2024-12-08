-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 30 nov. 2024 à 07:26
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `anas`
--

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `quantity`) VALUES
(12, 23, 14, 1),
(13, 24, 14, 2),
(14, 32, 18, 2);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`, `image`) VALUES
(499, 'pantalon', 'les pantalon', 'uploads/m9gropqk.png'),
(500, 'chandails', 'les chandails', 'uploads/38mjp3yk.png'),
(501, 'jeans', 'jeans', 'uploads/xgup986d.png'),
(502, 'manteau', 'manteau', 'uploads/j7giom0q.png'),
(503, 't-shirts', 't-shirts', 'uploads/31by0337.png');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `total_amount`, `customer_name`, `product_name`, `quantity`) VALUES
(20, 36, '2024-11-30 03:24:02', 559.00, NULL, NULL, NULL),
(21, 36, '2024-11-30 03:24:46', 559.00, NULL, NULL, NULL),
(22, 36, '2024-11-30 03:27:04', 88.00, NULL, NULL, NULL),
(23, 36, '2024-11-30 04:22:51', 176.00, NULL, NULL, NULL),
(24, 36, '2024-11-30 05:51:30', 140.00, NULL, NULL, NULL),
(25, 36, '2024-11-30 06:20:24', 65.00, NULL, NULL, NULL),
(26, 36, '2024-11-30 06:20:41', 70.00, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(14, 14, 14, 44, 250.00),
(15, 15, 14, 4, 250.00),
(16, 16, 14, 2, 250.00),
(17, 17, 14, 2, 250.00),
(18, 18, 14, 4, 250.00),
(19, 19, 18, 1, 222.00),
(20, 20, 24, 4, 2.00),
(21, 20, 25, 1, 111.00),
(22, 20, 29, 5, 88.00),
(23, 21, 24, 4, 2.00),
(24, 21, 25, 1, 111.00),
(25, 21, 29, 5, 88.00),
(26, 22, 29, 1, 88.00),
(27, 23, 29, 2, 88.00),
(28, 24, 47, 2, 70.00),
(29, 25, 31, 1, 65.00),
(30, 26, 47, 1, 70.00);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `name`, `description`, `price`, `image`, `created_at`) VALUES
(24, 496, 'aaa', 'aa', 2.00, 'uploads/book_noun_001_01679.jpg', '2024-11-27 23:32:27'),
(25, 496, 'Anas Mili', 'aa', 111.00, 'uploads/book_noun_001_01679.jpg', '2024-11-27 23:38:23'),
(28, 497, 'Anasssssssssssss', 'aaa', 0.06, 'uploads/AFNB4400.JPG', '2024-11-30 02:39:52'),
(29, 496, 'Mili', 'm', 88.00, 'uploads/DRIU8689.JPG', '2024-11-30 03:00:14'),
(30, 499, 'pantalon1', 'Pantalon en molleton léger de coton mélangé à l\'intérieur doux et brossé. Modèle avec élastique habillé et cordon de serrage à la taille, poches couture et ourlet côtelé en bas de jambe. Coupe classique pour une silhouette classique et un plus grand confort.', 60.00, 'uploads/dco38t6l.png', '2024-11-30 05:28:55'),
(31, 499, 'pantalon2', 'Pantalon en molleton léger de coton mélangé à l\'intérieur doux et brossé. Modèle avec élastique habillé et cordon de serrage à la taille, poches couture et ourlet côtelé en bas de jambe. Coupe classique pour une silhouette classique et un plus grand confort.', 65.00, 'uploads/sakrlznt.png', '2024-11-30 05:29:12'),
(32, 499, 'pantalon2', 'Pantalon en molleton léger de coton mélangé à l\'intérieur doux et brossé. Modèle avec élastique habillé et cordon de serrage à la taille, poches couture et ourlet côtelé en bas de jambe. Coupe classique pour une silhouette classique et un plus grand confort.', 65.00, 'uploads/eeup3e1j.png', '2024-11-30 05:29:23'),
(33, 500, 'chandails1', 'Chandail en molleton d\'épaisseur moyenne à l\'intérieur doux et brossé, réalisé à partir de coton mélangé, avec motif imprimé. Modèle avec capuchon double épaisseur resserrable par cordon, emmanchures descendues et manches longues. Poche kangourou. Ourlet côtelé aux poignets et à la base. Coupe flottante qui offre de l\'ampleur sans être trop grande.', 100.00, 'uploads/cvypjpsa.png', '2024-11-30 05:32:04'),
(34, 500, 'chandails2', 'Chandail en molleton d\'épaisseur moyenne à l\'intérieur doux et brossé, réalisé à partir de coton mélangé, avec motif imprimé. Modèle avec capuchon double épaisseur resserrable par cordon, emmanchures descendues et manches longues. Poche kangourou. Ourlet côtelé aux poignets et à la base. Coupe flottante qui offre de l\'ampleur sans être trop grande.', 90.00, 'uploads/cmhd6gsk.png', '2024-11-30 05:32:19'),
(35, 500, 'chandails3', 'Chandail en molleton d\'épaisseur moyenne à l\'intérieur doux et brossé, réalisé à partir de coton mélangé, avec motif imprimé. Modèle avec capuchon double épaisseur resserrable par cordon, emmanchures descendues et manches longues. Poche kangourou. Ourlet côtelé aux poignets et à la base. Coupe flottante qui offre de l\'ampleur sans être trop grande.', 90.00, 'uploads/c323z5yl.png', '2024-11-30 05:32:37'),
(36, 501, 'jean1', 'Jean 5 poches en denim de coton rigide. Jambes arrondies et coupe flottante de la taille jusqu\'à l\'ourlet avec fond descendu et plus d\'ampleur le long des jambes. Taille de hauteur classique et braguette à glissière. Tout ce dont vous avez besoin pour un style entièrement denim.', 150.00, 'uploads/w1azhqrw.png', '2024-11-30 05:35:06'),
(37, 501, 'jean2', 'Jean 5 poches en denim de coton rigide. Jambes arrondies et coupe flottante de la taille jusqu\'à l\'ourlet avec fond descendu et plus d\'ampleur le long des jambes. Taille de hauteur classique et braguette à glissière. Tout ce dont vous avez besoin pour un style entièrement denim.', 150.00, 'uploads/8nlf53vi.png', '2024-11-30 05:35:19'),
(38, 501, 'jean3', 'Jean 5 poches en denim de coton rigide. Jambes arrondies et coupe flottante de la taille jusqu\'à l\'ourlet avec fond descendu et plus d\'ampleur le long des jambes. Taille de hauteur classique et braguette à glissière. Tout ce dont vous avez besoin pour un style entièrement denim.', 140.00, 'uploads/7b2k7gni.png', '2024-11-30 05:35:33'),
(39, 502, 'manteau1', 'Doudoune matelassé en textile coupe-vent et déperlant. Coupe flottante avec capuchon doublé, resserrable par cordon élastique muni d\'un arrêt devant et sur l\'arrière pour un meilleur ajustement. Fermeture à glissière surmontée d\'un protège-menton anti-frottement devant. Manches longues terminées par ourlet côtelé intérieur. Poches latérales à glissière. Base resserrable par cordons élastiques. Une poche intérieure à fermeture auto-agrippante. Doublée.', 200.00, 'uploads/7a74iiac.png', '2024-11-30 05:37:36'),
(40, 502, 'manteau2', 'Doudoune matelassé en textile coupe-vent et déperlant. Coupe flottante avec capuchon doublé, resserrable par cordon élastique muni d\'un arrêt devant et sur l\'arrière pour un meilleur ajustement. Fermeture à glissière surmontée d\'un protège-menton anti-frottement devant. Manches longues terminées par ourlet côtelé intérieur. Poches latérales à glissière. Base resserrable par cordons élastiques. Une poche intérieure à fermeture auto-agrippante. Doublée.', 200.00, 'uploads/2jlk31zq.png', '2024-11-30 05:37:45'),
(41, 502, 'manteau3', 'Doudoune matelassé en textile coupe-vent et déperlant. Coupe flottante avec capuchon doublé, resserrable par cordon élastique muni d\'un arrêt devant et sur l\'arrière pour un meilleur ajustement. Fermeture à glissière surmontée d\'un protège-menton anti-frottement devant. Manches longues terminées par ourlet côtelé intérieur. Poches latérales à glissière. Base resserrable par cordons élastiques. Une poche intérieure à fermeture auto-agrippante. Doublée.', 240.00, 'uploads/gywhd3y3.png', '2024-11-30 05:38:00'),
(42, 503, 't-shirt1', 'T-shirt imprimé en jersey de coton d\'épaisseur moyenne, doux au toucher et à l\'aspect ancien. Modèle avec bande côtelée autour de l\'encolure ronde, emmanchures tombantes et bas droit. Coupe ample qui offre de l\'aisance sans être trop grande.', 40.00, 'uploads/roi7d5te.png', '2024-11-30 05:40:15'),
(43, 503, 't-shirt2', 'T-shirt imprimé en jersey de coton d\'épaisseur moyenne, doux au toucher et à l\'aspect ancien. Modèle avec bande côtelée autour de l\'encolure ronde, emmanchures tombantes et bas droit. Coupe ample qui offre de l\'aisance sans être trop grande.', 35.00, 'uploads/y2yz7wwa.png', '2024-11-30 05:40:30'),
(44, 503, 't-shirt3', 'T-shirt imprimé en jersey de coton d\'épaisseur moyenne, doux au toucher et à l\'aspect ancien. Modèle avec bande côtelée autour de l\'encolure ronde, emmanchures tombantes et bas droit. Coupe ample qui offre de l\'aisance sans être trop grande.', 35.00, 'uploads/yac0310i.png', '2024-11-30 05:40:58'),
(45, 499, 'pantalon4', 'Jean 5 poches en denim de coton enrichi d\'une légère touche de matériau extensible pour plus de confort. Coupe classique de la taille jusqu\'à l\'ourlet pour une sensation plus flottante et confortable le long des jambes droites. Modèle avec taille de hauteur classique et braguette à fermeture à glissière. Un jean qui traverse le temps.', 100.00, 'uploads/8w71zrqq.png', '2024-11-30 05:46:41'),
(46, 503, 't-shirt4', 'T-shirt en jersey de coton épais avec motif imprimé. Modèle avec ourlet côtelé à l\'encolure, emmanchures descendues et base droite. Coupe grande taille pour une silhouette flottante très ample.', 50.00, 'uploads/oq36n56b.png', '2024-11-30 05:47:21'),
(47, 500, 'chandails4', 'Chandail en molleton léger à l\'intérieur doux et brossé. Modèle avec capuchon double épaisseur resserrable par cordon et poche kangourou devant. Large ourlet côtelé aux poignets et à la base. Coupe classique pour une silhouette classique et un plus grand confort.', 70.00, 'uploads/1uc602u9.png', '2024-11-30 05:48:06');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passworde` varchar(255) NOT NULL,
  `rolee` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `passworde`, `rolee`) VALUES
(1, 'admin', 'adminn@example.com', 'mdp', 'admin'),
(9, 'yassin', 'redaoutamh@gmail.com', '$2y$10$ZQLUtZK33VkLanb.PwkbEeorGa0xfVRixFn7J.fgK28xZZtxa0Kk2', 'client'),
(10, 'anas', 'mili@gmail.com', '$2y$10$XmD1RN8i/kaM7OQe6pNMnOGDrAbmBkbbmNQZNE8iF0NjozExw13/G', 'client'),
(11, 'jaouad', 'jaouad@gmail.com', '$2y$10$ETFMbYdogX2eI3jdFR1EBucyz4dQw4RB.qRqFDq.HbyEAyL7L4Sl2', 'client'),
(14, 'yassine', 'yassine@gmail.com', '$2y$10$F9NEsnvAhKDs6Su9t/iL3e3IMTJmH3GC0dfN9jdljrtbe9Wz1P7HK', 'client'),
(15, 'houssam', 'houssam@gmail.com', '$2y$10$ZvHuY8ltNw224fcOf76Kgu1H/7E9MwniYrX8S1gnO0RuC/K9ccl62', 'client'),
(20, 'jare', 'jare@gmail.com', '$2y$10$oK6aH62ubNtBc.TIoiHALukoUdWLOBDUWETppVLWQ59Fd0/ApMlPm', 'client'),
(21, 'yassineee', 'abdo@gmail.com', '$2y$10$Lutu5Zv.NyO66I76LuJLwOHQj2q0DxmllZ.cXtKUu/Y/oGlqMu7dS', 'client'),
(23, 'reda222', 'redaouta@gmail.com', '$2y$10$PwPQU6xFMBJjdS7J3IUXnOtE6SjL9uBqX8emLGk7y2DYd.emIoKW6', 'client'),
(24, 'tine', 'tine@gmail.com', '$2y$10$phdfiypmxw3tKzm3u7aVXuQBHNaziiDC8lBq3Pi7l2pcxQr8PMAmq', 'client'),
(25, 'ouanhar', 'wanhar@gmail.com', '$2y$10$ij9X9FWvjOlD3m5eKiOZNO1D3CpbTTeNlqFEm1nvLnPLVQj9yK3JC', 'client'),
(31, 'farouk', 'admin@gmail.com', '$2y$10$cj7dHg/PwfvzJu.alDLL1.Zn1e.zMUkpvHCOgV5.FsIYQxhjPepZ6', 'admin'),
(32, 'anass', 'AnasMili@teccart.com', '$2y$10$O6gcr9anfquJLctxwy.6BefR6efuxBA0Dp2sfURMxbCET/sBmb1/u', 'client'),
(34, 'aa', 'aAANYT04@gmail.com', '$2y$10$Dxk8DMZQAwHjdWDMS1teQ.buCL4hWXPaIBelKrBSRHIk7rwySbKLe', 'client'),
(36, 'aaa', 'Anasmili4@gmail.com', '$2y$10$OIQJ5VG/pvQvjOBVCykUKezsJvM/zLJlREc91GldY2F17BQjKmsfC', 'client'),
(37, 'ss', 'ss@gmail.com', '$2y$10$As2xSfXnD3Mycnrc.mqMF.V./JDBTCvYKAHSHVgPWh0YgXwQRTHd6', 'client'),
(38, 'zz', 'zz@gnail.cc', '$2y$10$CWmrkhFciwuWGnJX.AiGVer0MwfVigU88BjONfLrRqJ6zbOlyTyCi', 'client');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `products_ibfk_1` (`category_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=504;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
