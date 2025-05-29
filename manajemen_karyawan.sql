-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for manajemen_karyawan
CREATE DATABASE IF NOT EXISTS `manajemen_karyawan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `manajemen_karyawan`;

-- Dumping structure for table manajemen_karyawan.users
CREATE TABLE IF NOT EXISTS `users` (
  `NIP` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255),
  `umur` int NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `departemen` varchar(255),
  `jabatan` varchar(255),
  `kota_asal` varchar(255),
  PRIMARY KEY (`NIP`)
);

-- Dumping data for table manajemen_karyawan.users: ~2 rows (approximately)
INSERT INTO `users` (`NIP`, `username`, `email`, `password`, `nama`, `umur`, `jenis_kelamin`, `departemen`, `jabatan`, `kota_asal`) VALUES
	(123, '123', '123@123', '$2y$10$iklBYMYi6.ztxF0EiSWih.6LMPgBj6VL1fIXWFrkY/YNd8mOQRUYq', '123', 123, 'L', '123', '123', '123'),
	(444, 'user 1', '444@444', '$2y$10$oHyeeQeJB0ZCXL6nRWetL.IIBfSbhr1EloVqb4AQ.56qUaoyGiyaC', 'Sujatmiko Arafuru', 4443332, 'L', '444', '444', '44432');
	
	-- Dumping structure for table manajemen_karyawan.absensi_karyawan
CREATE TABLE IF NOT EXISTS `absensi_karyawan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nip_karyawan` int NOT NULL,
  `tanggal_absensi` date NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `absensi_karyawan_nip_karyawan_to_users.nip` (`nip_karyawan`),
  CONSTRAINT `absensi_karyawan_nip_karyawan_to_users.nip` FOREIGN KEY (`nip_karyawan`) REFERENCES `users` (`NIP`) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Dumping data for table manajemen_karyawan.absensi_karyawan: ~1 rows (approximately)
INSERT INTO `absensi_karyawan` (`id`, `nip_karyawan`, `tanggal_absensi`, `jam_masuk`, `jam_keluar`) VALUES
	(24, 123, '2025-05-31', '10:58:00', '09:58:00');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
