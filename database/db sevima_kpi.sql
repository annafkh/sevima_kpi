-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 13 Agu 2025 pada 05.20
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sevima_kpi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_1f97b588ea738b9cbfca7afcf3417f7a', 'i:1;', 1754536382),
('laravel_cache_1f97b588ea738b9cbfca7afcf3417f7a:timer', 'i:1754536382;', 1754536382),
('laravel_cache_7cc70e7e2616c25f24272328f9cb9e1a', 'i:1;', 1754536300),
('laravel_cache_7cc70e7e2616c25f24272328f9cb9e1a:timer', 'i:1754536300;', 1754536300),
('laravel_cache_dfa7a0a1ca20fbd27807044f9fe52c68', 'i:1;', 1753684119),
('laravel_cache_dfa7a0a1ca20fbd27807044f9fe52c68:timer', 'i:1753684119;', 1753684119),
('laravel_cache_efc3743101e31b32747a7d0ef736bfdb', 'i:1;', 1754996381),
('laravel_cache_efc3743101e31b32747a7d0ef736bfdb:timer', 'i:1754996381;', 1754996381);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `catatan_pelanggaran`
--

CREATE TABLE `catatan_pelanggaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `karyawan_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `catatan_pelanggaran`
--

INSERT INTO `catatan_pelanggaran` (`id`, `karyawan_id`, `tanggal`, `deskripsi`, `created_at`, `updated_at`) VALUES
(5, 5, '2025-11-12', 'oke', '2025-07-27 23:32:25', '2025-07-28 00:04:02'),
(11, 6, '2025-08-11', 'memakai sandal waktu rapat', '2025-07-29 19:45:40', '2025-07-29 19:45:40'),
(13, 6, '2025-08-13', NULL, '2025-07-31 02:48:49', '2025-07-31 02:48:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawans`
--

CREATE TABLE `karyawans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ktp` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jk` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `nohp` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `karyawans`
--

INSERT INTO `karyawans` (`id`, `ktp`, `nama`, `jk`, `jabatan`, `nohp`, `created_at`, `updated_at`) VALUES
(5, '332211', 'Kusuma', 'Perempuan', 'Product Trainer', '082211122333', '2025-06-13 18:32:00', '2025-06-13 19:14:36'),
(6, '1222', 'Friska', 'Perempuan', 'PIC of CS', '081234457129', '2025-06-13 19:41:42', '2025-06-13 19:41:42'),
(7, '123321', 'Zakhfa', 'Laki - Laki', 'PIC of CS', '081234712394', '2025-06-13 19:42:11', '2025-06-13 19:42:11'),
(8, '798231946234', 'Rizki', 'Laki - Laki', 'PIC of CS', '0812649832789', '2025-06-13 19:42:40', '2025-06-13 19:42:40'),
(9, '23452323493', 'Dewi', 'Perempuan', 'Product Trainer', '084237423324', '2025-06-13 19:46:55', '2025-06-13 19:46:55'),
(10, '324982332424', 'Fais', 'Laki - Laki', 'Product Trainer', '081348249245', '2025-06-13 19:47:19', '2025-06-13 19:47:19'),
(11, '32423458293', 'Rahel', 'Perempuan', 'QA of CS', '08234572343432', '2025-06-13 19:52:14', '2025-06-13 19:52:22'),
(12, '32457823768432789', 'Jamal', 'Laki - Laki', 'QA of CS', '08324523423432', '2025-06-13 19:52:53', '2025-06-13 19:52:53'),
(13, '3527682578234', 'Farel', 'Laki - Laki', 'QA of CS', '0823548234724', '2025-06-13 19:53:13', '2025-06-13 19:53:13'),
(14, '234324', 'Annafi', 'Laki - Laki', 'Product Trainer', '081233432', '2025-06-16 21:55:05', '2025-06-16 21:55:05'),
(18, '2498482', 'dito', 'Laki - Laki', 'Product Trainer', '08234567346', '2025-06-19 04:40:53', '2025-06-19 04:40:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kpi_categories`
--

CREATE TABLE `kpi_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kpi_categories`
--

INSERT INTO `kpi_categories` (`id`, `nama`, `created_at`, `updated_at`, `deskripsi`) VALUES
(1, 'Responsibility', '2025-04-30 11:40:57', '2025-05-30 18:59:58', 'Dalam melakukan pekerjaan harus mempunyai peran untuk bertanggungjawab selain kepada shareholder juga kepada masyarakat luas.'),
(2, 'Openess', '2025-04-30 12:43:09', '2025-04-30 12:43:09', 'Pemikiran yang terbuka adalah sikap yang tepat untuk mendapatkan lebih banyak ide, fakta, pengetahuan dan kebijaksanaan untuk meningkatkan kinerja.'),
(6, 'Trustfullnes', '2025-04-30 12:44:24', '2025-04-30 12:44:24', 'Saling percaya satu sama lain, menjadi positif dan berwawasan ke depan menginspirasi semua orang untuk berkontribusi pada pembangunan.'),
(7, 'Integrity', '2025-04-30 12:45:07', '2025-04-30 12:45:07', 'Konsistensi dalam tindakan, nilai, prinsip menjadi dasar yang melekat pada diri sendiri sebagai nilai- nilai moral untuk pekerjaan menjadi lebih baik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kpi_indicators`
--

CREATE TABLE `kpi_indicators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kpi_category_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `bobot` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kpi_indicators`
--

INSERT INTO `kpi_indicators` (`id`, `kpi_category_id`, `nama`, `deskripsi`, `bobot`, `target`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 'Mampu menyelesaikan tugas dengan tepat waktu', '1. Menyelesaikan tugas kurang dari 30%, selain itu kualitas hasil kerjanya juga belum optimal. \r\n\r\n2. Beberapa kali tugas & proyek diselesaikan antara 31% - 60% ketepatan, dengan kualitas hasil kerja yang belum sepenuhnya memenuhi standard yang diharapkan. \r\n\r\n3. Menyelesaikan tugas tepat antara 61% - 80%, dan projek kerja yang diberikan, dengan kualitas hasil kerja memenuhi standard yang diharapkan. \r\n\r\n4. Secara konsisten tepat waktu dalam menyelesaikan tugas dan projek kerja yang diberikan sekurangnya 81% sampai 90%, dengan kualitas hasil kerja melebihi apa yang diharapkan oleh perusahaan.\r\n\r\n5. Konsisten 100% dalam menyelesaikan tugas dan projek kerja yang diberikan sebelum deadline yang diharapkan, dengan kualitas hasil kerja melebihi apa yang diharapkan oleh perusahaan', 10, 5, '2025-04-30 11:40:57', '2025-06-06 20:18:40', 'aktif'),
(2, 1, 'Mampu menyelesaikan pekerjaan dengan akurat & sesuai supervisi', '1. Menampilkan performa kerja yang belum memuaskan dengan level akurasi kerja yang tergolong rendah, konsisten menampilkan kesalahan major walaupun dengan supervisi yang ketat dari atasan\r\n\r\n2. Menampilkan performa kerja dengan level akurasi kerja yang tergolong cukup baik (masih acceptable), beberapa kali memunculkan kesalahan major walaupun dengan supervisi yang ketat dari atasan\r\n\r\n3. Sering tepat waktu menyelesaikan tugas dan projek kerja yang diberikan, dengan kualitas hasil kerja memenuhi standard yang diharapkan\r\n\r\n4. Menampilkan performa kerja dengan level akurasi kerja tergolong sangat baik, hanya melakukan kesalahan yang minim dan sifatnya minor, serta mampu bekerja dengan supervisi yang minim\r\n\r\n5. Menampilkan performa kerja dengan level kerja yang melebihi standard kerja yang diharapkan, akurasi kerja yang tergolong sangat baik dengan konsisten memberikan ide pembaharuan, serta mampu bekerja tanpa supervisi', 10, 5, '2025-04-30 11:40:57', '2025-05-10 11:54:21', 'aktif'),
(3, 1, 'Memberikan solusi atas permasalahan pelanggan (Internal & Eksternal)', '1. Sesekali peduli terhadap permasalaha n pelanggan internal dan eksternal, menyelesaik an 0% - 10% task\r\n\r\n2. Sering menunjukkan kepedulian dengan mengedukasi rekan kerja dan memberikan 11% - 40% alternatif solusi\r\n\r\n3. Selalu peduli dengan memberikan kesadaran kepada unit lain untuk membantu solusi pelanggan 41% - 70%\r\n\r\n4. Menjadi role model karena kepeduliannya, menyelesaikan 71% - 90% permasalahan pelanggan secara efektif\r\n\r\n5. Menampilkan performa di atas standar, akurasi sangat baik 91% - 100%, konsisten memberikan inovasi', 10, 5, '2025-04-30 11:40:57', '2025-05-10 11:57:19', 'aktif'),
(4, 2, 'Kemampuan adaptasi terhadap tantangan dan situasi yang dihadapi', '1. Mengenali adanya perbedaan pendapat dan pandangan di antara individu atau kelompok, menghargai diversitas dan mampu memahami sudut pandang yang berbeda dari pandangan pribadi.\r\n\r\n2. Menyesuaikan diri dengan berbagai individu atau kelompok yang berbeda selain itu mampu berkomunikas i dan berinteraksi secara efektif dengan gaya kerja yang berbeda, serta menyesuaikan pendekatan yang diperlukan sesuai dengan kebutuhan individu atau kelompok tersebut.\r\n\r\n3. Memiliki sikap yang terbuka terhadap perubahan dalam organisasi. Siap menerima dan mengadaptasi perubahan dengan cepat, baik itu perubahan proses, perubahan kebijakan, atau perubahan dalam tugas yang diberikan. Memberikan ide-ide perubahan yang sederhana\r\n\r\n4. Tidak hanya mampu beradaptasi dengan situasi yang berbeda, tetapi juga memiliki kemampuan kreativitas dalam menemukan solusi untuk masalah yang muncul. Dapat berpikir di luar batasan dan menemukan cara baru untuk menyelesaikan masalah dengan inovatif.\r\n\r\n5. Memiliki ketahanan mental yang tinggi dan mampu bangkit dari kegagalan atau situasi sulit. Dapat dengan cepat pulih dan beradaptasi setelah menghadapi rintangan atau perubahan yang tidak terduga.', 10, 5, '2025-05-07 09:10:26', '2025-05-10 11:58:58', 'aktif'),
(5, 2, 'Menggunakan Pemecahan masalah yang berbeda/unik/krea tif, fokus pada solusi, dan berdasar data/fakta', '1. Belum memahami pentingnya bersikap terbuka dan berbasis fakta/data terhadap berbagai cara pemecahan masalah, tidak fokus pada solusi dan cenderung menyalahkan pihak lain dalam suatu permasalaha n, belum mampu menyusun perbaikan terhadap solusi yang sudah ada.\r\n\r\n2. Mengetahui pentingnya bersikap terbuka terhadap berbagai cara pemecahan masalah, belum konsisten menggunakan data/fakta dalam pemecahan masalah, menunjukkan usaha yang cukup untuk fokus pada solusi dalam melakukan perbaikan terhadap solusi yang ada.\r\n\r\n3. Berani menyampaikan solusi dengan memperhatika n data dan fakta serta dampak pemecahan masalah yang terkait dengan pihak lain; dalam rangka menemukan solusi-solusi kreatif yang dapat digunakan di lingkup kerja pribadi dan rekan satu tim.\r\n\r\n4. Menggunakan konsep-konsep baru dalam memandang permasalahan secara lebih luas untuk mencari alternatif pemecahan masalah yang lebih kreatif di unit kerjanya dengan mempertimbangk an berbagai data dan fakta yang ada.\r\n\r\n5. Berani mengimplementasikan ide/cara yang tidak biasa dalam memecahkan masalah atau menemukan peluang yang menguntungkan perusahaan dengan mempertimbangka n berbagai data dan fakta yang ada. Mau mengakui kesalahan atas solusi yang ditawarkan dan mampu menyusun rencana perbaikan dari kesalahan yang dilakukan.', 10, 5, '2025-05-07 09:11:37', '2025-05-10 12:35:11', 'aktif'),
(6, 6, 'Mampu untuk memberikan usaha lebih untuk mencapai tujuan organisasi dengan menyelaraskan kepentingan pribadi dengan kebutuhan, prioritas, dan sasaran organisasi.', '1. Bekerja sesuai dengan job desc dan belum mampu menampilka n kinerja melebihi dari apa yang diharapkan\r\n\r\n2. Bekerja sesuai dengan job desc dan sesekali mampu menampilkan kinerja melebihi dari apa yang diharapkan ketika diminta oleh atasan\r\n\r\n3. Dengan penuh semangat selalu berusaha bekerja melebihi dari apa yang diharapkan untuk mengembangk an tujuan tim kerja dan memenuhi kebutuhan organisasi dengan kualitas kerja yang cukup baik\r\n\r\n4. Berinisiatif melakukan pengorbanan pribadi tanpa diminta untuk mencapai tujuan strategis organisasi, dengan tetap memperhatikan penyelesaian tugasnya sendiri dengan kualitas kerja yang baik. Mampu menyelaraskan antara kepentingan pribadi dengan kepentingan, sasaran, dan prioritas organisasi.\r\n\r\n5. Menunjukkan komitmen yang luar biasa serta konsisten mengambil tindakan beresiko terukur dalam membuat langkah- langkah yang komprehensif dan dibutuhkan untuk mencapai tujuan strategis organisasi dan mengamankan kepentingan organisasi. Mampu menjadi teladan dan menularkan komitmen tersebut kepada rekan kerja lainnya.', 10, 5, '2025-05-07 09:12:17', '2025-05-10 12:50:48', 'aktif'),
(7, 6, 'Memberikan bantuan, masukan positif/aktif untuk perbaikan kinerja tim', '1. Belum konsisten dalam membantu tim kerjanya yang mengalami kesulitan, dan cenderung tidak ingin memberikan masukan- masukan untuk tim kerjanya\r\n\r\n2. Mampu membantu tim kerjanya yang mengalami kesulitan, namun cenderung membantu ala kadarnya/ sesuai yang diminta saja.\r\n\r\n3. Memiliki inisiatif untuk membantu tim kerjanya dalam menghadapi permasalahan dan menanggapiny a dengan sikap simpati (contoh: mau mendengar keluh kesah dan memberikan saran yang sesuai).\r\n\r\n4. Konsisten membantu tim kerjanya untuk mengatasi hambatan yang dialami, tanpa mengorbankan tanggung jawab pribadi (membantu permasalahan rekan kerjanya melebihi dari apa yang diharapkan).\r\n\r\n5. Mampu menjadi role model bagi unit kerja sendiri dan unit lain, bahkan mampu menyediakan waktu untuk membantu unit kerja lain tanpa mengorbankan kepentingan tim kerjanya sendiri', 10, 5, '2025-05-07 09:12:39', '2025-05-10 12:54:46', 'aktif'),
(8, 7, 'Menampilkan perilaku yang sesuai dengan kode etik perilaku profesional dan peraturan perusahaan', '1. Belum sepenuhnya memahami dan mengikuti kode etik yang berlaku di tempat kerja, serta belum mampu menunjukka n kesadaran terhadap pentingnya menjaga integritas dalam lingkungan kerja.\r\n\r\n2. Menunjukan perilaku sesuai dengan kode etik yang berlaku di tempat kerja, menunjukkan kesadaran terhadap pentingnya menjaga integritas dalam lingkungan kerja. Tidak mengungkapk an informasi yang bersifat pribadi atau rahasia tanpa izin yang sesuai, sesekali masih masih memerlukan reminder agar perilakunya bisa benar- benar sesuai dengan kode etik di tempat kerja yang diharapkan\r\n\r\n3. Mampu menjadi teladan di tim kerjanya dalam menampilkan perilaku yang sesuai dengan kode etik, peraturan dan kebijakan perusahaan serta mampu menghindari situasi dan melaporkan kepada pihak yang berkepentinga n di mana terdapat potensi benturan kepentingan antara tugas pekerjaan dan kepentingan pribadi.\r\n\r\n4. Mampu menjadi pembimbing untuk unit kerjanya dan eksternal karena menampilkan perilaku yang sesuai dengan kode etik, peraturan dan kebijakan perusahaan dengan kemampuan komunikasi yang profesional, hormat, dan sopan. Mampu mendengarkan dengan saksama dan memberikan tanggapan yang relevan dan tepat serta menghindari komunikasi yang tidak pantas atau merugikan bagi pihak lain.\r\n\r\n5. Membangun dan mengupayakan budaya kerja yang mendorong kepatuhan terhadap kode etik profesional, menjunjung tinggi prosedur, dan kebijakan perusahaan, serta melakukan langkah perbaikan secara konsisten yang kemudian bisa diterapkan dalam konteks organisasi secara keseluruhan', 10, 5, '2025-05-07 09:13:17', '2025-05-10 13:00:37', 'aktif'),
(9, 7, 'Memiliki komitmen kerja yang tinggi untuk perusahaan', '1. Kurang mampu berkomitmen dalam menyelesaik an tugas dan pekerjaan (memenuhi 0% - 50% tugas)\r\n\r\n2. Mampu berkomitmen dalam bekerja dengan memenuhi tuntutan batas waktu yang telah ditetapkan (51% - 70%)\r\n\r\n3. Menunjukkan komitmen tinggi dengan menjaga kualitas hasil kerja sesuai atau melebihi standar (71% - 85%)\r\n\r\n4. Mampu membangun budaya komitmen dalam tim, misalnya membuat aturan yang diikuti seluruh anggota (86% - 95%)\r\n\r\n5. Menegakkan budaya kerja yang menjunjung komitmen organisasi secara luas, mencapai/melebihi target ≥ 95%', 10, 5, '2025-05-07 09:14:06', '2025-05-10 13:02:17', 'aktif'),
(10, 7, 'Menampilkan konsistensi antara perkataan dan tindakan, mengambil tindakan konkret yang sejalan dengan apa yang telah dikatakan atau dinyatakan sebelumnya', '1. Masih tidak konsisten dalam menunjukka n kesesuaian antara perkataan dan tindakan (0% - 50% tindakan sesuai ucapan)\r\n\r\n2. Mampu secara konsisten menunjukkan kesesuaian yang baik antara perkataan dan tindakan (51% - 70% tindakan sesuai)\r\n\r\n3. Selalu konsisten dan dapat diandalkan, membangun kepercayaan dari orang lain (71% - 85% tindakan sesuai dan dipercaya\r\n\r\n4. Mencerminkan konsistensi luar biasa sesuai dengan nilai organisasi dan menjadi teladan yang kuat (86% - 95% sesuai)\r\n\r\n5. Menjadi teladan dan perubahan dalam mendorong budaya konsistensi di seluruh organisasi (≥ 95% sesuai)', 10, 5, '2025-05-07 09:14:29', '2025-06-03 00:26:22', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kpi_scores`
--

CREATE TABLE `kpi_scores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `karyawan_id` bigint(20) UNSIGNED NOT NULL,
  `kpi_indicator_id` bigint(20) UNSIGNED NOT NULL,
  `nilai` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `feedback` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kpi_scores`
--

INSERT INTO `kpi_scores` (`id`, `karyawan_id`, `kpi_indicator_id`, `nilai`, `tanggal`, `created_at`, `updated_at`, `feedback`) VALUES
(50, 6, 1, 4, '2025-06-14', '2025-06-13 20:16:05', '2025-06-13 20:16:05', NULL),
(51, 6, 2, 5, '2025-06-14', '2025-06-13 20:16:08', '2025-06-13 20:16:08', NULL),
(52, 6, 3, 4, '2025-06-14', '2025-06-13 20:16:13', '2025-06-13 20:16:13', NULL),
(53, 6, 4, 5, '2025-06-14', '2025-06-13 20:16:16', '2025-06-13 20:16:16', NULL),
(54, 6, 5, 3, '2025-06-14', '2025-06-13 20:16:19', '2025-06-13 20:16:19', NULL),
(55, 6, 6, 5, '2025-06-14', '2025-06-13 20:16:22', '2025-06-13 20:16:22', NULL),
(56, 6, 7, 4, '2025-06-14', '2025-06-13 20:16:25', '2025-06-13 20:16:25', NULL),
(57, 6, 8, 3, '2025-06-14', '2025-06-13 20:16:28', '2025-06-13 20:16:28', NULL),
(58, 6, 9, 5, '2025-06-14', '2025-06-13 20:16:31', '2025-06-13 20:16:31', NULL),
(59, 6, 10, 3, '2025-06-14', '2025-06-13 20:16:34', '2025-06-13 20:16:34', NULL),
(60, 7, 1, 5, '2025-06-14', '2025-06-13 20:17:05', '2025-06-13 20:17:05', NULL),
(61, 7, 2, 4, '2025-06-14', '2025-06-13 20:17:09', '2025-06-13 20:17:09', NULL),
(62, 7, 3, 5, '2025-06-14', '2025-06-13 20:17:12', '2025-06-13 20:17:12', NULL),
(63, 7, 4, 4, '2025-06-14', '2025-06-13 20:17:15', '2025-06-13 20:17:15', NULL),
(64, 7, 5, 4, '2025-06-14', '2025-06-13 20:17:17', '2025-06-13 20:17:17', NULL),
(65, 7, 6, 5, '2025-06-14', '2025-06-13 20:17:20', '2025-06-13 20:17:20', NULL),
(66, 7, 7, 5, '2025-06-14', '2025-06-13 20:17:24', '2025-06-13 20:17:24', NULL),
(67, 7, 8, 5, '2025-06-14', '2025-06-13 20:17:26', '2025-06-13 20:17:26', NULL),
(68, 7, 9, 4, '2025-06-14', '2025-06-13 20:17:29', '2025-06-13 20:17:29', NULL),
(69, 7, 10, 5, '2025-06-14', '2025-06-13 20:17:32', '2025-06-13 20:17:32', NULL),
(70, 8, 1, 3, '2025-06-14', '2025-06-13 20:17:48', '2025-06-13 20:17:48', NULL),
(71, 8, 2, 4, '2025-06-14', '2025-06-13 20:17:51', '2025-06-13 20:17:51', NULL),
(72, 8, 3, 3, '2025-06-14', '2025-06-13 20:17:54', '2025-06-13 20:17:54', NULL),
(73, 8, 4, 2, '2025-06-14', '2025-06-13 20:17:57', '2025-06-13 20:17:57', NULL),
(74, 8, 5, 5, '2025-06-14', '2025-06-13 20:18:00', '2025-06-13 20:18:00', NULL),
(75, 8, 6, 4, '2025-06-14', '2025-06-13 20:18:02', '2025-06-13 20:18:02', NULL),
(76, 8, 7, 3, '2025-06-14', '2025-06-13 20:18:05', '2025-06-13 20:18:05', NULL),
(77, 8, 8, 4, '2025-06-14', '2025-06-13 20:18:08', '2025-06-13 20:18:08', NULL),
(78, 8, 9, 2, '2025-06-14', '2025-06-13 20:18:12', '2025-06-13 20:18:12', NULL),
(79, 8, 10, 3, '2025-06-14', '2025-06-13 20:18:15', '2025-06-13 20:18:15', NULL),
(80, 5, 1, 4, '2025-06-14', '2025-06-13 20:31:57', '2025-06-13 20:31:57', NULL),
(81, 5, 2, 5, '2025-06-14', '2025-06-13 20:32:01', '2025-06-13 20:32:01', NULL),
(82, 5, 3, 4, '2025-06-14', '2025-06-13 20:32:06', '2025-06-13 20:32:06', NULL),
(83, 5, 4, 4, '2025-06-14', '2025-06-13 20:32:09', '2025-06-13 20:32:09', NULL),
(84, 5, 5, 3, '2025-06-14', '2025-06-13 20:32:12', '2025-06-13 20:32:12', NULL),
(85, 5, 6, 5, '2025-06-14', '2025-06-13 20:32:15', '2025-06-13 20:32:15', NULL),
(86, 5, 7, 4, '2025-06-14', '2025-06-13 20:32:17', '2025-06-13 20:32:17', NULL),
(87, 5, 8, 3, '2025-06-14', '2025-06-13 20:32:20', '2025-06-13 20:32:20', NULL),
(88, 5, 9, 4, '2025-06-14', '2025-06-13 20:32:23', '2025-06-13 20:32:23', NULL),
(89, 5, 10, 3, '2025-06-14', '2025-06-13 20:32:26', '2025-06-13 20:32:26', NULL),
(90, 9, 1, 4, '2025-06-14', '2025-06-13 20:32:41', '2025-06-13 20:32:41', NULL),
(91, 9, 2, 3, '2025-06-14', '2025-06-13 20:32:44', '2025-06-13 20:32:44', NULL),
(92, 9, 3, 3, '2025-06-14', '2025-06-13 20:32:47', '2025-06-13 20:32:47', NULL),
(93, 9, 4, 4, '2025-06-14', '2025-06-13 20:32:50', '2025-06-13 20:32:50', NULL),
(94, 9, 5, 3, '2025-06-14', '2025-06-13 20:32:52', '2025-06-13 20:32:52', NULL),
(95, 9, 6, 4, '2025-06-14', '2025-06-13 20:32:55', '2025-06-13 20:32:55', NULL),
(96, 9, 7, 3, '2025-06-14', '2025-06-13 20:32:58', '2025-06-13 20:32:58', NULL),
(97, 9, 8, 4, '2025-06-14', '2025-06-13 20:33:01', '2025-06-13 20:33:01', NULL),
(98, 9, 9, 3, '2025-06-14', '2025-06-13 20:33:03', '2025-06-13 20:33:03', NULL),
(99, 9, 10, 4, '2025-06-14', '2025-06-13 20:33:06', '2025-06-13 20:33:06', NULL),
(100, 10, 1, 5, '2025-06-14', '2025-06-13 20:33:27', '2025-06-13 20:33:27', NULL),
(101, 10, 2, 5, '2025-06-14', '2025-06-13 20:33:30', '2025-06-13 20:33:30', NULL),
(102, 10, 3, 4, '2025-06-14', '2025-06-13 20:33:33', '2025-06-13 20:33:33', NULL),
(103, 10, 4, 5, '2025-06-14', '2025-06-13 20:33:35', '2025-06-13 20:33:35', NULL),
(104, 10, 5, 4, '2025-06-14', '2025-06-13 20:33:38', '2025-06-13 20:33:38', NULL),
(105, 10, 6, 4, '2025-06-14', '2025-06-13 20:33:40', '2025-06-13 20:33:40', NULL),
(106, 10, 7, 5, '2025-06-14', '2025-06-13 20:33:43', '2025-06-13 20:33:43', NULL),
(107, 10, 8, 3, '2025-06-14', '2025-06-13 20:33:46', '2025-06-13 20:33:46', NULL),
(108, 10, 9, 3, '2025-06-14', '2025-06-13 20:33:55', '2025-06-13 20:33:55', NULL),
(109, 10, 10, 4, '2025-06-14', '2025-06-13 20:33:58', '2025-06-13 20:33:58', NULL),
(110, 11, 1, 4, '2025-06-14', '2025-06-13 20:36:20', '2025-06-13 20:36:20', NULL),
(111, 11, 2, 3, '2025-06-14', '2025-06-13 20:36:23', '2025-06-13 20:36:23', NULL),
(112, 11, 3, 5, '2025-06-14', '2025-06-13 20:36:26', '2025-06-13 20:36:26', NULL),
(113, 11, 4, 4, '2025-06-14', '2025-06-13 20:36:28', '2025-06-13 20:36:28', NULL),
(114, 11, 5, 5, '2025-06-14', '2025-06-13 20:36:31', '2025-06-13 20:36:31', NULL),
(115, 11, 6, 4, '2025-06-14', '2025-06-13 20:36:34', '2025-06-13 20:36:34', NULL),
(116, 11, 7, 5, '2025-06-14', '2025-06-13 20:36:37', '2025-06-13 20:36:37', NULL),
(117, 11, 8, 3, '2025-06-14', '2025-06-13 20:36:39', '2025-06-13 20:36:39', NULL),
(118, 11, 9, 5, '2025-06-14', '2025-06-13 20:36:42', '2025-06-13 20:36:42', NULL),
(119, 11, 10, 4, '2025-06-14', '2025-06-13 20:36:45', '2025-06-13 20:36:45', NULL),
(120, 12, 1, 3, '2025-06-14', '2025-06-13 20:37:01', '2025-06-13 20:37:01', NULL),
(121, 12, 2, 4, '2025-06-14', '2025-06-13 20:37:04', '2025-06-13 20:37:04', NULL),
(122, 12, 3, 2, '2025-06-14', '2025-06-13 20:37:07', '2025-06-13 20:37:07', NULL),
(123, 12, 4, 3, '2025-06-14', '2025-06-13 20:37:14', '2025-06-13 20:37:14', NULL),
(124, 12, 5, 4, '2025-06-14', '2025-06-13 20:37:16', '2025-06-13 20:37:16', NULL),
(125, 12, 6, 2, '2025-06-14', '2025-06-13 20:37:19', '2025-06-13 20:37:19', NULL),
(126, 12, 7, 3, '2025-06-14', '2025-06-13 20:37:23', '2025-06-13 20:37:23', NULL),
(127, 12, 8, 4, '2025-06-14', '2025-06-13 20:37:25', '2025-06-13 20:37:25', NULL),
(128, 12, 9, 2, '2025-06-14', '2025-06-13 20:37:28', '2025-06-13 20:37:28', NULL),
(129, 12, 10, 3, '2025-06-14', '2025-06-13 20:37:31', '2025-06-13 20:37:31', NULL),
(130, 13, 1, 4, '2025-06-14', '2025-06-13 20:37:45', '2025-06-13 20:37:45', NULL),
(131, 13, 2, 3, '2025-06-14', '2025-06-13 20:37:47', '2025-06-13 20:37:47', NULL),
(132, 13, 3, 4, '2025-06-14', '2025-06-13 20:37:50', '2025-06-13 20:37:50', NULL),
(133, 13, 4, 3, '2025-06-14', '2025-06-13 20:37:53', '2025-06-13 20:37:53', NULL),
(134, 13, 5, 4, '2025-06-14', '2025-06-13 20:37:56', '2025-06-13 20:37:56', NULL),
(135, 13, 6, 5, '2025-06-14', '2025-06-13 20:37:59', '2025-06-13 20:37:59', NULL),
(136, 13, 7, 3, '2025-06-14', '2025-06-13 20:38:02', '2025-06-13 20:38:02', NULL),
(137, 13, 8, 5, '2025-06-14', '2025-06-13 20:38:06', '2025-06-13 20:38:06', NULL),
(138, 13, 9, 4, '2025-06-14', '2025-06-13 20:38:08', '2025-06-13 20:38:08', NULL),
(139, 13, 10, 3, '2025-06-14', '2025-06-13 20:38:11', '2025-06-13 20:38:11', NULL),
(141, 14, 1, 5, '2025-06-17', '2025-06-16 22:02:47', '2025-06-16 22:02:47', NULL),
(152, 6, 1, 2, '2025-08-07', '2025-08-06 20:11:30', '2025-08-06 20:11:30', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `leader_karyawans`
--

CREATE TABLE `leader_karyawans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `leader_user_id` bigint(20) UNSIGNED NOT NULL,
  `karyawan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `leader_karyawans`
--

INSERT INTO `leader_karyawans` (`id`, `leader_user_id`, `karyawan_id`, `created_at`, `updated_at`) VALUES
(1, 6, 5, '2025-06-13 18:32:25', '2025-06-13 18:32:25'),
(2, 3, 6, '2025-06-13 19:43:21', '2025-06-13 19:43:21'),
(3, 3, 7, '2025-06-13 19:44:04', '2025-06-13 19:44:04'),
(4, 3, 8, '2025-06-13 19:44:31', '2025-06-13 19:44:31'),
(5, 6, 9, '2025-06-13 19:47:48', '2025-06-13 19:47:48'),
(6, 6, 10, '2025-06-13 19:48:31', '2025-06-13 19:48:31'),
(7, 10, 13, '2025-06-13 19:53:45', '2025-06-13 19:53:45'),
(8, 10, 12, '2025-06-13 19:54:03', '2025-06-13 19:54:03'),
(9, 10, 11, '2025-06-13 19:54:40', '2025-06-13 19:54:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_07_084453_add_two_factor_columns_to_users_table', 1),
(5, '2025_04_07_084512_create_personal_access_tokens_table', 1),
(6, '2025_04_07_084834_add_role_to_users_table', 1),
(7, '2025_04_08_020404_create_karyawans_table', 1),
(8, '2025_05_01_013658_create_kpi_categories_table', 1),
(9, '2025_05_01_013739_create_kpi_indicators_table', 1),
(10, '2025_05_01_013755_create_kpi_scores_table', 1),
(11, '2025_05_01_023128_add_deskripsi_to_kpi_categories_table', 1),
(12, '2025_05_06_004829_add_feedback_to_kpi_scores_table', 1),
(13, '2025_05_11_013828_add_deskripsi_to_kpi_indicators_table', 1),
(14, '2025_05_30_034715_add_tanggal_to_kpi_scores_table', 1),
(15, '2025_06_13_083807_create_leader_karyawans_table', 2),
(16, '2025_07_14_062058_create_progress_tasks_table', 3),
(17, '2025_07_24_150057_create_catatan_pelanggaran_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `progress_tasks`
--

CREATE TABLE `progress_tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `karyawan_id` bigint(20) UNSIGNED NOT NULL,
  `judul_tugas` varchar(255) NOT NULL,
  `deadline` date NOT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `tepat_waktu` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `progress_tasks`
--

INSERT INTO `progress_tasks` (`id`, `karyawan_id`, `judul_tugas`, `deadline`, `tanggal_selesai`, `tepat_waktu`, `created_at`, `updated_at`) VALUES
(2, 6, 'tes2', '2025-12-12', '2025-11-11', 1, '2025-07-25 02:35:36', '2025-07-25 02:35:36'),
(3, 6, 'testing', '2026-01-15', '2026-02-21', 0, '2025-07-25 02:36:10', '2025-07-25 02:36:10'),
(4, 5, 'sad', '2025-11-11', '2025-11-10', 1, '2025-07-27 23:34:51', '2025-07-27 23:34:51'),
(5, 5, 'testing', '2025-02-11', '2025-01-11', 1, '2025-07-28 00:31:39', '2025-07-28 00:31:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('K1OOaryZflRYJsSux5GYa6bAM1iLuhzLeuLMY49H', 2, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZW1sNzd1VFN0WUdoeTAzS3JKR1FudjRJNThvaVViTDYxQUtjUkF5YiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jaGFydC1kYXRhL3NlbWVzdGVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1754996427),
('u31iX4QmDFcLelYmNz3YXpYjbiZJWXQZRFnxFlr8', 12, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNFAxNEE0dDhTVlcyU1VoV1Bhd0FSeE1TN1pubERxYUlHOUNNWnZmdyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQva2FyeWF3YW4iO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxMjt9', 1754536335);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'karyawan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `role`) VALUES
(2, 'HC Sevima', 'hc@kpi.com', NULL, '$2y$12$dySUQwvxbetvVdyhr5lPJOf83kEdckJTx81AkuR3fLsf6XBqhWzMy', NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-30 18:48:27', '2025-05-30 18:48:27', 'hc'),
(3, 'Leader PIC of CS', 'leader@kpi.com', NULL, '$2y$12$JNUkFyaYN10HIEzq6xlztO0xr6WwzXhoT3wU8nO/SAIoHm41x7IQO', NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-30 18:49:13', '2025-06-13 18:59:15', 'leader'),
(6, 'Leader Product Trainer', 'leader1@kpi.com', NULL, '$2y$12$bRdESZLr2YRJz9UW7MHWoe70xEUJ2Zuu2g9yFR3oRcDoULyT1qOe.', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-13 02:09:16', '2025-06-13 18:59:42', 'leader'),
(9, 'Kusuma', 'kusuma@gmail.com', NULL, '$2y$12$M86NpIC8uqoFEvf.ZzuKcORlctFThOGYYIi484Cj3nL1DncuPY/jG', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-13 18:32:25', '2025-06-13 18:32:25', 'karyawan'),
(10, 'Leader QA of CS', 'leader2@kpi.com', NULL, '$2y$12$jv5toItmHjXnWBGPU.zhBOo585eqWz7uQTagKhUT/knC6p/98VlWe', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-13 19:00:26', '2025-06-13 19:00:26', 'leader'),
(11, 'Friska', 'friska@gmail.com', NULL, '$2y$12$mSQRdW9oV9/K5Lc6ALVcCOyb42Ti6Fc2rhXLYWkFymC6vC8.Qsh0K', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-13 19:43:21', '2025-06-13 19:43:32', 'karyawan'),
(12, 'Zakhfa', 'zakhfa@gmail.com', NULL, '$2y$12$rEdwRhy/jRTOkYYTOkM6GenvKsV4yYC29efvbwSLB9H32X9sS4bH2', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-13 19:44:04', '2025-06-13 19:44:04', 'karyawan'),
(13, 'Rizki', 'rizki@gmail.com', NULL, '$2y$12$hbWo0dJDcIsrzR3FmakheeZsYBSSc9IwoidyJh.GP11gIGEwg22ku', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-13 19:44:31', '2025-06-13 19:44:31', 'karyawan'),
(14, 'Dewi', 'dewi@gmail.com', NULL, '$2y$12$I7bIQ5/cUDTlQtMuONPvNuNgFKgtL8ZuoFvDoTw04y94/E34fihri', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-13 19:47:48', '2025-06-13 19:47:48', 'karyawan'),
(15, 'Fais', 'fais@gmail.com', NULL, '$2y$12$h4KwLb2qzIt3ogT3mKw.BOiv845thDPSynUWjg.Pl7fu/avHL.Yby', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-13 19:48:31', '2025-06-13 19:48:31', 'karyawan'),
(16, 'Farel', 'farel@gmail.com', NULL, '$2y$12$qAI.Ye25drD8M7p6UVuAG.mTz7pmorGP0TPh/P10ntJM0pCeFHYAG', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-13 19:53:45', '2025-06-13 19:53:45', 'karyawan'),
(17, 'Jamal', 'jamal@gmail.com', NULL, '$2y$12$eXNufonx/oG42ZB557B3FORlutKMqZRsnSgBMmfkYedn1prUMhJEG', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-13 19:54:03', '2025-06-13 19:54:03', 'karyawan'),
(18, 'Rahel', 'rahel@gmail.com', NULL, '$2y$12$VYMVZbq/6bpQCoREo2PrOehoq6jKnzSlgCbMJ5Rtcdlm0p9qC3806', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-13 19:54:40', '2025-06-13 19:54:40', 'karyawan'),
(19, 'annafi', 'annafi@kpi.com', NULL, '$2y$12$vDCeSGStzBG2X5kFGMqqJ.oQygh5f9GSB2dpNL7lzu7RRgPebWDCW', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-16 22:02:14', '2025-06-16 22:07:15', 'karyawan'),
(21, 'test', 'abcd@gma.com', NULL, '$2y$12$C39NylfGi9gRhcey4kcp3OVecVSQWedCC2Wl1CILwWzqerO8xnAGC', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-18 00:22:07', '2025-06-18 00:22:07', 'karyawan'),
(22, 'dito', 'dio@kpi.com', NULL, '$2y$12$Oh3Tw3/kZXAJyo3QViR9Wuw055Du7yMyhxJqhqY5PFB9jT39/orpW', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-19 04:42:25', '2025-06-19 04:42:25', 'karyawan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `catatan_pelanggaran`
--
ALTER TABLE `catatan_pelanggaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `karyawans`
--
ALTER TABLE `karyawans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `karyawans_ktp_unique` (`ktp`);

--
-- Indeks untuk tabel `kpi_categories`
--
ALTER TABLE `kpi_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kpi_indicators`
--
ALTER TABLE `kpi_indicators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kpi_indicators_kpi_category_id_foreign` (`kpi_category_id`);

--
-- Indeks untuk tabel `kpi_scores`
--
ALTER TABLE `kpi_scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kpi_scores_karyawan_id_foreign` (`karyawan_id`),
  ADD KEY `kpi_scores_kpi_indicator_id_foreign` (`kpi_indicator_id`);

--
-- Indeks untuk tabel `leader_karyawans`
--
ALTER TABLE `leader_karyawans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leader_karyawans_leader_user_id_foreign` (`leader_user_id`),
  ADD KEY `leader_karyawans_karyawan_id_foreign` (`karyawan_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `progress_tasks`
--
ALTER TABLE `progress_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `progress_tasks_karyawan_id_foreign` (`karyawan_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `catatan_pelanggaran`
--
ALTER TABLE `catatan_pelanggaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `karyawans`
--
ALTER TABLE `karyawans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `kpi_categories`
--
ALTER TABLE `kpi_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kpi_indicators`
--
ALTER TABLE `kpi_indicators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `kpi_scores`
--
ALTER TABLE `kpi_scores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT untuk tabel `leader_karyawans`
--
ALTER TABLE `leader_karyawans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `progress_tasks`
--
ALTER TABLE `progress_tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kpi_indicators`
--
ALTER TABLE `kpi_indicators`
  ADD CONSTRAINT `kpi_indicators_kpi_category_id_foreign` FOREIGN KEY (`kpi_category_id`) REFERENCES `kpi_categories` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kpi_scores`
--
ALTER TABLE `kpi_scores`
  ADD CONSTRAINT `kpi_scores_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kpi_scores_kpi_indicator_id_foreign` FOREIGN KEY (`kpi_indicator_id`) REFERENCES `kpi_indicators` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `leader_karyawans`
--
ALTER TABLE `leader_karyawans`
  ADD CONSTRAINT `leader_karyawans_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `leader_karyawans_leader_user_id_foreign` FOREIGN KEY (`leader_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `progress_tasks`
--
ALTER TABLE `progress_tasks`
  ADD CONSTRAINT `progress_tasks_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
