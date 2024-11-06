-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Nov 2024 pada 15.46
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
-- Database: `portofinka`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `telp` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `contact`
--

INSERT INTO `contact` (`id`, `address`, `telp`, `email`) VALUES
(1, 'Kayu Putih, Pulogadung, Jakarta Timur 13210', '+62813-8328-0164', 'finkaaa21@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `general_setting`
--

CREATE TABLE `general_setting` (
  `id` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `sub_judul` varchar(100) NOT NULL,
  `ig_link` varchar(100) DEFAULT NULL,
  `linkedin_link` varchar(100) DEFAULT NULL,
  `site_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `general_setting`
--

INSERT INTO `general_setting` (`id`, `foto`, `judul`, `sub_judul`, `ig_link`, `linkedin_link`, `site_name`) VALUES
(2, 'wp10536638.jpg', 'FINKA ARDHIANISSA', 'Freelance Event ', 'https://www.instagram.com/finkaarsa_', 'https://www.linkedin.com/in/finka-ardhianissa', 'FINKA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `resume`
--

CREATE TABLE `resume` (
  `id` int(11) NOT NULL,
  `education` text NOT NULL,
  `sub_education` text NOT NULL,
  `text_education` text NOT NULL,
  `internship` text NOT NULL,
  `sub_internship` text NOT NULL,
  `text_internship` text NOT NULL,
  `organization` text NOT NULL,
  `sub_organization` text NOT NULL,
  `text_organization` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `resume`
--

INSERT INTO `resume` (`id`, `education`, `sub_education`, `text_education`, `internship`, `sub_internship`, `text_internship`, `organization`, `sub_organization`, `text_organization`) VALUES
(1, 'Bachelor of Family Welfare Education', 'Universitas Negeri Jakarta', 'In this major, study several courses such as human growth and development, family counseling, nutrition and family care, education and childcare, and others.', 'Freelance Ticketing Event ', 'Kebun Raya Bogor ', 'Checking tickets based on category, validating e-invitation and stamping the invitation to visitors, providing media ID according to media data', 'Internal Secretary', 'Student Executive Board', 'Create analysis and data presentation reports, create outgoing and incoming letters for activities, and analyze data from each departement ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_contact`
--

CREATE TABLE `table_contact` (
  `id` int(11) NOT NULL,
  `birthday` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `degree` varchar(50) NOT NULL,
  `age` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `table_contact`
--

INSERT INTO `table_contact` (`id`, `birthday`, `phone`, `city`, `email`, `degree`, `age`, `foto`, `updated_at`) VALUES
(1, '2001-05-27', '+62813-8328-0164', 'East Jakarta', 'finkaaa21@gmail.com', 'Bachelor', '23', 'WhatsApp Image 2024-10-30 at 11.54.25.jpeg', '2024-10-30 14:03:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `password`, `foto`, `created_at`, `updated_at`) VALUES
(5, 'finkaa', 'finkaa@gmail.com', '12345678', 'user.jpg', '2024-10-30 04:36:41', '2024-10-30 04:36:41');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `general_setting`
--
ALTER TABLE `general_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `resume`
--
ALTER TABLE `resume`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `table_contact`
--
ALTER TABLE `table_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `general_setting`
--
ALTER TABLE `general_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `resume`
--
ALTER TABLE `resume`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `table_contact`
--
ALTER TABLE `table_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
