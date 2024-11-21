-- phpMyAdmin SQL Dump


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cinephoria`
--

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE `cart` (
  `id` varchar(8) NOT NULL,
  `user_id` varchar(8) NOT NULL,
  `film_id` varchar(8) NOT NULL,
  `price` varchar(60) NOT NULL,
  `seats` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

CREATE TABLE `film` (
  `id` varchar(8) NOT NULL,
  `name` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `price` varchar(20) NOT NULL,
  `category` varchar(30) NOT NULL,
  `image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `film`
--

INSERT INTO `film` (`id`, `name`, `date`, `price`, `category`, `image`) VALUES
('0r5qVZDX', 'naya', '2023-04-09', '15', 'kids', 'kSOuJrL6.png');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` varchar(8) NOT NULL,
  `user_id` varchar(8) NOT NULL,
  `film_id` varchar(8) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `seats` varchar(2) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `price` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `film_id`, `name`, `email`, `seats`, `date`, `price`, `status`) VALUES
('UkPS5155', 'RJEUiFSk', 'DVlphS3T', 'tasnim', 'tasnim@gmail.com', '3', '0000-00-00', '15', ''),
('QKHaHO1S', 'RJEUiFSk', 'gEAU0US5', 'tasnim', 'tasnim@gmail.com', '1', '0000-00-00', '15', ''),
('zkOoWxAy', 'RJEUiFSk', 'QP5jcg2M', 'tasnim', 'tasnim@gmail.com', '1', '0000-00-00', '15', ''),
('dssS16Gt', 'RJEUiFSk', '5p9kCJnR', 'tasnim', 'tasnim@gmail.com', '1', '2023-04-08', '15', ''),
('0zINdaYN', 'RJEUiFSk', 'GmgdXzaA', 'tasnim', 'tasnim@gmail.com', '1', '2023-04-08', '15', '');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` varchar(8) NOT NULL,
  `last name` varchar(30) NOT NULL,
  `first name` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
