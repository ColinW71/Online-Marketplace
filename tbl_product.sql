SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `tbl_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

INSERT INTO `tbl_product` (`id`, `name`, `image`, `price`, `stock`) VALUES
(1, 'Samsung J2 Pro', '1.jpg', 100.00, 5),
(2, 'HP Notebook', '2.jpg', 299.00, 3),
(3, 'Car Charger', '3.jpg', 15.00, 8),
(4, 'Headphones', '4.jpg', 40.00, 6),
(5, 'Backpack', '5.jpg', 50.00, 4);






