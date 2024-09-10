-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 16, 2023 at 02:19 PM
-- Server version: 10.6.16-MariaDB-cll-lve
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magang_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `pengajuan_id` int(11) NOT NULL,
  `kegiatan` text NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0 menunggu, 1 diterima, 2 ditolak'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `pengajuan_id`, `kegiatan`, `tanggal`, `status`) VALUES
(1, 2, 'Membenarkan UI', '2023-12-12 14:09:46', 2),
(2, 2, 'Wawancara', '2023-12-13 07:58:34', 1),
(3, 3, 'Maintenance', '2023-12-13 10:27:27', 0),
(4, 5, 'Meetin dan wawancara', '2023-12-14 04:35:34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bimbingan`
--

CREATE TABLE `bimbingan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `catatan_mahasiswa` text DEFAULT NULL,
  `catatan_dosen` text DEFAULT NULL,
  `tanggal_pengajuan` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bimbingan`
--

INSERT INTO `bimbingan` (`id`, `user_id`, `dosen_id`, `catatan_mahasiswa`, `catatan_dosen`, `tanggal_pengajuan`, `status`) VALUES
(1, 17, 12, 'Membuat kerangka laporan akhir', NULL, '2023-12-12 15:29:00', 1),
(2, 17, 12, 'Pengecekan Alur Bisnis', NULL, '2023-12-12 16:00:36', 2),
(3, 18, 12, 'Maintenance', NULL, '2023-12-13 10:28:08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_pengajuan`
--

CREATE TABLE `dokumen_pengajuan` (
  `id` int(11) NOT NULL,
  `pengajuan_id` int(11) NOT NULL,
  `dokumen` varchar(255) NOT NULL,
  `nama_dokumen` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dokumen_pengajuan`
--

INSERT INTO `dokumen_pengajuan` (`id`, `pengajuan_id`, `dokumen`, `nama_dokumen`, `created_at`) VALUES
(1, 1, '/assets/uploads/mahasiswa/16/lowongan/6577feb4732a1_6667.pdf', 'Sistem+Informasi+Perpustakaan+Menggunakan+Framework+Bootstrap+Dengan+PHP+Native+dan+Database+MySQL+Berbasis+Web+Pada+SMP+Negeri+2+Dawan.pdf', '2023-12-12 06:33:24'),
(2, 1, '/assets/uploads/mahasiswa/16/lowongan/6577feb4bff80_7295.pdf', '7.pdf', '2023-12-12 06:33:24'),
(3, 1, '/assets/uploads/mahasiswa/16/lowongan/6577feb4c2656_1822.pdf', 'SURAT SLF.pdf', '2023-12-12 06:33:24'),
(4, 2, '/assets/uploads/mahasiswa/17/lowongan/657806f00b7bd_8273.pdf', 'Sistem+Informasi+Perpustakaan+Menggunakan+Framework+Bootstrap+Dengan+PHP+Native+dan+Database+MySQL+Berbasis+Web+Pada+SMP+Negeri+2+Dawan.pdf', '2023-12-12 07:08:32'),
(5, 2, '/assets/uploads/mahasiswa/17/lowongan/657806f057ba5_5317.pdf', '7.pdf', '2023-12-12 07:08:32'),
(6, 2, '/assets/uploads/mahasiswa/17/lowongan/657806f05adf0_4060.pdf', 'SURAT SLF.pdf', '2023-12-12 07:08:32'),
(7, 3, '/assets/uploads/mahasiswa/18/lowongan/6578fd4436d78_9774.pdf', 'Data Perusahaan_2.pdf', '2023-12-13 00:39:32'),
(8, 3, '/assets/uploads/mahasiswa/18/lowongan/6578fd4436ff1_1759.pdf', 'Data Perusahaan.pdf', '2023-12-13 00:39:32'),
(9, 3, '/assets/uploads/mahasiswa/18/lowongan/6578fd44371d8_3330.pdf', 'Data Dosen_2.pdf', '2023-12-13 00:39:32'),
(10, 4, '/assets/uploads/mahasiswa/19/lowongan/6578fd6347b20_8612.pdf', 'Data Perusahaan.pdf', '2023-12-13 00:40:03'),
(11, 4, '/assets/uploads/mahasiswa/19/lowongan/6578fd6347c8d_6689.pdf', 'Data Dosen_2.pdf', '2023-12-13 00:40:03'),
(12, 4, '/assets/uploads/mahasiswa/19/lowongan/6578fd6347da3_6479.pdf', 'Data Mahasiswa_4.pdf', '2023-12-13 00:40:03'),
(13, 5, '/assets/uploads/mahasiswa/16/lowongan/657a859a176b8_4347.pdf', 'Data Perusahaan.pdf', '2023-12-14 04:33:30'),
(14, 5, '/assets/uploads/mahasiswa/16/lowongan/657a859a17916_1614.pdf', 'Data Dosen_2.pdf', '2023-12-14 04:33:30'),
(15, 5, '/assets/uploads/mahasiswa/16/lowongan/657a859a17aab_4186.pdf', 'Data Mahasiswa_4.pdf', '2023-12-14 04:33:30'),
(16, 6, '/assets/uploads/mahasiswa/20/lowongan/657a96a2caa75_2847.pdf', 'Data Perusahaan.pdf', '2023-12-14 05:46:10'),
(17, 6, '/assets/uploads/mahasiswa/20/lowongan/657a96a2cab80_9230.pdf', 'Data Dosen_2.pdf', '2023-12-14 05:46:10'),
(18, 6, '/assets/uploads/mahasiswa/20/lowongan/657a96a2cac68_5689.pdf', 'Data Mahasiswa_4.pdf', '2023-12-14 05:46:10');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_akhir`
--

CREATE TABLE `laporan_akhir` (
  `id` int(11) NOT NULL,
  `pembimbing_id` int(11) NOT NULL,
  `dokumen` varchar(255) NOT NULL,
  `nama_dokumen` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `laporan_akhir`
--

INSERT INTO `laporan_akhir` (`id`, `pembimbing_id`, `dokumen`, `nama_dokumen`, `created_at`) VALUES
(1, 2, '/assets/uploads/mahasiswa/17/laporan-pkl/65796b352e220_5152.pdf', 'Data Bimbingan PKL.pdf', '2023-12-13 08:28:37'),
(2, 2, '/assets/uploads/mahasiswa/17/laporan-pkl/65796b352e463_4345.pdf', 'Data Perusahaan.pdf', '2023-12-13 08:28:37'),
(3, 2, '/assets/uploads/mahasiswa/17/laporan-pkl/65796b352e614_1329.pdf', 'Data Mahasiswa_4.pdf', '2023-12-13 08:28:37'),
(4, 2, '/assets/uploads/mahasiswa/17/laporan-pkl/65796b352e89f_9178.pdf', 'UML_Distilled_From_Difficulties_to_Assets.pdf', '2023-12-13 08:28:37');

-- --------------------------------------------------------

--
-- Table structure for table `lowongan`
--

CREATE TABLE `lowongan` (
  `id` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `posisi` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `kuota` int(11) NOT NULL,
  `deskripsi_dokumen` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lowongan`
--

INSERT INTO `lowongan` (`id`, `perusahaan_id`, `gambar`, `posisi`, `deskripsi`, `kuota`, `deskripsi_dokumen`, `created_at`) VALUES
(1, 1, NULL, 'Fullstack Developer', '3 Bulan WFO', 3, 'Pendukung, proposal, Pengantar', '2023-12-12 06:22:53'),
(2, 3, NULL, 'Web Designer', 'WFH', 2, 'pengantar, proposal, skck', '2023-12-13 12:59:11');

-- --------------------------------------------------------

--
-- Table structure for table `pembimbing`
--

CREATE TABLE `pembimbing` (
  `id` int(11) NOT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `dokumen_akhir` varchar(255) DEFAULT NULL,
  `tgl_dokumen` timestamp NULL DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pembimbing`
--

INSERT INTO `pembimbing` (`id`, `dosen_id`, `user_id`, `dokumen_akhir`, `tgl_dokumen`, `nilai`, `created_at`) VALUES
(1, 12, 16, NULL, NULL, NULL, '2023-12-12 06:10:54'),
(2, 12, 17, NULL, NULL, NULL, '2023-12-12 06:10:54'),
(3, 12, 18, NULL, NULL, NULL, '2023-12-12 06:10:54'),
(4, 12, 19, NULL, NULL, NULL, '2023-12-12 06:10:54'),
(5, 0, 20, NULL, NULL, NULL, '2023-12-12 06:10:55');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id` int(11) NOT NULL,
  `pembimbing_id` int(11) NOT NULL,
  `lowongan_id` int(11) NOT NULL,
  `nilai` int(11) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0 pending, 1 diterima, 2 ditolak',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`id`, `pembimbing_id`, `lowongan_id`, `nilai`, `status`, `created_at`) VALUES
(1, 1, 1, NULL, 2, '2023-12-12 06:26:25'),
(2, 2, 1, NULL, 1, '2023-12-12 07:07:51'),
(3, 3, 1, NULL, 1, '2023-12-13 00:39:04'),
(4, 4, 1, NULL, 0, '2023-12-13 00:39:53'),
(5, 1, 2, NULL, 1, '2023-12-13 12:59:51'),
(6, 5, 3, NULL, 0, '2023-12-14 05:44:35');

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tahun_berdiri` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `dokumen_ktp` varchar(255) NOT NULL,
  `dokumen_npwp` varchar(255) NOT NULL,
  `dokumen_nib` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id`, `user_id`, `nama`, `email`, `tahun_berdiri`, `deskripsi`, `alamat`, `telepon`, `dokumen_ktp`, `dokumen_npwp`, `dokumen_nib`, `created_at`) VALUES
(1, 21, 'Jayakarta', 'abc@gmail.vom', 2020, 'Perusahaan yang berfokus kepada berdirinya Indonesia pintar', 'Kayutangan, Malang ', '12345678', '/assets/uploads/perusahaan/21/6577fb5143da2_4282.pdf', '/assets/uploads/perusahaan/21/6577fb514d38b_2574.pdf', '/assets/uploads/perusahaan/21/6577fb5184e17_1565.pdf', '2023-12-12 06:18:57'),
(2, 22, 'PT ABC', 'abcd@gmail.com', 2019, 'Mencerdaskan Lewat Makanan', 'Situbondo', '089123123123', '/assets/uploads/perusahaan/22/6578235867dec_3245.pdf', '/assets/uploads/perusahaan/22/6578235892cc0_2764.pdf', '/assets/uploads/perusahaan/22/65782358a6121_7267.pdf', '2023-12-12 09:09:44'),
(3, 23, 'PT ABC', 'abcde@gmail.com', 2021, 'Ini Perusahaan', 'Pasuruan', '087234567887', '/assets/uploads/perusahaan/23/65799d3a114a8_4001.pdf', '/assets/uploads/perusahaan/23/65799d3a116a9_3531.pdf', '/assets/uploads/perusahaan/23/65799d3ba7e79_9785.pdf', '2023-12-13 12:02:03');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `nama`) VALUES
(1, 'Koordinator PKL'),
(2, 'Perusahaan'),
(3, 'Dosen'),
(4, 'Mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nim` varchar(50) DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `no_telepon` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `nama`, `nim`, `nip`, `jurusan`, `no_telepon`, `password`, `foto`, `role_id`, `status`, `created_at`) VALUES
(1, 'koordinator-pkl', 'Koordinator PKL', NULL, NULL, NULL, NULL, '$2y$10$DhDFI9Ylyy6f.QSoXs2b0.YwyNfkP6FeY.PZMdOOn3qb7m5loAqFO', NULL, 1, 1, '2023-11-26 17:41:56'),
(12, '198906212019031013', 'Yoppy Yunhasnawa, S.ST., M.Sc.', NULL, '198906212019031013', NULL, '85123123123', '$2y$10$yCU6l2o6BBT1DlvvTUh/guFQ.FXD02xQv4vN/IMagkkCTWfdP/2UK', NULL, 3, 1, '2023-12-12 06:10:34'),
(13, '198406102008121004', 'Imam Fahrur Rozi, S.T., M.T.', NULL, '198406102008121004', NULL, '34100023561', '$2y$10$7QkemE3WUVupFBUB64yDKeKDFNFHoibUwnTmwhr0eRXuPEvMwPWl.', NULL, 3, 1, '2023-12-12 06:10:34'),
(14, '199112302019031016', 'Anugrah Nur Rahmanto, S.Sn., M.Ds.', NULL, '199112302019031016', NULL, '23984172649', '$2y$10$oR11WrCVwx00ce/eNMjyS.NxZQfKNfiwxse7wBj7uz/tVZkmq04u.', NULL, 3, 1, '2023-12-12 06:10:34'),
(16, '1741720001', 'PADANG BASUDEWA', '1741720001', NULL, 'TI', NULL, '$2y$10$O4VXSb4Za5OhDLilC.q1Be6YceG2DgPa7FFutqac48ZNGDxLdnpyG', NULL, 4, 1, '2023-12-12 06:10:54'),
(17, '1741720002', 'D. DENA INDAH AMALIA', '1741720002', NULL, 'TI', NULL, '$2y$10$IRyWe0yFS3.WPxjTv8s37eJxBNiW4Bq9Jwe4gf2Bv6toSNafVT4jS', NULL, 4, 1, '2023-12-12 06:10:54'),
(18, '1741720003', 'TOMI DWI SETYAWAN', '1741720003', NULL, 'TI', NULL, '$2y$10$ZjH2Zo9gi081ej8Cgzv1CeWzSG/kStbBOwVspqfUuvDhmtgJio0Ra', NULL, 4, 1, '2023-12-12 06:10:54'),
(19, '1741720004', 'SULISTIO ILHAM ROSADY', '1741720004', NULL, 'TI', NULL, '$2y$10$4IwmM7IYr5pEHjdbFQtq1Oz2rOK14n1f4MY3xlw/MT.DKGvd08Pt.', NULL, 4, 1, '2023-12-12 06:10:54'),
(20, '1741720005', 'LINDA PUSPITA TARUMAWARDANI', '1741720005', NULL, 'TI', NULL, '$2y$10$SddEf4GieWt8M1a5hnk7VOOnA0R8h1YBCDfJmtTUOUBLdpMBdz9sm', NULL, 4, 1, '2023-12-12 06:10:55'),
(21, 'joko11', 'Joko', NULL, NULL, NULL, NULL, '$2y$10$AmGBizynF88L8b2cl2VNxeflJRtJp36YNl0iBrl2UQY84ILWQx7dy', NULL, 2, 1, '2023-12-12 06:18:57'),
(22, 'joko12', 'Ahmad', NULL, NULL, NULL, NULL, '$2y$10$XB6vhaK8Cgjwvl3HEr0Ne.GUiBud14TMrbVaoF.47sZieUYiXO9E.', NULL, 2, 2, '2023-12-12 09:09:44'),
(23, 'joko13', 'Putra', NULL, NULL, NULL, NULL, '$2y$10$a16MZPdcw/3kP3uDEqs.i.wtYx7XsyNUP9lQPELNnJ6k6gr/kcIre', NULL, 2, 0, '2023-12-13 12:02:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bimbingan`
--
ALTER TABLE `bimbingan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokumen_pengajuan`
--
ALTER TABLE `dokumen_pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_akhir`
--
ALTER TABLE `laporan_akhir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lowongan`
--
ALTER TABLE `lowongan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembimbing`
--
ALTER TABLE `pembimbing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bimbingan`
--
ALTER TABLE `bimbingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dokumen_pengajuan`
--
ALTER TABLE `dokumen_pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `laporan_akhir`
--
ALTER TABLE `laporan_akhir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lowongan`
--
ALTER TABLE `lowongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembimbing`
--
ALTER TABLE `pembimbing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
