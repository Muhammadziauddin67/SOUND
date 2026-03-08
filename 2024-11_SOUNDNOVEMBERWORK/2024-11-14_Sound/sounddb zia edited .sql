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

(1,'The_Click_Album', 'AJR', 'assets/albums/The_Click_Album_Cover AJR.jpg', 5, '2017', 'albumlinkpages/ajr_albuminkpage.php'),
(2,'Evolve_album', 'IMAGINE DRAGONS', 'assets/albums/ImagineDragons_Evolve_album_Cover.jpg', 5, '2017', 'albumlinkpages/imagine_dragons_albumlinkpage.php'),
(3,'Serotonin_Dreams_Album', 'BOYWITHUKE', 'assets/albums/Serotonin_Dreams_Album_by_BoyWithUke.jpg', 5, '2022', 'albumlinkpages/boywithuke_albumlinkpage.php'),
(4,'Smile_Album', 'EVE', 'assets/albums/EVE_Smile_Album_cover.png', 5, '2020', 'albumlinkpages/eve_albumlinkpage.php'),
(5,'Help_Ever_Hurt_Never_Album', 'FUJII KAZE', 'assets/albums/Fujii_Kaze_Album_Cover_Help_Ever_Hurt_Never.png', 5, '2020', 'albumlinkpages/fujii_albumlinkpage.php'),
(6,'Ready For My Show', 'Ado', 'assets/albums/Ado_Ready For My Show Playlist_Album_cover.jpg', 5, '2024', 'albumlinkpages/ado_albumlinkpage.php'),
(7,'Best_of_Arijit_Singh_Album', 'ARJIT SINGH', 'assets/albums/Best_of_Arijit_Singh_Album_cover.jpg', 5, '2013', 'albumlinkpages/arijit_albumlinkpage.php'),
(8,'Best_of_Tulsi_Kumar_Birthday_Special_Album', 'Tulsi Kumar', 'assets/albums/Best_of_Tulsi_Kumar_Birthday_Special_Album_cover.jpg', 5, '2017', 'albumlinkpages/tulsi_albumlinkpage.php'),
(9,'Hate story 3_album', 'Armaan Malik', 'assets/albums/Armaan Malik_Hate story 3_album_cover.jpg', 5, '2015', 'albumlinkpages/armaan_albumlinkpage.php'),
(10,'doorie_album', 'ATIF ASLAM', 'assets/albums/atif_aslam_album_cover_doorie.jpg', 5, '2006', 'albumlinkpages/atif_albumlinkpage.php'),
(11,'rebirth_album', 'Young Stunners', 'assets/albums/YOUNG_Stunners_album_cover_rebirth.jpg', 5, '2017', 'albumlinkpages/youngstunner_albumlinkpage.php'),
(12,'Open_letter_album', 'Umair', 'assets/albums/Umair_Open_letter_album_cover.jpg', 5, '2024', 'albumlinkpages/umair_albumlinkpage.php'),
(13,'Caja de Música_album', 'Monsieur Periné', 'assets/albums/Monsieur Periné_Caja de Música_album_cover.jpg', 5, '2015', 'albumlinkpages/monsieur_albumlinkpage.php'),
(14,'Vida_album', 'Luis Fonsi', 'assets/albums/Luis_fonsi_Vida_album_cover.jpg', 5, '2019', 'albumlinkpages/luisfonsi_albumlinkpage.php'),
(15,'Colores_Album', 'J Balvin', 'assets/albums/J_Balvin_Album_cover_Colores.png', 5, '2020', 'albumlinkpages/j_balvin_albumlinkpage.php'),
(16,'kompass_ohne_norden_album', 'PRINZ PI', 'assets/albums/prinz_pi_kompass_ohne_norden_album_cover.jpg', 5, '2013', 'albumlinkpages/prinz_albumlinkpage.php'),
(17,'Hey_album', 'Andreas Bourani', 'assets/albums/Andreas Bourani Hey_album_cover.jpg', 5, '2014', 'albumlinkpages/andreas_albumlinkpage.php'),
(18,'Schlagschatten_album', 'AnnenMaykantereit', 'assets/albums/AnnenMayKantereit Schlagschatten_album_cover.jpg', 5, '2018', 'albumlinkpages/annenmaykantereit_albumlinkpage.php');


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
(1,'AJR' , 'assets/artists/English/AJR_artist.jpg', 'artistlinkpages/ajr_linkpage.php', 'albumlinkpage.php', '2017'),
(2,'IMAGINE DRAGONS','assets/artists/English/Imagine_Dragons_artist.jpg', 'artistlinkpages/imagine_dragons_linkpage.php', 'albumlinkpage.php', '2017'),
(3,'BOYWITHUKE', 'assets/artists/English/Bouwithuke_artist.jpg', 'artistlinkpages/boywithuke_linkpage.php', 'albumlinkpage.php', '2022'),
(4,'EVE', 'assets/artists/japanese/EVE_artist.jpg', 'artistlinkpages/eve_linkpage.php', 'albumlinkpage.php', '2020'),
(5,'FUJII KAZE', 'assets/artists/japanese/Fujii Kaze_artist.jpeg', 'artistlinkpages/fujii_linkpage.php', 'albumlinkpage.php', '2020'),
(6,'ADO', 'assets/artists/japanese/ADO_artist.jpg', 'artistlinkpages/ado_linkpage.php', 'albumlinkpage.php', '2024'),
(7,'ARJIT SINGH', 'assets/artists/hindi/Arijit_Singh_artist.jpg', 'artistlinkpages/arijit_linkpage.php', 'albumlinkpage.php', '2013'),
(8,'Tulsi Kumar', 'assets/artists/hindi/Tulsi_kumar_artist.jpg', 'artistlinkpages/tulsi_linkpage.php', 'albumlinkpage.php', '2017'), 
(9,'Armaan Malik', 'assets/artists/hindi/Armaan_Malik_artist.jpg', 'artistlinkpages/armaan_linkpage.php', 'albumlinkpage.php', '2015'), 
(10,'ATIF ASLAM', 'assets/artists/urdu/Atif_Aslam_artist.jpg', 'artistlinkpages/atif_linkpage.php', 'albumlinkpage.php', '2006'),
(11,'Young Stunners', 'assets/artists/urdu/YOUNG STUNNERS_artist.jpg', 'artistlinkpages/youngstunner_linkpage.php', 'albumlinkpage.php', '2017'),
(12,'Umair', 'assets/artists/urdu/Umair_artist.jpg', 'artistlinkpages/umair_linkpage.php', 'albumlinkpage.php', '2024'),
(13,'PRINZ PI', 'assets/artists/GERMAN/Prinz PI_artist.jpg', 'artistlinkpages/prinz_linkpage.php', 'albumlinkpage.php', '2013'),
(14,'Andreas Bourani', 'assets/artists/GERMAN/Andreas_Bourani_artist.jpg', 'artistlinkpages/andreas_linkpage.php','albumlinkpage.php', '2014'),
(15,'AnnenMaykantereit', 'assets/artists/GERMAN/annenmaykantereit_artist.jpg', 'artistlinkpages/annenmaykantereit_linkpage.php', 'albumlinkpage.php', '2018'),
(16,'Monsieur Periné', 'assets/artists/SPANISH/Monsieur periné_artist.jpg', 'artistlinkpages/monsieur_linkpage.php', 'albumlinkpage.php', '2015'),
(17,'Luis Fonsit', 'assets/artists/SPANISH/Luis Fonsi_artist.jpg', 'artistlinkpages/luisfonsi_linkpage.php', 'albumlinkpage.php', '2019'),
(18, 'J Balvin', 'assets/artists/SPANISH/J-Balvin_artist.jpg', 'artistlinkpages/j_balvin_linkpage.php', 'albumlinkpage.php', '2020');

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
(1,'Burn the house' , 'AJR' , 'assets/songs/image/AJR - Burn The House Down (image).jpg' , 'assets/songs/audiofiles/AJR_BurnTheHouseDown(Song).mp3' , 'https://www.youtube.com/embed/UnyLfqpyi94?si=ta1wzsNTRiq-yK_C' , 'ALTERNATIVE'),
(2,'im not famous' , 'AJR' , 'assets/songs/image/AJR - Im Not Famous (image).jpg' , 'assets/songs/audiofiles/AJR_ImNotFamous(Song).mp3' , 'https://www.youtube.com/embed/VkXYjy6sZ2A' , 'ALTERNATIVE'),
(3,'weak' , 'AJR' , 'assets/songs/image/AJR  Weak (image).jpg', 'assets/songs/audiofiles/AJR_Weak(Song).mp3' , 'https://www.youtube.com/embed/tgnNJsG4O8M' , 'ALTERNATIVE'),
(4,'Contigo' , 'boywithuke' , 'assets/songs/image/Boywithuke - Contigo (image).PNG', 'assets/songs/audiofiles/Boywithuke_Contigo.mp3' , 'https://www.youtube.com/embed/UMchhIEDvaM?si=0PmhqbPTqviyBRIq' , 'ALTERNATIVE'),
(5,'Toxic' , 'boywithuke' , 'assets/songs/image/BoyWithUke - Toxic (image).jpg', 'assets/songs/audiofiles/BoyWithUke_Toxic.mp3' , 'https://www.youtube.com/embed/UMchhIEDvaM' , 'POP'),
(6,'IDGAF' , 'boywithuke' , 'assets/songs/image/BoyWithUke_IDGAF (image).png', 'assets/songs/audiofiles/Boywithuke_IDGAF(song).mp3' , 'https://www.youtube.com/embed/Q1QcLbkYFaM' , 'ALTERNATIVE'),
(7,'Believer' , 'imagine_dragons' , 'assets/songs/image/Imagine-Dragons-Believer (image).jpg' , 'assets/songs/audiofiles/ImagineDragonsBeliever(Audio).mp3' , 'https://www.youtube.com/embed/W0DM5lcj6mw' , 'PUNK'),
(8,'Thunder' , 'imagine_dragons' , 'assets/songs/image/Imagine_Dragons_Thunder (image).jpg' , 'assets/songs/audiofiles/ImagineDragonsThunder(Audio).mp3' , 'https://www.youtube.com/embed/GtEvysh1654' , 'PUNK'),
(9,'Whatever it takes' , 'imagine_dragons' , 'assets/songs/image/Imagine_Dragons_Whatever_It_Takes_  (image).jpg' , 'assets/songs/audiofiles/ImagineDragons_WhateverItTakes(Audio).mp3' , 'https://www.youtube.com/embed/v=gOsM-DYAEhY' , 'ALTERNATIVE'),
(10,'Boumkuchen end' , 'EVE' , 'assets/songs/image/EVE_Baumkuchen_End (image).jpg' , 'assets/songs/audiofiles/EVE_BaumkuchenEnd(song).mp3' , 'https://www.youtube.com/embed/D_v8oX5s51g' , 'RAP'),
(11,'raison detre' , 'EVE' , 'assets/songs/image/EVE_Raison_dêtre (image).jpg' , 'assets/songs/audiofiles/EVE_Raisondêtre(song).mp3' , 'https://www.youtube.com/embed/ulfY8WQE_HE' , 'POP'),
(12,'yamiyo' , 'EVE' , 'assets/songs/image/EVE _Yamiyo(image).jpg' , 'assets/songs/audiofiles/EVE_Yamiyo.mp3' , 'https://www.youtube.com/embed/O8vi_D89weo' , 'POP'),
(13,'sayonara baby' , 'fujii_kaze' , 'assets/songs/image/Fujii_Kaze_Sayonara_Baby(image).jpg' , 'assets/songs/audiofiles/Fujii_Kaze_SAYONARA_Baby(song).mp3' , 'https://www.youtube.com/embed/JB_bLPp3wCs' , 'POP'),
(14,'yasashisa' , 'fujii_kaze' , 'assets/songs/image/Fujii_Kaze_Yasashisa  (image).PNG' , 'assets/songs/audiofiles/Fujii_Kaze_YASASHISA+(song).mp3' , 'https://www.youtube.com/embed/vzhTpIIQR5I' , 'JAZZ'),
(15,'shinunoga E-wa' , 'fujii_kaze' , 'assets/songs/image/Fujii_Kaze_Shinunoga E-Wa (image).png' , 'assets/songs/audiofiles/Fujii_Kaze_ShinunogaEWa(song).mp3' , 'https://www.youtube.com/embed/dawrQnvwMTY' , 'JAZZ'),
(16,'gira gira' , 'ADO' , 'assets/songs/image/Ado_Gira_Gira_(image).jpg' , 'assets/songs/audiofiles/Ado_GiraGira(song).mp3' , 'https://www.youtube.com/embed/sOiMD45QGLs' , 'PUNK'),
(17,'useewa' , 'ADO' , 'assets/songs/image/Ado_Usseewa_(image).jpg' , 'assets/songs/audiofiles/Ado_Useewa(song).mp3' , 'https://www.youtube.com/embed/Qp3b-RXtz4w' , 'PUNK'),
(18,'unravel' , 'ADO' , 'assets/songs/image/Ado_Unravel_(image).jpg' , 'assets/songs/audiofiles/Ado_unravel(song).mp3' , 'https://www.youtube.com/embed/eZuDklxsaRg' , 'ROCK'),
(19,'asan nahi yahan' , 'Arjit_singh' , 'assets/songs/image/Arjit_singh_aasan_nahin_yahan (image).jpg' , 'assets/songs/audiofiles/ArjitSingh_Aasan_Nahin_Yahan_(song).mp3' , 'https://www.youtube.com/embed/2b-S3ejc63E' , 'POP'),
(20,'ilahi' , 'Arjit_singh' , 'assets/songs/image/Arjit_singh_ilahi_(image).jpg' , 'assets/songs/audiofiles/ArjitSingh_Ilahi_(song).mp3' , 'https://www.youtube.com/embed/wM4xpaWV5s4' , 'POP'),
(21,'tum hi ho' , 'Arjit_singh' , 'assets/songs/image/Artjit_singh_Tum_Hi_Ho_(image).jpeg' , 'assets/songs/audiofiles/ArjitSingh_Tum_Hi_Ho+(song).mp3' , 'https://www.youtube.com/embed/10iV-krF-6g' , 'PUNK'),
(22,'dil main chupa lunga' , 'arman_malik' , 'assets/songs/image/Armaan Malik dil mein chuppa lounga (image).jpg' , 'assets/songs/audiofiles/ArmaanMalik_DilMeinChhupaLoonga(song).mp3' , 'https://www.youtube.com/embed/GW_PRQMzOEc' , 'POP'),
(23,'tumhe apna banany ka' , 'arman_malik' , 'assets/songs/image/Armaan Malik tumhe apna banane ka junoon (image).jpg' , 'assets/songs/audiofiles/ArmaanMalik_TumheApnaBananeKa(song).mp3' , 'https://www.youtube.com/embed/FFLNN0OrtnA' , 'POP'),
(24,'wajah tum ho' , 'arman_malik' , 'assets/songs/image/Armaan Malik wajah tum ho (image).jpg' , 'assets/songs/audiofiles/ArmaanMalik_WAJAHTUMHO(song).mp3' , 'https://www.youtube.com/embed/o6rpRCyDBZE' , 'POP'),
(25,'mere humsafar', 'tulsi_kumar' , 'assets/songs/image/Tulsi_Kumar_mere-hamsafar_(image).jpg' , 'assets/songs/audiofiles/Tulsi_Kumar_MereHumsafar(song).mp3' , 'https://www.youtube.com/embed/nBLYHFwIyYA' , 'PUNK'),
(26,'soch na sake' , 'tulsi_kumar' , 'assets/songs/image/Tulsi_Kumar_Soch-Na-Sake_(image).jpg' , 'assets/songs/audiofiles/Tulsi_Kumar_SochNaSake(song).mp3' , 'https://www.youtube.com/embed/MRtRcTfszjY' , 'POP'),
(27,'wajah tum ho' , 'tulsi_kumar' , 'assets/songs/image/Tulsi_Kumar_Wajah-Tum-Ho_(image).jpg' , 'assets/songs/audiofiles/Tulsi_kumar_WajahTumHo(Song).mp3' , 'https://www.youtube.com/embed/6TnqOitoJ9Q' , 'POP'),
(28,'DOORIE' , 'ATIF ASLAM' , 'assets/songs/image/atif_aslam_doorie (image).jpg' ,'assets/songs/audiofiles/Atif_aslam_Doorie(song).mp3' , 'https://www.youtube.com/embed/Jv2Z9KJgYjU?si=6xq0DnZWGO6qMR1b' , 'Classical'),
(29,'Kuch-Is-Tarah' , 'ATIF ASLAM' , 'assets/songs/image/Atif_aslam_Kuch-Is-Tarah (image).jpg' , 'assets/songs/audiofiles/Atif_aslam_KuchIsTarah(song).mp3' , 'https://www.youtube.com/embed/jjk-nmsXYhw?si=i1LlAYua4ySDsMkl' , 'Classical'),
(30,'Mahiya-Ve-Soniya' , 'ATIF ASLAM' , 'assets/songs/image/atif_aslam_mahiya ve soniya(image).jpg' , 'assets/songs/audiofiles/Atif_aslam_MahiyaVeSoniya(song).mp3' , 'https://www.youtube.com/embed/hnlhpj986bA?si=0ONij9NVyqBg2jT3' , 'POP'),
(31,'Real Talk' , 'Young Stunners' , 'assets/songs/image/young stunners_real talk (image).jpg' , 'assets/songs/audiofiles/Young_Stunners_RealTalk(song).mp3' , 'https://www.youtube.com/embed/h2E2wiz3sug?si=jPbLtppxKff5UiwL' , 'RAP'),
(32,'Jhoolay-Lal' , 'Young Stunners' , 'assets/songs/image/young_stunners_jhoolay_lal_(image).jpg' , 'assets/songs/audiofiles/Young_Stunners_JHOOLAYLAAL(song).mp3' , 'https://www.youtube.com/embed/Pb3MM4-3Hik?si=u2KAp3O7NBoWZA7T' , 'RAP'),
(33,'Uber' , 'Young Stunners' , 'assets/songs/image/Young_stunners_uber (image).PNG' , 'assets/songs/audiofiles/Young_Stunners_UBER(song).mp3' , 'https://www.youtube.com/embed/Q1RUQAVXRzM?si=EUNcKzmYW30gP3dT' , 'RAP'),
(34,'Secrets' , 'Umair' , 'assets/songs/image/Umair - Secrets (image).jpg' , 'assets/songs/audiofiles/Umair_Secrets(song).mp3' , 'https://www.youtube.com/embed/PzU2ru1kcJw?si=IH56p4aiuVG7zRRM' , 'RAP'),
(35,'Happy_Hour' , 'Umair' , 'assets/songs/image/Umair_Happy_Hour (image).jpg' , 'assets/songs/audiofiles/Umair_HappyHour(song).mp3' , 'https://www.youtube.com/embed/wedNGWk-l0A?si=S7TfhlbGt6CR1kz6' , 'RAP'),
(36,'Downers_at_dusk' , 'Umair' , 'assets/songs/image/Umair_Downers_at_dusk (image).PNG' , 'assets/songs/audiofiles/Umair_DownersAtDusk(song).mp3' , 'https://www.youtube.com/embed/iWomYr2dlsM?si=1lmI1Zq2WUToffDS' , 'RAP'),
(37,'Nuestra Canción' , 'Monsieur Periné' , 'assets/songs/image/Monsieur Periné Nuestra Canción (image).jpg' , 'assets/songs/audiofiles/MonsieurPériné_Nuestracanción(song).mp3' , 'https://www.youtube.com/embed/2vODuvIdQvU?si=uYg4TpXT5rLtNbPu' , 'ALTERNATIVE'),
(38,'Bailar Contigo' , 'Monsieur Periné' , 'assets/songs/image/Monsieur Periné_Bailar Contigo(image).jpg' , 'assets/songs/audiofiles/MonsieurPeriné_BailarContigo(song).mp3' , 'https://www.youtube.com/embed/mT7_qIFBa3Y?si=aA3Wc-JIpIX9CvGZ' , 'ALTERNATIVE'),
(39,'No Hace Falta' , 'Monsieur Periné' , 'assets/songs/image/Monsieur Periné_No Hace Falta (image).jpg' , 'assets/songs/audiofiles/MonsieurPeriné_NoHaceFalta(song).mp3' , 'https://www.youtube.com/embed/WLzegpyRXu0?si=SarkCBgtif0e8mux' , 'ROCK'),
(40,'Despacito' , 'Luis Fonsi' , 'assets/songs/image/Luis_Fonsi_Despacito_(image).png' , 'assets/songs/audiofiles/LuisFonsi_Despacito(song).mp3' , 'https://www.youtube.com/embed/kJQP7kiw5Fk?si=JW4YgbNH6T7ZsFus' , 'POP'),
(41, 'Échame_la_Culpa', 'Luis Fonsi', 'assets/songs/image/Luis_Fonsi_Échame_la_Culpa (image).jpg', 'assets/songs/audiofiles/LuisFonsi_ÉchameLaCulpa(song).mp3', 'https://www.youtube.com/embed/TyHvyGVs42U?si=KQ16vAo5sYvxw64C', 'POP'),
(42, 'Sola', 'Luis Fonsi', 'assets/songs/image/Luis_fonsi_Sola_(image).jpg', 'assets/songs/audiofiles/LuisFonsi_Sola(song).mp3', 'https://www.youtube.com/embed/PmFarK4gFRk?si=ESJf4NZTfcB8Zb-0', 'POP'),
(43, 'Amarillo', 'J Balvin', 'assets/songs/image/J Balvin_Amarillo (image).jpg', 'assets/songs/audiofiles/JBalvinAmarillo(song).mp3', 'https://www.youtube.com/embed/1-TaqM-Bklw?si=4iOjWpOhVbsogv6Z', 'RAP'),
(44, 'Morado', 'J Balvin', 'assets/songs/image/j balvin_morado(image).png', 'assets/songs/audiofiles/JBalvinMorado(song).mp3', 'https://www.youtube.com/embed/d5ZVaWxkAaQ?si=zVr4F3qZWjoqiONj', 'RAP'),
(45, 'Rojo', 'J Balvin', 'assets/songs/image/j balvin_rojo (image).jpg', 'assets/songs/audiofiles/JBalvinRojo(Songs).mp3', 'https://www.youtube.com/embed/_tG70FWd1Ds?si=u0BowQ5VAskBIRLh', 'POP'),
(46, 'Du Bist', 'PRINZ PI', 'assets/songs/image/prinz pi du bist(image).jpg', 'assets/songs/audiofiles/PrinzPi_Dubist(song).mp3', 'https://www.youtube.com/embed/dcfXE9jaCUo?si=MWO6POeihQAZ2V4P', 'RAP'),
(47, 'Kompass Ohne Norden', 'PRINZ PI', 'assets/songs/image/Prinz Pi Kompass Ohne Norden (image).jpg', 'assets/songs/audiofiles/PrinzPi_KompassohneNorden(song).mp3', 'https://www.youtube.com/embed/UPOgrtlc_ds?si=5yDY8r-iQOPUo5dt', 'RAP'),
(48, '100X', 'PRINZ PI', 'assets/songs/image/prinz pi 100X_(image).jpg', 'assets/songs/audiofiles/PrinzPi_100x(song).mp3', 'https://www.youtube.com/embed/jqNOWRIv-ss?si=rof3q_nobdPRh7_f', 'RAP'),
(49, 'Auf-Uns', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Auf-uns_(image).jpg', 'assets/songs/audiofiles/AndreasBourani_Aufuns!(song).mp3', 'https://www.youtube.com/embed/pg9k-lAM7M8?si=7LykoD_eGC2wRQc-', 'POP'),
(50, 'Delirium', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Delirium_(image).jpg', 'assets/songs/audiofiles/AndreasBourani_Delirium(song).mp3', 'https://www.youtube.com/embed/-GAiFbtD3I4?si=64dgw75y0qNW-SKO', 'POP'),
(51, 'Ultraleicht', 'Andreas Bourani', 'assets/songs/image/Andreas Bourani Ultraleicht (image).jpg', 'assets/songs/audiofiles/AndreasBourani_Ultraleicht(song).mp3', 'https://www.youtube.com/embed/pqkLSrh7JGE?si=WBwfJSGDT_oTKoCH', 'POP'),
(52, 'Marie', 'AnnenMaykantereit', 'assets/songs/image/AnnenMayKantereit Marie (image).jpg', 'assets/songs/audiofiles/AnnenMayKantereit_Marie(song).mp3', 'https://www.youtube.com/embed/kpviEKrWysA?si=4mqfIQugwEuwNyOb', 'ALTERNATIVE'),
(53, 'Schon Krass', 'AnnenMaykantereit', 'assets/songs/image/AnnenMayKantereit Schon Krass (image).PNG', 'assets/songs/audiofiles/AnnenMayKantereit_SchonKrass(song).mp3', 'https://www.youtube.com/embed/wlWNbByDa78?si=ar8Q9fHBb0AdUSQg', 'ROCK'),
(54, 'Vielleicht Vielleicht', 'AnnenMaykantereit', 'assets/songs/image/AnnenMayKantereit Vielleicht Vielleicht (image).jpg', 'assets/songs/audiofiles/AnnenMayKantereit_VielleichtVielleicht(song).mp3', 'https://www.youtube.com/embed/kjFAlDksz5A?si=fkBGn0Geq3fYQTsm', 'ALTERNATIVE');
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
