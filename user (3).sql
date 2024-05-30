-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 30 mai 2024 à 21:26
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
-- Base de données : `user`
--

-- --------------------------------------------------------

--
-- Structure de la table `actes_paramedicaux`
--

CREATE TABLE `actes_paramedicaux` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `actes_paramedicaux`
--

INSERT INTO `actes_paramedicaux` (`id`, `nom`, `usertype`) VALUES
(5, 'Prise de sang', 'infirmier'),
(6, 'Injection sous-cutanée', 'infirmier'),
(7, 'Injection intramusculaire', 'infirmier'),
(9, 'Pansement simple', 'infirmier'),
(10, 'Pansement complexe', 'infirmier'),
(11, 'Suivi de diabète', 'infirmier'),
(12, 'Soins palliatifs', 'infirmier'),
(15, 'Perfusion à domicile', 'infirmier'),
(16, 'Surveillance post-opératoire', 'infirmier'),
(17, 'Soins d’escarres', 'infirmier'),
(18, 'Rééducation fonctionnelle', 'ergotherapeute'),
(19, 'Réadaptation cognitive', 'ergotherapeute'),
(20, 'Adaptation du domicile', 'ergotherapeute'),
(21, 'Conseils en aides techniques', 'ergotherapeute'),
(22, 'Évaluation des capacités fonctionnelles', 'ergotherapeute'),
(23, 'Rééducation de la main', 'ergotherapeute'),
(24, 'Thérapie occupationnelle', 'ergotherapeute'),
(25, 'Rééducation des troubles de l’écriture', 'ergotherapeute'),
(26, 'Rééducation des troubles de la coordination', 'ergotherapeute'),
(27, 'Rééducation des troubles de la motricité fine', 'ergotherapeute'),
(28, 'Massage thérapeutique', 'kinesitherapeute'),
(29, 'Rééducation posturale', 'kinesitherapeute'),
(30, 'Rééducation respiratoire', 'kinesitherapeute'),
(31, 'Drainage lymphatique', 'kinesitherapeute'),
(32, 'Mobilisation articulaire', 'kinesitherapeute'),
(33, 'Rééducation vestibulaire', 'kinesitherapeute'),
(34, 'Rééducation périnéale', 'kinesitherapeute'),
(35, 'Rééducation cardio-respiratoire', 'kinesitherapeute'),
(36, 'Rééducation neurologique', 'kinesitherapeute'),
(37, 'Rééducation des troubles musculo-squelettiques', 'kinesitherapeute'),
(38, 'Aide à la toilette', 'ats'),
(39, 'Aide à l\'habillage', 'ats'),
(40, 'Aide aux repas', 'ats'),
(41, 'Accompagnement aux activités sociales', 'ats'),
(42, 'Stimulation cognitive', 'ats'),
(43, 'Soins de confort et de bien-être', 'ats'),
(44, 'Aide à la prise de médicaments', 'ats'),
(45, 'Surveillance de l\'état de santé', 'ats'),
(46, 'Assistance pour les besoins quotidiens', 'ats');

-- --------------------------------------------------------

--
-- Structure de la table `acts_paramedicaux`
--

CREATE TABLE `acts_paramedicaux` (
  `id` int(11) NOT NULL,
  `usertype` varchar(50) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `acts_paramedicaux`
--

INSERT INTO `acts_paramedicaux` (`id`, `usertype`, `nom`, `date`) VALUES
(1, 'infirmier', 'changement de pancement', '2024-02-15'),
(2, 'infirmier', 'jhvyttyryy', '2024-11-14'),
(3, 'ergotherapeute', 'kjnkjhuigyu', '2024-01-22'),
(4, 'infirmier', 'hjjjjhjyjy', '2024-07-22'),
(5, 'infirmier', 'chnagement', '2024-05-28'),
(6, 'infirmier', 'chnagement', '2024-05-28'),
(7, 'infirmier', 'linouun', '2024-05-28'),
(8, 'kinesitherapeute', 'hgjyfyuy', '2024-05-28'),
(9, 'infirmier', 'wissal', '2024-05-29');

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `phone` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `email`, `address`, `sex`, `phone`, `created_at`) VALUES
(1, 'admin', '1234', 'admin@gmail.com', 'sidi bel abbes', 'male', 0, '2024-04-13 23:08:24');

-- --------------------------------------------------------

--
-- Structure de la table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) DEFAULT 'hors ligne'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `patients`
--

INSERT INTO `patients` (`id`, `username`, `password`, `email`, `address`, `sex`, `phone`, `created_at`, `status`) VALUES
(8, 'boukebch manel', '1234', 'manel26@gmail.com', 'roche dubai', 'female', '0654879563', '2024-05-05 15:13:27', 'hors ligne'),
(9, 'Benamer feriel', '1234', 'fifiben254@gmail.com', 'labrimer B8 P6', 'female', '0748748556', '2024-05-05 15:23:40', 'hors ligne'),
(10, 'Beloufa Bassma', '1234', 'bassoubel@gmail.com', 'makam', 'female', '0548796587', '2024-05-05 15:24:16', 'hors ligne'),
(20, 'ferhaoui layane', '1234', 'layanferhaoui@gmail.com', 'roche ghalmi 22', 'female', '0685471220', '2024-05-05 15:32:48', 'hors ligne'),
(21, 'bouanani manal', '1234', 'manou2003@gmail.com', 'sorikor', 'female', '0547896512', '2024-05-25 03:43:00', 'hors ligne'),
(22, 'Belkebiche Malek', '1234', 'maleklina325@gmail.com', 'roche ghalmi 22', 'female', '0521566987', '2024-05-25 03:47:02', 'hors ligne'),
(25, 'Ferhaoui Abde El Illah', '1234', 'abdeilahferhaoui@gmail.com', 'roché ghalmi', 'male', '0562548987', '2024-05-30 19:10:15', 'hors ligne'),
(26, 'Beloufa Riad', '1234', 'riadbeloufa@gmail.com', 'makam225p3', 'male', '0569321002', '2024-05-30 19:11:36', 'hors ligne');

-- --------------------------------------------------------

--
-- Structure de la table `professionnels`
--

CREATE TABLE `professionnels` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `sex` enum('male','female') NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `usertype` enum('infirmier','ergotherapeute','kinesitherapeute','ats') NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `statut` varchar(10) DEFAULT 'hors ligne'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `professionnels`
--

INSERT INTO `professionnels` (`id`, `username`, `password`, `email`, `address`, `sex`, `phone`, `created_at`, `usertype`, `start_time`, `end_time`, `statut`) VALUES
(12, 'Bouanani Safaa', '1234', 'bouananisafaa@gmail.com', 'soricor', 'female', '0623155698', '2024-05-30 18:57:33', 'infirmier', '08:00:00', '16:00:00', 'en ligne'),
(13, 'Benhamadi Rouayda', '1234', 'rouaydabenhamadi@gmail.com', 'vilege tiere', 'female', '0623155889', '2024-05-30 18:58:46', 'infirmier', '16:00:00', '08:00:00', 'hors ligne'),
(14, 'Belkebiche Lina', '1234', 'linabelkebich@gmail.com', 'roché', 'female', '0674320163', '2024-05-30 19:00:08', 'ergotherapeute', '08:00:00', '16:00:00', 'hors ligne'),
(15, 'Talbi Hibat Allah', '1234', 'hibatallah@gmail.com', 'ben badis', 'female', '0785896632', '2024-05-30 19:01:21', 'ergotherapeute', '16:00:00', '08:00:00', 'hors ligne'),
(16, 'Belkebiche Mohammed', '1234', 'mohamedblk@gmail.com', 'roché', 'male', '0698886166', '2024-05-30 19:02:30', 'kinesitherapeute', '08:00:00', '16:00:00', 'hors ligne'),
(17, 'Beloufa Khaled', '1234', 'khaledbeloufa@gmail.com', 'makam225p3', 'male', '0548789663', '2024-05-30 19:03:26', 'kinesitherapeute', '16:00:00', '08:00:00', 'hors ligne'),
(18, 'Belghoul Khadija', '1234', 'Belghoulkhadija@gmail.com', 'boukhanifis', 'female', '0623155896', '2024-05-30 19:04:22', 'ats', '08:00:00', '16:00:00', 'hors ligne'),
(19, 'Mbrabet Khayra', '1234', 'khayramerabet@gamil.com', 'soricor', 'female', '0654589521', '2024-05-30 19:05:49', 'ats', '16:00:00', '08:00:00', 'hors ligne');

-- --------------------------------------------------------

--
-- Structure de la table `receptionists`
--

CREATE TABLE `receptionists` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `receptionists`
--

INSERT INTO `receptionists` (`id`, `username`, `password`, `email`, `address`, `sex`, `created_at`) VALUES
(3, 'mohammed', 'moh22', 'mohammedbelkebiche@gmail.com', 'la rue aissat idir', 'male', '2024-04-13 23:55:19');

-- --------------------------------------------------------

--
-- Structure de la table `rendez_vous`
--

CREATE TABLE `rendez_vous` (
  `id` int(11) NOT NULL,
  `patients_id` int(11) DEFAULT NULL,
  `professionnels_id` int(11) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `date_rendez_vous` date DEFAULT NULL,
  `heure_rendez_vous` time DEFAULT NULL,
  `acte_paramedical` varchar(255) DEFAULT NULL,
  `statut` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `rendez_vous`
--

INSERT INTO `rendez_vous` (`id`, `patients_id`, `professionnels_id`, `address`, `date_rendez_vous`, `heure_rendez_vous`, `acte_paramedical`, `statut`) VALUES
(29, 25, 12, 'roché', '2024-06-01', '12:00:00', 'Prise de sang, Pansement simple', 'Confirmé'),
(30, 26, 14, 'makam', '2024-06-10', '15:00:00', 'Réadaptation cognitive', 'En attente'),
(31, 22, 16, 'roche', '2024-06-05', '16:00:00', 'Rééducation respiratoire', 'En attente'),
(32, 21, 19, 'citymimoun', '2024-06-23', '18:00:00', 'Aide aux repas', 'En attente');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actes_paramedicaux`
--
ALTER TABLE `actes_paramedicaux`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `acts_paramedicaux`
--
ALTER TABLE `acts_paramedicaux`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `professionnels`
--
ALTER TABLE `professionnels`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `receptionists`
--
ALTER TABLE `receptionists`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patients_id` (`patients_id`),
  ADD KEY `professionnels_id` (`professionnels_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actes_paramedicaux`
--
ALTER TABLE `actes_paramedicaux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `acts_paramedicaux`
--
ALTER TABLE `acts_paramedicaux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `professionnels`
--
ALTER TABLE `professionnels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `receptionists`
--
ALTER TABLE `receptionists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD CONSTRAINT `rendez_vous_ibfk_1` FOREIGN KEY (`patients_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rendez_vous_ibfk_2` FOREIGN KEY (`professionnels_id`) REFERENCES `professionnels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
