-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.14 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for ag_pekerjaan
CREATE DATABASE IF NOT EXISTS `ag_pekerjaan` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ag_pekerjaan`;


-- Dumping structure for table ag_pekerjaan.cluster
CREATE TABLE IF NOT EXISTS `cluster` (
  `cluster_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` char(3) NOT NULL DEFAULT '0',
  `homebase` varchar(50) NOT NULL,
  `wilayah` varchar(50) NOT NULL,
  `is_used` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`cluster_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ag_pekerjaan.cluster: 2 rows
/*!40000 ALTER TABLE `cluster` DISABLE KEYS */;
INSERT INTO `cluster` (`cluster_id`, `site_id`, `homebase`, `wilayah`, `is_used`) VALUES
	(1, '1', 'KOTA TASIK', 'Tasik Kota 1', 'N'),
	(2, '1', 'KOTA TASIK', 'Tasik Kota 2', 'N');
/*!40000 ALTER TABLE `cluster` ENABLE KEYS */;


-- Dumping structure for table ag_pekerjaan.evidence
CREATE TABLE IF NOT EXISTS `evidence` (
  `id_evidence` int(11) NOT NULL AUTO_INCREMENT,
  `url` text,
  `keterangan` text,
  `extension` varchar(50) DEFAULT NULL,
  `uploaded_at` date DEFAULT NULL,
  `uploaded_by` char(50) DEFAULT NULL,
  PRIMARY KEY (`id_evidence`)
) ENGINE=MyISAM AUTO_INCREMENT=118 DEFAULT CHARSET=latin1;

-- Dumping data for table ag_pekerjaan.evidence: 1 rows
/*!40000 ALTER TABLE `evidence` DISABLE KEYS */;
INSERT INTO `evidence` (`id_evidence`, `url`, `keterangan`, `extension`, `uploaded_at`, `uploaded_by`) VALUES
	(117, '20180206033547hasil_export_cetak.png', '', 'png', '2018-02-06', '4');
/*!40000 ALTER TABLE `evidence` ENABLE KEYS */;


-- Dumping structure for table ag_pekerjaan.feedback
CREATE TABLE IF NOT EXISTS `feedback` (
  `id_feedback` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `content` text,
  `tanggal_umpan` date DEFAULT NULL,
  PRIMARY KEY (`id_feedback`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table ag_pekerjaan.feedback: 1 rows
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` (`id_feedback`, `name`, `type`, `content`, `tanggal_umpan`) VALUES
	(1, 'Ahmad Fauzi', 'report_bug', 'BUG DISINI DISITU', '2018-01-30');
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;


-- Dumping structure for table ag_pekerjaan.kegiatan
CREATE TABLE IF NOT EXISTS `kegiatan` (
  `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT,
  `tipe_pekerjaan_id` char(3) DEFAULT NULL,
  `tipe_kegiatan_id` char(3) DEFAULT NULL,
  `nama_kegiatan` varchar(50) DEFAULT NULL,
  `diajukan_oleh` char(3) DEFAULT NULL,
  `approval_status` enum('Y','N') DEFAULT NULL,
  `sph_date` date DEFAULT NULL,
  `nilai_sph` bigint(20) DEFAULT NULL,
  `corr_date` date DEFAULT NULL,
  `nilai_corr` bigint(20) DEFAULT NULL,
  `po_date` date DEFAULT NULL,
  `nilai_po` bigint(20) DEFAULT NULL,
  `pengajuan_date` date DEFAULT NULL,
  `nilai_pengajuan` bigint(20) DEFAULT NULL,
  `is_po` enum('Y','N') NOT NULL DEFAULT 'N',
  `is_bast` enum('Y','N') NOT NULL DEFAULT 'N',
  `is_invoiced` enum('Y','N') NOT NULL DEFAULT 'N',
  `is_paid` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_kegiatan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table ag_pekerjaan.kegiatan: 0 rows
/*!40000 ALTER TABLE `kegiatan` DISABLE KEYS */;
/*!40000 ALTER TABLE `kegiatan` ENABLE KEYS */;


-- Dumping structure for table ag_pekerjaan.kendaraan
CREATE TABLE IF NOT EXISTS `kendaraan` (
  `kendaraan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kendaraan` varchar(50) NOT NULL,
  `jenis_kendaraan` enum('Mobil','Motor') DEFAULT NULL,
  `plat_kendaraan` varchar(50) DEFAULT NULL,
  `is_used` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`kendaraan_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ag_pekerjaan.kendaraan: 2 rows
/*!40000 ALTER TABLE `kendaraan` DISABLE KEYS */;
INSERT INTO `kendaraan` (`kendaraan_id`, `nama_kendaraan`, `jenis_kendaraan`, `plat_kendaraan`, `is_used`) VALUES
	(1, 'Toyota', 'Mobil', 'B 1111 EZ', 'Y'),
	(2, 'Honda', 'Mobil', 'B 2222 PRO', 'Y');
/*!40000 ALTER TABLE `kendaraan` ENABLE KEYS */;


-- Dumping structure for table ag_pekerjaan.pengajuan
CREATE TABLE IF NOT EXISTS `pengajuan` (
  `pengajuan_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` char(3) DEFAULT NULL,
  `site_id` char(3) DEFAULT NULL,
  `tanggal_pengajuan` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pengajuan` text,
  `realisasi_pengajuan` date DEFAULT NULL,
  `kategori_pengajuan` enum('Project','Non Project') DEFAULT NULL,
  `jenis_pengajuan` enum('Project','Non Project','Operasional','Corrective','Commcase','Gaji PJS','Imbas Petir') DEFAULT NULL,
  `nama_project` varchar(50) DEFAULT NULL,
  `tanggal_approval` date DEFAULT NULL,
  `tanggal_approval_keuangan` date DEFAULT NULL,
  `start_penawaran_dmt` date DEFAULT NULL,
  `nilai_sph` bigint(20) DEFAULT NULL,
  `nilai_corr` bigint(20) DEFAULT NULL,
  `nilai_po` bigint(20) DEFAULT NULL,
  `no_sph` varchar(50) DEFAULT NULL,
  `no_corr` varchar(50) DEFAULT NULL,
  `no_po` varchar(50) DEFAULT NULL,
  `no_spk` varchar(50) DEFAULT NULL,
  `nilai_pengajuan` bigint(50) DEFAULT NULL,
  `status_admin_dmt` date DEFAULT NULL,
  `keterangan` text,
  `keterangan_approval` text,
  `evidence_id` varchar(50) DEFAULT NULL,
  `pengaju_id` char(3) DEFAULT NULL,
  `is_invoiced` enum('Y','N') DEFAULT 'N',
  `is_bayar` enum('Y','N') DEFAULT 'N',
  `is_bayarclient` enum('Y','N') DEFAULT 'N',
  `is_printed` enum('Y','N') DEFAULT 'N',
  `success_print` enum('Y','N') DEFAULT 'N',
  `is_checked` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`pengajuan_id`)
) ENGINE=MyISAM AUTO_INCREMENT=436 DEFAULT CHARSET=latin1;

-- Dumping data for table ag_pekerjaan.pengajuan: 3 rows
/*!40000 ALTER TABLE `pengajuan` DISABLE KEYS */;
INSERT INTO `pengajuan` (`pengajuan_id`, `project_id`, `site_id`, `tanggal_pengajuan`, `pengajuan`, `realisasi_pengajuan`, `kategori_pengajuan`, `jenis_pengajuan`, `nama_project`, `tanggal_approval`, `tanggal_approval_keuangan`, `start_penawaran_dmt`, `nilai_sph`, `nilai_corr`, `nilai_po`, `no_sph`, `no_corr`, `no_po`, `no_spk`, `nilai_pengajuan`, `status_admin_dmt`, `keterangan`, `keterangan_approval`, `evidence_id`, `pengaju_id`, `is_invoiced`, `is_bayar`, `is_bayarclient`, `is_printed`, `success_print`, `is_checked`) VALUES
	(434, '', '', '2018-02-06 11:38:48', 'TES AJA B', '2018-02-14', 'Non Project', 'Non Project', '', NULL, '2018-02-06', NULL, 0, 0, 0, '', '', '', '', 550000, '2018-02-06', '', NULL, NULL, '4', 'N', 'N', 'N', 'Y', 'Y', 'Y'),
	(433, '13', '21', '2018-02-06 10:37:27', 'TES AJA', '2018-02-08', 'Project', 'Project', 'TELKOM', NULL, '2018-02-06', NULL, 0, 0, 1000000, '', '', 'DMT/PO/20170101/105', '', 150000, '2018-02-06', '', NULL, NULL, '4', 'N', 'N', 'N', 'Y', 'Y', 'Y'),
	(435, '13', '21', '2018-02-07 16:40:23', 'INDIHOME', '2018-02-09', NULL, 'Corrective', 'TELKOM', '2018-02-08', NULL, '2018-02-21', 0, 50000000, 0, '', 'DMT/COR/20171206/0017', '', 'DMT/SPK/20171224/0067', 1500000, NULL, '', NULL, NULL, '4', 'N', 'N', 'N', 'N', 'N', 'N');
/*!40000 ALTER TABLE `pengajuan` ENABLE KEYS */;


-- Dumping structure for table ag_pekerjaan.progress
CREATE TABLE IF NOT EXISTS `progress` (
  `progress_id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_mulai` date DEFAULT NULL,
  `project_id` char(3) DEFAULT NULL,
  `site_id` char(3) DEFAULT NULL,
  `keterangan` text,
  `tanggal_bapp` date DEFAULT NULL,
  `tanggal_bast` date DEFAULT NULL,
  `no_bapp` varchar(50) DEFAULT NULL,
  `no_bast` varchar(50) DEFAULT NULL,
  `ag_progress` date DEFAULT NULL,
  `dmt_progress` date DEFAULT NULL,
  `no_po` varchar(50) DEFAULT NULL,
  `tanggal_po` date DEFAULT NULL,
  `no_corr` varchar(50) DEFAULT NULL,
  `tanggal_corr` date DEFAULT NULL,
  `tanggal_kontrak` date DEFAULT NULL,
  `deskripsi` text,
  `is_bayar` date DEFAULT NULL,
  `is_invoiced` date DEFAULT NULL,
  `is_bayarclient` date DEFAULT NULL,
  PRIMARY KEY (`progress_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table ag_pekerjaan.progress: 1 rows
/*!40000 ALTER TABLE `progress` DISABLE KEYS */;
INSERT INTO `progress` (`progress_id`, `tanggal_mulai`, `project_id`, `site_id`, `keterangan`, `tanggal_bapp`, `tanggal_bast`, `no_bapp`, `no_bast`, `ag_progress`, `dmt_progress`, `no_po`, `tanggal_po`, `no_corr`, `tanggal_corr`, `tanggal_kontrak`, `deskripsi`, `is_bayar`, `is_invoiced`, `is_bayarclient`) VALUES
	(14, '2018-02-09', '13', '21', 'Pekerjaan PJS Juli 2018', '0000-00-00', '0000-00-00', '', '', NULL, NULL, '4100050916', '2018-02-09', 'DMT/COR/2017/0017', '2018-02-15', '2018-02-15', '', NULL, NULL, NULL);
/*!40000 ALTER TABLE `progress` ENABLE KEYS */;


-- Dumping structure for table ag_pekerjaan.project
CREATE TABLE IF NOT EXISTS `project` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_project` text,
  PRIMARY KEY (`project_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table ag_pekerjaan.project: 3 rows
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` (`project_id`, `nama_project`) VALUES
	(15, 'ABC'),
	(14, 'TES'),
	(13, 'TELKOM');
/*!40000 ALTER TABLE `project` ENABLE KEYS */;


-- Dumping structure for table ag_pekerjaan.site
CREATE TABLE IF NOT EXISTS `site` (
  `site_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_site` varchar(50) NOT NULL,
  `id_site_telkom` varchar(50) NOT NULL,
  `nama_site` varchar(50) NOT NULL DEFAULT '0',
  `lokasi` text NOT NULL,
  `keterangan_site` text,
  PRIMARY KEY (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Dumping data for table ag_pekerjaan.site: 1 rows
/*!40000 ALTER TABLE `site` DISABLE KEYS */;
INSERT INTO `site` (`site_id`, `id_site`, `id_site_telkom`, `nama_site`, `lokasi`, `keterangan_site`) VALUES
	(21, 'TLK001', 'TLKPST001', 'TELKOM', 'Jakarta Pusat', 'Deket Gedung Telkom');
/*!40000 ALTER TABLE `site` ENABLE KEYS */;


-- Dumping structure for table ag_pekerjaan.staff
CREATE TABLE IF NOT EXISTS `staff` (
  `staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `keluarga_yg_bisa_dihub` varchar(50) DEFAULT NULL,
  `telp_keluarga_yg_bisa_dihub` varchar(50) DEFAULT NULL,
  `keterangan` text,
  `posisi` varchar(50) NOT NULL,
  `team_id` char(3) DEFAULT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- Dumping data for table ag_pekerjaan.staff: 1 rows
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` (`staff_id`, `nama`, `alamat`, `telp`, `dob`, `keluarga_yg_bisa_dihub`, `telp_keluarga_yg_bisa_dihub`, `keterangan`, `posisi`, `team_id`) VALUES
	(24, 'Ahmad Fauzi', 'Depok', '082112710702', '1997-07-09', 'Sumaryo', '081318260540', '-', 'IT', NULL);
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;


-- Dumping structure for table ag_pekerjaan.team
CREATE TABLE IF NOT EXISTS `team` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` char(50) NOT NULL DEFAULT '0',
  `cluster_id` char(50) NOT NULL DEFAULT '0',
  `kendaraan_id` varchar(50) DEFAULT NULL,
  `genset_mobile_75` char(50) NOT NULL DEFAULT '0',
  `genset_mobile_10` char(50) NOT NULL DEFAULT '0',
  `genset_mobile_12` char(50) NOT NULL DEFAULT '0',
  `genset_fix_75` char(50) NOT NULL DEFAULT '0',
  `genset_fix_10` char(50) NOT NULL DEFAULT '0',
  `genset_fix_12` char(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`team_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table ag_pekerjaan.team: 1 rows
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
INSERT INTO `team` (`team_id`, `staff_id`, `cluster_id`, `kendaraan_id`, `genset_mobile_75`, `genset_mobile_10`, `genset_mobile_12`, `genset_fix_75`, `genset_fix_10`, `genset_fix_12`) VALUES
	(9, '0', '1', '1,2', '2', '0', '0', '0', '0', '0');
/*!40000 ALTER TABLE `team` ENABLE KEYS */;


-- Dumping structure for table ag_pekerjaan.tipe_kegiatan
CREATE TABLE IF NOT EXISTS `tipe_kegiatan` (
  `kegiatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `tipe_kegiatan` varchar(50) NOT NULL,
  PRIMARY KEY (`kegiatan_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table ag_pekerjaan.tipe_kegiatan: 5 rows
/*!40000 ALTER TABLE `tipe_kegiatan` DISABLE KEYS */;
INSERT INTO `tipe_kegiatan` (`kegiatan_id`, `tipe_kegiatan`) VALUES
	(1, 'FLM'),
	(2, 'CORRECTIVE'),
	(3, 'IMBAS PETIR'),
	(4, 'COMMCASE'),
	(5, 'THR PJS 2017');
/*!40000 ALTER TABLE `tipe_kegiatan` ENABLE KEYS */;


-- Dumping structure for table ag_pekerjaan.tipe_pekerjaan
CREATE TABLE IF NOT EXISTS `tipe_pekerjaan` (
  `tipe_p_id` int(11) NOT NULL AUTO_INCREMENT,
  `tipe_pekerjaan` varchar(50) NOT NULL,
  PRIMARY KEY (`tipe_p_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ag_pekerjaan.tipe_pekerjaan: 2 rows
/*!40000 ALTER TABLE `tipe_pekerjaan` DISABLE KEYS */;
INSERT INTO `tipe_pekerjaan` (`tipe_p_id`, `tipe_pekerjaan`) VALUES
	(1, 'PROJECT'),
	(2, 'NON PROJECT');
/*!40000 ALTER TABLE `tipe_pekerjaan` ENABLE KEYS */;


-- Dumping structure for table ag_pekerjaan.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `permission` enum('ADMINISTRATOR','VIEWER','APPROVAL','ADMIN TASIK','ADMIN JAKARTA','ADM') NOT NULL,
  `created_at` time NOT NULL,
  `status` enum('ACTIVE','DEACTIVE') NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table ag_pekerjaan.users: 7 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`, `name`, `username`, `password`, `permission`, `created_at`, `status`) VALUES
	(1, 'Ahmad Fauzi', 'admin', 'admin', 'ADMINISTRATOR', '17:05:14', 'ACTIVE'),
	(2, 'Alvenius Gultom', 'alven', 'alven', 'APPROVAL', '09:28:33', 'ACTIVE'),
	(3, 'Keuangan', 'jkt', 'jkt', 'ADMIN JAKARTA', '09:28:23', 'ACTIVE'),
	(4, 'Tasik', 'tasik', 'tasik', 'ADMIN TASIK', '09:29:24', 'ACTIVE'),
	(6, 'Simon Tambunan', 'simon', 'simon', 'VIEWER', '09:29:46', 'ACTIVE'),
	(7, 'Viewer', 'vwr', 'vwr', 'VIEWER', '16:27:38', 'ACTIVE'),
	(8, 'Admin Progress', 'adm', 'adm', 'ADM', '11:58:10', 'ACTIVE');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
