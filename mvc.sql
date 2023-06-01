-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 01 juin 2023 à 20:39
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mvc`
--

-- --------------------------------------------------------

--
-- Structure de la table `buy`
--

CREATE TABLE `buy` (
  `id_buy` int(11) NOT NULL,
  `id_purchase` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `buy`
--

INSERT INTO `buy` (`id_buy`, `id_purchase`, `id_product`, `quantity`) VALUES
(1, 1, 9, 1),
(2, 1, 10, 1);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id_category`, `name`) VALUES
(1, 'chaussures'),
(2, 't-shirt');

-- --------------------------------------------------------

--
-- Structure de la table `focus`
--

CREATE TABLE `focus` (
  `id_focus` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `sale` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_category` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id_product`, `name`, `id_category`, `image`, `price`, `description`) VALUES
(9, 'AIR JORDAN 1 MID - Baskets montantes', 1, '30052023184030jordans.webp', 119.95, 'Dessus / Tige: Cuir et imitation de cuir\r\nDoublure: Textile\r\nSemelle de propreté: Textile\r\nSemelle d\'usure: Matière synthétique\r\nÉpaisseur de la doublure: Doublure protégeant du froid\r\nMatière: Cuir synthétique\r\nConseils d\'entretien: Appliquez un imperméabilisant avant la première utilisation'),
(10, 'CHAUSSURE STAN SMITH', 1, '30052023184205adidas.webp', 110, 'Look intemporel. Style casual. Polyvalence au quotidien. Depuis plus de 50 ans, la chaussure adidas Stan Smith s’impose comme une icône. Ce modèle affiche un nouveau design dans le cadre de l’engagement d’adidas à n’utiliser que du polyester recyclé d’ici 2024. Avec sa tige vegan et sa semelle extérieure fabriquée à partir de déchets de caoutchouc, elle conserve son style iconique, tout en respectant la planète.\r\n\r\nCe produit a été conçu avec des alternatives vegan, sans ingrédients ou matériaux d\'origine animale. Il est aussi confectionné avec Primegreen, une série de matériaux recyclés haute performance. La tige est faite à 50 % de matière recyclée. Sans polyester vierge.'),
(11, 'Tee shirt ', 2, '30052023184549tshirt-blanc.jpg', 15.99, 'Un jersey lourd pour une belle tenue, des coutures solides qui le rendent indéformable, un col avec de l\'élasthanne, pour éviter qu\'il se détende, un toucher doux, une étiquette griffée , signature de la marque... Vous comprenez pourquoi on l\'appelle \"Le Parfait by Jules\"\r\n\r\nCoupe regular, ni trop ajustée ni trop large avec un tombé droit\r\nManches courtes\r\nCol rond en bord-côtes\r\nGriffe brodée ton sur ton\r\nGrammage : 200 g/m²- jersey lourd\r\n100% coton issu de l\'agriculture biologique\r\nCe t-shirt est éco-conçu, pour durer dans le temps. Il est proposé dans un colorama de plusieurs teintes toutes plus tendances les unes que les autres, pour varier les plaisirs, et les styles.\r\n\r\nLe mannequin mesure 1m86 et porte une taille L.');

-- --------------------------------------------------------

--
-- Structure de la table `purchase`
--

CREATE TABLE `purchase` (
  `id_purchase` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `purchase_date` datetime NOT NULL,
  `total` float NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `purchase`
--

INSERT INTO `purchase` (`id_purchase`, `id_user`, `purchase_date`, `total`, `status`) VALUES
(1, 1, '2023-06-01 20:07:42', 229.95, 'En cours de traitement');

-- --------------------------------------------------------

--
-- Structure de la table `review`
--

CREATE TABLE `review` (
  `id_review` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `review`
--

INSERT INTO `review` (`id_review`, `id_user`, `id_product`, `comment`, `created_at`, `rating`) VALUES
(1, 1, 9, 'génial', '2023-06-01 19:37:59', 4),
(2, 1, 9, 'youpi', '2023-06-01 19:38:11', 5);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `delivery_address` varchar(255) DEFAULT NULL,
  `billing_address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `verify_account` tinyint(1) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `email`, `f_name`, `l_name`, `pseudo`, `password`, `delivery_address`, `billing_address`, `phone`, `verify_account`, `token`, `role`) VALUES
(1, 'admin@admin.com', 'admin', 'admin', 'admin', '$2y$10$3oG43mhFqXbp42GBFPxLFuKKREmgskmXbbQdiJNGvxAeNPJIuW.sa', '22 rue de l\'aube', '22 rue de truc', NULL, 0, NULL, 'ROLE_ADMIN');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`id_buy`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Index pour la table `focus`
--
ALTER TABLE `focus`
  ADD PRIMARY KEY (`id_focus`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Index pour la table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id_purchase`);

--
-- Index pour la table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id_review`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `buy`
--
ALTER TABLE `buy`
  MODIFY `id_buy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `focus`
--
ALTER TABLE `focus`
  MODIFY `id_focus` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id_purchase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `review`
--
ALTER TABLE `review`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
