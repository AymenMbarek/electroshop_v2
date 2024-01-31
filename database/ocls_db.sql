-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 31 jan. 2024 à 18:22
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
-- Base de données : `ocls_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `brands`
--

CREATE TABLE `brands` (
  `id` int(30) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `brands`
--

INSERT INTO `brands` (`id`, `name`, `description`, `status`, `date_created`) VALUES
(1, 'Asus', 'AZUS Brand', 1, '2023-04-03 09:25:50'),
(2, 'Acer', 'Acer Brand', 1, '2023-04-03 09:26:04'),
(3, 'Alienware', 'Alienware Brand', 1, '2023-04-03 09:26:32'),
(4, 'Dell', 'Dell Brand', 1, '2023-04-03 09:28:59'),
(5, 'HP', 'HP Brand', 1, '2023-04-03 09:29:24'),
(6, 'Lenovo', 'Lenovo Brand', 1, '2023-04-03 09:29:53');

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE `cart` (
  `id` int(30) NOT NULL,
  `client_id` int(30) NOT NULL,
  `inventory_id` int(30) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(30) NOT NULL,
  `category` varchar(250) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `category`, `description`, `status`, `date_created`) VALUES
(1, 'Personal Computers', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut rutrum, elit sit amet iaculis eleifend, risus enim accumsan libero, vel commodo ante neque at mi. Donec consectetur magna turpis, ac tempor sapien tristique eget.', 1, '2023-04-03 09:32:09'),
(2, 'Minicomputer', 'Suspendisse porta aliquet finibus. Interdum et malesuada fames ac ante ipsum primis in faucibus', 1, '2023-04-03 09:33:26'),
(3, 'Mainframe Computers', 'Donec rhoncus diam nisi. Cras vehicula lorem et leo dignissim pharetra nec ac nisl. Curabitur scelerisque scelerisque felis, a lacinia odio elementum id.', 1, '2023-04-03 09:33:45'),
(4, 'Super Computers', 'Praesent sollicitudin quam vitae lorem finibus, at feugiat est lobortis. Etiam vitae imperdiet neque. In magna ligula, lobortis sed porta quis, sodales vel libero.', 1, '2023-04-03 09:34:22');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(30) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` text NOT NULL,
  `default_delivery_address` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `firstname`, `lastname`, `gender`, `contact`, `email`, `password`, `default_delivery_address`, `date_created`) VALUES
(1, 'Mark', 'Cooper', 'Male', '09123654789', 'mcooper@mail.com', '$2y$10$GfYNgIJ8E86XdO6ZA5qwW.55KzSqyl9FDOpVCEZVYmaqwKjCCezKa', 'Sample Address Only', '2023-04-03 13:05:15'),
(2, 'test', 'test', 'Male', '22111333', 'test@yahoo.fr', 'f82bc2d010eab662e43cfbb772ec63ff', 'test', '2024-01-31 18:21:15');

-- --------------------------------------------------------

--
-- Structure de la table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `quantity` double NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `inventory`
--

INSERT INTO `inventory` (`id`, `product_id`, `quantity`, `date_created`, `date_updated`) VALUES
(1, 1, 10, '2023-04-03 11:30:20', NULL),
(2, 2, 15, '2023-04-03 13:48:35', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(30) NOT NULL,
  `client_id` int(30) NOT NULL,
  `delivery_address` text NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `order_type` tinyint(1) NOT NULL COMMENT '1= pickup,2= deliver',
  `amount` double NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0,
  `paid` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `client_id`, `delivery_address`, `payment_method`, `order_type`, `amount`, `status`, `paid`, `date_created`, `date_updated`) VALUES
(3, 1, 'Sample Address Only', 'cod', 1, 99999, 3, 1, '2023-04-03 13:09:19', '2023-04-03 13:14:47'),
(4, 2, 'test', 'cod', 1, 99999, 0, 0, '2024-01-31 18:21:36', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `order_list`
--

CREATE TABLE `order_list` (
  `id` int(30) NOT NULL,
  `order_id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `quantity` int(30) NOT NULL,
  `price` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `order_list`
--

INSERT INTO `order_list` (`id`, `order_id`, `product_id`, `quantity`, `price`, `total`) VALUES
(1, 3, 1, 1, 99999, 99999),
(2, 4, 1, 1, 99999, 99999);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(30) NOT NULL,
  `brand_id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `sub_category_id` int(30) NOT NULL,
  `name` varchar(250) NOT NULL,
  `price` float(12,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `category_id`, `sub_category_id`, `name`, `price`, `status`, `date_created`) VALUES
(1, 2, 1, 0, 'Acer Predator Helios 300 PH315-52 (PH315-52-581R)', 99999.00, 1, '2023-04-03 10:48:32'),
(2, 2, 1, 2, 'Acer Aspire 3 A315-24P (A315-24P-R5XG)', 31349.00, 1, '2023-04-03 13:46:54');

-- --------------------------------------------------------

--
-- Structure de la table `sales`
--

CREATE TABLE `sales` (
  `id` int(30) NOT NULL,
  `order_id` int(30) NOT NULL,
  `total_amount` double NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sales`
--

INSERT INTO `sales` (`id`, `order_id`, `total_amount`, `date_created`) VALUES
(1, 3, 99999, '2023-04-03 13:09:19'),
(2, 4, 99999, '2024-01-31 18:21:36');

-- --------------------------------------------------------

--
-- Structure de la table `specification_list`
--

CREATE TABLE `specification_list` (
  `id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `specification_list`
--

INSERT INTO `specification_list` (`id`, `product_id`, `meta_field`, `meta_value`) VALUES
(27, 1, 'processor', 'Intel i5-9300H'),
(28, 1, 'clock_speed', '2.4GHz'),
(29, 1, 'GPU', 'NVIDIA GeForce RTX 2060 6GB GDDR6'),
(30, 1, 'RAM', '8GB DDR4 SDRAM'),
(31, 1, 'RAM_slot', '2'),
(32, 1, 'SSD_OR_HDD', 'SSD 512GB'),
(33, 1, 'OS', 'Windows 10 Home'),
(34, 1, 'display_size', '15.6\" Full HD 1920 x 1080, 144 Hz'),
(35, 1, 'display_type', 'ComfyView, In-plane Switching (IPS) Technology'),
(36, 1, 'display_touch', 'N/A'),
(37, 1, 'power_adapter', '180 W'),
(38, 1, 'battery_capacity', '4-cell Battery Lithium Polymer, 3815 mAh'),
(39, 1, 'battery_hour', '6 Hour'),
(40, 1, 'dimension', '23.15 x 361.4 x 254.2 mm'),
(41, 1, 'weight', '2.4Kg'),
(42, 1, 'colors', 'Black'),
(43, 1, 'IO_ports', '3x USB Ports\r\n1x Network (RJ-45)\r\n1x HDMI'),
(44, 1, 'fingerprint_sensor', 'N/A'),
(45, 1, 'camera', 'N/A'),
(46, 1, 'keyboard', 'Yes, Keyboard Backlight'),
(47, 1, 'touchpad', 'Yes'),
(48, 1, 'WIFI', 'IEEE 802.11 a/b/g/n/ac/ax Gigabit Ethernet'),
(49, 1, 'bluetooth', 'N/A'),
(50, 1, 'speaker', 'Stereo 2 Speakers'),
(51, 1, 'mic', 'Yes'),
(52, 1, 'other', 'Sample Other Information'),
(53, 2, 'processor', 'AMD Athlon™ Gold 7220U dual-core processor'),
(54, 2, 'clock_speed', '2.4 GHz (MAX 3.7 GHz)'),
(55, 2, 'GPU', 'AMD Radeon Graphics'),
(56, 2, 'RAM', '8GB of onboard LPDDR5'),
(57, 2, 'RAM_slot', '(No Extra Slot)'),
(58, 2, 'SSD_OR_HDD', '256GB PCIe NVMe SSD'),
(59, 2, 'OS', '	Windows 11 Home'),
(60, 2, 'display_size', '39.6 cm (15.6\") LED 1920 x 1080'),
(61, 2, 'display_type', 'Acer ComfyView'),
(62, 2, 'display_touch', 'N/A'),
(63, 2, 'power_adapter', 'N/A'),
(64, 2, 'battery_capacity', '2-cell Li-ion battery 37 Wh 4810 mAh 7.7 V'),
(65, 2, 'battery_hour', 'Up to 6.50 Hour'),
(66, 2, 'dimension', '18.9 x 237.5 x 362.9 mm'),
(67, 2, 'weight', '1.8 kg'),
(68, 2, 'colors', 'Pure Silver'),
(69, 2, 'IO_ports', 'USB : Yes\r\nNumber of USB 2.0 Ports : 1\r\nNumber of USB 3.2 Gen 1 Port : 2\r\nNetwork (RJ-45) : Yes'),
(70, 2, 'fingerprint_sensor', 'N/A'),
(71, 2, 'camera', 'Yes'),
(72, 2, 'keyboard', 'Yes'),
(73, 2, 'touchpad', 'Yes'),
(74, 2, 'WIFI', 'IEEE 802.11ac/a/b/g/n'),
(75, 2, 'bluetooth', 'Bluetooth® 5.2'),
(76, 2, 'speaker', 'Yes'),
(77, 2, 'mic', 'Yes'),
(78, 2, 'other', 'N/A');

-- --------------------------------------------------------

--
-- Structure de la table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(30) NOT NULL,
  `parent_id` int(30) NOT NULL,
  `sub_category` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `parent_id`, `sub_category`, `description`, `status`, `date_created`) VALUES
(1, 1, 'Desktop', 'Pellentesque congue dui at leo ullamcorper rutrum. Sed semper hendrerit lectus, at varius diam pretium id. Proin vel metus in orci pulvinar condimentum.', 1, '2023-04-03 09:36:53'),
(2, 1, 'Laptop', 'Donec nibh lorem, convallis eu libero sit amet, porttitor molestie neque.', 1, '2023-04-03 09:37:12'),
(3, 1, 'Tablets', 'Integer ante velit, porta ac magna vitae, maximus semper dui. Integer vitae nisi et erat tincidunt luctus. Proin condimentum aliquet quam vel interdum.', 1, '2023-04-03 09:37:42');

-- --------------------------------------------------------

--
-- Structure de la table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Electro Shop'),
(6, 'short_name', 'Electro Shop'),
(11, 'logo', 'uploads/logo.jpg'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/1680484800_bg.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', 'Admin', 'admin', '$2y$10$y0p7spgiauysy1J.XC8/3u9nV58HFab64sSKckQpVySGydVODKbme', 'uploads/1624240500_avatar.png', NULL, 1, '2021-01-20 14:02:37', '2023-04-03 13:26:20');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `specification_list`
--
ALTER TABLE `specification_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id_fk` (`product_id`);

--
-- Index pour la table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `specification_list`
--
ALTER TABLE `specification_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT pour la table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `specification_list`
--
ALTER TABLE `specification_list`
  ADD CONSTRAINT `product_id_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
