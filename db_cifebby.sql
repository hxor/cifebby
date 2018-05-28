-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 28 Mei 2018 pada 13.22
-- Versi Server: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cifebby`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `body`, `date`) VALUES
(0, 6, 1, 'Test Comment', '0000-00-00 00:00:00'),
(1, 1, 3, 'Maybe there is another approach. But I always love to use str_random() function that is a core function of PHP.\r\n\r\nYou can try this-\r\n\r\nstr_random(32);', '2018-05-27 17:00:00'),
(2, 2, 1, 'Make sure that you have right route type. Normally it happens if your route type is not matching.', '2018-05-27 17:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `date` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `body`, `date`) VALUES
(1, 1, 'Hello\r\n\r\nHow to generate 32 bit random token / key in Laravel 5.6?', '2018-05-27 17:00:00'),
(2, 2, 'when i send post request to using it in api it give me MethodNotAllowedHttpException After searching the solution is add exception in App\\Http\\Middleware\\VerifyCsrfToken.php how can i add URI ??\r\n\r\nthanks', '2018-05-27 17:00:00'),
(6, 1, 'This is trying to update status', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'User 1', 'user1@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(2, 'User 2', 'user2@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(3, 'User 3', 'user3@mail.net', '5f4dcc3b5aa765d61d8327deb882cf99');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
