-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 15, 2025 at 06:39 PM
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
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

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
  `size_file_kb` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `waktu` date NOT NULL,
  PRIMARY KEY (`id_file`)
) ENGINE=MyISAM AUTO_INCREMENT=278 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_kategori_transaksi`
--

DROP TABLE IF EXISTS `data_kategori_transaksi`;
CREATE TABLE IF NOT EXISTS `data_kategori_transaksi` (
  `id_kategori_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) NOT NULL,
  `waktu` date NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kategori_transaksi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_level`
--

INSERT INTO `data_level` (`id_level`, `nama_level`, `user_admin`, `waktu`, `status`) VALUES
(21, 'admin', 'admin', '2025-08-27', 'ACTIVE'),
(22, 'mentor', 'admin', '2025-08-27', 'ACTIVE'),
(23, 'user', 'admin', '2025-08-27', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `data_quiz_soal`
--

DROP TABLE IF EXISTS `data_quiz_soal`;
CREATE TABLE IF NOT EXISTS `data_quiz_soal` (
  `id_quiz_soal` int(11) NOT NULL AUTO_INCREMENT,
  `id_lesson_quiz` int(11) NOT NULL,
  `soal` text NOT NULL,
  `pg1` varchar(255) NOT NULL,
  `pg2` varchar(255) NOT NULL,
  `pg3` varchar(255) NOT NULL,
  `pg4` varchar(255) NOT NULL,
  `kunci_jawaban` varchar(10) DEFAULT NULL,
  `id_file` varchar(50) DEFAULT NULL,
  `source_file` varchar(255) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'ACTIVE',
  `waktu` date NOT NULL,
  PRIMARY KEY (`id_quiz_soal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `status_absensi_peserta` enum('hadir','izin','alpa') NOT NULL,
  PRIMARY KEY (`id_submission_absensi`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_transaksi`
--

DROP TABLE IF EXISTS `data_transaksi`;
CREATE TABLE IF NOT EXISTS `data_transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi_kategori` varchar(100) NOT NULL,
  `user_admin` varchar(100) NOT NULL,
  `nama_transaksi` varchar(100) NOT NULL,
  `nominal_transaksi` int(11) NOT NULL,
  `catatan_transaksi` text NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `id_file` varchar(100) NOT NULL,
  `source_file` text NOT NULL,
  `waktu` date NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_transaksi`
--

INSERT INTO `data_transaksi` (`id_transaksi`, `id_transaksi_kategori`, `user_admin`, `nama_transaksi`, `nominal_transaksi`, `catatan_transaksi`, `waktu_transaksi`, `id_file`, `source_file`, `waktu`, `status`) VALUES
(1, '1', 'admin', 'sadhas', 4000, 'asa sdhabdsh', '2025-09-10', '', '', '2025-09-01', 'ACTIVE'),
(2, '1', 'admin', 'Transaksi 11', 2000, 'sadahsdbas', '2025-09-25', '', '', '2025-09-01', 'ACTIVE'),
(3, '1', 'admin', 'ssd', 20000, 'sdbahsd', '2025-09-29', '', '', '2025-09-14', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `data_transaksi_kategori`
--

DROP TABLE IF EXISTS `data_transaksi_kategori`;
CREATE TABLE IF NOT EXISTS `data_transaksi_kategori` (
  `id_transaksi_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `user_admin` varchar(100) NOT NULL,
  `nama_transaksi_kategori` varchar(100) NOT NULL,
  `deskripsi_transaksi_kategori` text NOT NULL,
  `waktu` date NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id_transaksi_kategori`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_transaksi_pemasukan`
--

DROP TABLE IF EXISTS `data_transaksi_pemasukan`;
CREATE TABLE IF NOT EXISTS `data_transaksi_pemasukan` (
  `id_transaksi_pemasukan` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi_kategori` varchar(100) NOT NULL,
  `user_admin` varchar(100) NOT NULL,
  `nama_transaksi` varchar(100) NOT NULL,
  `nominal_transaksi` int(11) NOT NULL,
  `catatan_transaksi` text NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `id_file` varchar(100) NOT NULL,
  `source_file` text NOT NULL,
  `waktu` date NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id_transaksi_pemasukan`)
) ENGINE=MyISAM AUTO_INCREMENT=128 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_transaksi_pengeluaran`
--

DROP TABLE IF EXISTS `data_transaksi_pengeluaran`;
CREATE TABLE IF NOT EXISTS `data_transaksi_pengeluaran` (
  `id_transaksi_pengeluaran` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi_kategori` varchar(100) NOT NULL,
  `user_admin` varchar(100) NOT NULL,
  `nama_transaksi` varchar(100) NOT NULL,
  `nominal_transaksi` int(11) NOT NULL,
  `catatan_transaksi` text NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `id_file` varchar(100) NOT NULL,
  `source_file` text NOT NULL,
  `waktu` date NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id_transaksi_pengeluaran`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`id_user`, `user`, `user_pembuat`, `password`, `id_file_profile`, `source_file_profile`, `nama`, `alamat`, `email`, `level`, `waktu`, `status`) VALUES
(60, 'admin', 'admin', 'admin', '268', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68b5667f1ac83_file_admin2025-09-01_68b5667f1ac92.JPG', 'shandss', 'NULL', 'admin@gmail.com', 'admin', '2025-08-31', 'ACTIVE');

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
