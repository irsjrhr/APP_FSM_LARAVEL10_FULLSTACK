-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 25, 2025 at 03:11 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_course`
--

DROP TABLE IF EXISTS `data_course`;
CREATE TABLE IF NOT EXISTS `data_course` (
  `id_course` int(11) NOT NULL AUTO_INCREMENT,
  `user_admin` varchar(100) NOT NULL,
  `nama_course` varchar(100) NOT NULL,
  `deskripsi_course` text NOT NULL,
  `waktu` date NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id_course`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_course`
--

INSERT INTO `data_course` (`id_course`, `user_admin`, `nama_course`, `deskripsi_course`, `waktu`, `status`) VALUES
(62, 'admin', 'admin', 'admin\r\n', '2025-08-15', 'ACTIVE'),
(63, 'admin', 'Testing ', 'sada', '2025-08-15', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `data_course_peserta`
--

DROP TABLE IF EXISTS `data_course_peserta`;
CREATE TABLE IF NOT EXISTS `data_course_peserta` (
  `id_course_peserta` int(11) NOT NULL AUTO_INCREMENT,
  `id_course` varchar(100) NOT NULL,
  `user_peserta` varchar(100) NOT NULL,
  `status_peserta` varchar(100) NOT NULL,
  `waktu` date NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id_course_peserta`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_course_peserta`
--

INSERT INTO `data_course_peserta` (`id_course_peserta`, `id_course`, `user_peserta`, `status_peserta`, `waktu`, `status`) VALUES
(45, '63', 'sandi', '', '2025-08-15', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `data_file`
--

DROP TABLE IF EXISTS `data_file`;
CREATE TABLE IF NOT EXISTS `data_file` (
  `id_file` int(11) NOT NULL AUTO_INCREMENT,
  `user_admin` varchar(100) NOT NULL,
  `tipe_penyimpanan` varchar(100) NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  `source_file` text NOT NULL,
  `status` varchar(100) NOT NULL,
  `waktu` date NOT NULL,
  PRIMARY KEY (`id_file`)
) ENGINE=MyISAM AUTO_INCREMENT=208 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_file`
--

INSERT INTO `data_file` (`id_file`, `user_admin`, `tipe_penyimpanan`, `nama_file`, `source_file`, `status`, `waktu`) VALUES
(207, 'admin', 'cloud', 'File cloud', 'https://nos.wjv-1.neo.id/certara/uploads/Frame%20Detail%20Absensi.png', 'ACTIVE', '2025-08-23'),
(206, 'admin', 'lokal', 'Filee ', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68a9d83199476_file_admin2025-08-23_68a9d8319947c.png', 'ACTIVE', '2025-08-23'),
(205, 'admin', 'lokal', 'File baru', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68a9d8235475e_file_admin2025-08-23_68a9d82354762.png', 'ACTIVE', '2025-08-23');

-- --------------------------------------------------------

--
-- Table structure for table `data_lesson`
--

DROP TABLE IF EXISTS `data_lesson`;
CREATE TABLE IF NOT EXISTS `data_lesson` (
  `id_lesson` int(11) NOT NULL AUTO_INCREMENT,
  `id_course` varchar(100) NOT NULL,
  `user_admin` varchar(100) NOT NULL,
  `nama_lesson` varchar(100) NOT NULL,
  `deskripsi_lesson` text NOT NULL,
  `status_absensi` varchar(100) NOT NULL,
  `status_live` varchar(100) NOT NULL,
  `id_file_video` varchar(100) NOT NULL,
  `source_file_video` text NOT NULL,
  `waktu` date NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id_lesson`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_lesson`
--

INSERT INTO `data_lesson` (`id_lesson`, `id_course`, `user_admin`, `nama_lesson`, `deskripsi_lesson`, `status_absensi`, `status_live`, `id_file_video`, `source_file_video`, `waktu`, `status`) VALUES
(64, '62', 'admin', 'Lesson Testing', 'sajdahsbd     ', 'ACTIVE', 'ACTIVE', '149', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin66/68a980888129b_file_admin662025-08-23_68a98088812a0.mp4', '2025-08-23', 'ACTIVE'),
(63, '63', 'admin', 'Lesson 99', 'asdasd\r\n', 'DISABLED', 'ACTIVE', '139', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68a48e44737d0_file_admin2025-08-19_68a48e44738ba.mp4', '2025-08-20', 'ACTIVE'),
(61, '63', 'admin', 'Lesson Intro', 'sdasd     ', 'ACTIVE', 'DISABLED', '139', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68a48e44737d0_file_admin2025-08-19_68a48e44738ba.mp4', '2025-08-19', 'ACTIVE'),
(62, '63', 'admin', 'Lesson5', '     ', 'ACTIVE', 'ACTIVE', '', '', '2025-08-19', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `data_lesson_media`
--

DROP TABLE IF EXISTS `data_lesson_media`;
CREATE TABLE IF NOT EXISTS `data_lesson_media` (
  `id_lesson_media` int(11) NOT NULL AUTO_INCREMENT,
  `id_lesson` varchar(100) NOT NULL,
  `nama_media` varchar(100) NOT NULL,
  `id_file` varchar(100) NOT NULL,
  `source_file` text NOT NULL,
  `deskripsi_media` text NOT NULL,
  `waktu` date NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id_lesson_media`)
) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_lesson_media`
--

INSERT INTO `data_lesson_media` (`id_lesson_media`, `id_lesson`, `nama_media`, `id_file`, `source_file`, `deskripsi_media`, `waktu`, `status`) VALUES
(102, '64', 'sdasd', '148', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin66/68a9805b2af19_file_admin662025-08-23_68a9805b2af1e.JPG', '', '2025-08-23', 'ACTIVE'),
(101, '63', 'Media 1s', '141', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68a51e3e64065_file_admin2025-08-20_68a51e3e64069.JPG', '', '2025-08-20', 'ACTIVE'),
(100, '62', 'SAASD', '139', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68a48e44737d0_file_admin2025-08-19_68a48e44738ba.mp4', '', '2025-08-19', 'ACTIVE'),
(99, '61', 'Media 1', '139', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68a48e44737d0_file_admin2025-08-19_68a48e44738ba.mp4', '', '2025-08-19', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `data_lesson_quiz`
--

DROP TABLE IF EXISTS `data_lesson_quiz`;
CREATE TABLE IF NOT EXISTS `data_lesson_quiz` (
  `id_lesson_quiz` int(11) NOT NULL AUTO_INCREMENT,
  `id_lesson` int(11) NOT NULL,
  `nama_quiz` varchar(100) NOT NULL,
  `deskripsi_quiz` text NOT NULL,
  `passing_grade` int(11) NOT NULL,
  `batas_waktu` date NOT NULL,
  `durasi_waktu` int(11) NOT NULL,
  `status_quiz` varchar(100) NOT NULL,
  `id_file` varchar(100) NOT NULL,
  `source_file` text NOT NULL,
  `waktu` date NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id_lesson_quiz`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_lesson_quiz`
--

INSERT INTO `data_lesson_quiz` (`id_lesson_quiz`, `id_lesson`, `nama_quiz`, `deskripsi_quiz`, `passing_grade`, `batas_waktu`, `durasi_waktu`, `status_quiz`, `id_file`, `source_file`, `waktu`, `status`) VALUES
(20, 61, 'Quiz 1', 'SDSAHSD', 31, '2025-08-27', 30, 'DISABLED', '139', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68a48e44737d0_file_admin2025-08-19_68a48e44738ba.mp4', '2025-08-19', 'ACTIVE'),
(21, 63, 'Quiz 99', 'Quiz sebagai bahan pembelajaran', 20, '2025-08-31', 70, 'DISABLED', '139', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68a48e44737d0_file_admin2025-08-19_68a48e44738ba.mp4', '2025-08-20', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `data_lesson_tugas`
--

DROP TABLE IF EXISTS `data_lesson_tugas`;
CREATE TABLE IF NOT EXISTS `data_lesson_tugas` (
  `id_lesson_tugas` int(11) NOT NULL AUTO_INCREMENT,
  `id_lesson` int(11) NOT NULL,
  `nama_tugas` varchar(100) NOT NULL,
  `deskripsi_tugas` text NOT NULL,
  `batas_waktu` date NOT NULL,
  `id_file` varchar(100) NOT NULL,
  `source_file` text NOT NULL,
  `status_tugas` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `waktu` date NOT NULL,
  PRIMARY KEY (`id_lesson_tugas`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_lesson_tugas`
--

INSERT INTO `data_lesson_tugas` (`id_lesson_tugas`, `id_lesson`, `nama_tugas`, `deskripsi_tugas`, `batas_waktu`, `id_file`, `source_file`, `status_tugas`, `status`, `waktu`) VALUES
(42, 63, 'Tugas 69', 'Tugas ini merupakan sebagai bahan pembelajaran ', '2025-08-31', '141', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68a51e3e64065_file_admin2025-08-20_68a51e3e64069.JPG', 'DISABLED', 'ACTIVE', '2025-08-20'),
(41, 61, 'Tugas 1', 'sdbashdas', '2025-08-31', '139', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68a48e44737d0_file_admin2025-08-19_68a48e44738ba.mp4', 'DISABLED', 'ACTIVE', '2025-08-19');

-- --------------------------------------------------------

--
-- Table structure for table `data_level`
--

DROP TABLE IF EXISTS `data_level`;
CREATE TABLE IF NOT EXISTS `data_level` (
  `id_level` int(11) NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(100) NOT NULL,
  `user_admin` varchar(100) NOT NULL,
  `waktu` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_level`
--

INSERT INTO `data_level` (`id_level`, `nama_level`, `user_admin`, `waktu`, `status`) VALUES
(18, 'admin', 'admin', '2025-07-10', 'ACTIVE'),
(19, 'mentor', 'admin', '2025-07-10', 'ACTIVE'),
(20, 'user', 'admin', '2025-07-10', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `data_submission_absensi`
--

DROP TABLE IF EXISTS `data_submission_absensi`;
CREATE TABLE IF NOT EXISTS `data_submission_absensi` (
  `id_submission_absensi` int(11) NOT NULL AUTO_INCREMENT,
  `id_lesson` varchar(100) NOT NULL,
  `user_peserta` varchar(100) NOT NULL,
  `waktu` date NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id_submission_absensi`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_submission_absensi`
--

INSERT INTO `data_submission_absensi` (`id_submission_absensi`, `id_lesson`, `user_peserta`, `waktu`, `status`) VALUES
(17, '63', 'admin', '2025-08-20', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `data_submission_quiz`
--

DROP TABLE IF EXISTS `data_submission_quiz`;
CREATE TABLE IF NOT EXISTS `data_submission_quiz` (
  `id_submission_quiz` int(11) NOT NULL AUTO_INCREMENT,
  `id_lesson_quiz` varchar(100) NOT NULL,
  `id_lesson` varchar(100) NOT NULL,
  `user_peserta` varchar(100) NOT NULL,
  `nilai` int(11) NOT NULL,
  `waktu` date NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id_submission_quiz`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_submission_quiz`
--

INSERT INTO `data_submission_quiz` (`id_submission_quiz`, `id_lesson_quiz`, `id_lesson`, `user_peserta`, `nilai`, `waktu`, `status`) VALUES
(33, '21', '63', 'admin', 20, '2025-08-20', 'ACTIVE'),
(32, '20', '61', 'sandi', 0, '2025-08-19', 'ACTIVE'),
(31, '20', '61', 'admin', 20, '2025-08-19', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `data_submission_tugas`
--

DROP TABLE IF EXISTS `data_submission_tugas`;
CREATE TABLE IF NOT EXISTS `data_submission_tugas` (
  `id_submission_tugas` int(11) NOT NULL AUTO_INCREMENT,
  `id_lesson_tugas` varchar(100) NOT NULL,
  `id_lesson` varchar(100) NOT NULL,
  `user_peserta` varchar(100) NOT NULL,
  `id_file` varchar(100) NOT NULL,
  `source_file` text NOT NULL,
  `catatan_submission` text NOT NULL,
  `nilai` varchar(100) NOT NULL,
  `catatan_mentor` text NOT NULL,
  `status` varchar(100) NOT NULL,
  `waktu` date NOT NULL,
  PRIMARY KEY (`id_submission_tugas`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_submission_tugas`
--

INSERT INTO `data_submission_tugas` (`id_submission_tugas`, `id_lesson_tugas`, `id_lesson`, `user_peserta`, `id_file`, `source_file`, `catatan_submission`, `nilai`, `catatan_mentor`, `status`, `waktu`) VALUES
(35, '42', '63', 'admin', '141', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68a51e3e64065_file_admin2025-08-20_68a51e3e64069.JPG', 'Ini jawaban saya', '60', 'sdhahsdbhahsbdb', 'ACTIVE', '2025-08-20'),
(33, '41', '61', 'admin', '139', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68a48e44737d0_file_admin2025-08-19_68a48e44738ba.mp4', 'sdvasdas', '30', 'kkk', 'ACTIVE', '2025-08-19'),
(34, '41', '61', 'sandi', '140', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/sandi/68a4925640db4_file_sandi2025-08-19_68a4925640db7.mp4', 'dbashdashd', '0', '', 'ACTIVE', '2025-08-19');

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

DROP TABLE IF EXISTS `data_user`;
CREATE TABLE IF NOT EXISTS `data_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(100) NOT NULL,
  `user_pembuat` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_file_profile` varchar(100) NOT NULL,
  `source_file_profile` text NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  `waktu` date NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`id_user`, `user`, `user_pembuat`, `password`, `id_file_profile`, `source_file_profile`, `nama`, `alamat`, `email`, `level`, `waktu`, `status`) VALUES
(58, 'sandi', 'admin', 'admin', '128', 'https://nos.wjv-1.neo.id/certara/uploads/undefined(11).png', 'Irshandy Juniar Hardadi ', 'Perum Puri Mekar Blok I No 3, RT 004', 'irshandy.juniar88@gmail.com', 'user', '2025-08-15', 'ACTIVE'),
(59, 'mentor1', 'admin', 'mentor', '144', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68a6808425dc2_file_admin2025-08-21_68a6808425dc6.jpg', 'njnn', 'NULL', 'mentor@gmail.com', 'mentor', '2025-08-15', 'ACTIVE'),
(60, 'admin', 'admin', 'admin', '141', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68a51e3e64065_file_admin2025-08-20_68a51e3e64069.JPG', 'shandss', 'NULL', 'irsgajjj@gmail.com', 'admin', '2025-08-31', ''),
(61, 'admin66', 'admin', 'admin', '148', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin66/68a9805b2af19_file_admin662025-08-23_68a9805b2af1e.JPG', 'ssssskk', 'NULL', 'admin@gmail.com', 'admin', '2025-08-20', 'ACTIVE'),
(62, 'shandddy', 'admin', 'admin', '141', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68a51e3e64065_file_admin2025-08-20_68a51e3e64069.JPG', 'shandss', 'NULL', 'irsgak@gmail.com', 'mentor', '2025-08-21', 'ACTIVE'),
(63, 'coba1', 'admin', 'admin', '141', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68a51e3e64065_file_admin2025-08-20_68a51e3e64069.JPG', 'coba12', 'NULL', 'coba@gmail.com', 'admin', '2025-08-21', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `live_participants`
--

DROP TABLE IF EXISTS `live_participants`;
CREATE TABLE IF NOT EXISTS `live_participants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `peer_id` varchar(50) NOT NULL,
  `role` enum('mentor','viewer') NOT NULL,
  `joined_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `live_participants`
--

INSERT INTO `live_participants` (`id`, `room_id`, `user_id`, `peer_id`, `role`, `joined_at`) VALUES
(1, 'Room4', 'user_7422', '6126e01b-85c4-4822-ac51-835240a0973f', 'mentor', '2025-08-10 14:40:03'),
(3, 'Room4', 'user_3782', '0335313a-b2a8-4305-8ff5-d84dd1809454', 'viewer', '2025-08-10 14:44:11'),
(4, 'Room4', 'user_8487', '6e4dda37-b473-451f-8fff-6b7a672bea47', 'mentor', '2025-08-10 14:44:50'),
(5, 'Room4', 'user_7739', 'faa71ecd-3097-48e9-92f4-c9d3702636d7', 'viewer', '2025-08-10 14:47:56'),
(6, 'Room4', 'user_9953', '80126895-130e-46e8-afd1-3800cec8ed41', 'mentor', '2025-08-10 14:51:08'),
(8, 'Room4', 'user_9910', '33acc428-f584-45d4-8aa0-d7bf55f3182b', 'viewer', '2025-08-10 14:51:25');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
