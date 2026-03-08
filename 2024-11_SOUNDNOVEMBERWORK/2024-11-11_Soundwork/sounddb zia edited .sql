-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2024 at 05:35 AM
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
  `album_id` int(11) NOT NULL,
  `album_name` varchar(2000) DEFAULT NULL,
  `artist_name` varchar(2000) DEFAULT NULL,
  `img_path` varchar(1000) NOT NULL,
  `rating` int(11) DEFAULT 0,
  `release_year` int(11) DEFAULT NULL,
  `album_link_page` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`album_id`, `album_name`, `artist_name`, `img_path`, `rating`, `release_year`, `album_link_page`) VALUES
(1, 'Ready For My Show', 'Ado', 'assets/albums/Ado_Ready For My Show Playlist_Album_cover.jpg', 4, NULL, NULL),
(3, 'Hey', 'Andreas Bourani', 'assets/albums/Andreas Bourani Hey_album_cover.jpg', 4, NULL, NULL),
(4, 'doorie', 'atif_aslam', 'assets/albums/atif_aslam_album_cover_doorie.jpg', 2, NULL, NULL),
(5, 'Hey', 'Andreas Bourani', 'assets/albums/Andreas Bourani Hey_album_cover.jpg', 5, NULL, NULL),
(6, 'doorie', 'atif_aslam', 'assets/albums/atif_aslam_album_cover_doorie.jpg', 5, NULL, NULL),
(7, 'Vida', 'Luis_fonsi', 'assets/albums/Luis_fonsi_Vida_album_cover.jpg', 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `artist_id` int(11) NOT NULL,
  `artist_name` varchar(2000) DEFAULT NULL,
  `img_path` varchar(1000) NOT NULL,
  `artist_link_page` varchar(255) DEFAULT NULL,
  `album_link_page` varchar(255) DEFAULT NULL,
  `album_release_year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`artist_id`, `artist_name`, `img_path`, `artist_link_page`, `album_link_page`, `album_release_year`) VALUES
(1, 'AJR', 'assets/artists/English/AJR_artist.jpg', 'ajr_linkpage.php', 'assets/albums/English/AJR_album_page.html', 2017),
(2, 'Dragons', 'assets/artists/English/Imagine_Dragons_artist.jpg', 'imagine_dragons_linkpage.php', 'Imagine_Dragons_album_page.html', 2017),
(3, 'AJR', 'assets/artists/English/AJR_artist.jpg', 'ajr_linkpage.php', 'assets/albums/English/AJR_album_page.html', 2017),
(4, 'Dragons', 'assets/artists/English/Imagine_Dragons_artist.jpg', 'imagine_dragons_linkpage.php', 'Imagine_Dragons_album_page.html', 2017),
(5, 'Tulsi Kumar', 'assets/artists/Hindi/Tulsi_kumar_artist.jpg', NULL, NULL, NULL),
(6, 'Arijit Singh', 'assets/artists/Hindi/Arijit_Singh_artist.jpg', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `followed_artist`
--

CREATE TABLE `followed_artist` (
  `followed_artist_id` int(11) NOT NULL,
  `followed_artist_name` varchar(2000) DEFAULT NULL,
  `img_path` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `followed_artist`
--

INSERT INTO `followed_artist` (`followed_artist_id`, `followed_artist_name`, `img_path`) VALUES
(34, 'Dragons', 'assets/artists/English/Imagine_Dragons_artist.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` int(11) NOT NULL,
  `song_id` int(11) NOT NULL,
  `song_title` varchar(255) NOT NULL,
  `artist_name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `played_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `song_id`, `song_title`, `artist_name`, `image_path`, `played_at`) VALUES
(1, 2, 'AJR - Burn The House Down', 'AJR', 'assets/songs/image/AJR - Burn The House Down (image).jpg', '2024-11-03 18:49:33'),
(2, 2, 'AJR - Burn The House Down', 'AJR', 'assets/songs/image/AJR - Burn The House Down (image).jpg', '2024-11-03 18:49:48'),
(3, 7, 'Marie', 'AnnenMayKantereit', 'assets/songs/image/AnnenMayKantereit Marie (image).jpg', '2024-11-03 18:52:03'),
(83, 1, 'AJR Weak', 'AJR', 'assets/songs/image/AJR Weak (image).jpg', '2024-11-10 03:59:34'),
(84, 1, 'AJR Weak', 'AJR', 'assets/songs/image/AJR Weak (image).jpg', '2024-11-10 04:03:17'),
(85, 2, 'AJR - Burn The House Down', 'AJR', 'assets/songs/image/AJR - Burn The House Down (image).jpg', '2024-11-10 04:09:38'),
(86, 1, 'AJR Weak', 'AJR', 'assets/songs/image/AJR Weak (image).jpg', '2024-11-10 04:22:17'),
(87, 1, 'AJR Weak', 'AJR', 'assets/songs/image/AJR Weak (image).jpg', '2024-11-10 04:27:02'),
(88, 1, 'AJR Weak', 'AJR', 'assets/songs/image/AJR Weak (image).jpg', '2024-11-10 04:33:23');

-- --------------------------------------------------------

--
-- Table structure for table `songs_data`
--

CREATE TABLE `songs_data` (
  `song_id` int(11) NOT NULL,
  `song_title` varchar(2000) DEFAULT NULL,
  `artist_name` varchar(200) DEFAULT NULL,
  `img_path` varchar(1000) NOT NULL,
  `audio_path` varchar(1000) DEFAULT NULL,
  `youtube_url` varchar(1000) DEFAULT NULL,
  `genre` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `songs_data`
--

INSERT INTO `songs_data` (`song_id`, `song_title`, `artist_name`, `img_path`, `audio_path`, `youtube_url`, `genre`) VALUES
(1, 'AJR Weak', 'AJR', 'assets/songs/image/AJR Weak (image).jpg', 'assets/songs/audiofiles/AJR+-+Weak+(Song).mp3', 'https://www.youtube.com/embed/txCCYBMKdB0?si=uOwtoZV5AewAz_1z', ''),
(2, 'AJR - Burn The House Down', 'AJR', 'assets/songs/image/AJR - Burn The House Down (image).jpg', 'assets/songs/audiofiles/AJR+-+Burn+The+House+Down+(Song).mp3', 'https://www.youtube.com/embed/UnyLfqpyi94?si=yL76uA1GNZj6ucwV', ''),
(3, 'AJR - Im Not Famous', 'AJR', 'assets/songs/image/AJR - Im Not Famous (image).jpg', 'assets/songs/audiofiles/AJR+-+Im+Not+Famous+(Song).mp3', '', ''),
(4, 'Auf uns', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Auf-uns_(image).jpg', 'assets/songs/audiofiles/Andreas+Bourani+-+Auf+uns!+(song).mp3', '', ''),
(5, 'Delirium', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Delirium_(image).jpg', 'assets/songs/audiofiles/Andreas+Bourani+-+Delirium+(song).mp3', '', ''),
(6, 'Ultraleicht', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Ultraleicht (image).jpg', 'assets/songs/audiofiles/Andreas+Bourani+-+Ultraleicht+(song).mp3', '', ''),
(7, 'Marie', 'AnnenMayKantereit', 'assets/songs/image/AnnenMayKantereit Marie (image).jpg', 'assets/songs/audiofiles/AnnenMayKantereit+Marie+(song).mp3', '', ''),
(8, 'Vielleicht Vielleicht', 'AnnenMayKantereit', 'assets/songs/image/AnnenMayKantereit Vielleicht Vielleicht (image).jpg', 'assets/songs/audiofiles/AnnenMayKantereit+Vielleicht+Vielleicht+(song).mp3', '', ''),
(9, 'Aasan Nahin Yahan', 'Arjit Singh', 'assets/songs/image/Arjit_singh_aasan_nahin_yahan (image).jpg', 'assets/songs/audiofiles/Arjit_Singh_Aasan_Nahin_Yahan_(song).mp3', '', ''),
(10, 'Ilahi', 'Arjit Singh', 'assets/songs/image/Arjit_singh_ilahi_(image).jpg', 'assets/songs/audiofiles/Arjit_singh_Ilahi_(song).mp3', '', ''),
(11, 'Tum Hi Ho', 'Arjit Singh', 'assets/songs/image/Arjit_singh_tum_hi_ho (image).jpeg', 'assets/songs/audiofiles/Arjit_Singh_Tum_Hi_Ho+(song).mp3', '', ''),
(12, 'Dil Mein Chhupa Loonga', 'Armaan Malik', 'assets/songs/image/Armaan Malik dil mein chuppa lounga (image).jpg', 'assets/songs/audiofiles/Armaan+Malik+Dil+Mein+Chhupa+Loonga+(song).mp3', '', ''),
(13, 'Tumhe Apna Banane Ka', 'Armaan Malik', 'assets/songs/image/Armaan Malik tumhe apna banane ka junoon (image).jpg', 'assets/songs/audiofiles/Armaan+Malik+Tumhe+Apna+Banane+Ka+(song).mp3', '', ''),
(14, 'Wajah Tum Ho', 'Armaan Malik', 'assets/songs/image/Armaan Malik wajah tum ho (image).jpg', 'assets/songs/audiofiles/Armaan+Malik+WAJAH+TUM+HO+(song).mp3', '', ''),
(15, 'Kuch Is Tarah', 'Atif Aslam', 'assets/songs/image/Atif_aslam_Kuch-Is-Tarah (image).jpg', 'assets/songs/audiofiles/Atif_aslam_Kuch+Is+Tarah_(song).mp3', '', ''),
(16, 'Doorie', 'Atif Aslam', 'assets/songs/image/atif_aslam_doorie (image).jpg', 'assets/songs/audiofiles/Atif_aslam_Doorie+(song).mp3', '', ''),
(17, 'Mahiya Ve Soniya', 'Atif Aslam', 'assets/songs/image/atif_aslam_mahiya ve soniya(image).jpg', 'assets/songs/audiofiles/Atif_aslam_Mahiya+Ve+Soniya+(song).mp3', '', '');

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
(4, 'Adminsound', '$2y$10$OxvUiuXPAD8glpFBA9gXwelSYsUPo6RtIR5nfsTa37Hd0gpS7QGuq', NULL, NULL, 'ziaazeem2004@gmail.com', 'admin', '2024-11-01 22:37:28'),
(5, 'asadharoon', '$2y$10$oPkQf/cRis4GqUlGfQaCT..WFpfDiROfVNQRyycrFjbWhPLumugfi', 'Gulf road New Mexico', '0321466489', 'asadharoon@gmail.com', 'user', '2024-11-01 22:38:36'),
(6, 'affan', '$2y$10$8t3p5YityMVlZKRtLr6/2u9rUg7z1kgdeKqg3asKqwRXbTYHRWQ36', 'North Karachi', '0313227521', 'affanahme12@gmail.com', 'user', '2024-11-07 19:18:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`album_id`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`artist_id`);

--
-- Indexes for table `followed_artist`
--
ALTER TABLE `followed_artist`
  ADD PRIMARY KEY (`followed_artist_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `song_id` (`song_id`);

--
-- Indexes for table `songs_data`
--
ALTER TABLE `songs_data`
  ADD PRIMARY KEY (`song_id`);

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
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `artist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `followed_artist`
--
ALTER TABLE `followed_artist`
  MODIFY `followed_artist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `songs_data`
--
ALTER TABLE `songs_data`
  MODIFY `song_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`song_id`) REFERENCES `songs_data` (`song_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
