

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `email`, `mot_de_passe`) VALUES
(1, 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `film_id` int NOT NULL,
  `note` int NOT NULL,
  `commentaire` varchar(255) NOT NULL,
  `valide` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `film_id` (`film_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `user_id`, `film_id`, `note`, `commentaire`, `valide`) VALUES
(1, 6, 9, 3, 'Joli film', '0'),
(2, 6, 7, 5, 'Top du Top', '0');

-- --------------------------------------------------------

--
-- Structure de la table `cinemas`
--

DROP TABLE IF EXISTS `cinemas`;
CREATE TABLE IF NOT EXISTS `cinemas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `adresse` varchar(250) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `pays` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `cinemas`
--

INSERT INTO `cinemas` (`id`, `nom`, `adresse`, `ville`, `pays`) VALUES
(1, 'Cinéma Lumière', '10 rue des Étoiles', 'Paris', 'France'),
(2, 'CinéMax', '25 avenue du Film', 'Lyon', 'France'),
(3, 'Grand Ciné', '5 boulevard des Réalisateurs', 'Marseille', 'France'),
(4, 'CinéPolis', '100 Main Street', 'Nice', 'France'),
(5, 'MegaScreen', '45 Cine Avenue', 'Bordeaux', 'France'),
(6, 'StarCiné', '12 Place du Film', 'Lille', 'France'),
(7, 'CinéLand', '78 Boulevard du Cinéma', 'Strasbourg', 'France'),
(8, 'Filmorama', '6 Rue des Projectionnistes', 'Toulouse', 'France'),
(9, 'CinéVerse', '33 Rue Lumière', 'Nantes', 'France'),
(10, 'CinéPlanet', '21 Avenue des Réalisateurs', 'Montpellier', 'France');

-- --------------------------------------------------------

--
-- Structure de la table `employer`
--

DROP TABLE IF EXISTS `employer`;
CREATE TABLE IF NOT EXISTS `employer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `employer`
--

INSERT INTO `employer` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`) VALUES
(1, 'ALI', 'Djoumoi', 'ali@gmail.com', '$2y$10$f98.ICl6DJY//2fozAf2Nu6eu'),
(2, 'Mohammed', 'Abdou', 'mohamed@gmail.com', '$2y$10$7uWyiGVwkt6YSVXOpZg6KeUXI'),
(3, 'Employe 1', 'Falih', 'falih@gmail.com', 'test'),
(4, 'remi', 'dupont', 'remi@gmail.com', '$2y$10$JUdT51xZXi3brOMXbzPM9uaQ4');

-- --------------------------------------------------------

--
-- Structure de la table `films`
--

DROP TABLE IF EXISTS `films`;
CREATE TABLE IF NOT EXISTS `films` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `age_min` int NOT NULL,
  `note` int NOT NULL,
  `genre` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `poster` varchar(5000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `films`
--

INSERT INTO `films` (`id`, `titre`, `description`, `age_min`, `note`, `genre`, `date`, `poster`) VALUES
(1, 'Inception', 'Un film sur les rêves et la réalité.', 12, 4, 'Science-fiction', '0000-00-00', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSMqhsdibWozX8xYgs5JSprEITdSPtRzJr5HQ&s"),
(2, "Interstellar", "Voyage dans l\'espace et le temps.", 10, 2, "Science-fiction", "0000-00-00", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTc-8kdT0-lTXyi60_n1KLWJMQuAs-KUNeFsg&s"),
(3, "Titanic", "Une romance dramatique sur l\'océan.", 12, 5, "Drame", "0000-00-00", "https://m.media-amazon.com/images/I/51g2uaceJ7L._AC_UF894,1000_QL80_.jpg"),
(4, "Avatar", "Un monde extraterrestre fascinant.", 10, 1, "Science-fiction", "0000-00-00", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQtFm2w1eAinQAdjRE2B21r9sL2wPdPTTxog&s"),
(5, "Joker", "L\'origine du célèbre ennemi de Batman.", 16, 3, "Drame", "0000-00-00", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQtFm2w1eAinQAdjRE2B21r9sL2wPdPTTxog&s"),
(6, "Parasite", "Un thriller social captivant.", 12, 4, "Thriller", "0000-00-00", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRCjE43o1yDCk0yhDllRJRgwxlX0lSaUnYdng&s"),
(7, "The Dark Knight", "Le combat de Batman contre le Joker.", 12, 1, "Action", "0000-00-00", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSRr9zwkmwYaiYfEuYJtaTw-4j19rRJ8RkVSA&s"),
(8, "Forrest Gump", "L\'histoire touchante d\'un homme simple.", 10, 5, "Drame", "0000-00-00", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTVhy59xS1wo-YHKzNOnc6uMr8nfE1hTedHWA&s"),
(9, "La La Land", "Une romance musicale vibrante.", 10, 2, "Musical", "0000-00-00", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTc-8kdT0-lTXyi60_n1KLWJMQuAs-KUNeFsg&s"),
(10, "Gladiator", "Un combat pour l\'honneur et la liberté.", 16, 5, "Historique", "0000-00-00", "https://www.ecranlarge.com/content/uploads/2020/07/5gjou3t2qrznujqjcg7fqdmi76t-349.jpg"),
(11, "Avengers", "Réunis dans l\'univers cinématographique Marvel à partir du film Avengers (2012), l\'équipe originale (dans le MCU) est constituée de Tony Stark (Iron Man), Steve Rogers (Captain America), Bruce Banner (Hulk), Thor, Natasha Romanoff (la Veuve noire) et", 19, 5, "Aventure", "2025-04-09", "https://www.francetvinfo.fr/pictures/4_DXROZmf1ELukMvR0RKbz53zYQ/1200x1200/2019/04/23/php8Zaq6g.jpg"),
(12, "Jeu de la mort", "film d\'action", 18, 4, "action", "2024-09-18", "https://m.media-amazon.com/images/I/61sdygq9CAS._AC_UF894,1000_QL80_.jpg"),
(13, "Le parain", "aventure", 10, 3, "action", "2023-09-20", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1w8MwmnX5WMHOiJE63EGUlxnnXXc87LoJ7Q&s"),
(14, "Alone", "beau, merveilleux et comique", 18, 5, "Aventure", "2023-03-22", "https://assets.e-cinema.com/PICTURES/BA8C95-insoumise.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `incidents`
--

DROP TABLE IF EXISTS `incidents`;
CREATE TABLE IF NOT EXISTS `incidents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `salle` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_incident` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `incidents`
--

INSERT INTO `incidents` (`id`, `salle`, `description`, `date_incident`) VALUES
(1, 'Salle 2', 'probleme technique', '02/05/2025 12:38'),
(2, '4', 'test techniques', '02/05/2025 12:46'),
(3, '5', 'La chaise numéro 4 est casséee', '02/05/2025 13:02'),
(4, '7', 'Il y a un problème dans la salle 7 :', '02/05/2025 16:35'),
(5, '3', 'Il y a un problème de son', '02/05/2025 17:33'),
(6, '10', 'Il ya un problème de son', '02/05/2025 19:26'),
(7, '5', 'Manque de chiases', '05/05/2025 13:15'),
(8, '9', 'Il faut augmenter les chises', '11/05/2025 18:49');


--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `seance_id` int NOT NULL,
  `film_id` int NOT NULL,
  `nombre_places` int NOT NULL,
  `date_reservation` date NOT NULL,
  `statut` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `seance_id` (`seance_id`),
  KEY `film_id` (`film_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `seance_id`, `film_id`, `nombre_places`, `date_reservation`, `statut`) VALUES
(12, 5, 3, 3, 1, '2025-04-10', 'En attente'),
(13, 5, 1, 1, 34, '2025-04-18', 'En attente'),
(14, 6, 9, 9, 2, '2025-05-24', 'En attente'),
(15, 6, 3, 3, 2, '2025-05-29', 'En attente'),
(16, 6, 7, 7, 1, '2025-05-25', 'En attente');

-- --------------------------------------------------------

--
-- Structure de la table `salles`
--

DROP TABLE IF EXISTS `salles`;
CREATE TABLE IF NOT EXISTS `salles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nbr_places` int NOT NULL,
  `qualite_projection` varchar(50) NOT NULL,
  `cinema_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cinema_id` (`cinema_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `salles`
--

INSERT INTO `salles` (`id`, `nbr_places`, `qualite_projection`, `cinema_id`) VALUES
(1, 200, 'IMAX', 1),
(2, 150, '4K', 2),
(3, 120, 'HD', 3),
(4, 180, 'Dolby Cinema', 4),
(5, 220, 'IMAX', 5),
(6, 160, '4K', 6),
(7, 140, 'HD', 7),
(8, 130, 'Dolby Atmos', 8),
(9, 170, 'IMAX', 9),
(10, 190, '4K', 10),
(11, 20, '2D', 1),
(12, 100, '3D', 4),
(13, 5, '2D', 4),
(14, 2, 'IMAX', 3);

-- --------------------------------------------------------

--
-- Structure de la table `seances`
--

DROP TABLE IF EXISTS `seances`;
CREATE TABLE IF NOT EXISTS `seances` (
  `id` int NOT NULL AUTO_INCREMENT,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `qualité` varchar(50) NOT NULL,
  `film_id` int NOT NULL,
  `salle_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `film_id` (`film_id`),
  KEY `salle_id` (`salle_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `seances`
--

INSERT INTO `seances` (`id`, `heure_debut`, `heure_fin`, `qualité`, `film_id`, `salle_id`) VALUES
(1, '00:00:14', '00:00:16', 'IMAX', 1, 1),
(2, '00:00:17', '00:00:19', '4K', 2, 2),
(3, '00:00:20', '00:00:22', 'HD', 3, 3),
(4, '00:00:13', '00:00:15', 'Dolby Cinema', 4, 4),
(5, '00:00:18', '00:00:20', 'IMAX', 5, 5),
(6, '00:00:21', '00:00:23', '4K', 6, 6),
(7, '00:00:15', '00:00:17', 'HD', 7, 7),
(8, '00:00:19', '00:00:21', 'Dolby Atmos', 8, 8),
(9, '00:00:12', '00:00:14', 'IMAX', 9, 9),
(10, '12:15:16', '00:00:18', '4K', 10, 10),
(11, '00:20:25', '00:20:25', '3D', 11, 9),
(12, '00:20:25', '00:20:25', '3D', 11, 10);

-- --------------------------------------------------------

--
-- Structure de la table `siege`
--

DROP TABLE IF EXISTS `siege`;
CREATE TABLE IF NOT EXISTS `siege` (
  `id` int NOT NULL AUTO_INCREMENT,
  `numero` int NOT NULL,
  `type` varchar(50) NOT NULL,
  `salle_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `salle_id` (`salle_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `siege`
--

INSERT INTO `siege` (`id`, `numero`, `type`, `salle_id`) VALUES
(1, 1, 'Standard', 1),
(2, 2, 'VIP', 1),
(3, 3, 'Standard', 2),
(4, 4, 'VIP', 2),
(5, 5, 'Standard', 3),
(6, 6, 'VIP', 3),
(7, 7, 'Standard', 4),
(8, 8, 'VIP', 4),
(9, 9, 'Standard', 5),
(10, 10, 'VIP', 5),
(11, 1, 'Standard', 1),
(12, 2, 'VIP', 1),
(13, 3, 'Standard', 2),
(14, 4, 'VIP', 2),
(15, 5, 'Standard', 3),
(16, 6, 'VIP', 3),
(17, 7, 'Standard', 4),
(18, 8, 'VIP', 4),
(19, 9, 'Standard', 5),
(20, 10, 'VIP', 5);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom_utilisateur` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mot_de_passe` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `nom_utilisateur`, `email`, `mot_de_passe`) VALUES
(6, 'Mohammed', 'Adam', 'MoAdam', 'adam@gmail.com', '098f6bcd4621d373cade4e832627b4f6'),
(5, 'Abdou', 'Mohammed', 'abdou_mohammed', 'abdou@gmail.com', '098f6bcd4621d373cade4e832627b4f6');
COMMIT;
