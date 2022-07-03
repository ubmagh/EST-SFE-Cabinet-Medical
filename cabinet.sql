/*
 Navicat Premium Data Transfer

 Source Server         : MyLocalMySQLDB
 Source Server Type    : MySQL
 Source Server Version : 100424
 Source Host           : localhost:3306
 Source Schema         : cabinet

 Target Server Type    : MySQL
 Target Server Version : 100424
 File Encoding         : 65001

 Date: 03/07/2022 23:39:55
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cabinets
-- ----------------------------
DROP TABLE IF EXISTS `cabinets`;
CREATE TABLE `cabinets`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Nom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Adresse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Specialites` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Tel` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Fax` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `AdminPseudo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `AdminEmail` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `AdminToken` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `remember_token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `AdminLastLogin` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cabinets
-- ----------------------------
INSERT INTO `cabinets` VALUES (1, 'Cabinet Alfarah', ' 12, Rue ziz, Agadir ', 'Cabinet-Default-logo.png', '  Chirurgie orale ', ' Cabinet Medical specialisée à la  chirurgie orale .', '0600000000', 'Contact@AlfarahCabinet.info', '0500000000', 'admin', '$2y$10$aP5j53uuw10djZUvas6jaeJ3hp0K.Dck7ELc0lz0sNVukfQiNgM92', 'admin@localhost.com', NULL, NULL, '{\"last\":\"\",\"first\":\"\"}');

-- ----------------------------
-- Table structure for certificats
-- ----------------------------
DROP TABLE IF EXISTS `certificats`;
CREATE TABLE `certificats`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `PatientId` bigint UNSIGNED NOT NULL,
  `medcinId` bigint UNSIGNED NOT NULL,
  `Motif` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp,
  `Duree` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `certificats_patientid_foreign`(`PatientId` ASC) USING BTREE,
  INDEX `certificats_medcinid_foreign`(`medcinId` ASC) USING BTREE,
  CONSTRAINT `certificats_medcinid_foreign` FOREIGN KEY (`medcinId`) REFERENCES `medcins` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `certificats_patientid_foreign` FOREIGN KEY (`PatientId`) REFERENCES `patients` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of certificats
-- ----------------------------

-- ----------------------------
-- Table structure for confreres
-- ----------------------------
DROP TABLE IF EXISTS `confreres`;
CREATE TABLE `confreres`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tel` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Fax` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Email` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `adresse` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Ville` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Specialite` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_ajout` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of confreres
-- ----------------------------
INSERT INTO `confreres` VALUES (1, 'Malena Dorrell', '0634476170', '0532372536', 'mdorrell0@comcast.net', 'Bureau 10, Agadir Plaza', 'Agadir', 'Opticien', '2017-01-28 00:00:00');
INSERT INTO `confreres` VALUES (2, 'Clare Greave', '0688184819', '0521810652', 'cgreave1@mapy.cz', '267 Randy Parkway', 'Marrakech', '   -   ', '2018-07-23 00:00:00');
INSERT INTO `confreres` VALUES (3, 'Coraline Cossem', '0639556828', '0596660582', 'ccossem2@spotify.com', '64278 Fair Oaks Terrace', 'Dawang', 'La neurologie', '2018-03-14 00:00:00');
INSERT INTO `confreres` VALUES (4, 'Siobhan Pfeiffer', '0669987755', '0556093397', 'spfeiffer3@over-blog.com', '1493 Shasta Pass', 'Silago', 'L’odontologie', '2019-12-27 00:00:00');
INSERT INTO `confreres` VALUES (5, 'Brandyn Housbie', '0645313950', '0511099908', 'bhousbie4@ucoz.com', '91 Garrison Plaza', 'Dundrum', 'La radiologie', '2019-10-10 00:00:00');
INSERT INTO `confreres` VALUES (6, 'Nevins Grimm', '0682315221', '0577445544', 'ngrimm5@reddit.com', '4772 Pleasure Avenue', 'Waikambila', 'La rhumatologie', '2020-05-10 00:00:00');
INSERT INTO `confreres` VALUES (7, 'Claire Hulks', '0660808181', '0520278093', 'chulks6@shinystat.com', '99 Ridge Oak Way', 'Il’ichëvo', 'La gériatrie', '2017-04-30 00:00:00');
INSERT INTO `confreres` VALUES (8, 'Rad Mein', '0668750129', '0529330973', 'rmein7@ca.gov', '1 Mosinee Junction', 'Pereleshino', '   -   ', '2017-05-19 00:00:00');
INSERT INTO `confreres` VALUES (9, 'Lauralee Tomala', '0663068632', '0548056771', 'ltomala8@devhub.com', '8951 Havey Point', 'Nirji', 'L’hépatologie', '2019-04-28 00:00:00');
INSERT INTO `confreres` VALUES (10, 'Junina Frean', '0628541095', '0581851639', 'jfrean9@vistaprint.com', '951 Grayhawk Crossing', 'Lom Sak', 'La médecine générale', '2019-01-24 00:00:00');
INSERT INTO `confreres` VALUES (11, 'Devondra Shaul', '0652256232', '0512671179', 'dshaula@yahoo.co.jp', '036 Westend Street', 'Savannah', 'La médecine préventive', '2017-12-19 00:00:00');
INSERT INTO `confreres` VALUES (12, 'Ardith Thurber', '0661401316', '0522086660', 'athurberb@wp.com', '5637 3rd Park', 'Siqian', 'La médecine générale', '2018-04-09 00:00:00');
INSERT INTO `confreres` VALUES (13, 'Kalil Edwicker', '0662635673', '0573420513', 'kedwickerc@google.co.uk', '7 Roxbury Pass', 'Lycksele', 'La psychiatrie', '2015-10-31 00:00:00');
INSERT INTO `confreres` VALUES (14, 'Carline Clarricoates', '0648706975', '0563494711', 'cclarricoatesd@cdbaby.com', '0922 Melody Court', 'Santa Cruz do Bispo', 'La cardiologie', '2017-02-10 00:00:00');

-- ----------------------------
-- Table structure for consultations
-- ----------------------------
DROP TABLE IF EXISTS `consultations`;
CREATE TABLE `consultations`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Date` timestamp NOT NULL DEFAULT current_timestamp,
  `Type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `PatientId` bigint UNSIGNED NOT NULL,
  `MedcinId` bigint UNSIGNED NOT NULL,
  `Urgent` tinyint(1) NOT NULL,
  `ExamensAfaire` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `consultations_patientid_foreign`(`PatientId` ASC) USING BTREE,
  INDEX `consultations_medcinid_foreign`(`MedcinId` ASC) USING BTREE,
  CONSTRAINT `consultations_medcinid_foreign` FOREIGN KEY (`MedcinId`) REFERENCES `medcins` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `consultations_patientid_foreign` FOREIGN KEY (`PatientId`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of consultations
-- ----------------------------

-- ----------------------------
-- Table structure for examens
-- ----------------------------
DROP TABLE IF EXISTS `examens`;
CREATE TABLE `examens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Titre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Valeur` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `ConsultationId` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `examens_consultationid_foreign`(`ConsultationId` ASC) USING BTREE,
  CONSTRAINT `examens_consultationid_foreign` FOREIGN KEY (`ConsultationId`) REFERENCES `consultations` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of examens
-- ----------------------------

-- ----------------------------
-- Table structure for factures
-- ----------------------------
DROP TABLE IF EXISTS `factures`;
CREATE TABLE `factures`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `ConsultationId` bigint UNSIGNED NULL DEFAULT NULL,
  `Motif` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Date` date NOT NULL,
  `Somme` decimal(8, 2) NOT NULL,
  `Paye` decimal(8, 2) NOT NULL DEFAULT 0.00,
  `Remise` decimal(8, 2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `factures_consultationid_foreign`(`ConsultationId` ASC) USING BTREE,
  CONSTRAINT `factures_consultationid_foreign` FOREIGN KEY (`ConsultationId`) REFERENCES `consultations` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of factures
-- ----------------------------

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for fichiers
-- ----------------------------
DROP TABLE IF EXISTS `fichiers`;
CREATE TABLE `fichiers`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Date` timestamp NOT NULL DEFAULT current_timestamp,
  `Type` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `CurrentName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `OriginalName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Size` bigint NOT NULL,
  `ConsultationId` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fichiers_consultationid_foreign`(`ConsultationId` ASC) USING BTREE,
  CONSTRAINT `fichiers_consultationid_foreign` FOREIGN KEY (`ConsultationId`) REFERENCES `consultations` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fichiers
-- ----------------------------

-- ----------------------------
-- Table structure for lettre_au_confreres
-- ----------------------------
DROP TABLE IF EXISTS `lettre_au_confreres`;
CREATE TABLE `lettre_au_confreres`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `ConfrereID` bigint UNSIGNED NOT NULL,
  `Titre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `MedcinId` bigint UNSIGNED NOT NULL,
  `PatientId` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `lettre_au_confreres_patientid_foreign`(`PatientId` ASC) USING BTREE,
  INDEX `lettre_au_confreres_confrereid_foreign`(`ConfrereID` ASC) USING BTREE,
  INDEX `lettre_au_confreres_medcinid_foreign`(`MedcinId` ASC) USING BTREE,
  CONSTRAINT `lettre_au_confreres_confrereid_foreign` FOREIGN KEY (`ConfrereID`) REFERENCES `confreres` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `lettre_au_confreres_medcinid_foreign` FOREIGN KEY (`MedcinId`) REFERENCES `medcins` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `lettre_au_confreres_patientid_foreign` FOREIGN KEY (`PatientId`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lettre_au_confreres
-- ----------------------------

-- ----------------------------
-- Table structure for medcins
-- ----------------------------
DROP TABLE IF EXISTS `medcins`;
CREATE TABLE `medcins`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Nom` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Prenom` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Specialite` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Adresse` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Signature` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Tel` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Pseudo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `DernierLog` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `PrixDeConsultation` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `medcins_email_unique`(`Email` ASC) USING BTREE,
  UNIQUE INDEX `medcins_pseudo_unique`(`Pseudo` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of medcins
-- ----------------------------
INSERT INTO `medcins` VALUES (1, 'Bacha', 'Abdellatif', 'Dentist', '13 rue ziz, Agadir', NULL, '0687542150', 'Medcin1@localhost.com', 'medecin1', '$2y$10$f/zwBpTychbicGjs/dcXKOdDnuuq0IiRvqh/JJuILgKJTNXdZSoaW', NULL, '{\"last\":\"\",\"first\":\"\"}', 100, '2022-07-03 22:37:34');
INSERT INTO `medcins` VALUES (2, 'Ben Ali', 'Meryem', 'Dentist', '6 rue Hassan 2, Agadir', NULL, '0687542220', 'Medcin2@localhost.com', 'medecin2', '$2y$10$cEVaj8VFUiEKiJuo/EYsSu/nufRYP88WRdTA.N6BtSRaaLDoqUq3G', NULL, '{\"last\":\"\",\"first\":\"\"}', 95, '2022-07-03 22:37:34');

-- ----------------------------
-- Table structure for medicament_par_ordonnances
-- ----------------------------
DROP TABLE IF EXISTS `medicament_par_ordonnances`;
CREATE TABLE `medicament_par_ordonnances`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `MedicamentId` bigint UNSIGNED NOT NULL,
  `OrdonnanceId` bigint UNSIGNED NOT NULL,
  `Periode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `NbrParJour` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `medicament_par_ordonnances_medicamentid_foreign`(`MedicamentId` ASC) USING BTREE,
  INDEX `medicament_par_ordonnances_ordonnanceid_foreign`(`OrdonnanceId` ASC) USING BTREE,
  CONSTRAINT `medicament_par_ordonnances_medicamentid_foreign` FOREIGN KEY (`MedicamentId`) REFERENCES `medicaments` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `medicament_par_ordonnances_ordonnanceid_foreign` FOREIGN KEY (`OrdonnanceId`) REFERENCES `ordonnances` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of medicament_par_ordonnances
-- ----------------------------

-- ----------------------------
-- Table structure for medicaments
-- ----------------------------
DROP TABLE IF EXISTS `medicaments`;
CREATE TABLE `medicaments`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Nom` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Prise` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Quand` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of medicaments
-- ----------------------------
INSERT INTO `medicaments` VALUES (1, 'Aspirine', 'Comprimés', 'indifini');
INSERT INTO `medicaments` VALUES (2, 'Azathioprine', 'Comprimés', 'avant');
INSERT INTO `medicaments` VALUES (3, 'Éphédrine', 'injection', 'indifini');
INSERT INTO `medicaments` VALUES (4, 'Flucytosine', 'Capsules', 'indifini');
INSERT INTO `medicaments` VALUES (5, 'Amphotéricine', 'Sachets', 'avant');
INSERT INTO `medicaments` VALUES (6, 'Doxycycline', 'Capsules', 'indifini');
INSERT INTO `medicaments` VALUES (7, 'Ploxycyne', 'Comprimés', 'indifini');
INSERT INTO `medicaments` VALUES (8, 'Amiodarone', 'gélules', 'indifini');
INSERT INTO `medicaments` VALUES (9, 'Digoxine', 'Comprimés', 'indifini');
INSERT INTO `medicaments` VALUES (10, 'Mupirocine', 'gélules', 'indifini');
INSERT INTO `medicaments` VALUES (11, 'Diazépam', 'Comprimés', 'indifini');
INSERT INTO `medicaments` VALUES (12, 'DOLIPRANE', 'gélules', 'indifini');
INSERT INTO `medicaments` VALUES (13, 'SPASFON', 'Comprimés', 'indifini');
INSERT INTO `medicaments` VALUES (14, 'LAMALINE', 'suppositoire', 'indifini');
INSERT INTO `medicaments` VALUES (15, 'RTYUKa', 'suppositoire', 'indifini');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (2, '2020_03_29_120040_create_patients_table', 1);
INSERT INTO `migrations` VALUES (3, '2020_03_29_141456_create_secretaires_table', 1);
INSERT INTO `migrations` VALUES (4, '2020_03_29_142301_create_rendezvouses_table', 1);
INSERT INTO `migrations` VALUES (5, '2020_03_29_143042_create_rappel_sms_table', 1);
INSERT INTO `migrations` VALUES (6, '2020_03_29_151804_create_medcins_table', 1);
INSERT INTO `migrations` VALUES (7, '2020_03_29_152932_create_consultations_table', 1);
INSERT INTO `migrations` VALUES (8, '2020_03_29_155418_create_certificats_table', 1);
INSERT INTO `migrations` VALUES (9, '2020_03_29_155919_create_examens_table', 1);
INSERT INTO `migrations` VALUES (10, '2020_03_29_160757_create_ordonnances_table', 1);
INSERT INTO `migrations` VALUES (11, '2020_03_29_161138_create_medicaments_table', 1);
INSERT INTO `migrations` VALUES (12, '2020_03_29_161810_create_factures_table', 1);
INSERT INTO `migrations` VALUES (13, '2020_03_29_163328_create_paiments_table', 1);
INSERT INTO `migrations` VALUES (14, '2020_03_29_163751_create_operations__cabinets_table', 1);
INSERT INTO `migrations` VALUES (15, '2020_03_29_164304_create_operations__selon__consultation_table', 1);
INSERT INTO `migrations` VALUES (16, '2020_03_29_170208_create_cabinets_table', 1);
INSERT INTO `migrations` VALUES (17, '2020_03_29_171539_create_fichiers_table', 1);
INSERT INTO `migrations` VALUES (18, '2020_04_08_151448_create_confreres_table', 1);
INSERT INTO `migrations` VALUES (19, '2020_04_08_153035_create_lettre_au_confreres_table', 1);
INSERT INTO `migrations` VALUES (20, '2020_04_08_171615_create_medicament_par_ordonnances_table', 1);
INSERT INTO `migrations` VALUES (21, '2020_04_18_122741_password_reset', 1);
INSERT INTO `migrations` VALUES (22, '2020_05_12_150715_create_salle_attentes_table', 1);

-- ----------------------------
-- Table structure for operations__cabinets
-- ----------------------------
DROP TABLE IF EXISTS `operations__cabinets`;
CREATE TABLE `operations__cabinets`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Intitule` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Prix` decimal(8, 2) NOT NULL,
  `Description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of operations__cabinets
-- ----------------------------
INSERT INTO `operations__cabinets` VALUES (1, 'Radio', 400.00, NULL);
INSERT INTO `operations__cabinets` VALUES (2, 'L’extraction des dents', 100.00, 'L’extraction des dents');
INSERT INTO `operations__cabinets` VALUES (3, 'L’implantologie', 150.00, 'Cet acte chirurgical consiste à remplacer les dents manquantes par des implants en titane. Trois étapes sont à suivre pour cette opération');
INSERT INTO `operations__cabinets` VALUES (4, 'La freinectomie', 170.00, 'La freinectomie consiste en l’ablation d’un frein labial ou lingual si celui pose problème.	');
INSERT INTO `operations__cabinets` VALUES (5, 'La greffe gingivale', 200.00, ' Cette diminution de la gencive conduit au dévoilement des racines des dents, ce qui est peu esthétique et conduit à des risques élevés de caries.');
INSERT INTO `operations__cabinets` VALUES (6, 'La greffe osseuse', 240.00, 'Il peut arriver que cet os alvéolaire se résorbe à cause de la perte des dents ou pour des raisons liées à la condition bucco-dentaire du patient.	');

-- ----------------------------
-- Table structure for operations__selon__consultation
-- ----------------------------
DROP TABLE IF EXISTS `operations__selon__consultation`;
CREATE TABLE `operations__selon__consultation`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `ConsultationID` bigint UNSIGNED NOT NULL,
  `OperationId` bigint UNSIGNED NOT NULL,
  `Remarque` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `operations__selon__consultation_operationid_foreign`(`OperationId` ASC) USING BTREE,
  INDEX `operations__selon__consultation_consultationid_foreign`(`ConsultationID` ASC) USING BTREE,
  CONSTRAINT `operations__selon__consultation_consultationid_foreign` FOREIGN KEY (`ConsultationID`) REFERENCES `consultations` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `operations__selon__consultation_operationid_foreign` FOREIGN KEY (`OperationId`) REFERENCES `operations__cabinets` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of operations__selon__consultation
-- ----------------------------

-- ----------------------------
-- Table structure for ordonnances
-- ----------------------------
DROP TABLE IF EXISTS `ordonnances`;
CREATE TABLE `ordonnances`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `ConsultationId` bigint UNSIGNED NOT NULL,
  `Description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `ordonnances_consultationid_foreign`(`ConsultationId` ASC) USING BTREE,
  CONSTRAINT `ordonnances_consultationid_foreign` FOREIGN KEY (`ConsultationId`) REFERENCES `consultations` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ordonnances
-- ----------------------------

-- ----------------------------
-- Table structure for paiments
-- ----------------------------
DROP TABLE IF EXISTS `paiments`;
CREATE TABLE `paiments`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Montant` decimal(8, 2) NOT NULL,
  `date` date NOT NULL,
  `Motif` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `FactureId` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `paiments_factureid_foreign`(`FactureId` ASC) USING BTREE,
  CONSTRAINT `paiments_factureid_foreign` FOREIGN KEY (`FactureId`) REFERENCES `factures` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of paiments
-- ----------------------------

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `password_resets_email_index`(`email` ASC) USING BTREE,
  INDEX `password_resets_token_index`(`token` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for patients
-- ----------------------------
DROP TABLE IF EXISTS `patients`;
CREATE TABLE `patients`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_civile` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Nom` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Prenom` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tel` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Email` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Sexe` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Ville` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `DateNaissance` date NULL DEFAULT NULL,
  `Occupation` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Nationnalite` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `typeMutuel` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ref_mutuel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `patients_id_civile_unique`(`id_civile` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of patients
-- ----------------------------
INSERT INTO `patients` VALUES (1, 'JC000001', 'Sendid', 'Omar', '0612345678', 'omar@gmail.com', 'homme', ' 12 Rue ziz ', 'Agadir', '2000-01-01', 'Etudiant', 'Marocain', 'CNSS', 'BC15454545', '2015-06-21 10:27:07');
INSERT INTO `patients` VALUES (2, 'JC000002', 'Ait moha', 'Ali', '0612345679', 'ali@gmail.com', 'homme', ' 13 Rue ziz ', 'Marrakech', '1999-12-08', 'Etudiant', 'Marocain', 'FAR', 'WYX4897320', '2016-01-10 10:27:07');
INSERT INTO `patients` VALUES (3, 'JC000003', 'Ait moha', 'Aicha', '0612345670', 'Aicha@gmail.com', 'femme', ' hay al amal Drargua ', 'Agadir', '1986-10-22', 'Femme de ménage', 'Marocain', NULL, NULL, '2015-06-21 11:27:07');
INSERT INTO `patients` VALUES (4, 'JC000004', 'Maghdaoui', 'Ayoub', '0612345689', 'Ayoub@gmail.com', 'homme', ' Ouled Berhil ', 'Taroudant', '2000-07-17', 'Etudiant', 'Marocain', 'CNSS', '43CPX13028', '2018-08-08 10:27:07');
INSERT INTO `patients` VALUES (5, 'PR865183', 'ID Brahim', 'Ahmed', '0648578127', 'Ahmed@ask.com', 'homme', ' 32 rue lboustane ', 'Fes', '1978-04-16', 'Ingénieur', 'Marocain', 'CNSS', 'BTX6548X7220', '2018-08-11 17:27:07');
INSERT INTO `patients` VALUES (6, 'GK950470', 'Jalal', 'Abderahim', '0639838712', 'Jalal@fotki.com', 'homme', '3 Hay agoudal', 'Rabat', '2007-12-17', NULL, 'Marocain', '1', '1', '2019-10-10 15:27:07');
INSERT INTO `patients` VALUES (7, 'AS945231', 'Qaddour', 'Ibrahim', '0627340141', 'Brahimi@printfriendly.com', 'homme', NULL, 'Safi', '1989-10-19', 'Retraité', 'Marocain', 'RAMED', 'LPCI18014850', '2019-10-27 16:27:07');
INSERT INTO `patients` VALUES (8, 'DQ764179', 'Fido', 'Sara', '0672937208', 'Sara@blogger.com', 'femme', '91 Hotel Sahara', 'Agadir', '1971-06-23', 'Tourisme', 'Française', NULL, NULL, '2015-06-21 10:27:07');
INSERT INTO `patients` VALUES (9, 'DO335258', 'Ait Bihi', 'Meryem', '0605078084', 'Merym@unc.edu', 'femme', NULL, 'Agadir', '1981-09-22', 'Professeur', 'Marocain', 'CNSS', 'BMXA1574720', '2020-03-21 10:27:07');
INSERT INTO `patients` VALUES (10, 'BE436891', 'BERAMIN', 'Yassine', '0690996816', 'mberndt7@cornell.edu', 'femme', '3 Dayton Junction', 'Zhongyuan', '2004-11-29', 'Chauffeur', 'Marocain', NULL, NULL, '2020-04-29 10:27:07');
INSERT INTO `patients` VALUES (11, 'BQ281410', 'Crab', 'Helsa', '0630213146', 'hcrab8@psu.edu', 'femme', '2 Gerald Way', 'La Esperanza', '1992-03-11', NULL, NULL, NULL, NULL, '2020-06-10 10:27:07');
INSERT INTO `patients` VALUES (12, 'FV666423', 'Franzelini', 'Marshall', '0691883350', 'mfranzelini9@privacy.gov.au', 'homme', '0709 Brickson Park Pass', 'Ath', '2006-05-29', NULL, NULL, NULL, NULL, '2020-06-15 10:27:07');
INSERT INTO `patients` VALUES (13, 'FK666423', 'Rakim', 'Sana', '0691783350', 'Rakimi@privacy.au', 'femme', '0709 Brickson Park Pass', 'Agadir', '2006-05-29', NULL, 'Marocaine', NULL, NULL, '2020-06-15 11:52:07');

-- ----------------------------
-- Table structure for rappel_sms
-- ----------------------------
DROP TABLE IF EXISTS `rappel_sms`;
CREATE TABLE `rappel_sms`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `DateEnvoi` timestamp NOT NULL DEFAULT current_timestamp,
  `RdvId` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `rappel_sms_rdvid_foreign`(`RdvId` ASC) USING BTREE,
  CONSTRAINT `rappel_sms_rdvid_foreign` FOREIGN KEY (`RdvId`) REFERENCES `rendezvouses` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rappel_sms
-- ----------------------------

-- ----------------------------
-- Table structure for rendezvouses
-- ----------------------------
DROP TABLE IF EXISTS `rendezvouses`;
CREATE TABLE `rendezvouses`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `DateTimeDebut` datetime NOT NULL,
  `DateTimeFin` datetime NOT NULL,
  `PatientId` bigint UNSIGNED NOT NULL,
  `Description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `SecretaireId` bigint UNSIGNED NOT NULL,
  `Statut` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `rendezvouses_patientid_foreign`(`PatientId` ASC) USING BTREE,
  INDEX `rendezvouses_secretaireid_foreign`(`SecretaireId` ASC) USING BTREE,
  CONSTRAINT `rendezvouses_patientid_foreign` FOREIGN KEY (`PatientId`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `rendezvouses_secretaireid_foreign` FOREIGN KEY (`SecretaireId`) REFERENCES `secretaires` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rendezvouses
-- ----------------------------

-- ----------------------------
-- Table structure for salle_attentes
-- ----------------------------
DROP TABLE IF EXISTS `salle_attentes`;
CREATE TABLE `salle_attentes`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `DateArrive` timestamp NOT NULL DEFAULT current_timestamp,
  `PatientId` bigint UNSIGNED NOT NULL,
  `ConsultationID` bigint UNSIGNED NULL DEFAULT NULL,
  `rdvID` bigint UNSIGNED NULL DEFAULT NULL,
  `SecretaireID` bigint UNSIGNED NOT NULL,
  `Urgent` tinyint(1) NOT NULL DEFAULT 0,
  `Quitte` tinyint(1) NOT NULL DEFAULT 0,
  `startTime` time NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `salle_attentes_patientid_foreign`(`PatientId` ASC) USING BTREE,
  INDEX `salle_attentes_consultationid_foreign`(`ConsultationID` ASC) USING BTREE,
  INDEX `salle_attentes_rdvid_foreign`(`rdvID` ASC) USING BTREE,
  INDEX `salle_attentes_secretaireid_foreign`(`SecretaireID` ASC) USING BTREE,
  CONSTRAINT `salle_attentes_consultationid_foreign` FOREIGN KEY (`ConsultationID`) REFERENCES `consultations` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `salle_attentes_patientid_foreign` FOREIGN KEY (`PatientId`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `salle_attentes_rdvid_foreign` FOREIGN KEY (`rdvID`) REFERENCES `rendezvouses` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `salle_attentes_secretaireid_foreign` FOREIGN KEY (`SecretaireID`) REFERENCES `secretaires` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of salle_attentes
-- ----------------------------

-- ----------------------------
-- Table structure for secretaires
-- ----------------------------
DROP TABLE IF EXISTS `secretaires`;
CREATE TABLE `secretaires`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Nom` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Prenom` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Adresse` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Tel` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Pseudo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `DernierLog` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `secretaires_email_unique`(`Email` ASC) USING BTREE,
  UNIQUE INDEX `secretaires_pseudo_unique`(`Pseudo` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of secretaires
-- ----------------------------
INSERT INTO `secretaires` VALUES (1, 'Smith', 'Jhon', '12 hay al Quds, Agadir', '0696857455', 'Secretaire1@localhost.com', 'secretaire1', '$2y$10$f3SrjUV.ymXYROCCNTys.e8LpfJcPc5eCVItzXn2lyDZFh4W0gWsm', NULL, '{\"last\":\"\",\"first\":\"\"}', '2022-07-03 22:37:31');
INSERT INTO `secretaires` VALUES (2, 'Costa', 'Alex', '13 Imeuble Idrissi rue Farah, agadir', '0696857415', 'Secretaire2@localhost.com', 'secretaire2', '$2y$10$m/kRMAvnCsj4DNXfgOk8Fub2YuqdMT10QO6jpNqba24mlA17qjsSS', NULL, '{\"last\":\"\",\"first\":\"\"}', '2022-07-03 22:37:34');

SET FOREIGN_KEY_CHECKS = 1;
