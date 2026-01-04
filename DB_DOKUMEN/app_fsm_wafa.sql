-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 04, 2026 at 04:44 PM
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
-- Database: `app_fsm_wafa`
--

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
) ENGINE=MyISAM AUTO_INCREMENT=302 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_file`
--

INSERT INTO `data_file` (`id_file`, `user_admin`, `tipe_penyimpanan`, `nama_file`, `source_file`, `size_file_kb`, `status`, `waktu`) VALUES
(286, 'admin', 'lokal', 'sadsd', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68d98bdfbf575_file_admin2025-09-28_68d98bdfbf57a.php', 12, 'ACTIVE', '2025-09-28'),
(287, 'admin', 'lokal', 'sql', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68d98c8c3a8f5_file_admin2025-09-28_68d98c8c3a8f9.sql', 18, 'ACTIVE', '2025-09-28'),
(288, 'admin', 'lokal', 'python kode', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68d98cdef1949_file_admin2025-09-28_68d98cdef1951.py', 0, 'ACTIVE', '2025-09-28'),
(289, 'admin', 'lokal', 'Tugas PY', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68d98d53c97a1_file_admin2025-09-28_68d98d53c97a5.py', 25, 'ACTIVE', '2025-09-28'),
(290, 'admin', 'lokal', 'TA ', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68d98dd711721_file_admin2025-09-28_68d98dd711724.docx', 8567, 'ACTIVE', '2025-09-28'),
(291, 'admin', 'cloud', 'TA Cloud', 'https://nos.wjv-1.neo.id/certara/uploads/TA%2C%20LMS%20CERTARA.docx', 8567, 'ACTIVE', '2025-09-28'),
(292, 'admin', 'lokal', 'BAB 1', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68d992ab3b7e4_file_admin2025-09-28_68d992ab3b7e8.pdf', 142, 'ACTIVE', '2025-09-28'),
(293, 'admin', 'lokal', 'Porto', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68d992dc7db85_file_admin2025-09-28_68d992dc7db88.mp4', 27793, 'ACTIVE', '2025-09-28'),
(294, 'admin', 'lokal', 'sdsa', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68d9981611b81_file_admin2025-09-28_68d9981611b89.txt', 0, 'ACTIVE', '2025-09-28'),
(295, 'admin', 'lokal', 's', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68d99a67064f9_file_admin2025-09-28_68d99a67064fe.txt', 0, 'ACTIVE', '2025-09-28'),
(296, 'admin', 'lokal', 'fh', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68d99b4aaeadf_file_admin2025-09-28_68d99b4aaeae4.txt', 0, 'ACTIVE', '2025-09-28'),
(297, 'admin', 'lokal', 'c', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68d99b9f6177a_file_admin2025-09-28_68d99b9f6177d.txt', 9, 'ACTIVE', '2025-09-28'),
(298, 'admin', 'lokal', 'sds', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68ef0abf4bcb9_file_admin2025-10-15_68ef0abf4be7c.png', 143, 'ACTIVE', '2025-10-15'),
(299, 'admin', 'cloud', 'asasda', 'https://nos.wjv-1.neo.id/certara/uploads/CASUAL-removebg-preview.jpg', 40, 'ACTIVE', '2025-10-15'),
(300, 'admin', 'lokal', 'hh', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/690371690bff0_file_admin2025-10-30_690371690bfff.txt', 4, 'ACTIVE', '2025-10-30'),
(301, 'admin', 'lokal', 'ss', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_FSM_WAFA/service_file/asset_storage/admin/6928974a2353d_file_admin2025-11-27_6928974a236bb.pdf', 198, 'ACTIVE', '2025-11-27');

-- --------------------------------------------------------

--
-- Table structure for table `data_level`
--

DROP TABLE IF EXISTS `data_level`;
CREATE TABLE IF NOT EXISTS `data_level` (
  `id_level` int(11) NOT NULL AUTO_INCREMENT,
  `nama_level` enum('admin','teknisi','user','') NOT NULL,
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
(22, 'teknisi', 'admin', '2025-08-27', 'ACTIVE'),
(23, 'user', 'admin', '2025-08-27', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `data_produk`
--

DROP TABLE IF EXISTS `data_produk`;
CREATE TABLE IF NOT EXISTS `data_produk` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(100) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `id_file_thumb` varchar(100) NOT NULL,
  `source_file_thumb` text NOT NULL,
  `user_pembuat` varchar(100) NOT NULL,
  `waktu` date NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_produk`
--

INSERT INTO `data_produk` (`id_produk`, `nama_produk`, `deskripsi_produk`, `harga_produk`, `id_file_thumb`, `source_file_thumb`, `user_pembuat`, `waktu`, `status`) VALUES
(1, 'Produk A', '', 150000, 'thumb_001', '/images/thumb_001.jpg', 'user1', '2026-01-01', 'ACTIVE'),
(2, 'Produk B', '', 250000, 'thumb_002', '/images/thumb_002.jpg', 'user2', '2026-01-02', 'ACTIVE'),
(3, 'Produk C', '', 100000, 'thumb_003', '/images/thumb_003.jpg', 'user3', '2026-01-03', 'ACTIVE'),
(4, 'Produk D', '', 175000, 'thumb_004', '/images/thumb_004.jpg', 'user1', '2026-01-04', 'ACTIVE'),
(5, 'Produk E', '', 300000, 'thumb_005', '/images/thumb_005.jpg', 'user4', '2026-01-05', 'ACTIVE'),
(6, 'Produk F', '', 120000, 'thumb_006', '/images/thumb_006.jpg', 'user2', '2026-01-06', 'ACTIVE'),
(7, 'Produk G', '', 200000, 'thumb_007', '/images/thumb_007.jpg', 'user3', '2026-01-07', 'ACTIVE'),
(8, 'Produk H', '', 220000, 'thumb_008', '/images/thumb_008.jpg', 'user4', '2026-01-08', 'ACTIVE'),
(9, 'Produk I', '', 180000, 'thumb_009', '/images/thumb_009.jpg', 'user1', '2026-01-09', 'ACTIVE'),
(10, 'Produk J', '', 275000, 'thumb_010', '/images/thumb_010.jpg', 'user2', '2026-01-10', 'ACTIVE'),
(11, 'ada', 'asd', 222, '301', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_FSM_WAFA/service_file/asset_storage/admin/6928974a2353d_file_admin2025-11-27_6928974a236bb.pdf', 'admin', '2002-01-26', 'ACTIVE'),
(12, 'sadad', 'asd', 2222, '301', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_FSM_WAFA/service_file/asset_storage/admin/6928974a2353d_file_admin2025-11-27_6928974a236bb.pdf', 'admin', '2002-01-26', 'ACTIVE'),
(13, 'sadadkk', 'asd', 2222, '301', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_FSM_WAFA/service_file/asset_storage/admin/6928974a2353d_file_admin2025-11-27_6928974a236bb.pdf', 'admin', '2002-01-26', 'ACTIVE'),
(14, 'sadadkkkk', 'asd', 2222, '301', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_FSM_WAFA/service_file/asset_storage/admin/6928974a2353d_file_admin2025-11-27_6928974a236bb.pdf', 'admin', '2002-01-26', 'ACTIVE'),
(15, 'sad', 's', 2, '299', 'https://nos.wjv-1.neo.id/certara/uploads/CASUAL-removebg-preview.jpg', 'admin', '2003-01-26', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `data_project`
--

DROP TABLE IF EXISTS `data_project`;
CREATE TABLE IF NOT EXISTS `data_project` (
  `id_project` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) NOT NULL,
  `user_teknisi` varchar(100) NOT NULL,
  `user_client` varchar(100) NOT NULL,
  `nama_project` varchar(100) NOT NULL,
  `deskripsi_project` text NOT NULL,
  `id_dokumen_project` varchar(100) NOT NULL,
  `source_dokumen_project` text NOT NULL,
  `lok_long` varchar(100) NOT NULL,
  `lok_lat` varchar(100) NOT NULL,
  `waktu_mulai_project` date NOT NULL,
  `waktu_selesai_project` date NOT NULL,
  `status_project` enum('PENDING','TODO','PROGRESS','COMPLETED') NOT NULL,
  `user_pembuat` varchar(100) NOT NULL,
  `waktu` date NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id_project`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_project`
--

INSERT INTO `data_project` (`id_project`, `id_produk`, `user_teknisi`, `user_client`, `nama_project`, `deskripsi_project`, `id_dokumen_project`, `source_dokumen_project`, `lok_long`, `lok_lat`, `waktu_mulai_project`, `waktu_selesai_project`, `status_project`, `user_pembuat`, `waktu`, `status`) VALUES
(1, 1, 'didi', 'dada', 'Project A', 'Deskripsi Project A', 'DOC001', '/dokumen/doc1.pdf', '106.827153', '-6.175110', '2026-01-01', '2026-01-10', 'PROGRESS', 'admin', '2026-01-01', 'ACTIVE'),
(2, 2, 'didi', 'dada', 'Project B', 'Deskripsi Project B', 'DOC002', '/dokumen/doc2.pdf', '106.828000', '-6.176000', '2026-01-02', '2026-01-12', 'PROGRESS', 'admin', '2026-01-02', 'ACTIVE'),
(3, 3, 'didi', 'dada', 'Project C', 'Deskripsi Project C', 'DOC003', '/dokumen/doc3.pdf', '106.829000', '-6.177000', '2026-01-03', '2026-01-13', 'PENDING', 'admin', '2026-01-03', 'ACTIVE'),
(4, 4, 'didi', 'dada', 'Project D', 'Deskripsi Project D', 'DOC004', '/dokumen/doc4.pdf', '106.830000', '-6.178000', '2026-01-04', '2026-01-14', 'COMPLETED', 'admin', '2026-01-04', 'ACTIVE'),
(5, 5, 'didi', 'dada', 'Project E', 'Deskripsi Project E', 'DOC005', '/dokumen/doc5.pdf', '106.831000', '-6.179000', '2026-01-05', '2026-01-15', 'PROGRESS', 'admin', '2026-01-05', 'ACTIVE'),
(6, 6, 'didi', 'dada', 'Project F', 'Deskripsi Project F', 'DOC006', '/dokumen/doc6.pdf', '106.832000', '-6.180000', '2026-01-06', '2026-01-16', 'PENDING', 'admin', '2026-01-06', 'ACTIVE'),
(7, 7, 'didi', 'dada', 'Project G', 'Deskripsi Project G', 'DOC007', '/dokumen/doc7.pdf', '106.833000', '-6.181000', '2026-01-07', '2026-01-17', 'PROGRESS', 'admin', '2026-01-07', 'ACTIVE'),
(8, 8, 'didi', 'dada', 'Project H', 'Deskripsi Project H', 'DOC008', '/dokumen/doc8.pdf', '106.834000', '-6.182000', '2026-01-08', '2026-01-18', 'COMPLETED', 'admin', '2026-01-08', 'ACTIVE'),
(9, 9, 'didi', 'dada', 'Project I', 'Deskripsi Project I', 'DOC009', '/dokumen/doc9.pdf', '106.835000', '-6.183000', '2026-01-09', '2026-01-19', 'PROGRESS', 'admin', '2026-01-09', 'ACTIVE'),
(10, 10, 'didi', 'dada', 'Project J', 'Deskripsi Project J', 'DOC010', '/dokumen/doc10.pdf', '106.836000', '-6.184000', '2026-01-10', '2026-01-20', 'PENDING', 'admin', '2026-01-10', 'ACTIVE');

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
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`id_user`, `user`, `user_pembuat`, `password`, `id_file_profile`, `source_file_profile`, `nama`, `alamat`, `email`, `level`, `waktu`, `status`) VALUES
(60, 'admin', 'admin', 'admin', '280', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/service_file/asset_storage/admin/68ca56dde7e2a_file_admin2025-09-17_68ca56dde7f56.JPG', 'admin', 'NULL', 'admin@gmail.com', 'admin', '2025-08-31', 'ACTIVE'),
(66, 'didi', 'admin', 'admin', '', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/asset/gam/user_default.png', 'didi', 'NULL', 'didi@gmail.com', 'teknisi', '2025-09-30', 'ACTIVE'),
(67, 'dada', 'admin', 'admin', '', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/asset/gam/user_default.png', 'dada', 'NULL', 'dada@gmail.com', 'user', '2025-10-02', 'ACTIVE'),
(68, 'dudu', 'admin', 'admin', '', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/asset/gam/user_default.png', 'dudu', 'NULL', 'dudu@gmail..com', 'teknisi', '2025-10-02', 'ACTIVE'),
(69, 'lili', 'admin', 'admin', '', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/asset/gam/user_default.png', 'lili', 'NULL', 'lili@gmail..com', 'teknisi', '2025-10-02', 'ACTIVE'),
(70, 'lilu', 'admin', 'admin', '', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/asset/gam/user_default.png', 'lilu', 'NULL', 'lilu@gmail..com', 'teknisi', '2025-10-02', 'ACTIVE'),
(71, 'nana', 'admin', 'admin', '', 'http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/asset/gam/user_default.png', 'nana', 'NULL', 'nana@gmail..com', 'teknisi', '2025-10-02', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `data_user_teknisi`
--

DROP TABLE IF EXISTS `data_user_teknisi`;
CREATE TABLE IF NOT EXISTS `data_user_teknisi` (
  `id_user_teknisi` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(100) NOT NULL,
  `lok_long` varchar(100) NOT NULL,
  `lok_lat` varchar(100) NOT NULL,
  `status_teknisi` enum('READY','BOOKING','WORKING','') NOT NULL,
  `last_update_lacak` date NOT NULL,
  `user_pembuat` varchar(100) NOT NULL,
  `waktu` date NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id_user_teknisi`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_user_teknisi`
--

INSERT INTO `data_user_teknisi` (`id_user_teknisi`, `user`, `lok_long`, `lok_lat`, `status_teknisi`, `last_update_lacak`, `user_pembuat`, `waktu`, `status`) VALUES
(15, 'didi', '0', '0', 'READY', '2003-01-26', 'admin', '2003-01-26', 'ACTIVE'),
(16, 'nana', '0', '0', 'READY', '2003-01-26', 'admin', '2003-01-26', 'ACTIVE'),
(14, 'admin', '0', '0', 'READY', '2003-01-26', 'admin', '2003-01-26', 'ACTIVE');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
