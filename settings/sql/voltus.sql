-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 08 Agu 2015 pada 09.15
-- Versi Server: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `voltus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bonus_consistent`
--

CREATE TABLE IF NOT EXISTS `bonus_consistent` (
`id` int(10) unsigned NOT NULL,
  `kedalaman` int(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `bonus_consistent`
--

INSERT INTO `bonus_consistent` (`id`, `kedalaman`, `nilai`) VALUES
(1, 1, 4),
(2, 2, 3),
(3, 3, 2),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bonus_generation`
--

CREATE TABLE IF NOT EXISTS `bonus_generation` (
`id` int(11) unsigned NOT NULL,
  `kedalaman` int(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `bonus_generation`
--

INSERT INTO `bonus_generation` (`id`, `kedalaman`, `nilai`) VALUES
(1, 1, 5),
(2, 2, 4),
(3, 3, 3),
(4, 4, 2),
(5, 5, 1),
(6, 5, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bonus_queue`
--

CREATE TABLE IF NOT EXISTS `bonus_queue` (
`id` int(11) unsigned NOT NULL,
  `id_referral` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `bonus_type` int(11) NOT NULL,
  `amount` double(19,4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `bonus_queue`
--

INSERT INTO `bonus_queue` (`id`, `id_referral`, `id_user`, `bonus_type`, `amount`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 5, 1, 30.0000, '2015-08-08 10:26:44', '2015-08-08 03:26:44', 0),
(2, 1, 5, 2, 15.0000, '2015-08-08 10:26:44', '2015-08-08 03:26:44', 0),
(3, 1, 5, 3, 15.0000, '2015-08-08 10:26:44', '2015-08-08 03:26:44', 0),
(4, 1, 5, 4, 5.0000, '2015-08-08 10:26:44', '2015-08-08 03:26:44', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cancel`
--

CREATE TABLE IF NOT EXISTS `cancel` (
`id` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cancel_msg`
--

CREATE TABLE IF NOT EXISTS `cancel_msg` (
`id` int(10) unsigned NOT NULL,
  `id_cancel` int(10) unsigned NOT NULL,
  `msg` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `config`
--

CREATE TABLE IF NOT EXISTS `config` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `cnf_value` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `config`
--

INSERT INTO `config` (`id`, `name`, `cnf_value`, `description`) VALUES
(1, 'trial_time', '14 days', 'trial time for new member. during this period member can cancel their activation. after this period member will automatic active. you can use days, hours, or months also'),
(2, 'registration_fee', '300', 'using usd for the money. this value is using for references any percentage bonus '),
(3, 'bonus_referral', '10', 'persentase of referral bonus from registration fee of new member'),
(4, 'bonus_passive_amount', '5', 'in usd. how much passive bonus for referral every month.'),
(5, 'bonus_passive_referral', '10', 'how much max member can invite member and get passive bonus');

-- --------------------------------------------------------

--
-- Struktur dari tabel `members`
--

CREATE TABLE IF NOT EXISTS `members` (
`id` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  `id_referral` int(10) unsigned DEFAULT NULL,
  `status` enum('aktif','tidak aktif','trial') NOT NULL DEFAULT 'tidak aktif',
  `last_referral_date` datetime NOT NULL,
  `activation_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `members`
--

INSERT INTO `members` (`id`, `id_user`, `id_referral`, `status`, `last_referral_date`, `activation_at`) VALUES
(1, 1, 0, 'aktif', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 5, 1, 'trial', '0000-00-00 00:00:00', '2015-08-08 10:26:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `privileges`
--

CREATE TABLE IF NOT EXISTS `privileges` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `privileges`
--

INSERT INTO `privileges` (`id`, `name`) VALUES
(1, 'member_area'),
(2, 'privileges_management'),
(3, 'roles_management'),
(4, 'users_management');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'member'),
(3, 'super_admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_privilege`
--

CREATE TABLE IF NOT EXISTS `role_privilege` (
`id` int(10) unsigned NOT NULL,
  `id_role` int(10) unsigned NOT NULL,
  `id_privilege` int(10) unsigned NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `role_privilege`
--

INSERT INTO `role_privilege` (`id`, `id_role`, `id_privilege`) VALUES
(1, 2, 1),
(2, 3, 2),
(3, 3, 3),
(4, 3, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `handphone` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`, `updated_at`, `last_login`, `nama`, `alamat`, `tanggal_lahir`, `handphone`, `foto`) VALUES
(1, 'member', '$2y$10$0sU3T.NnhLU.K/F2FokbCepH6c8qt.Uj4BPEH8YsHGH2EXaT.3lym', 'member\r\n', '2015-08-04 00:00:00', '2015-08-08 05:11:40', '2015-08-08 12:11:40', 'Angga Kesuma', 'Sukarami Palembang', '2015-08-01', '089661147512', 'default.jpg'),
(2, 'admin', '$2y$10$0sU3T.NnhLU.K/F2FokbCepH6c8qt.Uj4BPEH8YsHGH2EXaT.3lym', 'admin@admin.com', '2015-08-05 00:00:00', '2015-08-08 02:44:29', '2015-08-08 09:44:29', 'Admin', 'palembang', '2015-08-05', '08966114612', 'default.jpg'),
(5, 'yuyu', '$2y$10$/1fjDkDKra4HTieiUVLaeOySqB5BWGBHLu1YpmS.n632ys.OcaHW2', 'yuyu@yuyu.comuyu', '2015-08-06 20:11:32', '2015-08-08 05:12:12', '2015-08-08 12:12:12', 'Yuyu', 'yu', '1992-01-21', 'yu', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
`id` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  `id_role` int(10) unsigned NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `id_user`, `id_role`) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 2, 3),
(4, 5, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `wallet`
--

CREATE TABLE IF NOT EXISTS `wallet` (
`id` int(10) unsigned NOT NULL,
  `id_member` int(10) unsigned NOT NULL,
  `balance` double(19,4) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `wallet`
--

INSERT INTO `wallet` (`id`, `id_member`, `balance`) VALUES
(1, 1, 0.0000),
(2, 2, 0.0000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bonus_consistent`
--
ALTER TABLE `bonus_consistent`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bonus_generation`
--
ALTER TABLE `bonus_generation`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bonus_queue`
--
ALTER TABLE `bonus_queue`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cancel`
--
ALTER TABLE `cancel`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cancel_msg`
--
ALTER TABLE `cancel_msg`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privileges`
--
ALTER TABLE `privileges`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `role_privilege`
--
ALTER TABLE `role_privilege`
 ADD PRIMARY KEY (`id`), ADD KEY `id_role` (`id_role`), ADD KEY `id_privilege` (`id_privilege`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
 ADD PRIMARY KEY (`id`), ADD KEY `id_user` (`id_user`), ADD KEY `id_role` (`id_role`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bonus_consistent`
--
ALTER TABLE `bonus_consistent`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `bonus_generation`
--
ALTER TABLE `bonus_generation`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `bonus_queue`
--
ALTER TABLE `bonus_queue`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cancel`
--
ALTER TABLE `cancel`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cancel_msg`
--
ALTER TABLE `cancel_msg`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `privileges`
--
ALTER TABLE `privileges`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `role_privilege`
--
ALTER TABLE `role_privilege`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `role_privilege`
--
ALTER TABLE `role_privilege`
ADD CONSTRAINT `role_privilege_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `role_privilege_ibfk_2` FOREIGN KEY (`id_privilege`) REFERENCES `privileges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_role`
--
ALTER TABLE `user_role`
ADD CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `user_role_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
