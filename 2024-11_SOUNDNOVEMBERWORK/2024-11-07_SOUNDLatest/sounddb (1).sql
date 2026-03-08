-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2024 at 11:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sounddb`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(100) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `artist` varchar(1000) NOT NULL,
  `img_path` varchar(1000) NOT NULL,
  `rating` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `name`, `artist`, `img_path`, `rating`) VALUES
(1, 'Ready For My Show', 'Ado', 'assets/albums/Ado_Ready For My Show Playlist_Album_cover.jpg', 5),
(3, 'Hey', 'Andreas Bourani', 'assets/albums/Andreas Bourani Hey_album_cover.jpg', 2),
(4, 'doorie', 'atif_aslam', 'assets/albums/atif_aslam_album_cover_doorie.jpg', 5),
(5, 'Hey', 'Andreas Bourani', 'assets/albums/Andreas Bourani Hey_album_cover.jpg', 5),
(6, 'doorie', 'atif_aslam', 'assets/albums/atif_aslam_album_cover_doorie.jpg', 5),
(7, 'Vida', 'Luis_fonsi', 'assets/albums/Luis_fonsi_Vida_album_cover.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `id` int(100) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `img_path` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`id`, `name`, `img_path`) VALUES
(1, 'AJR', 'assets/artists/English/AJR_artist.jpg'),
(2, 'Dragons', 'assets/artists/English/Imagine_Dragons_artist.jpg'),
(3, 'AJR', 'assets/artists/English/AJR_artist.jpg'),
(4, 'Dragons', 'assets/artists/English/Imagine_Dragons_artist.jpg'),
(5, 'Tulsi Kumar', 'assets/artists/Hindi/Tulsi_kumar_artist.jpg'),
(6, 'Arijit Singh', 'assets/artists/Hindi/Arijit_Singh_artist.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `followed_artist`
--

CREATE TABLE `followed_artist` (
  `id` int(11) NOT NULL,
  `name` varchar(2000) NOT NULL,
  `img_path` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `followed_artist`
--

INSERT INTO `followed_artist` (`id`, `name`, `img_path`) VALUES
(2, 'Dragons', 'assets/artists/English/Imagine_Dragons_artist.jpg'),
(3, 'Dragons', 'assets/artists/English/Imagine_Dragons_artist.jpg'),
(4, 'Arijit Singh', 'assets/artists/Hindi/Arijit_Singh_artist.jpg'),
(5, 'AJR', 'assets/artists/English/AJR_artist.jpg'),
(6, 'Dragons', 'assets/artists/English/Imagine_Dragons_artist.jpg'),
(7, 'Tulsi Kumar', 'assets/artists/Hindi/Tulsi_kumar_artist.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `history1`
--

CREATE TABLE `history1` (
  `id` int(11) NOT NULL,
  `song_id` int(11) NOT NULL,
  `song_title` varchar(255) NOT NULL,
  `artist_name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `played_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history1`
--

INSERT INTO `history1` (`id`, `song_id`, `song_title`, `artist_name`, `image_path`, `played_at`) VALUES
(1, 2, 'AJR - Burn The House Down', 'AJR', 'assets/songs/image/AJR - Burn The House Down (image).jpg', '2024-11-03 23:49:33'),
(2, 2, 'AJR - Burn The House Down', 'AJR', 'assets/songs/image/AJR - Burn The House Down (image).jpg', '2024-11-03 23:49:48'),
(3, 7, 'Marie', 'AnnenMayKantereit', 'assets/songs/image/AnnenMayKantereit Marie (image).jpg', '2024-11-03 23:52:03'),
(4, 7, 'Marie', 'AnnenMayKantereit', 'assets/songs/image/AnnenMayKantereit Marie (image).jpg', '2024-11-03 23:52:11'),
(5, 14, 'Wajah Tum Ho', 'Armaan Malik', 'assets/songs/image/Armaan Malik wajah tum ho (image).jpg', '2024-11-03 23:52:16'),
(6, 12, 'Dil Mein Chhupa Loonga', 'Armaan Malik', 'assets/songs/image/Armaan Malik dil mein chuppa lounga (image).jpg', '2024-11-03 23:53:42'),
(7, 5, 'Delirium', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Delirium_(image).jpg', '2024-11-03 23:54:37'),
(8, 5, 'Delirium', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Delirium_(image).jpg', '2024-11-03 23:54:43'),
(9, 6, 'Ultraleicht', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Ultraleicht (image).jpg', '2024-11-03 23:57:03'),
(10, 2, 'AJR - Burn The House Down', 'AJR', 'assets/songs/image/AJR - Burn The House Down (image).jpg', '2024-11-04 00:00:52'),
(11, 2, 'AJR - Burn The House Down', 'AJR', 'assets/songs/image/AJR - Burn The House Down (image).jpg', '2024-11-04 00:00:53'),
(12, 4, 'Auf uns', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Auf-uns_(image).jpg', '2024-11-04 00:00:55'),
(13, 4, 'Auf uns', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Auf-uns_(image).jpg', '2024-11-04 00:00:56'),
(14, 7, 'Marie', 'AnnenMayKantereit', 'assets/songs/image/AnnenMayKantereit Marie (image).jpg', '2024-11-04 00:01:09'),
(15, 4, 'Auf uns', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Auf-uns_(image).jpg', '2024-11-04 00:03:38'),
(16, 10, 'Ilahi', 'Arjit Singh', 'assets/songs/image/Arjit_singh_ilahi_(image).jpg', '2024-11-04 00:03:44'),
(17, 1, 'AJR Weak', 'AJR', 'assets/songs/image/AJR Weak (image).jpg', '2024-11-04 00:06:06'),
(18, 1, 'AJR Weak', 'AJR', 'assets/songs/image/AJR Weak (image).jpg', '2024-11-04 00:06:07'),
(19, 15, 'Kuch Is Tarah', 'Atif Aslam', 'assets/songs/image/Atif_aslam_Kuch-Is-Tarah (image).jpg', '2024-11-04 00:06:49'),
(20, 4, 'Auf uns', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Auf-uns_(image).jpg', '2024-11-04 00:09:44'),
(21, 5, 'Delirium', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Delirium_(image).jpg', '2024-11-04 00:09:47'),
(22, 5, 'Delirium', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Delirium_(image).jpg', '2024-11-04 00:09:51'),
(23, 7, 'Marie', 'AnnenMayKantereit', 'assets/songs/image/AnnenMayKantereit Marie (image).jpg', '2024-11-04 00:10:43'),
(24, 6, 'Ultraleicht', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Ultraleicht (image).jpg', '2024-11-04 00:10:49'),
(25, 5, 'Delirium', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Delirium_(image).jpg', '2024-11-04 00:10:52'),
(26, 14, 'Wajah Tum Ho', 'Armaan Malik', 'assets/songs/image/Armaan Malik wajah tum ho (image).jpg', '2024-11-04 00:11:00'),
(27, 1, 'AJR Weak', 'AJR', 'assets/songs/image/AJR Weak (image).jpg', '2024-11-04 00:14:51'),
(28, 1, 'AJR Weak', 'AJR', 'assets/songs/image/AJR Weak (image).jpg', '2024-11-04 00:14:53'),
(29, 4, 'Auf uns', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Auf-uns_(image).jpg', '2024-11-04 00:15:01'),
(30, 4, 'Auf uns', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Auf-uns_(image).jpg', '2024-11-04 00:15:03'),
(31, 4, 'Auf uns', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Auf-uns_(image).jpg', '2024-11-04 00:15:54'),
(32, 6, 'Ultraleicht', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Ultraleicht (image).jpg', '2024-11-04 00:16:08'),
(33, 24, 'Sayonara Baby', 'Fujii Kaze', 'assets/songs/image/Fujii_Kaze_Sayonara_Baby(image).jpg', '2024-11-04 00:16:20'),
(34, 14, 'Wajah Tum Ho', 'Armaan Malik', 'assets/songs/image/Armaan Malik wajah tum ho (image).jpg', '2024-11-04 00:16:52'),
(35, 1, 'AJR Weak', 'AJR', 'assets/songs/image/AJR Weak (image).jpg', '2024-11-04 22:59:09'),
(36, 1, 'AJR Weak', 'AJR', 'assets/songs/image/AJR Weak (image).jpg', '2024-11-04 22:59:10'),
(37, 5, 'Delirium', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Delirium_(image).jpg', '2024-11-04 23:13:01'),
(38, 5, 'Delirium', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Delirium_(image).jpg', '2024-11-04 23:13:03'),
(39, 11, 'Tum Hi Ho', 'Arjit Singh', 'assets/songs/image/Arjit_singh_tum_hi_ho (image).jpeg', '2024-11-04 23:13:10'),
(40, 11, 'Tum Hi Ho', 'Arjit Singh', 'assets/songs/image/Arjit_singh_tum_hi_ho (image).jpeg', '2024-11-04 23:13:14'),
(41, 10, 'Ilahi', 'Arjit Singh', 'assets/songs/image/Arjit_singh_ilahi_(image).jpg', '2024-11-04 23:13:36'),
(42, 10, 'Ilahi', 'Arjit Singh', 'assets/songs/image/Arjit_singh_ilahi_(image).jpg', '2024-11-04 23:13:40'),
(43, 9, 'Aasan Nahin Yahan', 'Arjit Singh', 'assets/songs/image/Arjit_singh_aasan_nahin_yahan (image).jpg', '2024-11-04 23:14:25'),
(44, 9, 'Aasan Nahin Yahan', 'Arjit Singh', 'assets/songs/image/Arjit_singh_aasan_nahin_yahan (image).jpg', '2024-11-04 23:14:26'),
(45, 26, 'Thunder', 'Imagine Dragons', 'assets/songs/image/Imagine_Dragons_Thunder (image).jpg', '2024-11-04 23:14:54'),
(46, 26, 'Thunder', 'Imagine Dragons', 'assets/songs/image/Imagine_Dragons_Thunder (image).jpg', '2024-11-04 23:14:54'),
(47, 6, 'Ultraleicht', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Ultraleicht (image).jpg', '2024-11-04 23:15:24'),
(48, 6, 'Ultraleicht', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Ultraleicht (image).jpg', '2024-11-04 23:15:24'),
(49, 12, 'Dil Mein Chhupa Loonga', 'Armaan Malik', 'assets/songs/image/Armaan Malik dil mein chuppa lounga (image).jpg', '2024-11-06 21:34:34');

-- --------------------------------------------------------

--
-- Table structure for table `songsdata`
--

CREATE TABLE `songsdata` (
  `id` int(100) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `artist` varchar(1000) NOT NULL,
  `img_path` varchar(1000) NOT NULL,
  `audio_url` varchar(1000) NOT NULL,
  `video_url` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `songsdata`
--

INSERT INTO `songsdata` (`id`, `title`, `artist`, `img_path`, `audio_url`, `video_url`) VALUES
(1, 'AJR Weak', 'AJR', 'assets/songs/image/AJR Weak (image).jpg', 'assets/songs/audiofiles/AJR+-+Weak+(Song).mp3', ''),
(2, 'AJR - Burn The House Down', 'AJR', 'assets/songs/image/AJR - Burn The House Down (image).jpg', 'assets/songs/audiofiles/AJR+-+Burn+The+House+Down+(Song).mp3', ''),
(3, 'AJR - I\'m Not Famous', 'AJR', 'assets/songs/image/AJR - Im Not Famous (image).jpg', 'assets/songs/audiofiles/AJR+-+Im+Not+Famous+(Song).mp3', ''),
(4, 'Auf uns', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Auf-uns_(image).jpg', 'assets/songs/audiofiles/Andreas+Bourani+-+Auf+uns!+(song).mp3', ''),
(5, 'Delirium', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Delirium_(image).jpg', 'assets/songs/audiofiles/Andreas+Bourani+-+Delirium+(song).mp3', ''),
(6, 'Ultraleicht', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Ultraleicht (image).jpg', 'assets/songs/audiofiles/Andreas+Bourani+-+Ultraleicht+(song).mp3', ''),
(7, 'Marie', 'AnnenMayKantereit', 'assets/songs/image/AnnenMayKantereit Marie (image).jpg', 'assets/songs/audiofiles/AnnenMayKantereit+Marie+(song).mp3', ''),
(8, 'Vielleicht Vielleicht', 'AnnenMayKantereit', 'assets/songs/image/AnnenMayKantereit Vielleicht Vielleicht (image).jpg', 'assets/songs/audiofiles/AnnenMayKantereit+Vielleicht+Vielleicht+(song).mp3', ''),
(9, 'Aasan Nahin Yahan', 'Arjit Singh', 'assets/songs/image/Arjit_singh_aasan_nahin_yahan (image).jpg', 'assets/songs/audiofiles/Arjit_Singh_Aasan_Nahin_Yahan_(song).mp3', ''),
(10, 'Ilahi', 'Arjit Singh', 'assets/songs/image/Arjit_singh_ilahi_(image).jpg', 'assets/songs/audiofiles/Arjit_singh_Ilahi_(song).mp3', ''),
(11, 'Tum Hi Ho', 'Arjit Singh', 'assets/songs/image/Arjit_singh_tum_hi_ho (image).jpeg', 'assets/songs/audiofiles/Arjit_Singh_Tum_Hi_Ho+(song).mp3', ''),
(12, 'Dil Mein Chhupa Loonga', 'Armaan Malik', 'assets/songs/image/Armaan Malik dil mein chuppa lounga (image).jpg', 'assets/songs/audiofiles/Armaan+Malik+Dil+Mein+Chhupa+Loonga+(song).mp3', ''),
(13, 'Tumhe Apna Banane Ka', 'Armaan Malik', 'assets/songs/image/Armaan Malik tumhe apna banane ka junoon (image).jpg', 'assets/songs/audiofiles/Armaan+Malik+Tumhe+Apna+Banane+Ka+(song).mp3', ''),
(14, 'Wajah Tum Ho', 'Armaan Malik', 'assets/songs/image/Armaan Malik wajah tum ho (image).jpg', 'assets/songs/audiofiles/Armaan+Malik+WAJAH+TUM+HO+(song).mp3', ''),
(15, 'Kuch Is Tarah', 'Atif Aslam', 'assets/songs/image/Atif_aslam_Kuch-Is-Tarah (image).jpg', 'assets/songs/audiofiles/Atif_aslam_Kuch+Is+Tarah_(song).mp3', ''),
(16, 'Doorie', 'Atif Aslam', 'assets/songs/image/atif_aslam_doorie (image).jpg', 'assets/songs/audiofiles/Atif_aslam_Doorie+(song).mp3', ''),
(17, 'Mahiya Ve Soniya', 'Atif Aslam', 'assets/songs/image/atif_aslam_mahiya ve soniya(image).jpg', 'assets/songs/audiofiles/Atif_aslam_Mahiya+Ve+Soniya+(song).mp3', ''),
(18, 'Toxic', 'BoyWithUke', 'assets/songs/image/BoyWithUke - Toxic (image).jpg', 'assets/songs/audiofiles/BoyWithUke+-+Toxic.mp3', ''),
(19, 'Contigo', 'BoyWithUke', 'assets/songs/image/BoyWithUke - Contigo (image).jpg', 'assets/songs/audiofiles/Boywithuke+-+Contigo.mp3', ''),
(20, 'IDGAF', 'BoyWithUke', 'assets/songs/image/BoyWithUke - IDGAF (image).jpg', 'assets/songs/audiofiles/Boywithuke+-IDGAF+(song).mp3', ''),
(21, 'Yamiyo', 'EVE', 'assets/songs/image/EVE_Yamiyo(image).jpg', 'assets/songs/audiofiles/EVE+Yamiyo.mp3', ''),
(22, 'Baumkuchen End', 'EVE', 'assets/songs/image/EVE_Baumkuchen_End (image).jpg', 'assets/songs/audiofiles/EVE_Baumkuchen+End+(song).mp3', ''),
(23, 'Raison d\'être', 'EVE', 'assets/songs/image/EVE_Raison_d\'etre (image).jpg', 'assets/songs/audiofiles/EVE+Raison+d’être+(song).mp3', ''),
(24, 'Sayonara Baby', 'Fujii Kaze', 'assets/songs/image/Fujii_Kaze_Sayonara_Baby(image).jpg', 'assets/songs/audiofiles/Fujii_Kaze_SAYONARA_Baby+(song).mp3', ''),
(25, 'Believer', 'Imagine Dragons', 'assets/songs/image/Imagine-Dragons-Believer (image).jpg', 'assets/songs/audiofiles/Imagine+Dragons+-+Believer+(Audio).mp3', ''),
(26, 'Thunder', 'Imagine Dragons', 'assets/songs/image/Imagine_Dragons_Thunder (image).jpg', 'assets/songs/audiofiles/Imagine+Dragons+-+Thunder+(Audio).mp3', ''),
(27, 'Whatever It Takes', 'Imagine Dragons', 'assets/songs/image/Imagine_Dragons_Whatever_It_Takes_ (image).jpg', 'assets/songs/audiofiles/Imagine+Dragons+-+Whatever+It+Takes+(Audio).mp3', ''),
(28, 'Amarillo', 'J Balvin', 'assets/songs/image/J Balvin_Amarillo (image).jpg', 'assets/songs/audiofiles/J+Balvin+-+Amarillo+(song).mp3', ''),
(29, 'Rojo', 'J Balvin', 'assets/songs/image/j balvin_rojo (image).jpg', 'assets/songs/audiofiles/J+Balvin+-+Rojo+(Songs).mp3', ''),
(30, 'Morado', 'J Balvin', 'assets/songs/image/J Balvin_Morado (image).jpg', 'assets/songs/audiofiles/J+Balvin+-+Morado+(song).mp3', ''),
(31, 'Échame La Culpa', 'Luis Fonsi', 'assets/songs/image/Luis_Fonsi_Échame_la_Culpa (image).jpg', 'assets/songs/audiofiles/Luis+Fonsi_Échame+La+Culpa+(song).mp3', ''),
(32, 'Sola', 'Luis Fonsi', 'assets/songs/image/Luis_fonsi_Sola_(image).jpg', 'assets/songs/audiofiles/LUIS_FONSI_SOLA+_(song).mp3', ''),
(33, 'Despacito', 'Luis Fonsi', 'assets/songs/image/Luis Fonsi_Despacito (image).jpg', 'assets/songs/audiofiles/Luis+Fonsi+‒+Despacito+(song).mp3', ''),
(34, 'Nuestra Canción', 'Monsieur Periné', 'assets/songs/image/Monsieur Periné Nuestra Canción (image).jpg', 'assets/songs/audiofiles/Monsieur+Periné+Nuestra+Canción+(song).mp3', ''),
(35, 'Cielo', 'Monsieur Periné', 'assets/songs/image/Monsieur Periné Cielo (image).jpg', 'assets/songs/audiofiles/Monsieur+Periné+Cielo+(song).mp3', ''),
(36, 'Fuego', 'Monsieur Periné', 'assets/songs/image/Monsieur Periné Fuego (image).jpg', 'assets/songs/audiofiles/Monsieur+Periné+Fuego+(song).mp3', ''),
(37, 'Perfect', 'Ed Sheeran', 'assets/songs/image/Ed_Sheeran_Perfect_(image).jpg', 'assets/songs/audiofiles/Ed+Sheeran+-+Perfect+(song).mp3', ''),
(38, 'Shape of You', 'Ed Sheeran', 'assets/songs/image/Ed Sheeran Shape of You (image).jpg', 'assets/songs/audiofiles/Ed+Sheeran+-+Shape+of+You+(song).mp3', ''),
(39, 'Thinking Out Loud', 'Ed Sheeran', 'assets/songs/image/Ed_Sheeran_Thinking_Out_Loud_(image).jpg', 'assets/songs/audiofiles/Ed+Sheeran+-+Thinking+Out+Loud+(song).mp3', ''),
(40, 'Where Are Ü Now', 'Justin Bieber', 'assets/songs/image/Justin Bieber Where Are Ü Now (image).jpg', 'assets/songs/audiofiles/Justin+Bieber+-+Where+Are+Ü+Now+(song).mp3', ''),
(41, 'Stay', 'The Kid LAROI', 'assets/songs/image/The Kid LAROI Stay (image).jpg', 'assets/songs/audiofiles/The+Kid+LAROI+-+Stay+(song).mp3', ''),
(42, 'Baila Baila Baila', 'DJ Snake', 'assets/songs/image/DJ Snake Baila Baila Baila (image).jpg', 'assets/songs/audiofiles/DJ+Snake+-+Baila+Baila+Baila+(song).mp3', ''),
(43, 'No Me Ames', 'Ana Gabriel', 'assets/songs/image/Ana Gabriel No Me Ames (image).jpg', 'assets/songs/audiofiles/Ana+Gabriel+-+No+Me+Ames+(song).mp3', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `password_hash`, `address`, `phone`, `email`, `role`, `created_at`) VALUES
(4, 'Adminsound', '$2y$10$OxvUiuXPAD8glpFBA9gXwelSYsUPo6RtIR5nfsTa37Hd0gpS7QGuq', NULL, NULL, 'ziaazeem2004@gmail.com', 'admin', '2024-11-02 03:37:28'),
(5, 'asadharoon', '$2y$10$oPkQf/cRis4GqUlGfQaCT..WFpfDiROfVNQRyycrFjbWhPLumugfi', 'Gulf road New Mexico', '0321466489', 'asadharoon@gmail.com', 'user', '2024-11-02 03:38:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `followed_artist`
--
ALTER TABLE `followed_artist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history1`
--
ALTER TABLE `history1`
  ADD PRIMARY KEY (`id`),
  ADD KEY `song_id` (`song_id`);

--
-- Indexes for table `songsdata`
--
ALTER TABLE `songsdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `followed_artist`
--
ALTER TABLE `followed_artist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `history1`
--
ALTER TABLE `history1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `songsdata`
--
ALTER TABLE `songsdata`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history1`
--
ALTER TABLE `history1`
  ADD CONSTRAINT `history1_ibfk_1` FOREIGN KEY (`song_id`) REFERENCES `songsdata` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
