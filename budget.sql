-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jun 2025 pada 08.50
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `budget`
--

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
-- Struktur dari tabel `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `items`
--

INSERT INTO `items` (`id`, `nama`, `kategori`, `harga`, `deskripsi`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Kemeja Cream', 'Kemeja', 6500, 'Kemeja dengan motif batik biru elegan.', 'layout/kemeja_cream.png', '2025-05-25 09:43:43', '2025-05-25 09:43:43'),
(2, 'Celana Chinos', 'Hoodie', 3500, 'Hoodie warna hitam nyaman dan stylish.', 'layout/Celana_Chinos.jpg', '2025-05-25 09:43:43', '2025-05-25 09:43:43'),
(4, 'Kaos Lengan Panjang', 'Kemeja', 1240000, 'Kemeja dengan motif batik biru elegan.', 'layout/kaos_lengan.jpg', '2025-05-25 17:40:42', '2025-05-25 17:40:42'),
(8, 'Jaket Sport', 'Jaket', 1890000, 'Jaket jeans warna hitam yang stylish dan cocok dipadukan dengan apa saja.', 'layout/Jaket_sport.jpg', '2025-05-25 17:40:42', '2025-05-25 17:40:42');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2025_05_25_164106_create_items_table', 2),
(5, '2025_05_26_164042_create_wishlists_table', 3);

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

--
-- Dumping data untuk tabel `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'auth_token', '847c1172edd0d61e015e8d88be1d3e288fdf89ebcedfb64038da8bc2775c4414', '[\"*\"]', '2025-05-25 11:44:44', NULL, '2025-05-25 11:43:17', '2025-05-25 11:44:44'),
(2, 'App\\Models\\User', 1, 'auth_token', '389b86a1369ab951de44e6c1a4c748f99553b1f5e703f7f02e657f8bcea2c424', '[\"*\"]', '2025-05-25 12:03:56', NULL, '2025-05-25 12:02:59', '2025-05-25 12:03:56'),
(3, 'App\\Models\\User', 1, 'auth_token', '02eb0df914d00d114057824648d11a1a0818121cb842b89bdd3518d5b4f17367', '[\"*\"]', '2025-05-25 12:09:06', NULL, '2025-05-25 12:06:11', '2025-05-25 12:09:06'),
(4, 'App\\Models\\User', 1, 'auth_token', '0c60b03258d0120becb5960b948e820a10925bfff136617c537fdf875284dc36', '[\"*\"]', '2025-05-25 12:14:16', NULL, '2025-05-25 12:13:49', '2025-05-25 12:14:16'),
(5, 'App\\Models\\User', 1, 'auth_token', 'af227c53f58df10675d81562a7c28a8979c36f78652d96c15f71bc69e202e52a', '[\"*\"]', '2025-05-25 12:23:04', NULL, '2025-05-25 12:21:57', '2025-05-25 12:23:04'),
(6, 'App\\Models\\User', 1, 'auth_token', 'c632a14f7c0eda2e5d5901363e80b52cee0b89a84d7c87470fb0004b707f9018', '[\"*\"]', '2025-05-25 12:25:56', NULL, '2025-05-25 12:25:52', '2025-05-25 12:25:56'),
(7, 'App\\Models\\User', 1, 'auth_token', '05aac03dc3ba31ab81ef5229bcb7d7b0cf73c67cca2ddab1871165bf67dd04f2', '[\"*\"]', '2025-05-25 12:28:36', NULL, '2025-05-25 12:28:13', '2025-05-25 12:28:36'),
(8, 'App\\Models\\User', 1, 'auth_token', 'ad755d1ccd21d255430ccb172c3f4c78fc43669a9380a3ef975374ad4658facb', '[\"*\"]', '2025-05-25 12:34:02', NULL, '2025-05-25 12:33:20', '2025-05-25 12:34:02'),
(9, 'App\\Models\\User', 1, 'auth_token', 'c87a17b613d8fc51fd5512a24bb7fba1649d3770dc93d2d82acc5f3608d2e019', '[\"*\"]', NULL, NULL, '2025-05-26 08:37:37', '2025-05-26 08:37:37'),
(10, 'App\\Models\\User', 1, 'auth_token', '4e6aeb6b6cfbf2f9f5a6c8ac7c7245e5ce72475e641c1ae7e2d0286cb66804bc', '[\"*\"]', NULL, NULL, '2025-05-26 08:37:40', '2025-05-26 08:37:40'),
(11, 'App\\Models\\User', 1, 'auth_token', '341efda689af5383fa771779438577abfd3dacda0cbb4fb165a455631ad5085a', '[\"*\"]', NULL, NULL, '2025-05-26 08:37:40', '2025-05-26 08:37:40'),
(12, 'App\\Models\\User', 1, 'auth_token', '48648201ee143ec566c0ec7de980cb7530720da52037395300a530b575ae6a86', '[\"*\"]', NULL, NULL, '2025-05-26 08:37:41', '2025-05-26 08:37:41'),
(13, 'App\\Models\\User', 1, 'auth_token', '3b24dde8c85f773d1d24e89bda6684746acb6e5c1eab89f326dcc2bd64647a8c', '[\"*\"]', NULL, NULL, '2025-05-26 08:37:43', '2025-05-26 08:37:43'),
(14, 'App\\Models\\User', 1, 'auth_token', '735614d6256950d6b7bdf27c76de188b9e30fe668e8b073b6f823dc646eb08a2', '[\"*\"]', NULL, NULL, '2025-05-26 08:37:44', '2025-05-26 08:37:44'),
(15, 'App\\Models\\User', 1, 'auth_token', 'b2a69bab22ea8ccc467bf983cf2034377177a91e7020ca13cabe9a8df535038d', '[\"*\"]', NULL, NULL, '2025-05-26 08:37:45', '2025-05-26 08:37:45'),
(16, 'App\\Models\\User', 1, 'auth_token', '36d5b06a21740e56b3d00a779b3203ea31aee65b6bc1b6a0b5a531c200c3573e', '[\"*\"]', NULL, NULL, '2025-05-26 08:37:46', '2025-05-26 08:37:46'),
(17, 'App\\Models\\User', 1, 'auth_token', '2e644af79b02c19e008b8a5d80644fc81791a554c9c15095430af2be43019354', '[\"*\"]', '2025-05-26 08:38:22', NULL, '2025-05-26 08:37:47', '2025-05-26 08:38:22'),
(18, 'App\\Models\\User', 1, 'auth_token', '00e3879151804f1bc11d9a39f1b9329d135d4bbbf3e067fdfdb4093debdcdcf7', '[\"*\"]', '2025-05-26 08:45:42', NULL, '2025-05-26 08:43:23', '2025-05-26 08:45:42'),
(19, 'App\\Models\\User', 1, 'auth_token', '6aa04a863dc7ddbfe3eab1802a927fc53371c71522e9d72eeb0e4521b75f87f1', '[\"*\"]', '2025-05-26 09:18:09', NULL, '2025-05-26 09:17:51', '2025-05-26 09:18:09'),
(20, 'App\\Models\\User', 1, 'auth_token', '1845be0a3319a8fded696b799a148723a14caa43371f873c56bfb2c97888508f', '[\"*\"]', '2025-05-26 09:23:55', NULL, '2025-05-26 09:22:28', '2025-05-26 09:23:55'),
(21, 'App\\Models\\User', 1, 'auth_token', '38fabcf6e99491d685cf9b0e2180cdf8fcdd9d39dd97a73c8fa28153a3471101', '[\"*\"]', NULL, NULL, '2025-05-26 10:03:27', '2025-05-26 10:03:27'),
(22, 'App\\Models\\User', 1, 'auth_token', '4140808b6fd2e96a69b592e9b4775592c0cc40da393f23be39509b6f919cf8ec', '[\"*\"]', '2025-05-26 10:04:28', NULL, '2025-05-26 10:04:06', '2025-05-26 10:04:28'),
(23, 'App\\Models\\User', 1, 'auth_token', '8562527d35d21fb1633ef6a12486b2d46cf7d232c35bd8908a99d15fe309df39', '[\"*\"]', NULL, NULL, '2025-05-26 10:07:04', '2025-05-26 10:07:04'),
(24, 'App\\Models\\User', 1, 'auth_token', '29c68798c46fbd443768de426b92e75c97cadc48b621484ab2da95edc4312e9c', '[\"*\"]', NULL, NULL, '2025-05-26 10:10:50', '2025-05-26 10:10:50'),
(25, 'App\\Models\\User', 1, 'auth_token', 'f6ac19defc4dfb08dd5499ad950b0aedc13174fc2e471e8e75cbab831b2f966b', '[\"*\"]', '2025-05-26 10:16:47', NULL, '2025-05-26 10:16:23', '2025-05-26 10:16:47'),
(26, 'App\\Models\\User', 1, 'auth_token', '08880815a7a9ec053852bf5a44abb2ab7296462f7d89ba0b8f10512a0867f8de', '[\"*\"]', '2025-05-26 10:20:58', NULL, '2025-05-26 10:20:03', '2025-05-26 10:20:58'),
(27, 'App\\Models\\User', 1, 'auth_token', '7fadf9e1957a021d6ce46475b7e59740ff08a964b8a0d89d71a3f70e95c3ac08', '[\"*\"]', NULL, NULL, '2025-05-27 06:52:06', '2025-05-27 06:52:06'),
(28, 'App\\Models\\User', 1, 'auth_token', 'ab88c1cae82b41c709b67caf548123129ec84a05cee0c44a68ce527ee4b9aeba', '[\"*\"]', '2025-05-27 06:52:17', NULL, '2025-05-27 06:52:08', '2025-05-27 06:52:17'),
(29, 'App\\Models\\User', 1, 'auth_token', 'ddbabb036554e00631caf71ccf945888eda1e518cce46000bffd20440567748b', '[\"*\"]', '2025-05-27 06:56:20', NULL, '2025-05-27 06:56:06', '2025-05-27 06:56:20'),
(30, 'App\\Models\\User', 1, 'auth_token', '2dbed4e9bbc84c7c4ec635707d9adae3a9976c1b71efe66d50b679ccfb565f37', '[\"*\"]', '2025-05-27 06:57:09', NULL, '2025-05-27 06:57:03', '2025-05-27 06:57:09'),
(31, 'App\\Models\\User', 1, 'auth_token', '5ab943b2e971e4daeb7037409cbab9b3f8422e751e8bc6cc79fe0d931345a626', '[\"*\"]', '2025-05-27 06:59:21', NULL, '2025-05-27 06:59:15', '2025-05-27 06:59:21'),
(32, 'App\\Models\\User', 1, 'auth_token', '9b7f7d879287463c78015535c41b2d6d72dd48e9b02abc7d41a479424d6b4a4e', '[\"*\"]', '2025-05-27 07:04:45', NULL, '2025-05-27 07:04:28', '2025-05-27 07:04:45'),
(33, 'App\\Models\\User', 1, 'auth_token', '69ae395e7fc0dc710ba1d914d792eba097d06bb02fd5ad1be2dfc6af2f5dc1a5', '[\"*\"]', '2025-05-27 07:09:05', NULL, '2025-05-27 07:08:59', '2025-05-27 07:09:05'),
(34, 'App\\Models\\User', 1, 'auth_token', 'bb65d210f62f8178e12a9f857adcfef6123db848ce196f219619ba212f480ae7', '[\"*\"]', NULL, NULL, '2025-05-27 07:14:00', '2025-05-27 07:14:00'),
(35, 'App\\Models\\User', 1, 'auth_token', '3a57c0fef7a7a77cead6ef23427ce22066f386236e2c5106a4997ed4fa38e428', '[\"*\"]', '2025-05-27 07:17:37', NULL, '2025-05-27 07:14:00', '2025-05-27 07:17:37'),
(36, 'App\\Models\\User', 1, 'auth_token', '7d7ddd8c23d6877788ae4585804896a1b3a93110c6278d211c93bb06a7ad1383', '[\"*\"]', NULL, NULL, '2025-05-27 07:18:51', '2025-05-27 07:18:51'),
(37, 'App\\Models\\User', 1, 'auth_token', '5c45124fc163ee007c75af68842a981ebc807f2e3283b540f27bbff9b4597b3b', '[\"*\"]', '2025-05-27 07:27:45', NULL, '2025-05-27 07:25:15', '2025-05-27 07:27:45'),
(38, 'App\\Models\\User', 1, 'auth_token', '30c098454c6d4d0bd030c2345019c4f5dcce356d2d8155d7144b1cc3db03bf6b', '[\"*\"]', '2025-05-27 07:31:48', NULL, '2025-05-27 07:31:42', '2025-05-27 07:31:48'),
(39, 'App\\Models\\User', 1, 'auth_token', '1f0a7453398dc4b8a2534e3aa9b00dd8e823e95e99c2848a1093fde7f44ff68a', '[\"*\"]', '2025-05-27 07:37:20', NULL, '2025-05-27 07:37:14', '2025-05-27 07:37:20'),
(40, 'App\\Models\\User', 1, 'auth_token', 'afadd7309f6da429cc444b612d76195e4229990c8145d724bc0705091d0d7b54', '[\"*\"]', '2025-05-27 07:40:38', NULL, '2025-05-27 07:40:33', '2025-05-27 07:40:38'),
(41, 'App\\Models\\User', 1, 'auth_token', '566ccca04709197c4ef10bbcb7e6fa2c649d4a7c4c8fd9d2ddbb8994af96d3a0', '[\"*\"]', '2025-05-27 07:51:17', NULL, '2025-05-27 07:45:19', '2025-05-27 07:51:17'),
(42, 'App\\Models\\User', 1, 'auth_token', '8e870142f0296a449dfe4126f3a1ed109873e57ab09ec2c363ac2efb7f3c6290', '[\"*\"]', '2025-05-27 08:27:16', NULL, '2025-05-27 08:26:35', '2025-05-27 08:27:16'),
(43, 'App\\Models\\User', 1, 'auth_token', '1f6da0df0e261b4198b57616498146c9c6f03b91acd18d8167b7adf6adc9a677', '[\"*\"]', '2025-05-27 11:21:44', NULL, '2025-05-27 11:21:15', '2025-05-27 11:21:44'),
(44, 'App\\Models\\User', 1, 'auth_token', '80d05a41a8aacf0975c196546d05486ea43c010ee274a1942035efc5026618af', '[\"*\"]', '2025-05-27 11:32:50', NULL, '2025-05-27 11:32:16', '2025-05-27 11:32:50'),
(45, 'App\\Models\\User', 1, 'auth_token', '470bd12eeafba1d717628406b441ba9f4c900e675a9f3c8f18525101183d6702', '[\"*\"]', '2025-05-27 11:41:54', NULL, '2025-05-27 11:41:41', '2025-05-27 11:41:54'),
(46, 'App\\Models\\User', 1, 'auth_token', '16677b8a41bff72b0be63b2c9cb51270406724d9ab289ab7082a2d0dc8dc4c43', '[\"*\"]', '2025-05-27 11:56:37', NULL, '2025-05-27 11:55:48', '2025-05-27 11:56:37'),
(47, 'App\\Models\\User', 1, 'auth_token', '479c216189def5bd9f73b5fa81f13309672231d2d24ee15a961671c9b2c6f4d7', '[\"*\"]', '2025-05-27 12:11:15', NULL, '2025-05-27 12:10:15', '2025-05-27 12:11:15'),
(48, 'App\\Models\\User', 1, 'auth_token', '50ea49959b87f4b200bd6c3815be6150848bf2752f50bdaf6b3aeed69fb87246', '[\"*\"]', NULL, NULL, '2025-06-03 22:43:50', '2025-06-03 22:43:50'),
(49, 'App\\Models\\User', 1, 'auth_token', 'a0c76554dffaaada35506784d872c140259173318a5eb5839bcb7a0d8df5e308', '[\"*\"]', NULL, NULL, '2025-06-03 22:43:52', '2025-06-03 22:43:52'),
(50, 'App\\Models\\User', 1, 'auth_token', '4a0a9f3d371b477ebcf192c4c6ae3680314102ad9b6dd578f0f2f30a17feab79', '[\"*\"]', NULL, NULL, '2025-06-03 22:43:52', '2025-06-03 22:43:52'),
(51, 'App\\Models\\User', 1, 'auth_token', 'b29c66becb802c6bb46cdefed0e5e2476363ce25d9e5239b4551879bb1970b08', '[\"*\"]', NULL, NULL, '2025-06-03 22:43:52', '2025-06-03 22:43:52'),
(52, 'App\\Models\\User', 1, 'auth_token', '652cc2fbe3f5b659619b3afb151da2e7239c48d264908ec4aa2afbd7dde51b02', '[\"*\"]', '2025-06-03 22:46:48', NULL, '2025-06-03 22:43:55', '2025-06-03 22:46:48'),
(53, 'App\\Models\\User', 1, 'auth_token', 'ddfcba1e8939abf8e6812c996e625e8f25a0acd63011939a983697bda34b156d', '[\"*\"]', '2025-06-03 22:47:20', NULL, '2025-06-03 22:47:14', '2025-06-03 22:47:20'),
(54, 'App\\Models\\User', 1, 'auth_token', '82aacbeef7337cca8fb81db29e1db813ce810a94871c341c643435f909fbca39', '[\"*\"]', '2025-06-03 22:48:06', NULL, '2025-06-03 22:47:56', '2025-06-03 22:48:06'),
(55, 'App\\Models\\User', 1, 'auth_token', '4319865297cf0129af915afb807053a0cf4a02d7c464398ee8f53ccb05fe5a99', '[\"*\"]', NULL, NULL, '2025-06-03 22:58:53', '2025-06-03 22:58:53'),
(56, 'App\\Models\\User', 1, 'auth_token', 'd1e9841cceccea7a957599ff7bc912314ef5f3f99073e24ec0518550911a5320', '[\"*\"]', '2025-06-03 23:20:58', NULL, '2025-06-03 23:00:30', '2025-06-03 23:20:58'),
(57, 'App\\Models\\User', 1, 'auth_token', '65de08e50304c4b0f7001b32003bb0236a9b06c5724b616ecc3cd5f3a6a7726f', '[\"*\"]', '2025-06-03 23:27:57', NULL, '2025-06-03 23:27:47', '2025-06-03 23:27:57'),
(58, 'App\\Models\\User', 1, 'auth_token', 'd7cdef9b664de5de7b86f32fa9dee51a95eb73470cf53a41d339ba15493f41c2', '[\"*\"]', '2025-06-03 23:35:01', NULL, '2025-06-03 23:34:49', '2025-06-03 23:35:01'),
(59, 'App\\Models\\User', 1, 'auth_token', '11475b2269da09fd956294d9b16217cfecef69b4ed0036754f324b6033f94b3d', '[\"*\"]', '2025-06-03 23:36:53', NULL, '2025-06-03 23:36:52', '2025-06-03 23:36:53'),
(60, 'App\\Models\\User', 1, 'auth_token', '7d9e9f4f0925f95891e3b3c20fe66005dde553efa2a22be8c3536284203b3b4d', '[\"*\"]', '2025-06-03 23:42:59', NULL, '2025-06-03 23:42:58', '2025-06-03 23:42:59'),
(61, 'App\\Models\\User', 1, 'auth_token', '9f7f342ea5829fbfe937cd627bd42867387c8c297af5217845ebdb05ba607d5d', '[\"*\"]', '2025-06-03 23:44:38', NULL, '2025-06-03 23:43:54', '2025-06-03 23:44:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `saldo` decimal(12,2) NOT NULL DEFAULT 0.00,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `saldo`, `pekerjaan`, `created_at`, `updated_at`) VALUES
(1, 'Haiya', 'test@gmail.com', '$2y$10$2U5wwaIAVdLlL1vqdYrltuuA.7SKTqPt3pjkQ4O0ICJ1Hz4oCwKnK', 1002999.00, 'www', '2025-05-25 08:17:43', '2025-06-03 23:01:51'),
(2, 'What', 'what@gmail.com', '$2y$10$O7V0xpJ5JLWh9rUraa751egeGzs8WOoFvi8EeJYoNafLAXyoIHXp2', 0.00, 'Pekerjaan', '2025-05-27 11:21:03', '2025-05-27 11:21:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `nama`, `harga`, `gambar`, `created_at`, `updated_at`) VALUES
(4, 1, 'Kaos Putih', 232323, 'layout/kaos_lengan.jpg', '2025-05-27 07:50:43', '2025-05-27 07:50:43'),
(5, 1, 'Kaos Lengan Panjang', 322111, 'layout/kaos_lengan.jpg', '2025-05-27 12:10:52', '2025-05-27 12:10:52');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
