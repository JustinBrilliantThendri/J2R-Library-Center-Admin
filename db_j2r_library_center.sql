-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2024 at 03:39 PM
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
-- Database: `db_j2r_library_center`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_perpustakaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_admin`, `password`, `id_perpustakaan`) VALUES
(1, 'Admin 1', '$2y$10$DBt6KOS3.FfsYgVjFKp5DudvKK3RWxMm33/q2hM7dywDHk8WCtPoi', 1),
(2, 'Admin 2', '$2a$12$MxWoL7aM9UfEXgTMRampXe7qbWmqhB5HgI.Ngi9ovNlYLXcF1hIUW', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_buku`
--

CREATE TABLE `tb_buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `rating` double NOT NULL,
  `harga` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_buku`
--

INSERT INTO `tb_buku` (`id_buku`, `judul_buku`, `cover`, `penulis`, `penerbit`, `deskripsi`, `rating`, `harga`, `stock`) VALUES
(1, 'Hujan', 'hujan.jpg', 'Tere Liye', 'Gramedia Pustaka Utama', 'Hujan oleh Tere Liye adalah novel fiksi romantis yang diterbitkan pertama kali pada tahun 2016. Novel ini menceritakan kisah cinta antara Laisha dan Andes yang terjalin di tengah hujan. Laisha, seorang gadis yang memiliki kemampuan unik untuk merasakan emosi orang lain melalui sentuhan, bertemu dengan Andes, seorang pemuda misterius yang selalu membawa payung kemana pun dia pergi. Pertemuan mereka yang tak terduga membawa mereka pada petualangan cinta yang penuh dengan rintangan dan kejutan.', 4.5, 25000, 5),
(2, 'Bintang', 'bintang.jpg', 'Tere Liye', 'Gramedia Pustaka Utama', 'Bintang adalah novel fiksi ilmiah remaja yang ditulis oleh Tere Liye dan merupakan bagian keempat dari serial \"Bumi\". Novel ini diterbitkan pertama kali pada tahun 2017. Novel ini menceritakan petualangan Seli, Raib, dan Ali di Klan Bintang, salah satu dari 12 Klan yang ada di dunia paralel. Misi mereka adalah mencari tahu tentang \"musuh besar\" yang mengancam Bumi dan Klan-Klan lainnya.', 4.2, 25000, 1),
(3, 'Nebula', 'nebula.jpg', 'Tere Liye', 'Gramedia Pustaka Utama', 'Deskripsi Singkat Novel \"Nebula\" Karya Tere Liye\r\nNebula adalah novel fiksi ilmiah remaja yang ditulis oleh Tere Liye dan merupakan bagian kesembilan dari serial \"Bumi\". Novel ini diterbitkan pertama kali pada tahun 2018. Novel ini menceritakan kisah petualangan lanjutan Seli, Raib, dan Ali di dunia paralel, setelah mereka berhasil mengalahkan \"musuh besar\" pada novel sebelumnya. Kali ini, mereka harus menghadapi ancaman baru yang datang dari luar angkasa, yaitu Nebula Hitam.', 4.6, 30000, 1),
(4, '2,578.0 KM', '25780 km.jpg', 'Ayu Nugraheni', 'Loveable X Bhumi Anoma', '2,578.0 KM adalah novel remaja karangan Ayu Nugraheni yang diterbitkan oleh Loveable pada tahun 2024. Novel ini menceritakan kisah Juni, seorang gadis yang ditinggalkan pacarnya seminggu sebelum mereka berlibur ke Eropa.', 3.4, 10000, 2),
(5, 'Septihan', 'septihan.jpeg', 'Poppi Pertiwi', 'Coconut Books', 'Septihan, karya Poppi Pertiwi, adalah novel fiksi remaja yang bergenre romantis dan persahabatan. Novel ini menceritakan kisah cinta antara Septian Aidan Nugroho, seorang siswa SMA yang cerdas dan pendiam, dengan Jihan Halana, seorang gadis periang dan penuh semangat.', 2.8, 20000, 9),
(6, 'Hilmy Milan', 'hilmy milan.jpg', 'Nadia Ristivani', 'Kawah Media Pustaka', 'Hilmy Milan adalah novel romance yang ditulis oleh Nadia Ristivani dan diterbitkan oleh Kawah Media Pustaka pada tahun 2021. Novel ini bercerita tentang Hilmy dan Milan, dua orang sahabat yang memiliki perasaan satu sama lain.', 4.1, 20000, 0),
(7, 'A Little Love Story Butterflies', 'a little love story butterflies.jpg', 'Alesa Cakes', 'Nelfia Publisher', 'A Little Love Story Butterflies adalah novel romance karya Alesa Cakes yang diterbitkan oleh Nelfia Publisher pada tahun 2024. Novel ini menceritakan kisah cinta antara Abel, seorang barista yang dingin dan pendiam, dengan Amara, seorang penulis yang cerah dan penuh semangat.', 4, 40000, 3),
(8, 'Dear J', 'dear j.jpg', 'Idea Fina', 'Ikon', 'Dear J adalah novel romance karya Idea Fina yang diterbitkan oleh Penerbit Ikon pada tahun 2017. Novel ini merupakan bagian dari seri Orion dan menceritakan kisah cinta antara Jingga, seorang jurnalis yang tegas dan mandiri, dengan Rayyan, seorang musisi yang dingin dan misterius. Jingga dan Rayyan bertemu secara tidak sengaja dan langsung merasa tertarik satu sama lain. Namun, mereka memiliki kepribadian yang bertolak belakang, sehingga hubungan mereka sering diwarnai dengan pertengkaran.', 3.3, 50000, 5),
(11, 'Bumi', 'bumi.jpg', 'Tere Liye', 'Gramedia Pustaka Utama', 'Bumi, karya Tere Liye, adalah novel fiksi ilmiah remaja yang pertama kali diterbitkan pada tahun 2012. Novel ini merupakan buku pertama dalam seri Bumi yang terdiri dari 5 buku. Bumi menceritakan kisah Seiko dan Raib, dua anak yatim piatu yang tinggal di panti asuhan. Suatu hari, mereka menemukan sebuah batu ajaib yang membawa mereka ke dunia lain bernama Bumi.', 4.1, 40000, 0),
(14, 'Mantappu Jiwa', 'mantappu jiwa.jpg', 'Jerome Polin Sijabat', 'Gramedia Pustaka Utama', 'Mantappu Jiwa adalah buku non-fiksi karya Jerome Polin Sijabat, seorang YouTuber dan influencer ternama di Indonesia. Buku ini pertama kali diterbitkan pada tahun 2021 oleh Penerbit Gagas Media. Mantappu Jiwa berisi kisah inspiratif tentang perjalanan hidup Jerome Polin, mulai dari masa kecilnya di Surabaya hingga saat ia menjadi mahasiswa di Waseda University, Jepang, dengan beasiswa prestisius. Buku ini juga berisi tips-tips dan strategi belajar yang telah diterapkan Jerome Polin selama ini, serta motivasi untuk para pelajar agar dapat mencapai mimpi mereka.', 3.4, 32000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_history`
--

CREATE TABLE `tb_history` (
  `kode_peminjaman` varchar(6) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_perpustakaan` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `tanggal_peminjaman` datetime NOT NULL,
  `tanggal_pengembalian` datetime NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_history`
--

INSERT INTO `tb_history` (`kode_peminjaman`, `id_user`, `id_perpustakaan`, `id_buku`, `tanggal_peminjaman`, `tanggal_pengembalian`, `status`) VALUES
('089290', 1, 1, 1, '2024-05-11 22:19:06', '2024-05-25 22:19:06', 'Dipinjam'),
('741435', 4, 2, 2, '2024-05-12 20:33:46', '2024-05-19 20:33:46', 'Dipinjam');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kode_peminjaman`
--

CREATE TABLE `tb_kode_peminjaman` (
  `kode_peminjaman` varchar(6) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_perpustakaan` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `durasi` int(11) NOT NULL,
  `tanggal_expire` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kode_peminjaman`
--

INSERT INTO `tb_kode_peminjaman` (`kode_peminjaman`, `id_user`, `id_perpustakaan`, `id_buku`, `durasi`, `tanggal_expire`) VALUES
('300468', 2, 1, 11, 4, '2024-05-13 20:05:27');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kota`
--

CREATE TABLE `tb_kota` (
  `id_kota` varchar(5) NOT NULL,
  `nama_kota` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kota`
--

INSERT INTO `tb_kota` (`id_kota`, `nama_kota`) VALUES
('PTK', 'Pontianak');

-- --------------------------------------------------------

--
-- Table structure for table `tb_lokasi_buku`
--

CREATE TABLE `tb_lokasi_buku` (
  `id_buku` int(11) NOT NULL,
  `id_perpustakaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_lokasi_buku`
--

INSERT INTO `tb_lokasi_buku` (`id_buku`, `id_perpustakaan`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 2),
(4, 1),
(5, 1),
(5, 2),
(6, 1),
(7, 2),
(8, 1),
(8, 2),
(11, 1),
(14, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_perpustakaan`
--

CREATE TABLE `tb_perpustakaan` (
  `id_perpustakaan` int(11) NOT NULL,
  `nama_perpustakaan` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `maps` text NOT NULL,
  `banyak_peminjaman` int(11) NOT NULL,
  `penghasilan` int(11) NOT NULL,
  `id_kota` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_perpustakaan`
--

INSERT INTO `tb_perpustakaan` (`id_perpustakaan`, `nama_perpustakaan`, `alamat`, `maps`, `banyak_peminjaman`, `penghasilan`, `id_kota`) VALUES
(1, 'Perpustakaan Provinsi Kalimantan Barat', 'Jl. Letnan Jendral Sutoyo No.6, Parit Tokaya, Kec. Pontianak Sel., Kota Pontianak, Kalimantan Barat 78121', 'https://maps.app.goo.gl/ci2oY7HBbTz4tJZh6', 1, 25000, 'PTK'),
(2, 'Perpustakaan FK UNTAN', 'Tanjungpura University, Pontianak, Indonesia.', 'https://maps.app.goo.gl/kRUrBE3N7jD4K7UL8', 1, 25000, 'PTK');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tanggal_register` datetime NOT NULL,
  `status` varchar(30) NOT NULL,
  `id_kota` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `password`, `tanggal_register`, `status`, `id_kota`) VALUES
(1, 'Justin Brilliant Thendri', '$2y$10$2vu/AlZMryNnTTGokhy/FeYxtLhoNtBhIU8hULH.DNmHQK8RCjeMm', '2024-04-23 10:24:44', 'Meminjam buku', 'PTK'),
(2, 'Steven Fandel', '$2y$10$DsOoi.TueMlgXf/BuwVmReXJmxAT01wiGfTTd/VD5d9O6bJJZINVO', '2024-05-12 20:04:26', 'Mengambil buku', 'PTK'),
(3, 'Betrand Steven', '$2y$10$PYKo5PY4HuoEVMMG9RnSNuO0AXL2C2yG8rCxguPTCRaWi7SbtetVW', '2024-05-12 20:07:38', 'Idle', 'PTK'),
(4, 'din0_', '$2y$10$beKQaHK1sPsMrPGToI/46eytG/t2D7HcL7x4jf6dGFmNnOz1nBh.a', '2024-05-12 20:30:59', 'Meminjam buku', 'PTK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `tb_admin_ibfk_1` (`id_perpustakaan`);

--
-- Indexes for table `tb_buku`
--
ALTER TABLE `tb_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `tb_history`
--
ALTER TABLE `tb_history`
  ADD PRIMARY KEY (`kode_peminjaman`),
  ADD KEY `tb_history_ibfk_1` (`id_user`),
  ADD KEY `tb_history_ibfk_2` (`id_buku`),
  ADD KEY `id_perpustakaan` (`id_perpustakaan`);

--
-- Indexes for table `tb_kode_peminjaman`
--
ALTER TABLE `tb_kode_peminjaman`
  ADD PRIMARY KEY (`kode_peminjaman`),
  ADD KEY `tb_kode_peminjaman_ibfk_1` (`id_user`),
  ADD KEY `tb_kode_peminjaman_ibfk_2` (`id_perpustakaan`),
  ADD KEY `tb_kode_peminjaman_ibfk_3` (`id_buku`);

--
-- Indexes for table `tb_kota`
--
ALTER TABLE `tb_kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `tb_lokasi_buku`
--
ALTER TABLE `tb_lokasi_buku`
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `tb_lokasi_buku_ibfk_2` (`id_perpustakaan`);

--
-- Indexes for table `tb_perpustakaan`
--
ALTER TABLE `tb_perpustakaan`
  ADD PRIMARY KEY (`id_perpustakaan`),
  ADD KEY `tb_perpustakaan_ibfk_1` (`id_kota`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `tb_user_ibfk_1` (`id_kota`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_buku`
--
ALTER TABLE `tb_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_perpustakaan`
--
ALTER TABLE `tb_perpustakaan`
  MODIFY `id_perpustakaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD CONSTRAINT `tb_admin_ibfk_1` FOREIGN KEY (`id_perpustakaan`) REFERENCES `tb_perpustakaan` (`id_perpustakaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_history`
--
ALTER TABLE `tb_history`
  ADD CONSTRAINT `tb_history_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_history_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `tb_buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_history_ibfk_3` FOREIGN KEY (`id_perpustakaan`) REFERENCES `tb_perpustakaan` (`id_perpustakaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_kode_peminjaman`
--
ALTER TABLE `tb_kode_peminjaman`
  ADD CONSTRAINT `tb_kode_peminjaman_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_kode_peminjaman_ibfk_2` FOREIGN KEY (`id_perpustakaan`) REFERENCES `tb_perpustakaan` (`id_perpustakaan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_kode_peminjaman_ibfk_3` FOREIGN KEY (`id_buku`) REFERENCES `tb_buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_lokasi_buku`
--
ALTER TABLE `tb_lokasi_buku`
  ADD CONSTRAINT `tb_lokasi_buku_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `tb_buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_lokasi_buku_ibfk_2` FOREIGN KEY (`id_perpustakaan`) REFERENCES `tb_perpustakaan` (`id_perpustakaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_perpustakaan`
--
ALTER TABLE `tb_perpustakaan`
  ADD CONSTRAINT `tb_perpustakaan_ibfk_1` FOREIGN KEY (`id_kota`) REFERENCES `tb_kota` (`id_kota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_kota`) REFERENCES `tb_kota` (`id_kota`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
