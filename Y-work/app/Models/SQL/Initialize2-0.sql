-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 25 mars 2021 à 12:31
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.3

START TRANSACTION;
SET autocommit=0;

DROP DATABASE IF EXISTS `y_work`;
CREATE DATABASE IF NOT EXISTS `y_work`;

USE `y_work`;
--
-- Base de données : `y_work`
--

-- --------------------------------------------------------

--
-- Structure de la table `hide`
--

CREATE TABLE `hide` (
  `ID` int(11) NOT NULL,
  `ID_Entreprise` int(11) NOT NULL,
  `bool` boolean
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `appartient`
--

CREATE TABLE `appartient` (
  `ID_Secteur` int(11) NOT NULL,
  `ID_Entreprise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `assigner`
--

CREATE TABLE `assigner` (
  `ID_Promo` int(11) NOT NULL,
  `ID_Personnel` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `candidature`
--

CREATE TABLE `candidature` (
  `ID` int(11) NOT NULL,
  `CV` varchar(256) NOT NULL,
  `LM` varchar(256) DEFAULT NULL,
  `msg` varchar(256) DEFAULT NULL,
  `fiche_validation` varchar(256) DEFAULT NULL,
  `convention_stage` varchar(256) DEFAULT NULL,
  `avancement` int(11) NOT NULL DEFAULT '1',
  `ID_Offre` int(11) NOT NULL,
  `ID_Personnel` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

CREATE TABLE `competence` (
  `ID` int(11) NOT NULL,
  `designation` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `critere`
--

CREATE TABLE `critere` (
  `ID` int(11) NOT NULL,
  `designation` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Déchargement des données de la table `critere`
--

INSERT INTO `critere` (`ID`, `designation`) VALUES
(1, 'gratification'),
(2, 'workcondition'),
(3, 'evolution'),
(4, 'overallimpression');
-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `ID` int(11) NOT NULL,
  `nom` varchar(128) NOT NULL,
  `nb_stagiaires_cesi` int(11) NOT NULL,
  `eval_stagiaires` int(11) DEFAULT NULL,
  `confiance_pilote` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `evaluation`
--

CREATE TABLE `evaluation` (
  `ID` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `comments` varchar(512) DEFAULT NULL,
  `ID_Critere` int(11) NOT NULL,
  `ID_Personnel` bigint(20) UNSIGNED NOT NULL,
  `ID_Entreprise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `localite`
--

CREATE TABLE `localite` (
  `ID` int(11) NOT NULL,
  `ville` varchar(128) NOT NULL,
  `ID_Entreprise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

CREATE TABLE `offre` (
  `ID` int(11) NOT NULL,
  `intitule` varchar(50) NOT NULL,
  `descriptif` varchar(1024) DEFAULT NULL,
  `type_promo` varchar(128) NOT NULL,
  `duree_stage` int(11) NOT NULL,
  `remuneration` decimal(6,2) NOT NULL,
  `date_debut` date NOT NULL,
  `nb_places` int(11) NOT NULL,
  `ID_Entreprise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Structure de la table `promo`
--

CREATE TABLE `promo` (
  `ID` int(11) NOT NULL,
  `type_promo` varchar(10) NOT NULL,
  `annee` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `promo`
--

INSERT INTO `promo` (`ID`, `type_promo`, `annee`) VALUES
(1, 'BTP', 'A1'),
(2, 'BTP', 'A2'),
(3, 'BTP', 'A3'),
(4, 'BTP', 'A4'),
(5, 'BTP', 'A5'),
(6, 'INFO', 'A1'),
(7, 'INFO', 'A2'),
(8, 'INFO', 'A3'),
(9, 'INFO', 'A4'),
(10, 'INFO', 'A5'),
(11, 'GN', 'A1'),
(12, 'GN', 'A2'),
(13, 'GN', 'A3'),
(14, 'GN', 'A4'),
(15, 'GN', 'A5'),
(16, 'S3E', 'A1'),
(17, 'S3E', 'A2'),
(18, 'S3E', 'A3'),
(19, 'S3E', 'A4'),
(20, 'S3E', 'A5');

-- --------------------------------------------------------

--
-- Structure de la table `qualifier`
--

CREATE TABLE `qualifier` (
  `ID_Personnel` bigint(20) UNSIGNED NOT NULL,
  `ID_Statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `requerir`
--

CREATE TABLE `requerir` (
  `ID_Offre` int(11) NOT NULL,
  `ID_Competence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `secteur`
--

CREATE TABLE `secteur` (
  `ID` int(11) NOT NULL,
  `designation` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE `statut` (
  `ID` int(11) NOT NULL,
  `designation` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `statut`
--

INSERT INTO `statut` (`ID`, `designation`) VALUES
(1, 'Étudiant'),
(2, 'Délégué'),
(3, 'Pilote');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `centre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `souhaiter`
--

CREATE TABLE `souhaiter` (
  `ID_Offre` int(11) NOT NULL,
  `ID_Personnel` bigint(20) UNSIGNED NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour la table `appartient`
--
ALTER TABLE `appartient`
  ADD PRIMARY KEY (`ID_Secteur`,`ID_Entreprise`),
  ADD KEY `appartient_Entreprise_FK` (`ID_Entreprise`);

--
-- Index pour la table `hide`
--
ALTER TABLE `hide`
    ADD PRIMARY KEY (`ID`),
    ADD KEY `hide_Entreprise_FK` (`ID_Entreprise`);

--
-- Index pour la table `assigner`
--
ALTER TABLE `assigner`
  ADD PRIMARY KEY (`ID_Promo`,`ID_Personnel`);

--
-- Index pour la table `candidature`
--
ALTER TABLE `candidature`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Candidature_Offre_FK` (`ID_Offre`),
  ADD KEY `Candidature_Personnel_FK` (`ID_Personnel`);

--
-- Index pour la table `competence`
--
ALTER TABLE `competence`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `critere`
--
ALTER TABLE `critere`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Evaluation_Critere_FK` (`ID_Critere`),
  ADD KEY `Evaluation_Personnel_FK` (`ID_Personnel`),
  ADD KEY `Evaluation_Entreprise_FK` (`ID_Entreprise`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `localite`
--
ALTER TABLE `localite`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Localite_Entreprise_FK` (`ID_Entreprise`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `offre`
--
ALTER TABLE `offre`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Offre_Entreprise_FK` (`ID_Entreprise`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `qualifier`
--
ALTER TABLE `qualifier`
  ADD PRIMARY KEY (`ID_Personnel`,`ID_Statut`),
  ADD KEY `qualifier_Statut_FK` (`ID_Statut`);

--
-- Index pour la table `requerir`
--
ALTER TABLE `requerir`
  ADD PRIMARY KEY (`ID_Offre`,`ID_Competence`),
  ADD KEY `requerir_Competence_FK` (`ID_Competence`);

--
-- Index pour la table `secteur`
--
ALTER TABLE `secteur`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `users`
--
ALTER TABLE `souhaiter`
  ADD PRIMARY KEY (`ID_Offre`, `ID_Personnel`),
  ADD KEY `souhaiter_Offre_FK` (`ID_Offre`);

--
-- AUTO_INCREMENT pour les tables déchargées
--


-- AUTO_INCREMENT pour la table `candidature`
--
ALTER TABLE `candidature`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;


--
-- AUTO_INCREMENT pour la table `hide`
--
ALTER TABLE `hide`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;


--
-- AUTO_INCREMENT pour la table `competence`
--
ALTER TABLE `competence`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `critere`
--
ALTER TABLE `critere`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `localite`
--
ALTER TABLE `localite`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `offre`
--
ALTER TABLE `offre`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `promo`
--
ALTER TABLE `promo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `secteur`
--
ALTER TABLE `secteur`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `statut`
--
ALTER TABLE `statut`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appartient`
--
ALTER TABLE `appartient`
  ADD CONSTRAINT `appartient_Entreprise_FK` FOREIGN KEY (`ID_Entreprise`) REFERENCES `entreprise` (`ID`),
  ADD CONSTRAINT `appartient_Secteur_FK` FOREIGN KEY (`ID_Secteur`) REFERENCES `secteur` (`ID`);


-- Contraintes pour la table `assigner`
--
ALTER TABLE `assigner`
  ADD CONSTRAINT `assigner_Personnel_FK` FOREIGN KEY (`ID_Personnel`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `assigner_Promo_FK` FOREIGN KEY (`ID_Promo`) REFERENCES `promo` (`ID`);

--
-- Contraintes pour la table `candidature`
--
ALTER TABLE `candidature`
  ADD CONSTRAINT `Candidature_Offre_FK` FOREIGN KEY (`ID_Offre`) REFERENCES `offre` (`ID`),
  ADD CONSTRAINT `Candidature_Personnel_FK` FOREIGN KEY (`ID_Personnel`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `evaluation`
--
ALTER TABLE `evaluation`
  ADD CONSTRAINT `Evaluation_Critere_FK` FOREIGN KEY (`ID_Critere`) REFERENCES `critere` (`ID`),
  ADD CONSTRAINT `Evaluation_Entreprise_FK` FOREIGN KEY (`ID_Entreprise`) REFERENCES `entreprise` (`ID`),
  ADD CONSTRAINT `Evaluation_Personnel_FK` FOREIGN KEY (`ID_Personnel`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `localite`
--
ALTER TABLE `localite`
  ADD CONSTRAINT `Localite_Entreprise_FK` FOREIGN KEY (`ID_Entreprise`) REFERENCES `entreprise` (`ID`);

--
-- Contraintes pour la table `offre`
--
ALTER TABLE `offre`
  ADD CONSTRAINT `Offre_Entreprise_FK` FOREIGN KEY (`ID_Entreprise`) REFERENCES `entreprise` (`ID`);

--
-- Contraintes pour la table `qualifier`
--
ALTER TABLE `qualifier`
  ADD CONSTRAINT `qualifier_Personnel_FK` FOREIGN KEY (`ID_Personnel`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `qualifier_Statut_FK` FOREIGN KEY (`ID_Statut`) REFERENCES `statut` (`ID`);

--
-- Contraintes pour la table `requerir`
--
ALTER TABLE `requerir`
  ADD CONSTRAINT `requerir_Competence_FK` FOREIGN KEY (`ID_Competence`) REFERENCES `competence` (`ID`),
  ADD CONSTRAINT `requerir_Offre_FK` FOREIGN KEY (`ID_Offre`) REFERENCES `offre` (`ID`);
COMMIT;

--
-- Contraintes pour la table `souhaiter`
--
ALTER TABLE `souhaiter`
  ADD CONSTRAINT `souhaiter_Personnel_FK` FOREIGN KEY (`ID_Personnel`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `souhaiter_Offre_FK` FOREIGN KEY (`ID_Offre`) REFERENCES `offre` (`ID`);
COMMIT;

-- !40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
-- !40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
-- !40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
