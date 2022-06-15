
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `lib` (
  `id` int(15) NOT NULL,
  `img` varchar(250) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




INSERT INTO `lib` (`id`, `img`, `judul`, `penulis`, `genre`, `link`) VALUES
(1, 'Algorithm & DS C01.png', 'Algorithm & DS C01', '-', 'Science Technology', '1GgzISEDwLQKtqZ-eW1-9-f6dGiu6P4vq'),
(2, 'Algorithm & DS C02.png', 'Algorithm & DS C02', '-', 'Science Technology', '1GaQHgEGrtN9XMxkV0RgD4tCZTTBLNh_s'),
(3, 'Introduction JavaScript.png', 'Introduction JavaScript', '-', 'Science Technology', '1P9E6_QtbBzuNqtj1CUb0A8QEP7Yn3uC4'),
(4, 'Software Engineering A Practitioners Approach.png', 'Software Engineering A Practitioners Approach', 'Roger S. Pressman', 'Science Technology', '103us_ucVXtLJzEZt8x9vD-BGKd0cqWta'),
(5, 'Introduction HTML Part01.png', 'Introduction HTML Part01', 'Tri Agus R', 'Technology', '1pNvO9Kz84GhnDn_PlxknrY-QS1N9ceAe'),
(6, 'Introduction HTML Part05CSS.png', 'Introduction HTML Part05CSS', 'Tri Agus R', 'Technology', '11Fbi8_vVo-NzoDSCTvlOzPZaALUC7SHn'),
(7, 'Introduction HTML Part02.png', 'Introduction HTML Part02', 'Tri Agus R', 'Technology', '1CQmYL3A-EvutyR4WlpSz-2g1Cocc8nYo'),
(10, 'Introduction HTML Part03.png', 'Introduction HTML Part03', 'Tri Agus R', 'Technology', '1FN9sSLNw2xfl9FPPvFXSI09fe54KQgrE'),
(11, 'Introduction HTML Part04.png', 'Introduction HTML Part04', 'Tri Agus R', 'Technology', '11A8qPgUnxWoG7kGGTZaPm5j31KJM5iCg'),
(12, 'Introduction HTML Part06CSSExtended.png', 'Introduction HTML Part06CSSExtended', 'Tri Agus R', 'Technology', '167ciAi8L4B8aadG3uT-TbOJH7XyJ6LUK'),
(13, 'Mein Kampf.jpg', 'Mein Kampf', 'Adolf Hitler', 'Comedy', '1dETHjmV0vZu1Np6SibaDtmCkjEjQccb9');


ALTER TABLE `lib`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `lib`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

