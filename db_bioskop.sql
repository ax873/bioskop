-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 24, 2015 at 11:21 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_bioskop`
--

-- --------------------------------------------------------

--
-- Table structure for table `jam`
--

CREATE TABLE IF NOT EXISTS `jam` (
  `id_jam` int(5) NOT NULL,
  `jam` time NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jam`
--

INSERT INTO `jam` (`id_jam`, `jam`) VALUES
(1, '10:30:00'),
(2, '14:00:00'),
(3, '19:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(5) NOT NULL,
  `nama_kategori` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(11, 'Adventure'),
(12, 'Animation'),
(13, 'Action'),
(15, 'Romance'),
(16, 'Mystery'),
(17, 'Biography'),
(18, 'Comedy'),
(20, 'Drama'),
(21, 'Cartoon');

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi`
--

CREATE TABLE IF NOT EXISTS `konfirmasi` (
  `id_konfirmasi` int(5) NOT NULL,
  `id_orders` varchar(5) NOT NULL,
  `id_rekening` int(5) NOT NULL,
  `nama_pemesan` varchar(100) NOT NULL,
  `total_bayar` varchar(100) NOT NULL,
  `rek_anda` varchar(150) NOT NULL,
  `atas_nama` varchar(150) NOT NULL,
  `nama_bank` varchar(150) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `konfirmasi`
--

INSERT INTO `konfirmasi` (`id_konfirmasi`, `id_orders`, `id_rekening`, `nama_pemesan`, `total_bayar`, `rek_anda`, `atas_nama`, `nama_bank`, `pesan`) VALUES
(13, '125', 6, 'Oksi Oktavia', 'Rp 20.000', '123.456.78-01', 'Oksi Oktavia', 'BRI', 'Sudah saya transfer'),
(14, 'All', 6, 'Oksi Oktavia', 'Rp 60.000', '1240 45 4 545 ', 'Robby Prihandaya', 'BCA', 'saya sudah bayar untuk 3 tiket sekaligus, silahkan di cek,..'),
(15, '129', 6, 'Robby Prihandaya', '20000', '742013233423', 'Robby Prihandaya', 'Bank Indonesia', 'Mohon secepatnya di cek,..');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE IF NOT EXISTS `laporan` (
  `id_orders` int(5) NOT NULL,
  `id_movie` int(5) NOT NULL,
  `id_jam` int(5) NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `bangku` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `total_harga` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `status_pesanan` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'Lunas'
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id_orders`, `id_movie`, `id_jam`, `username`, `bangku`, `total_harga`, `status_pesanan`) VALUES
(133, 112, 1, 'robby', 'D4', '20000', 'Lunas'),
(132, 112, 1, 'robby', 'D5', '20000', 'Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE IF NOT EXISTS `movie` (
  `id_movie` int(5) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `id_studio` int(5) NOT NULL,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `detail` text COLLATE latin1_general_ci NOT NULL,
  `tanggal_tayang` date NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `trailer` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `produser` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `produksi` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `home_page` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `durasi` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `tiket` int(5) NOT NULL DEFAULT '1',
  `harga_tiket` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=116 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id_movie`, `id_kategori`, `id_studio`, `judul`, `detail`, `tanggal_tayang`, `gambar`, `trailer`, `produser`, `produksi`, `home_page`, `durasi`, `status`, `tiket`, `harga_tiket`) VALUES
(105, 11, 1, 'X-MEN : Days Of Future Past', 'Betrayed by his own kind and left for dead on a desolate planet, Riddick fights for survival against alien predators and becomes more powerful and dangerous than ever before. Soon bounty hunters from throughout the galaxy descend on Riddick only to find themselves pawns in his greater scheme for revenge. With his enemies right where he wants them, Riddick unleashes a vicious attack of vengeance before returning to his home planet of Furya to save it from destruction.', '2013-05-19', 'x-men.jpg', 'MonstersUniversity.MP4', 'Stephenie Meyer, Wyck Godfrey', 'Submit Entertainment', 'http://www.breakingdawn-themovie.com/', '112', 'now', 150, '20000'),
(102, 12, 1, 'Insidious Chapter 2', 'Betrayed by his own kind and left for dead on a desolate planet, Riddick fights for survival against alien predators and becomes more powerful and dangerous than ever before. Soon bounty hunters from throughout the galaxy descend on Riddick only to find themselves pawns in his greater scheme for revenge. With his enemies right where he wants them, Riddick unleashes a vicious attack of vengeance before returning to his home planet of Furya to save it from destruction.', '2013-06-16', 'Insidious.jpg', 'MonstersUniversity.MP4', 'Stephenie Meyer, Wyck Godfrey', 'Submit Entertainment', 'http://www.breakingdawn-themovie.com/', '112', 'coming_soon', 150, '20000'),
(103, 13, 2, 'Lone Survivor', 'Betrayed by his own kind and left for dead on a desolate planet, Riddick fights for survival against alien predators and becomes more powerful and dangerous than ever before. Soon bounty hunters from throughout the galaxy descend on Riddick only to find themselves pawns in his greater scheme for revenge. With his enemies right where he wants them, Riddick unleashes a vicious attack of vengeance before returning to his home planet of Furya to save it from destruction.', '2013-06-16', 'lone.jpg', 'MonstersUniversity.MP4', 'Stephenie Meyer, Wyck Godfrey', 'Submit Entertainment', 'http://www.breakingdawn-themovie.com/', '112', 'coming_soon', 150, '20000'),
(106, 12, 2, 'Monsters University', 'Betrayed by his own kind and left for dead on a desolate planet, Riddick fights for survival against alien predators and becomes more powerful and dangerous than ever before. Soon bounty hunters from throughout the galaxy descend on Riddick only to find themselves pawns in his greater scheme for revenge. With his enemies right where he wants them, Riddick unleashes a vicious attack of vengeance before returning to his home planet of Furya to save it from destruction.', '2013-06-19', 'Monsters.jpg', 'MonstersUniversity.MP4', 'Stephenie Meyer, Wyck Godfrey', 'Submit Entertainment', 'http://www.breakingdawn-themovie.com/', '112', 'coming_soon', 150, '20000'),
(107, 11, 2, 'The Conjuring', 'Betrayed by his own kind and left for dead on a desolate planet, Riddick fights for survival against alien predators and becomes more powerful and dangerous than ever before. Soon bounty hunters from throughout the galaxy descend on Riddick only to find themselves pawns in his greater scheme for revenge. With his enemies right where he wants them, Riddick unleashes a vicious attack of vengeance before returning to his home planet of Furya to save it from destruction.', '2013-07-19', 'conjuring.jpg', 'MonstersUniversity.MP4', 'Stephenie Meyer, Wyck Godfrey', 'Submit Entertainment', 'http://www.breakingdawn-themovie.com/', '112', 'coming_soon', 150, '20000'),
(108, 13, 3, 'The Expendables 2', 'Betrayed by his own kind and left for dead on a desolate planet, Riddick fights for survival against alien predators and becomes more powerful and dangerous than ever before. Soon bounty hunters from throughout the galaxy descend on Riddick only to find themselves pawns in his greater scheme for revenge. With his enemies right where he wants them, Riddick unleashes a vicious attack of vengeance before returning to his home planet of Furya to save it from destruction.', '2013-05-19', 'expendables.jpg', 'MonstersUniversity.MP4', 'Stephenie Meyer, Wyck Godfrey', 'Submit Entertainment', 'http://www.breakingdawn-themovie.com/', '112', 'now', 150, '20000'),
(109, 13, 1, 'The Hunger Games 2', 'Betrayed by his own kind and left for dead on a desolate planet, Riddick fights for survival against alien predators and becomes more powerful and dangerous than ever before. Soon bounty hunters from throughout the galaxy descend on Riddick only to find themselves pawns in his greater scheme for revenge. With his enemies right where he wants them, Riddick unleashes a vicious attack of vengeance before returning to his home planet of Furya to save it from destruction.', '2013-05-16', 'TheHungerGames.jpg', 'MonstersUniversity.MP4', 'Stephenie Meyer, Wyck Godfrey', 'Submit Entertainment', 'http://www.breakingdawn-themovie.com/', '112', 'now', 150, '20000'),
(112, 15, 3, 'Twilight Breaking Dawn Part 2', 'Betrayed by his own kind and left for dead on a desolate planet, Riddick fights for survival against alien predators and becomes more powerful and dangerous than ever before. Soon bounty hunters from throughout the galaxy descend on Riddick only to find themselves pawns in his greater scheme for revenge. With his enemies right where he wants them, Riddick unleashes a vicious attack of vengeance before returning to his home planet of Furya to save it from destruction.', '2013-05-19', 'BreakingDawn.jpg', 'MonstersUniversity.MP4', 'Stephenie Meyer, Wyck Godfrey', 'Submit Entertainment', 'http://www.breakingdawn-themovie.com/', '112', 'now', 150, '20000');

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE IF NOT EXISTS `rekening` (
  `id_rekening` int(5) NOT NULL,
  `no_rekening` varchar(20) NOT NULL,
  `atas_namaa` varchar(50) NOT NULL,
  `nama_bankk` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`id_rekening`, `no_rekening`, `atas_namaa`, `nama_bankk`) VALUES
(6, '152-001030-2053', 'Bioskop 21', 'Bank Mandiri'),
(10, '521231231231231', 'Bioskop 21', 'Bank Toyip');

-- --------------------------------------------------------

--
-- Table structure for table `statis`
--

CREATE TABLE IF NOT EXISTS `statis` (
  `judul` varchar(255) NOT NULL,
  `halaman` varchar(20) NOT NULL,
  `detail` text NOT NULL,
  `id_statis` int(5) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `statis`
--

INSERT INTO `statis` (`judul`, `halaman`, `detail`, `id_statis`) VALUES
('Tentang Kami Bioskop 21', 'about', 'CINEMA 21 adalah sebuah jaringan bioskop di Indonesia, dan pelopor jaringan cineplex di Indonesia. Jaringan bioskop ini tersebar di beberapa kota besar di seluruh Indonesia dan sebagian besar di antaranya terletak di dalam pusat perbelanjaan, dengan film-film Hollywood dan Indonesia sebagai menu utama, dan didukung oleh teknologi tata suara Dolby Digital dan THX. CINEMA 21 memulai kiprahnya di industri hiburan sejak tahun 1986, hingga Juni 2015, Cinema 21 Group memiliki total 780 layar yang tersebar di 33 kota di 146 lokasi di seluruh Indonesia. Group ini didirikan oleh Sudwikatmono bekerjasama dengan Benny Suherman dan Harris Lesmana.\r\n\r\nSeiring dengan tuntutan perkembangan zaman, Cineplex 21 Group telah melakukan sejumlah pembenahan dan pembaharuan, di antaranya adalah dengan membentuk jaringan bioskopnya menjadi 4 merek terpisah, yakni Cinema XXI, The Premiere, Cinema 21, dan IMAX untuk target pasar berbeda.\r\n\r\nCINEMA 21 memiliki jaringan bioskop terbanyak yang tersebar di seluruh Nusantara sebelum Cinema XXI berdiri. Cinema 21 menguasai keseluruhan pangsa pasar penonton bioskop Indonesia dengan memberlakukan harga tiket bervariasi dan jenis film yang diputar, sesuai dengan lokasi dan target yang dituju.\r\n\r\nSetelah Cinema XXI berdiri, perlahan Cinema 21 berubah menjadi jaringan bioskop kelas dua, dengan sebagian besar film yang diputar merupakan film-film karya negeri sendiri dan film-film asing yang tidak diputar di Cinema 21 lagi. Namun hal ini tidak berlaku di beberapa kota di luar Jakarta yang belum tersedia Cinema XXI dan tidak banyak terdapat Cinema 21.', 2),
('Cara Pembelian dan Pemesanan Tiket Bioskop', 'help', 'Untuk pemesanan tiket pada Bioskop raya, anda harus memenuhi syarat-syarat yang kami berika pada bagian selanjutnya, apa saja syarat yang harus anda penuhi atau bagaimana cara untuk mendapatkan tiket secara online dari biosko raya, berikut :\r\n\r\n1. yang pertama yg harus anda lakukan adalah register sebagai members.\r\n2. silahkan isi semua data-data register anda dengan baik dan benar.\r\n3. jika semua sudah di isi, maka silahkan klik submit button.\r\n4. jika sukses melakukan pendaftaran, anda sudah bisa melakukan login.\r\n5. masukkan pada halaman login username dan password anda waktu mendaftar.\r\n6. jika benar, anda akan di bawa ke halaman members.\r\n7. pada halaman members anda bisa memilih film di menu now plating untuk film yang akan kami putar, sedang kan di coming soon berisi daftar film yag akan release.\r\n8. pilih dan lihat trailer film yang anda ingin tonton terlebih dahulu jika mau.\r\n9. jika pilihan anda sudah benar, klik button pesan tiket.\r\n10 dan isi semua data-data pemesanan tiket anda dengan baenar.\r\n11. klik button submit.\r\n12. jika data2 yang anda isikan benar dan tiket masih ada, maka anda akan sukses memesan tiket.\r\n13. tiket yang di pesan akan masuk ke laporan pemesanan tiket dengan status baru.\r\n14. silahkan bayar tiket anda ke rekening bioskop raya dengan transfer.\r\n15 jika sudah transfer, silahkan konfrmasi pembayaran.\r\n16. setelah konfirmasi, tunggu status anda samapai di konfirmasi oleh admin.\r\n17. cetak jika status tiket sudah lunas atau di konfirmasi dan selesai.<br/>\r\n\r\n', 3);

-- --------------------------------------------------------

--
-- Table structure for table `studio`
--

CREATE TABLE IF NOT EXISTS `studio` (
  `id_studio` int(5) NOT NULL,
  `nama_studio` varchar(255) NOT NULL,
  `alamat_studio` text NOT NULL,
  `no_telpon` varchar(15) NOT NULL,
  `kursi` varchar(10) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studio`
--

INSERT INTO `studio` (`id_studio`, `nama_studio`, `alamat_studio`, `no_telpon`, `kursi`) VALUES
(1, 'studio 1', 'Ambon Plaza Lantai 4  Jl. Sam Ratulangi Ambon', '(0911) 321717', '150'),
(2, 'studio 2', 'Ambon Plaza Lantai 4  Jl. Sam Ratulangi Ambon', '(0911) 321717', '150'),
(3, 'studio 3', 'Ambon Plaza Lantai 4  Jl. Sam Ratulangi Ambon', '(0911) 321717', '150');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'members',
  `alamat_lengkap` varchar(255) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `nama_lengkap`, `email`, `no_telp`, `level`, `alamat_lengkap`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'sisil@yahoo.com', '081947492588', 'admin', ''),
('robby', '8d05dd2f03981f86b56c23951f3f34d7', 'Robby Prihandaya', 'robby.prihandaya@yahoo.com', '081267771344', 'members', 'Padang, Sumatera Barat');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jam`
--
ALTER TABLE `jam`
  ADD PRIMARY KEY (`id_jam`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD PRIMARY KEY (`id_konfirmasi`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_orders`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id_movie`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id_rekening`);

--
-- Indexes for table `statis`
--
ALTER TABLE `statis`
  ADD PRIMARY KEY (`id_statis`);

--
-- Indexes for table `studio`
--
ALTER TABLE `studio`
  ADD PRIMARY KEY (`id_studio`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jam`
--
ALTER TABLE `jam`
  MODIFY `id_jam` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  MODIFY `id_konfirmasi` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_orders` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=134;
--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `id_movie` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=116;
--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id_rekening` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `statis`
--
ALTER TABLE `statis`
  MODIFY `id_statis` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `studio`
--
ALTER TABLE `studio`
  MODIFY `id_studio` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
