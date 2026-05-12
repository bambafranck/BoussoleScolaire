-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 12 mai 2026 à 18:13
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
-- Base de données : `boussolescolaire`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `id_admin` int(11) NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `privileges` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`privileges`)),
  `date_creation` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id_admin`, `id_utilisateur`, `nom`, `prenom`, `email`, `mot_de_passe`, `privileges`, `date_creation`) VALUES
(1, NULL, 'Admin', 'Super', 'admin@boussolescolaire.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-04-17 01:19:00');

-- --------------------------------------------------------

--
-- Structure de la table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `sujet` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `date_envoi` datetime NOT NULL DEFAULT current_timestamp(),
  `lu` tinyint(1) DEFAULT 0,
  `repondu` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etablissement`
--

CREATE TABLE `etablissement` (
  `id_etablissement` int(11) NOT NULL,
  `nom_etablissement` varchar(200) NOT NULL,
  `type_etablissement` enum('universite','grande_ecole','institut','lycee_technique','autre') NOT NULL,
  `ville` varchar(100) NOT NULL,
  `adresse` text DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `site_web` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `actif` tinyint(1) DEFAULT 1,
  `date_creation` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etablissement`
--

INSERT INTO `etablissement` (`id_etablissement`, `nom_etablissement`, `type_etablissement`, `ville`, `adresse`, `telephone`, `email`, `site_web`, `description`, `logo`, `actif`, `date_creation`) VALUES
(1, 'Université Félix Houphouët-Boigny', 'universite', 'Abidjan', NULL, '+225 22 44 08 95', 'contact@univ-fhb.edu.ci', NULL, NULL, NULL, 1, '2026-04-17 01:19:00'),
(2, 'Institut National Polytechnique Houphouët-Boigny', 'grande_ecole', 'Yamoussoukro', NULL, '+225 30 64 46 46', 'info@inphb.ci', NULL, NULL, NULL, 1, '2026-04-17 01:19:00'),
(3, 'École Supérieure de Commerce d\'Abidjan', 'grande_ecole', 'Abidjan', NULL, '+225 27 22 40 40 00', 'contact@esca.ci', NULL, NULL, NULL, 1, '2026-04-17 01:19:00'),
(4, 'Université Alassane Ouattara', 'universite', 'Bouaké', NULL, '+225 31 63 50 00', 'info@univ-ao.ci', NULL, NULL, NULL, 1, '2026-04-17 01:19:00'),
(5, 'École Nationale Supérieure de Statistique et d\'Économie Appliquée', 'grande_ecole', 'Abidjan', NULL, '+225 22 44 08 08', 'contact@ensea.ed.ci', NULL, NULL, NULL, 1, '2026-04-17 01:19:00'),
(6, 'Institut Africain d\'Informatique', 'institut', 'Abidjan', NULL, '+225 27 22 44 55 66', 'info@iai.ci', NULL, NULL, NULL, 1, '2026-04-17 01:19:00'),
(7, 'Université Nangui Abrogoua', 'universite', 'Abidjan', NULL, '+225 23 51 70 00', 'contact@univ-na.ci', NULL, NULL, NULL, 1, '2026-04-17 01:19:00'),
(8, 'Institut National Supérieur de l\'Enseignement Technique', 'institut', 'Abidjan', NULL, '+225 21 25 60 60', 'info@inset.ci', NULL, NULL, NULL, 1, '2026-04-17 01:19:00'),
(9, 'École des Mines et de la Géologie', 'grande_ecole', 'Abidjan', NULL, '+225 22 44 10 10', 'contact@emg.ci', NULL, NULL, NULL, 1, '2026-04-17 01:19:00'),
(10, 'Université Jean Lorougnon Guédé', 'universite', 'Daloa', NULL, '+225 32 78 50 00', 'info@ujlog.ci', NULL, NULL, NULL, 1, '2026-04-17 01:19:00'),
(11, 'Pigier Côte d\'Ivoire', 'grande_ecole', 'Abidjan', NULL, NULL, NULL, NULL, 'École de gestion, commerce et comptabilité', NULL, 1, '2026-05-03 14:29:13'),
(12, 'ISTC Polytechnique', 'grande_ecole', 'Abidjan', NULL, NULL, NULL, NULL, 'Institut Supérieur des Technologies de la Communication', NULL, 1, '2026-05-03 14:29:13'),
(13, 'Institut Universitaire d\'Abidjan', 'universite', 'Abidjan', NULL, NULL, NULL, NULL, 'Université privée multidisciplinaire', NULL, 1, '2026-05-03 14:29:13'),
(14, 'HEC Abidjan', 'grande_ecole', 'Abidjan', NULL, NULL, NULL, NULL, 'École de management et de commerce', NULL, 1, '2026-05-03 14:29:13'),
(15, 'ESATIC', 'grande_ecole', 'Abidjan', NULL, NULL, NULL, NULL, 'École Supérieure Africaine des Technologies de l\'Information et de la Communication', NULL, 1, '2026-05-03 14:29:13'),
(16, 'Sup\'Management', 'grande_ecole', 'Abidjan', NULL, NULL, NULL, NULL, 'École supérieure de management et marketing', NULL, 1, '2026-05-03 14:29:13'),
(17, 'ENS Abidjan', 'grande_ecole', 'Abidjan', NULL, NULL, NULL, NULL, 'École Normale Supérieure — formation des enseignants', NULL, 1, '2026-05-03 14:29:13');

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE `filiere` (
  `id_filiere` int(11) NOT NULL,
  `nom_filiere` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `matieres_principales` text DEFAULT NULL,
  `icone` varchar(50) DEFAULT NULL,
  `duree_annees` int(11) NOT NULL DEFAULT 3,
  `cout_moyen` decimal(10,2) DEFAULT 0.00,
  `debouches` text DEFAULT NULL,
  `conditions_admission` text DEFAULT NULL,
  `actif` tinyint(1) DEFAULT 1,
  `date_creation` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `filiere`
--

INSERT INTO `filiere` (`id_filiere`, `nom_filiere`, `description`, `matieres_principales`, `icone`, `duree_annees`, `cout_moyen`, `debouches`, `conditions_admission`, `actif`, `date_creation`) VALUES
(1, 'Informatique', 'Formation complète en développement logiciel, réseaux et systèmes d\'information', NULL, 'bi-laptop', 3, 800000.00, 'Développeur, Ingénieur logiciel, Data Scientist, Administrateur réseau', NULL, 1, '2026-04-17 01:19:00'),
(2, 'Médecine', 'Formation médicale pour devenir médecin généraliste ou spécialiste', 'Anatomie | Étude approfondie du corps humain et de ses systèmes;Physiologie | Fonctionnement des organes et mécanismes biologiques;Pathologie | Diagnostic et traitement des maladies;Pharmacologie | Étude des médicaments et de leurs effets', 'bi-heart-pulse', 7, 2500000.00, 'Médecin généraliste, Chirurgien, Pédiatre, Cardiologue', NULL, 1, '2026-04-17 01:19:00'),
(3, 'Droit', 'Étude du droit civil, pénal, commercial et international', 'Droit civil | Règles régissant les relations entre personnes;Droit pénal | Infractions et sanctions pénales;Droit constitutionnel | Organisation de l\'État et institutions;Procédure | Règles de fonctionnement de la justice', 'bi-balance-scale', 3, 600000.00, 'Avocat, Magistrat, Juriste d\'entreprise, Notaire', NULL, 1, '2026-04-17 01:19:00'),
(4, 'Gestion', 'Management, comptabilité et gestion d\'entreprise', NULL, 'bi-graph-up', 3, 700000.00, 'Manager, Comptable, Consultant, Chef de projet', NULL, 1, '2026-04-17 01:19:00'),
(5, 'Génie Civil', 'Conception et construction de bâtiments et infrastructures', 'Résistance des matériaux | Calcul des structures et contraintes;Topographie | Mesures et relevés de terrain;Béton armé | Conception et dimensionnement;Routes et ouvrages | Infrastructure et grands travaux', 'bi-buildings', 5, 1200000.00, 'Ingénieur civil, Architecte, Chef de chantier', NULL, 1, '2026-04-17 01:19:00'),
(6, 'Communication', 'Médias, journalisme et communication d\'entreprise', 'Stratégie de communication | Planification et campagnes;Rédaction professionnelle | Écriture journalistique et corporate;Marketing digital | Réseaux sociaux et content management;Relations publiques | Gestion d\'image et événementiel', 'bi-megaphone', 3, 650000.00, 'Journaliste, Chargé de communication, Community manager', NULL, 1, '2026-04-17 01:19:00'),
(7, 'Pharmacie', 'Sciences pharmaceutiques et pharmacologie', NULL, 'bi-capsule', 6, 1800000.00, 'Pharmacien, Biologiste, Chercheur', NULL, 1, '2026-04-17 01:19:00'),
(8, 'Marketing', 'Stratégies marketing et publicité', NULL, 'bi-bar-chart', 3, 750000.00, 'Chef de produit, Responsable marketing, Consultant', NULL, 1, '2026-04-17 01:19:00'),
(9, 'Psychologie', 'Étude du comportement humain et thérapies', 'Psychologie clinique | Évaluation et thérapies;Psychologie sociale | Comportements en groupe;Neuropsychologie | Fonctionnement du cerveau;Méthodes de recherche | Études expérimentales', 'bi-brain', 3, 600000.00, 'Psychologue clinicien, Conseiller d\'orientation, RH', NULL, 1, '2026-04-17 01:19:00'),
(10, 'Agronomie', 'Agriculture, élevage et développement rural', NULL, 'bi-tree', 3, 700000.00, 'Ingénieur agronome, Consultant agricole', NULL, 1, '2026-04-17 01:19:00'),
(11, 'Finance', 'Marchés financiers, banque et assurance', NULL, 'bi-currency-dollar', 3, 900000.00, 'Analyste financier, Trader, Contrôleur de gestion', NULL, 1, '2026-04-17 01:19:00'),
(12, 'Architecture', 'Conception et design de bâtiments', 'Dessin technique | Plans et maquettes architecturales;Histoire de l\'art | Évolution des styles et mouvements;Structure | Calculs de résistance et matériaux;Urbanisme | Aménagement du territoire et ville durable', 'bi-building', 5, 1500000.00, 'Architecte, Urbaniste, Designer', NULL, 1, '2026-04-17 01:19:00'),
(13, 'Biologie', 'Sciences de la vie et biotechnologies', NULL, 'bi-diagram-3', 3, 650000.00, 'Biologiste, Chercheur, Technicien de laboratoire', NULL, 1, '2026-04-17 01:19:00'),
(14, 'Lettres Modernes', 'Littérature française et comparée', 'Littérature française | Analyse des œuvres classiques et contemporaines;Linguistique | Structure et évolution de la langue;Civilisation | Contextes historiques et culturels;Expression écrite | Techniques de rédaction et argumentation', 'bi-book', 3, 500000.00, 'Enseignant, Écrivain, Éditeur', NULL, 1, '2026-04-17 01:19:00'),
(15, 'Génie Électrique', 'Électronique, automatique et électrotechnique', NULL, 'bi-lightning', 5, 1100000.00, 'Ingénieur électricien, Automaticien', NULL, 1, '2026-04-17 01:19:00'),
(16, 'Comptabilité', 'Comptabilité générale et finance', NULL, 'bi-calculator', 3, 700000.00, 'Expert-comptable, Auditeur, Contrôleur financier', NULL, 1, '2026-04-17 01:19:00'),
(17, 'Ressources Humaines', 'Gestion du personnel et des compétences', NULL, 'bi-people', 3, 650000.00, 'DRH, Chargé de recrutement, Formateur', NULL, 1, '2026-04-17 01:19:00'),
(18, 'Journalisme', 'Médias et information', NULL, 'bi-newspaper', 3, 600000.00, 'Journaliste, Reporter, Rédacteur', NULL, 1, '2026-04-17 01:19:00'),
(19, 'Sciences de l\'Éducation', 'Pédagogie et enseignement', NULL, 'bi-mortarboard', 3, 550000.00, 'Enseignant, Formateur, Conseiller pédagogique', NULL, 1, '2026-04-17 01:19:00'),
(20, 'Télécommunications', 'Réseaux et systèmes de communication', NULL, 'bi-broadcast', 5, 1000000.00, 'Ingénieur télécoms, Administrateur réseau', NULL, 1, '2026-04-17 01:19:00'),
(21, 'Génie Logiciel', 'Développement de logiciels et applications', NULL, 'bi-code-slash', 3, 850000.00, 'Développeur full-stack, Architecte logiciel', NULL, 1, '2026-04-17 01:19:00'),
(22, 'Sciences Politiques', 'Étude des systèmes politiques et relations internationales', NULL, 'bi-globe', 3, 600000.00, 'Diplomate, Analyste politique, Consultant', NULL, 1, '2026-04-17 01:19:00'),
(23, 'Philosophie', 'Réflexion philosophique et histoire de la pensée', NULL, 'bi-lightbulb', 3, 500000.00, 'Enseignant, Chercheur, Conseiller éthique', NULL, 1, '2026-04-17 01:19:00'),
(24, 'Sociologie', 'Étude des phénomènes sociaux', NULL, 'bi-person-hearts', 3, 550000.00, 'Sociologue, Chargé d\'études, Consultant RH', NULL, 1, '2026-04-17 01:19:00'),
(25, 'Biotechnologie', 'Applications technologiques de la biologie', NULL, 'bi-droplet', 3, 900000.00, 'Ingénieur biotech, Chercheur, Technicien', NULL, 1, '2026-04-17 01:19:00'),
(26, 'Odontologie', 'Médecine dentaire', NULL, 'bi-teeth', 6, 2200000.00, 'Dentiste, Orthodontiste, Chirurgien maxillo-facial', NULL, 1, '2026-04-17 01:19:00'),
(27, 'Génie Mécanique', 'Conception et fabrication de systèmes mécaniques', NULL, 'bi-gear', 5, 1150000.00, 'Ingénieur mécanique, Concepteur automobile', NULL, 1, '2026-04-17 01:19:00'),
(28, 'Mathématiques', 'Mathématiques appliquées et théoriques', NULL, 'bi-calculator', 3, 600000.00, 'Mathématicien, Data analyst, Actuaire', NULL, 1, '2026-04-17 01:19:00'),
(29, 'Physique', 'Étude des lois de la nature', NULL, 'bi-atom', 3, 650000.00, 'Physicien, Chercheur, Enseignant', NULL, 1, '2026-04-17 01:19:00'),
(30, 'Statistiques', 'Analyse de données et probabilités', NULL, 'bi-bar-chart-line', 3, 700000.00, 'Statisticien, Data scientist, Analyste', NULL, 1, '2026-04-17 01:19:00'),
(31, 'Biochimie', 'Chimie du vivant', NULL, 'bi-flask', 3, 750000.00, 'Biochimiste, Chercheur, Analyste médical', NULL, 1, '2026-04-17 01:19:00'),
(32, 'Écologie', 'Sciences de l\'environnement', NULL, 'bi-globe-americas', 3, 650000.00, 'Écologue, Consultant environnemental', NULL, 1, '2026-04-17 01:19:00'),
(33, 'Sciences de l\'Environnement', 'Protection et gestion de l\'environnement', NULL, 'bi-recycle', 3, 680000.00, 'Expert environnemental, Consultant', NULL, 1, '2026-04-17 01:19:00'),
(34, 'Commerce International', 'Commerce et échanges internationaux', NULL, 'bi-globe2', 3, 800000.00, 'Commercial international, Import-export', NULL, 1, '2026-04-17 01:19:00'),
(35, 'Management', 'Direction et gestion d\'équipes', NULL, 'bi-briefcase', 3, 750000.00, 'Manager, Directeur, Consultant', NULL, 1, '2026-04-17 01:19:00'),
(36, 'Gestion de Projet', 'Pilotage de projets complexes', NULL, 'bi-kanban', 3, 720000.00, 'Chef de projet, Product owner, Scrum master', NULL, 1, '2026-04-17 01:19:00'),
(37, 'Audit', 'Audit financier et contrôle de gestion', NULL, 'bi-search', 3, 900000.00, 'Auditeur, Contrôleur de gestion, Expert-comptable', NULL, 1, '2026-04-17 01:19:00'),
(38, 'Administration des Affaires', 'Formation en administration, gestion juridique et management des organisations', NULL, 'bi-briefcase-fill', 3, 750000.00, 'Administrateur d\'entreprise, Gestionnaire, Directeur administratif, Consultant en organisation', NULL, 1, '2026-05-03 14:55:16');

-- --------------------------------------------------------

--
-- Structure de la table `filiere_etablissement`
--

CREATE TABLE `filiere_etablissement` (
  `id` int(11) NOT NULL,
  `id_filiere` int(11) NOT NULL,
  `id_etablissement` int(11) NOT NULL,
  `date_association` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `filiere_etablissement`
--

INSERT INTO `filiere_etablissement` (`id`, `id_filiere`, `id_etablissement`, `date_association`) VALUES
(85, 10, 2, '2026-05-03 14:29:40'),
(86, 10, 7, '2026-05-03 14:29:40'),
(87, 12, 2, '2026-05-03 14:29:40'),
(88, 37, 3, '2026-05-03 14:29:40'),
(89, 37, 11, '2026-05-03 14:29:40'),
(90, 31, 1, '2026-05-03 14:29:40'),
(91, 31, 7, '2026-05-03 14:29:40'),
(92, 13, 1, '2026-05-03 14:29:40'),
(93, 25, 7, '2026-05-03 14:29:40'),
(94, 34, 11, '2026-05-03 14:29:40'),
(95, 34, 3, '2026-05-03 14:29:40'),
(96, 6, 12, '2026-05-03 14:29:40'),
(97, 6, 13, '2026-05-03 14:29:40'),
(98, 16, 11, '2026-05-03 14:29:40'),
(99, 16, 3, '2026-05-03 14:29:40'),
(100, 3, 1, '2026-05-03 14:29:40'),
(101, 3, 4, '2026-05-03 14:29:40'),
(102, 32, 7, '2026-05-03 14:29:40'),
(103, 11, 3, '2026-05-03 14:29:40'),
(104, 11, 14, '2026-05-03 14:29:40'),
(105, 5, 2, '2026-05-03 14:29:40'),
(106, 15, 2, '2026-05-03 14:29:40'),
(107, 21, 6, '2026-05-03 14:29:40'),
(108, 21, 15, '2026-05-03 14:29:40'),
(109, 21, 13, '2026-05-03 14:29:40'),
(110, 27, 2, '2026-05-03 14:29:40'),
(111, 4, 11, '2026-05-03 14:29:40'),
(112, 4, 13, '2026-05-03 14:29:40'),
(113, 36, 13, '2026-05-03 14:29:40'),
(114, 36, 14, '2026-05-03 14:29:40'),
(115, 1, 6, '2026-05-03 14:29:40'),
(116, 1, 15, '2026-05-03 14:29:40'),
(117, 1, 13, '2026-05-03 14:29:40'),
(118, 18, 12, '2026-05-03 14:29:40'),
(119, 14, 1, '2026-05-03 14:29:40'),
(120, 35, 14, '2026-05-03 14:29:40'),
(121, 35, 16, '2026-05-03 14:29:40'),
(122, 8, 11, '2026-05-03 14:29:40'),
(123, 8, 16, '2026-05-03 14:29:40'),
(124, 28, 1, '2026-05-03 14:29:40'),
(125, 2, 1, '2026-05-03 14:29:40'),
(126, 26, 1, '2026-05-03 14:29:40'),
(127, 7, 1, '2026-05-03 14:29:40'),
(128, 23, 1, '2026-05-03 14:29:40'),
(129, 29, 1, '2026-05-03 14:29:40'),
(130, 9, 1, '2026-05-03 14:29:40'),
(131, 17, 11, '2026-05-03 14:29:40'),
(132, 17, 16, '2026-05-03 14:29:40'),
(133, 19, 17, '2026-05-03 14:29:40'),
(134, 33, 7, '2026-05-03 14:29:40'),
(135, 22, 4, '2026-05-03 14:29:40'),
(136, 24, 1, '2026-05-03 14:29:40'),
(137, 30, 5, '2026-05-03 14:29:40'),
(138, 20, 15, '2026-05-03 14:29:40'),
(139, 20, 6, '2026-05-03 14:29:40'),
(140, 3, 13, '2026-05-03 14:55:16'),
(141, 38, 13, '2026-05-03 14:55:16');

-- --------------------------------------------------------

--
-- Structure de la table `formation_sauvegardee`
--

CREATE TABLE `formation_sauvegardee` (
  `id` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_filiere` int(11) NOT NULL,
  `date_sauvegarde` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `offre_formation`
--

CREATE TABLE `offre_formation` (
  `id_offre` int(11) NOT NULL,
  `id_etablissement` int(11) NOT NULL,
  `id_filiere` int(11) NOT NULL,
  `titre_offre` varchar(200) NOT NULL,
  `type_formation` enum('licence','master','doctorat','bts','diplome_ingenieur','autre') NOT NULL,
  `duree` varchar(50) NOT NULL,
  `cout` decimal(10,2) NOT NULL DEFAULT 0.00,
  `places_disponibles` int(11) DEFAULT 0,
  `date_debut` date DEFAULT NULL,
  `date_limite_inscription` date DEFAULT NULL,
  `actif` tinyint(1) DEFAULT 1,
  `date_creation` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `offre_formation`
--

INSERT INTO `offre_formation` (`id_offre`, `id_etablissement`, `id_filiere`, `titre_offre`, `type_formation`, `duree`, `cout`, `places_disponibles`, `date_debut`, `date_limite_inscription`, `actif`, `date_creation`) VALUES
(1, 6, 1, 'Licence en Informatique', 'licence', '3 ans', 800000.00, 50, NULL, NULL, 1, '2026-04-17 01:19:00'),
(2, 6, 1, 'Diplôme d\'Ingénieur Informatique', 'diplome_ingenieur', '5 ans', 1200000.00, 30, NULL, NULL, 1, '2026-04-17 01:19:00'),
(3, 1, 2, 'Doctorat en Médecine', 'doctorat', '7 ans', 2500000.00, 100, NULL, NULL, 1, '2026-04-17 01:19:00'),
(4, 1, 3, 'Master en Droit des Affaires', 'master', '2 ans', 900000.00, 40, NULL, NULL, 1, '2026-04-17 01:19:00'),
(5, 13, 4, 'MBA en Gestion', 'master', '2 ans', 2000000.00, 35, NULL, NULL, 1, '2026-04-17 01:19:00'),
(6, 2, 5, 'Diplôme d\'Ingénieur Génie Civil', 'diplome_ingenieur', '5 ans', 1500000.00, 45, NULL, NULL, 1, '2026-04-17 01:19:00'),
(7, 12, 6, 'Licence en Communication', 'licence', '3 ans', 700000.00, 60, NULL, NULL, 1, '2026-04-17 01:19:00'),
(8, 1, 7, 'Doctorat en Pharmacie', 'doctorat', '6 ans', 2000000.00, 80, NULL, NULL, 1, '2026-04-17 01:19:00'),
(9, 11, 8, 'Master en Marketing Digital', 'master', '2 ans', 1100000.00, 30, NULL, NULL, 1, '2026-04-17 01:19:00'),
(10, 1, 9, 'Licence en Psychologie', 'licence', '3 ans', 600000.00, 50, NULL, NULL, 1, '2026-04-17 01:19:00'),
(11, 3, 11, 'Master en Finance de Marché', 'master', '2 ans', 1500000.00, 25, NULL, NULL, 1, '2026-04-17 01:19:00'),
(12, 1, 13, 'Licence en Biologie', 'licence', '3 ans', 650000.00, 55, NULL, NULL, 1, '2026-04-17 01:19:00'),
(13, 2, 15, 'Diplôme d\'Ingénieur Électrique', 'diplome_ingenieur', '5 ans', 1400000.00, 35, NULL, NULL, 1, '2026-04-17 01:19:00'),
(14, 3, 16, 'Master en Expertise Comptable', 'master', '2 ans', 1200000.00, 30, NULL, NULL, 1, '2026-04-17 01:19:00'),
(15, 11, 17, 'Licence en Ressources Humaines', 'licence', '3 ans', 650000.00, 45, NULL, NULL, 1, '2026-04-17 01:19:00'),
(16, 13, 38, 'Licence en Administration des Affaires', 'licence', '3 ans', 750000.00, 0, NULL, NULL, 1, '2026-05-03 15:36:00'),
(17, 2, 10, 'Licence en Agronomie', 'licence', '3 ans', 700000.00, 0, NULL, NULL, 1, '2026-05-03 15:36:00'),
(18, 2, 12, 'Diplôme en Architecture', 'diplome_ingenieur', '5 ans', 1500000.00, 0, NULL, NULL, 1, '2026-05-03 15:36:00'),
(19, 3, 37, 'Licence en Audit et Contrôle de Gestion', 'licence', '3 ans', 900000.00, 0, NULL, NULL, 1, '2026-05-03 15:36:00'),
(20, 1, 31, 'Licence en Biochimie', 'licence', '3 ans', 750000.00, 0, NULL, NULL, 1, '2026-05-03 15:36:00'),
(21, 7, 25, 'Licence en Biotechnologie', 'licence', '3 ans', 900000.00, 0, NULL, NULL, 1, '2026-05-03 15:36:00'),
(22, 3, 34, 'Licence en Commerce International', 'licence', '3 ans', 800000.00, 0, NULL, NULL, 1, '2026-05-03 15:36:00'),
(23, 7, 32, 'Licence en Écologie', 'licence', '3 ans', 650000.00, 0, NULL, NULL, 1, '2026-05-03 15:36:00'),
(24, 6, 21, 'Licence en Génie Logiciel', 'licence', '3 ans', 850000.00, 0, NULL, NULL, 1, '2026-05-03 15:36:00'),
(25, 2, 27, 'Diplôme Ingénieur Génie Mécanique', 'diplome_ingenieur', '5 ans', 1150000.00, 0, NULL, NULL, 1, '2026-05-03 15:36:00'),
(26, 13, 36, 'Licence en Gestion de Projet', 'licence', '3 ans', 720000.00, 0, NULL, NULL, 1, '2026-05-03 15:36:00'),
(27, 12, 18, 'Licence en Journalisme', 'licence', '3 ans', 600000.00, 0, NULL, NULL, 1, '2026-05-03 15:36:00'),
(28, 1, 14, 'Licence en Lettres Modernes', 'licence', '3 ans', 500000.00, 0, NULL, NULL, 1, '2026-05-03 15:36:00'),
(29, 14, 35, 'Master en Management', 'master', '2 ans', 750000.00, 0, NULL, NULL, 1, '2026-05-03 15:36:00'),
(30, 1, 28, 'Licence en Mathématiques', 'licence', '3 ans', 600000.00, 0, NULL, NULL, 1, '2026-05-03 15:36:00'),
(31, 1, 26, 'Diplôme en Odontologie', 'doctorat', '6 ans', 2200000.00, 0, NULL, NULL, 1, '2026-05-03 15:36:00'),
(32, 1, 23, 'Licence en Philosophie', 'licence', '3 ans', 500000.00, 0, NULL, NULL, 1, '2026-05-03 15:36:00'),
(33, 1, 29, 'Licence en Physique', 'licence', '3 ans', 650000.00, 0, NULL, NULL, 1, '2026-05-03 15:36:00'),
(34, 17, 19, 'Licence en Sciences de l\'Éducation', 'licence', '3 ans', 550000.00, 0, NULL, NULL, 1, '2026-05-03 15:36:00'),
(35, 7, 33, 'Licence en Sciences de l\'Environnement', 'licence', '3 ans', 680000.00, 0, NULL, NULL, 1, '2026-05-03 15:36:00'),
(36, 4, 22, 'Licence en Sciences Politiques', 'licence', '3 ans', 600000.00, 0, NULL, NULL, 1, '2026-05-03 15:36:00'),
(37, 1, 24, 'Licence en Sociologie', 'licence', '3 ans', 550000.00, 0, NULL, NULL, 1, '2026-05-03 15:36:00'),
(38, 5, 30, 'Licence en Statistiques', 'licence', '3 ans', 700000.00, 0, NULL, NULL, 1, '2026-05-03 15:36:00'),
(39, 6, 20, 'Diplôme Ingénieur Télécommunications', 'diplome_ingenieur', '5 ans', 1000000.00, 0, NULL, NULL, 1, '2026-05-03 15:36:00');

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `id_question` int(11) NOT NULL,
  `id_test` int(11) NOT NULL,
  `numero_question` int(11) NOT NULL,
  `texte_question` text NOT NULL,
  `reponse_donnee` varchar(100) DEFAULT NULL,
  `points` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `recommandation`
--

CREATE TABLE `recommandation` (
  `id_recommandation` int(11) NOT NULL,
  `id_resultat` int(11) NOT NULL,
  `id_filiere` int(11) NOT NULL,
  `pourcentage_match` int(11) NOT NULL DEFAULT 0,
  `rang` int(11) NOT NULL DEFAULT 1,
  `date_recommandation` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recommandation`
--

INSERT INTO `recommandation` (`id_recommandation`, `id_resultat`, `id_filiere`, `pourcentage_match`, `rang`, `date_recommandation`) VALUES
(119, 36, 1, 92, 1, '2026-04-30 10:55:22'),
(120, 36, 5, 87, 2, '2026-04-30 10:55:22'),
(121, 36, 15, 82, 3, '2026-04-30 10:55:22'),
(122, 37, 1, 92, 1, '2026-04-30 11:12:28'),
(123, 37, 5, 87, 2, '2026-04-30 11:12:28'),
(124, 37, 15, 82, 3, '2026-04-30 11:12:28'),
(125, 38, 1, 92, 1, '2026-04-30 11:56:10'),
(126, 38, 5, 87, 2, '2026-04-30 11:56:10'),
(127, 38, 15, 82, 3, '2026-04-30 11:56:10'),
(128, 39, 3, 92, 1, '2026-05-01 01:12:29'),
(129, 39, 6, 87, 2, '2026-05-01 01:12:29'),
(130, 39, 9, 82, 3, '2026-05-01 01:12:29'),
(131, 40, 1, 92, 1, '2026-05-01 01:20:55'),
(132, 40, 5, 87, 2, '2026-05-01 01:20:55'),
(133, 40, 15, 82, 3, '2026-05-01 01:20:55'),
(134, 41, 1, 92, 1, '2026-05-01 01:21:39'),
(135, 41, 5, 87, 2, '2026-05-01 01:21:39'),
(136, 41, 15, 82, 3, '2026-05-01 01:21:39'),
(137, 42, 1, 92, 1, '2026-05-01 01:25:20'),
(138, 42, 5, 87, 2, '2026-05-01 01:25:20'),
(139, 42, 15, 82, 3, '2026-05-01 01:25:20'),
(140, 43, 1, 92, 1, '2026-05-01 01:26:57'),
(141, 43, 5, 87, 2, '2026-05-01 01:26:57'),
(142, 43, 15, 82, 3, '2026-05-01 01:26:57'),
(143, 44, 1, 92, 1, '2026-05-01 01:38:19'),
(144, 44, 5, 87, 2, '2026-05-01 01:38:19'),
(145, 44, 15, 82, 3, '2026-05-01 01:38:19'),
(146, 45, 1, 92, 1, '2026-05-01 01:40:35'),
(147, 45, 5, 87, 2, '2026-05-01 01:40:35'),
(148, 45, 15, 82, 3, '2026-05-01 01:40:35'),
(149, 46, 2, 92, 1, '2026-05-01 01:49:33'),
(150, 46, 7, 87, 2, '2026-05-01 01:49:33'),
(151, 46, 10, 82, 3, '2026-05-01 01:49:33'),
(152, 47, 2, 92, 1, '2026-05-01 01:52:09'),
(153, 47, 7, 87, 2, '2026-05-01 01:52:09'),
(154, 47, 10, 82, 3, '2026-05-01 01:52:09'),
(155, 48, 1, 92, 1, '2026-05-02 13:56:05'),
(156, 48, 5, 87, 2, '2026-05-02 13:56:05'),
(157, 48, 15, 82, 3, '2026-05-02 13:56:05'),
(158, 49, 1, 92, 1, '2026-05-02 14:12:33'),
(159, 49, 5, 87, 2, '2026-05-02 14:12:33'),
(160, 49, 15, 82, 3, '2026-05-02 14:12:33'),
(161, 50, 1, 92, 1, '2026-05-02 14:13:48'),
(162, 50, 5, 87, 2, '2026-05-02 14:13:48'),
(163, 50, 15, 82, 3, '2026-05-02 14:13:48'),
(164, 51, 4, 33, 1, '2026-05-02 15:03:37'),
(165, 51, 11, 33, 2, '2026-05-02 15:03:37'),
(166, 51, 16, 33, 3, '2026-05-02 15:03:37'),
(167, 52, 4, 34, 1, '2026-05-02 15:06:21'),
(168, 52, 11, 34, 2, '2026-05-02 15:06:21'),
(169, 52, 16, 34, 3, '2026-05-02 15:06:21'),
(170, 53, 2, 38, 1, '2026-05-02 15:08:45'),
(171, 53, 3, 38, 2, '2026-05-02 15:08:45'),
(172, 53, 4, 38, 3, '2026-05-02 15:08:45'),
(173, 54, 17, 35, 1, '2026-05-03 13:39:14'),
(174, 54, 6, 34, 2, '2026-05-03 13:39:14'),
(175, 54, 4, 33, 3, '2026-05-03 13:39:14'),
(176, 55, 17, 29, 1, '2026-05-03 13:41:50'),
(177, 55, 2, 28, 2, '2026-05-03 13:41:50'),
(178, 55, 3, 28, 3, '2026-05-03 13:41:50'),
(179, 56, 17, 36, 1, '2026-05-03 13:57:26'),
(180, 56, 4, 35, 2, '2026-05-03 13:57:26'),
(181, 56, 34, 35, 3, '2026-05-03 13:57:26'),
(182, 57, 17, 38, 1, '2026-05-03 14:37:59'),
(183, 57, 4, 36, 2, '2026-05-03 14:37:59'),
(184, 57, 2, 35, 3, '2026-05-03 14:37:59'),
(185, 58, 16, 27, 1, '2026-05-03 15:09:20'),
(186, 58, 2, 26, 2, '2026-05-03 15:09:20'),
(187, 58, 7, 26, 3, '2026-05-03 15:09:20'),
(188, 59, 6, 29, 1, '2026-05-03 15:15:53'),
(189, 59, 17, 29, 2, '2026-05-03 15:15:53'),
(190, 59, 3, 27, 3, '2026-05-03 15:15:53'),
(191, 60, 6, 29, 1, '2026-05-03 15:16:14'),
(192, 60, 17, 29, 2, '2026-05-03 15:16:14'),
(193, 60, 3, 27, 3, '2026-05-03 15:16:14'),
(194, 61, 2, 29, 1, '2026-05-03 15:42:04'),
(195, 61, 7, 29, 2, '2026-05-03 15:42:04'),
(196, 61, 11, 29, 3, '2026-05-03 15:42:04'),
(197, 62, 4, 34, 1, '2026-05-03 23:24:47'),
(198, 62, 17, 34, 2, '2026-05-03 23:24:47'),
(199, 62, 38, 34, 3, '2026-05-03 23:24:47'),
(200, 63, 14, 34, 1, '2026-05-04 12:18:56'),
(201, 63, 17, 34, 2, '2026-05-04 12:18:56'),
(202, 63, 24, 34, 3, '2026-05-04 12:18:56'),
(203, 64, 4, 28, 1, '2026-05-04 12:21:16'),
(204, 64, 17, 28, 2, '2026-05-04 12:21:16'),
(205, 64, 34, 28, 3, '2026-05-04 12:21:16'),
(206, 65, 17, 32, 1, '2026-05-05 13:40:38'),
(207, 65, 4, 31, 2, '2026-05-05 13:40:38'),
(208, 65, 6, 31, 3, '2026-05-05 13:40:38');

-- --------------------------------------------------------

--
-- Structure de la table `resultat_test`
--

CREATE TABLE `resultat_test` (
  `id_resultat` int(11) NOT NULL,
  `id_test` int(11) NOT NULL,
  `score_global` decimal(5,2) NOT NULL DEFAULT 0.00,
  `score_logique` int(11) NOT NULL DEFAULT 0,
  `score_creativite` int(11) NOT NULL DEFAULT 0,
  `score_communication` int(11) NOT NULL DEFAULT 0,
  `score_analyse` int(11) NOT NULL DEFAULT 0,
  `score_leadership` int(11) NOT NULL DEFAULT 0,
  `date_resultat` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `resultat_test`
--

INSERT INTO `resultat_test` (`id_resultat`, `id_test`, `score_global`, `score_logique`, `score_creativite`, `score_communication`, `score_analyse`, `score_leadership`, `date_resultat`) VALUES
(36, 36, 33.80, 30, 18, 40, 25, 56, '2026-04-30 10:55:22'),
(37, 37, 33.80, 27, 20, 49, 24, 49, '2026-04-30 11:12:28'),
(38, 38, 28.40, 46, 3, 33, 28, 32, '2026-04-30 11:56:10'),
(39, 41, 27.80, 17, 27, 45, 18, 32, '2026-05-01 01:12:29'),
(40, 42, 28.80, 28, 17, 39, 44, 16, '2026-05-01 01:20:55'),
(41, 43, 28.80, 28, 17, 39, 44, 16, '2026-05-01 01:21:39'),
(42, 44, 28.80, 28, 17, 39, 44, 16, '2026-05-01 01:25:20'),
(43, 45, 28.40, 32, 14, 45, 34, 17, '2026-05-01 01:26:57'),
(44, 46, 28.40, 32, 14, 45, 34, 17, '2026-05-01 01:38:19'),
(45, 47, 28.40, 32, 14, 45, 34, 17, '2026-05-01 01:40:35'),
(46, 48, 33.20, 18, 14, 53, 26, 55, '2026-05-01 01:49:33'),
(47, 49, 33.20, 18, 14, 53, 26, 55, '2026-05-01 01:52:09'),
(48, 50, 30.80, 34, 8, 34, 38, 40, '2026-05-02 13:56:05'),
(49, 51, 28.60, 39, 27, 47, 16, 14, '2026-05-02 14:12:33'),
(50, 52, 30.00, 31, 17, 24, 32, 46, '2026-05-02 14:13:48'),
(51, 53, 30.00, 31, 17, 24, 32, 46, '2026-05-02 15:03:37'),
(52, 54, 30.80, 32, 19, 27, 36, 40, '2026-05-02 15:06:21'),
(53, 55, 34.00, 24, 21, 45, 42, 38, '2026-05-02 15:08:45'),
(54, 56, 27.60, 10, 12, 62, 11, 43, '2026-05-03 13:39:14'),
(55, 57, 24.60, 25, 0, 42, 23, 33, '2026-05-03 13:41:50'),
(56, 58, 30.60, 25, 10, 52, 23, 43, '2026-05-03 13:57:26'),
(57, 59, 30.60, 25, 0, 57, 23, 48, '2026-05-03 14:37:59'),
(58, 60, 22.40, 27, 0, 24, 31, 30, '2026-05-03 15:09:20'),
(59, 61, 22.80, 5, 18, 51, 10, 30, '2026-05-03 15:15:53'),
(60, 62, 22.80, 5, 18, 51, 10, 30, '2026-05-03 15:16:14'),
(61, 63, 26.20, 34, 13, 32, 26, 26, '2026-05-03 15:42:04'),
(62, 64, 30.60, 31, 19, 43, 23, 37, '2026-05-03 23:24:47'),
(63, 65, 28.60, 14, 12, 53, 39, 25, '2026-05-04 12:18:56'),
(64, 66, 24.80, 23, 10, 33, 21, 37, '2026-05-04 12:21:16'),
(65, 67, 24.60, 6, 12, 47, 0, 58, '2026-05-05 13:40:38');

--
-- Déclencheurs `resultat_test`
--
DELIMITER $$
CREATE TRIGGER `trg_sync_score_global` AFTER INSERT ON `resultat_test` FOR EACH ROW BEGIN
    UPDATE test_orientation SET score_global = NEW.score_global WHERE id_test = NEW.id_test;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `test_orientation`
--

CREATE TABLE `test_orientation` (
  `id_test` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `titre` varchar(200) DEFAULT 'Test d''Orientation',
  `description` text DEFAULT NULL,
  `niveau` varchar(50) DEFAULT NULL COMMENT 'Niveau d''études de l''utilisateur au moment du test',
  `serie` varchar(100) DEFAULT NULL,
  `statut` enum('en_cours','termine','abandonne') DEFAULT 'en_cours',
  `score_global` decimal(5,2) DEFAULT 0.00,
  `date_test` datetime NOT NULL DEFAULT current_timestamp(),
  `date_fin` datetime DEFAULT NULL,
  `domaine` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `test_orientation`
--

INSERT INTO `test_orientation` (`id_test`, `id_utilisateur`, `titre`, `description`, `niveau`, `serie`, `statut`, `score_global`, `date_test`, `date_fin`, `domaine`) VALUES
(36, 13, 'Test d\'Orientation', NULL, 'L3', '', 'termine', 33.80, '2026-04-30 10:55:22', '2026-04-30 10:55:22', 'Sciences'),
(37, 13, 'Test d\'Orientation', NULL, 'L3', '', 'termine', 33.80, '2026-04-30 11:12:28', '2026-04-30 11:12:28', 'Sciences'),
(38, 14, 'Test d\'Orientation', NULL, 'Terminale', 'C', 'termine', 28.40, '2026-04-30 11:56:10', '2026-04-30 11:56:10', ''),
(41, 14, 'Test d\'Orientation', NULL, 'Terminale', 'A', 'termine', 27.80, '2026-05-01 01:12:29', '2026-05-01 01:12:29', ''),
(42, 14, 'Test d\'Orientation', NULL, 'Terminale', 'C', 'termine', 28.80, '2026-05-01 01:20:55', '2026-05-01 01:20:55', ''),
(43, 14, 'Test d\'Orientation', NULL, 'Terminale', 'C', 'termine', 28.80, '2026-05-01 01:21:39', '2026-05-01 01:21:39', ''),
(44, 14, 'Test d\'Orientation', NULL, 'Terminale', 'C', 'termine', 28.80, '2026-05-01 01:25:20', '2026-05-01 01:25:20', ''),
(45, 14, 'Test d\'Orientation', NULL, 'Terminale', 'C', 'termine', 28.40, '2026-05-01 01:26:57', '2026-05-01 01:26:57', ''),
(46, 14, 'Test d\'Orientation', NULL, 'Terminale', 'C', 'termine', 28.40, '2026-05-01 01:38:19', '2026-05-01 01:38:19', ''),
(47, 14, 'Test d\'Orientation', NULL, 'Terminale', 'C', 'termine', 28.40, '2026-05-01 01:40:35', '2026-05-01 01:40:35', ''),
(48, 13, 'Test d\'Orientation', NULL, 'L3', '', 'termine', 33.20, '2026-05-01 01:49:33', '2026-05-01 01:49:33', 'Sante'),
(49, 13, 'Test d\'Orientation', NULL, 'L3', '', 'termine', 33.20, '2026-05-01 01:52:09', '2026-05-01 01:52:09', 'Sante'),
(50, 13, 'Test d\'Orientation', NULL, 'L3', '', 'termine', 30.80, '2026-05-02 13:56:05', '2026-05-02 13:56:05', 'Sciences'),
(51, 15, 'Test d\'Orientation', NULL, 'Terminale', 'C', 'termine', 28.60, '2026-05-02 14:12:33', '2026-05-02 14:12:33', ''),
(52, 13, 'Test d\'Orientation', NULL, 'L3', '', 'termine', 30.00, '2026-05-02 14:13:48', '2026-05-02 14:13:48', 'Sciences'),
(53, 13, 'Test d\'Orientation', NULL, 'L3', '', 'termine', 30.00, '2026-05-02 15:03:37', '2026-05-02 15:03:37', 'Sciences'),
(54, 13, 'Test d\'Orientation', NULL, 'Doctorat', '', 'termine', 30.80, '2026-05-02 15:06:21', '2026-05-02 15:06:21', 'Gestion'),
(55, 13, 'Test d\'Orientation', NULL, 'L3', '', 'termine', 34.00, '2026-05-02 15:08:45', '2026-05-02 15:08:45', 'Lettres'),
(56, 13, 'Test d\'Orientation', NULL, 'L3', '', 'termine', 27.60, '2026-05-03 13:39:14', '2026-05-03 13:39:14', 'Lettres'),
(57, 13, 'Test d\'Orientation', NULL, 'L3', '', 'termine', 24.60, '2026-05-03 13:41:50', '2026-05-03 13:41:50', 'Sciences'),
(58, 13, 'Test d\'Orientation', NULL, 'L3', '', 'termine', 30.60, '2026-05-03 13:57:26', '2026-05-03 13:57:26', 'Sciences'),
(59, 13, 'Test d\'Orientation', NULL, 'L3', '', 'termine', 30.60, '2026-05-03 14:37:59', '2026-05-03 14:37:59', 'Sciences'),
(60, 14, 'Test d\'Orientation', NULL, 'Terminale', 'D', 'termine', 22.40, '2026-05-03 15:09:20', '2026-05-03 15:09:20', ''),
(61, 14, 'Test d\'Orientation', NULL, 'Terminale', 'A', 'termine', 22.80, '2026-05-03 15:15:53', '2026-05-03 15:15:53', ''),
(62, 14, 'Test d\'Orientation', NULL, 'Terminale', 'A', 'termine', 22.80, '2026-05-03 15:16:14', '2026-05-03 15:16:14', ''),
(63, 14, 'Test d\'Orientation', NULL, 'Terminale', 'C', 'termine', 26.20, '2026-05-03 15:42:04', '2026-05-03 15:42:04', ''),
(64, 13, 'Test d\'Orientation', NULL, 'L3', '', 'termine', 30.60, '2026-05-03 23:24:47', '2026-05-03 23:24:47', 'Sciences'),
(65, 13, 'Test d\'Orientation', NULL, 'L3', '', 'termine', 28.60, '2026-05-04 12:18:56', '2026-05-04 12:18:56', 'Lettres'),
(66, 14, 'Test d\'Orientation', NULL, 'Terminale', 'C', 'termine', 24.80, '2026-05-04 12:21:16', '2026-05-04 12:21:16', ''),
(67, 13, 'Test d\'Orientation', NULL, 'Doctorat', '', 'termine', 24.60, '2026-05-05 13:40:38', '2026-05-05 13:40:38', 'Gestion');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `type_utilisateur` enum('eleve','etudiant','parent') NOT NULL DEFAULT 'eleve',
  `niveau` varchar(50) DEFAULT NULL COMMENT 'Niveau scolaire ou universitaire',
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `date_inscription` datetime NOT NULL DEFAULT current_timestamp(),
  `derniere_connexion` datetime DEFAULT NULL,
  `actif` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom`, `prenom`, `email`, `mot_de_passe`, `type_utilisateur`, `niveau`, `role`, `date_inscription`, `derniere_connexion`, `actif`) VALUES
(13, 'Bamba', 'Franck', 'bambafranck99@gmail.com', '$2y$10$1JVTxi5NHj9VdW05.moh2eH34Y/WxRf.T.Z2JFhqQ7i54NpXnu4zq', 'etudiant', NULL, 'user', '2026-04-30 10:48:10', '2026-05-09 14:32:47', 1),
(14, 'diomande', 'aziz', 'diomandeaziz@gmail.com', '$2y$10$FnHJmJHhrGgOOWWP9omhJepJod0kJH9l/SbXpEmqS9f.vf8UWqH7m', 'eleve', NULL, 'user', '2026-04-30 11:24:31', '2026-05-04 12:19:52', 1),
(15, 'diomande', 'karim', 'diomandekarim@gmail.com', '$2y$10$XoTRAaIBI2JCQGm6ZAf.cuqhZsR0eM77bSk/q6aJeFVTVitiSSQCy', 'eleve', NULL, 'user', '2026-05-02 13:57:49', '2026-05-02 13:58:20', 1);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_stats_dashboard`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_stats_dashboard` (
`total_utilisateurs` bigint(21)
,`tests_termines` bigint(21)
,`filieres_actives` bigint(21)
,`etablissements_actifs` bigint(21)
,`moyenne_scores` decimal(9,6)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_tests_recents`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_tests_recents` (
`id_test` int(11)
,`niveau` varchar(50)
,`serie` varchar(100)
,`statut` enum('en_cours','termine','abandonne')
,`score_global` decimal(5,2)
,`date_test` datetime
,`nom` varchar(100)
,`prenom` varchar(100)
,`email` varchar(150)
);

-- --------------------------------------------------------

--
-- Structure de la vue `v_stats_dashboard`
--
DROP TABLE IF EXISTS `v_stats_dashboard`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_stats_dashboard`  AS SELECT (select count(0) from `utilisateur` where `utilisateur`.`role` = 'user') AS `total_utilisateurs`, (select count(0) from `test_orientation` where `test_orientation`.`statut` = 'termine') AS `tests_termines`, (select count(0) from `filiere` where `filiere`.`actif` = 1) AS `filieres_actives`, (select count(0) from `etablissement` where `etablissement`.`actif` = 1) AS `etablissements_actifs`, (select avg(`test_orientation`.`score_global`) from `test_orientation` where `test_orientation`.`statut` = 'termine') AS `moyenne_scores` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_tests_recents`
--
DROP TABLE IF EXISTS `v_tests_recents`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tests_recents`  AS SELECT `t`.`id_test` AS `id_test`, `t`.`niveau` AS `niveau`, `t`.`serie` AS `serie`, `t`.`statut` AS `statut`, `t`.`score_global` AS `score_global`, `t`.`date_test` AS `date_test`, `u`.`nom` AS `nom`, `u`.`prenom` AS `prenom`, `u`.`email` AS `email` FROM (`test_orientation` `t` join `utilisateur` `u` on(`t`.`id_utilisateur` = `u`.`id_utilisateur`)) ORDER BY `t`.`date_test` DESC ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `idx_email_admin` (`email`);

--
-- Index pour la table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_lu` (`lu`),
  ADD KEY `idx_date` (`date_envoi`);

--
-- Index pour la table `etablissement`
--
ALTER TABLE `etablissement`
  ADD PRIMARY KEY (`id_etablissement`),
  ADD KEY `idx_ville` (`ville`),
  ADD KEY `idx_actif` (`actif`);

--
-- Index pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`id_filiere`),
  ADD KEY `idx_nom` (`nom_filiere`),
  ADD KEY `idx_actif` (`actif`);

--
-- Index pour la table `filiere_etablissement`
--
ALTER TABLE `filiere_etablissement`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_filiere_etablissement` (`id_filiere`,`id_etablissement`),
  ADD KEY `id_etablissement` (`id_etablissement`);

--
-- Index pour la table `formation_sauvegardee`
--
ALTER TABLE `formation_sauvegardee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_filiere` (`id_utilisateur`,`id_filiere`),
  ADD KEY `id_filiere` (`id_filiere`);

--
-- Index pour la table `offre_formation`
--
ALTER TABLE `offre_formation`
  ADD PRIMARY KEY (`id_offre`),
  ADD KEY `id_etablissement` (`id_etablissement`),
  ADD KEY `id_filiere` (`id_filiere`),
  ADD KEY `idx_actif` (`actif`),
  ADD KEY `idx_type` (`type_formation`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id_question`),
  ADD KEY `idx_test` (`id_test`);

--
-- Index pour la table `recommandation`
--
ALTER TABLE `recommandation`
  ADD PRIMARY KEY (`id_recommandation`),
  ADD UNIQUE KEY `unique_resultat_filiere` (`id_resultat`,`id_filiere`),
  ADD KEY `idx_resultat` (`id_resultat`),
  ADD KEY `idx_filiere` (`id_filiere`);

--
-- Index pour la table `resultat_test`
--
ALTER TABLE `resultat_test`
  ADD PRIMARY KEY (`id_resultat`),
  ADD UNIQUE KEY `id_test` (`id_test`),
  ADD KEY `idx_test` (`id_test`);

--
-- Index pour la table `test_orientation`
--
ALTER TABLE `test_orientation`
  ADD PRIMARY KEY (`id_test`),
  ADD KEY `idx_utilisateur` (`id_utilisateur`),
  ADD KEY `idx_statut` (`statut`),
  ADD KEY `idx_niveau` (`niveau`),
  ADD KEY `idx_domaine` (`domaine`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_role` (`role`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etablissement`
--
ALTER TABLE `etablissement`
  MODIFY `id_etablissement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `id_filiere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `filiere_etablissement`
--
ALTER TABLE `filiere_etablissement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT pour la table `formation_sauvegardee`
--
ALTER TABLE `formation_sauvegardee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `offre_formation`
--
ALTER TABLE `offre_formation`
  MODIFY `id_offre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `recommandation`
--
ALTER TABLE `recommandation`
  MODIFY `id_recommandation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT pour la table `resultat_test`
--
ALTER TABLE `resultat_test`
  MODIFY `id_resultat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT pour la table `test_orientation`
--
ALTER TABLE `test_orientation`
  MODIFY `id_test` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `administrateur_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE SET NULL;

--
-- Contraintes pour la table `filiere_etablissement`
--
ALTER TABLE `filiere_etablissement`
  ADD CONSTRAINT `filiere_etablissement_ibfk_1` FOREIGN KEY (`id_filiere`) REFERENCES `filiere` (`id_filiere`) ON DELETE CASCADE,
  ADD CONSTRAINT `filiere_etablissement_ibfk_2` FOREIGN KEY (`id_etablissement`) REFERENCES `etablissement` (`id_etablissement`) ON DELETE CASCADE;

--
-- Contraintes pour la table `formation_sauvegardee`
--
ALTER TABLE `formation_sauvegardee`
  ADD CONSTRAINT `formation_sauvegardee_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE,
  ADD CONSTRAINT `formation_sauvegardee_ibfk_2` FOREIGN KEY (`id_filiere`) REFERENCES `filiere` (`id_filiere`) ON DELETE CASCADE;

--
-- Contraintes pour la table `offre_formation`
--
ALTER TABLE `offre_formation`
  ADD CONSTRAINT `offre_formation_ibfk_1` FOREIGN KEY (`id_etablissement`) REFERENCES `etablissement` (`id_etablissement`) ON DELETE CASCADE,
  ADD CONSTRAINT `offre_formation_ibfk_2` FOREIGN KEY (`id_filiere`) REFERENCES `filiere` (`id_filiere`) ON DELETE CASCADE;

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`id_test`) REFERENCES `test_orientation` (`id_test`) ON DELETE CASCADE;

--
-- Contraintes pour la table `recommandation`
--
ALTER TABLE `recommandation`
  ADD CONSTRAINT `recommandation_ibfk_1` FOREIGN KEY (`id_resultat`) REFERENCES `resultat_test` (`id_resultat`) ON DELETE CASCADE,
  ADD CONSTRAINT `recommandation_ibfk_2` FOREIGN KEY (`id_filiere`) REFERENCES `filiere` (`id_filiere`) ON DELETE CASCADE;

--
-- Contraintes pour la table `resultat_test`
--
ALTER TABLE `resultat_test`
  ADD CONSTRAINT `resultat_test_ibfk_1` FOREIGN KEY (`id_test`) REFERENCES `test_orientation` (`id_test`) ON DELETE CASCADE;

--
-- Contraintes pour la table `test_orientation`
--
ALTER TABLE `test_orientation`
  ADD CONSTRAINT `test_orientation_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
