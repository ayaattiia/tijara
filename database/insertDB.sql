-- ============================================================
-- insertDB.sql
-- TijaraDB26 - Data only (INSERT statements)
-- Extracted verbatim from the current XAMPP / phpMyAdmin export
-- (1784541173833_tijaradb.sql) so it matches the live `tijaradb`
-- database exactly.
-- Run AFTER database.sql
-- ============================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;
START TRANSACTION;


--
-- Déchargement des données de la table `adcomments`
--

INSERT INTO `adcomments` (`IdComment`, `IdAd`, `IdUser`, `Content`, `CreatedAt`, `Active`) VALUES
(2, 2, 3, 'Very good quality for the price.', '2026-07-03 09:00:00', 1),
(3, 3, 4, 'Trusted seller, fast response.', '2026-07-04 09:00:00', 1),
(4, 4, 5, 'Average, could be better.', '2026-07-05 09:00:00', 1),
(5, 5, 6, 'Great deal, worth it.', '2026-07-06 09:00:00', 1),
(6, 6, 7, 'Nice packaging and fast delivery.', '2026-07-07 09:00:00', 1),
(7, 7, 8, 'Recommended seller, no issues.', '2026-07-08 09:00:00', 1),
(8, 8, 9, 'Good value overall.', '2026-07-09 09:00:00', 1),
(9, 9, 10, 'Perfect condition as described.', '2026-07-10 09:00:00', 1),
(10, 10, 11, 'Amazing experience, will buy again.', '2026-07-11 09:00:00', 1),
(11, 11, 12, 'Satisfied with the purchase.', '2026-07-12 09:00:00', 1),
(12, 12, 13, 'Works as expected, no complaints.', '2026-07-13 09:00:00', 1),
(13, 13, 14, 'Fast shipping and great communication.', '2026-07-14 09:00:00', 1),
(14, 14, 15, 'Quality matches the description.', '2026-07-15 09:00:00', 1),
(15, 15, 16, 'Would buy from this seller again.', '2026-07-16 09:00:00', 1),
(16, 16, 17, 'Good customer service.', '2026-07-17 09:00:00', 1),
(17, 17, 18, 'Product arrived on time and intact.', '2026-07-18 09:00:00', 1),
(18, 18, 19, 'Solid build quality.', '2026-07-19 09:00:00', 1),
(19, 19, 20, 'Reasonable price for features.', '2026-07-20 09:00:00', 1),
(20, 20, 1, 'Definitely a five star experience.', '2026-07-21 09:00:00', 1),
(21, 11, 1, 'Sample description text MODIF', '2026-07-07 10:00:00', 1);

--
-- Déchargement des données de la table `adlikes`
--

INSERT INTO `adlikes` (`IdLike`, `IdAd`, `IdUser`, `CreatedAt`) VALUES
(12, 12, 13, '2026-07-03 09:00:00'),
(13, 13, 14, '2026-07-04 09:00:00'),
(14, 11, 10, '2026-06-07 10:00:00'),
(15, 15, 16, '2026-07-06 09:00:00'),
(16, 16, 17, '2026-07-07 09:00:00'),
(17, 17, 18, '2026-07-08 09:00:00'),
(18, 18, 19, '2026-07-09 09:00:00'),
(19, 19, 20, '2026-07-10 09:00:00'),
(20, 20, 21, '2026-07-11 09:00:00'),
(21, 21, 22, '2026-07-12 09:00:00'),
(22, 22, 23, '2026-07-13 09:00:00'),
(23, 23, 24, '2026-07-14 09:00:00'),
(24, 24, 25, '2026-07-15 09:00:00'),
(25, 25, 26, '2026-07-16 09:00:00'),
(26, 26, 27, '2026-07-17 09:00:00'),
(27, 27, 28, '2026-07-18 09:00:00'),
(28, 28, 29, '2026-07-19 09:00:00'),
(29, 29, 30, '2026-07-20 09:00:00'),
(30, 30, 11, '2026-07-21 09:00:00'),
(31, 6, 11, '2026-07-09 10:00:00');

--
-- Déchargement des données de la table `adminsettings`
--

INSERT INTO `adminsettings` (`Key`, `Value`, `UpdatedAt`) VALUES
('commission_rate', '5', '2026-07-11 09:00:00'),
('currency', 'TND', '2026-07-04 09:00:00'),
('default_language', 'fr', '2026-07-19 09:00:00'),
('delivery_fee_default', '8.000', '2026-07-09 09:00:00'),
('facebook_url', 'https://facebook.com/tijara', '2026-07-14 09:00:00'),
('instagram_url', 'https://instagram.com/tijara', '2026-07-15 09:00:00'),
('items_per_page', '20', '2026-07-20 09:00:00'),
('maintenance_mode', 'off', '2026-07-06 09:00:00'),
('max_upload_size', '10MB', '2026-07-07 09:00:00'),
('min_withdrawal', '50', '2026-07-10 09:00:00'),
('privacy_url', 'https://tijara.tn/privacy', '2026-07-18 09:00:00'),
('site_email', 'contact@tijara.tn', '2026-07-03 09:00:00'),
('site_name', 'Tijara Marketplace', '2026-07-02 09:00:00'),
('smtp_host', 'smtp.tijara.tn', '2026-07-21 09:00:00'),
('support_email', 'support@tijara.tn', '2026-07-13 09:00:00'),
('support_phone', '+21670000000', '2026-07-12 09:00:00'),
('tax_rate', '19', '2026-07-08 09:00:00'),
('terms_url', 'https://tijara.tn/terms', '2026-07-17 09:00:00'),
('test', 'test', '2026-07-07 10:00:00'),
('timezone', 'Africa/Tunis', '2026-07-05 09:00:00'),
('twitter_url', 'https://twitter.com/tijara', '2026-07-16 09:00:00');

--
-- Déchargement des données de la table `ads`
--

INSERT INTO `ads` (`IdAd`, `TitleAd`, `DescriptionAd`, `DetailsAd`, `PriceAd`, `DatePublication`, `ImageAd`, `VideoAd`, `IdCateg`, `IdUser`, `IdState`, `IdCountry`, `LocationAd`, `DateEnd`, `Brand`, `Ownerads`, `Telephone`, `Email`, `StartDate`, `Active`, `Type`) VALUES
(1, 'iPhone 15 Pro', 'Latest Apple smartphone', '256GB, 5G, Excellent condition', '4500', '2026-07-01', 'iphone15.jpg', 'iphone15.mp4', 2, 1, 11, 11, 'Tunis', '2026-08-01', 'Apple', 'Aya Store', '20764119', 'aya@gmail.com', '2026-07-01', 1, 'annonce'),
(2, 'Samsung Galaxy S24', 'Flagship Samsung smartphone', '256GB, 5G', '3200', '2026-07-02', '[\"s24.jpg\",\"assets\\/ads\\/images\\/6a5b5ef34826a_1784372979.jpg\"]', '[\"s24.mp4\",\"assets\\/ads\\/videos\\/6a5b96730c2ae_1784387187.mp4\"]', 2, 2, 25, 11, 'Sousse', '2026-08-02', 'Samsung', 'Mobile Shop', '22000000', 'shop@gmail.com', '2026-07-02', 1, 'annonce'),
(3, 'HP ProBook 450', 'Professional business laptop', 'Intel i7, 16GB RAM, 512GB SSD', '2800', '2026-07-03', 'hp.jpg', 'hp.mp4', 3, 2, 26, 11, 'Sfax', '2026-08-03', 'HP', 'Tech Store', '22111111', 'tech@gmail.com', '2026-07-03', 1, 'annonce'),
(4, 'AirPods Pro 2', 'Wireless Bluetooth earbuds', 'Noise cancellation', '900', '2026-07-04', 'airpods.jpg', 'airpods.mp4', 11, 1, 27, 11, 'Monastir', '2026-08-04', 'Apple', 'Aya Store', '20764119', 'aya@gmail.com', '2026-07-04', 1, 'annonce'),
(5, 'Huawei Smart Watch', 'Fitness smartwatch', 'Heart rate monitoring', '450', '2026-07-05', '[\"watch.jpg\",\"assets\\/ads\\/images\\/6a5b60e044b03_1784373472.png\"]', 'watch.mp4', 11, 1, 15, 11, 'Nabeul', '2026-08-05', 'Huawei', 'Digital Shop', '22333333', 'digital@gmail.com', '2026-07-05', 1, 'annonce'),
(6, 'Canon EOS R50', 'Mirrorless digital camera', '24MP Camera', '2200', '2026-07-05', 'canon.jpg', 'canon.mp4', 11, 2, 11, 11, 'Tunis', '2026-08-05', 'Canon', 'Photo Store', '22444444', 'photo@gmail.com', '2026-07-05', 1, 'annonce'),
(7, 'PlayStation 5', 'Sony gaming console', '1TB SSD', '2500', '2026-07-06', 'ps5.jpg', 'ps5.mp4', 11, 1, 11, 11, 'Tunis', '2026-08-06', 'Sony', 'Game Store', '22555555', 'game@gmail.com', '2026-07-06', 1, 'annonce'),
(8, 'JBL Charge 6', 'Portable Bluetooth speaker', 'Water resistant', '250', '2026-07-06', 'speaker.jpg', 'speaker.mp4', 11, 2, 17, 11, 'Bizerte', '2026-08-06', 'JBL', 'Sound Shop', '22666666', 'sound@gmail.com', '2026-07-06', 1, 'annonce'),
(9, 'Lenovo Tab P12', 'Android tablet', '10-inch display', '700', '2026-07-07', '[\"tablet.jpg\",\"assets\\/ads\\/images\\/6a5b634cf169c_1784374092.jpg\"]', 'tablet.mp4', 2, 1, 28, 11, 'Gabes', '2026-08-07', 'Lenovo', 'Tablet Shop', '22777777', 'tablet@gmail.com', '2026-07-07', 1, 'annonce'),
(10, 'Logitech G Pro Keyboard', 'Mechanical RGB gaming keyboard', 'GX Switches', '180', '2026-07-07', 'keyboard.jpg', 'keyboard.mp4', 11, 2, 22, 11, 'Kairouan', '2026-08-07', 'Logitech', 'PC Store', '22888888', 'pc@gmail.com', '2026-07-07', 1, 'annonce');

--
-- Déchargement des données de la table `adsfeaturevalues`
--

INSERT INTO `adsfeaturevalues` (`IdAdFeatureValue`, `IdAd`, `IdFV`) VALUES
(225, 1, 2),
(226, 1, 6),
(227, 1, 10),
(228, 1, 16),
(229, 1, 20),
(230, 1, 23),
(231, 1, 40),
(232, 2, 2),
(233, 2, 6),
(234, 2, 10),
(235, 2, 15),
(236, 2, 19),
(237, 2, 24),
(238, 2, 40),
(239, 3, 2),
(240, 3, 7),
(241, 3, 21),
(242, 3, 30),
(243, 3, 35),
(244, 3, 40),
(245, 4, 11),
(246, 4, 14),
(247, 4, 27),
(248, 4, 34),
(249, 4, 39),
(250, 5, 1),
(251, 5, 10),
(252, 5, 15),
(253, 5, 18),
(254, 5, 35),
(255, 5, 39),
(256, 6, 10),
(257, 6, 25),
(258, 6, 28),
(259, 6, 35),
(260, 6, 40),
(261, 7, 8),
(262, 7, 11),
(264, 7, 29),
(263, 7, 32),
(265, 7, 34),
(266, 7, 39),
(267, 8, 12),
(268, 8, 15),
(269, 8, 27),
(270, 8, 34),
(271, 8, 38),
(272, 9, 2),
(273, 9, 5),
(274, 9, 10),
(275, 9, 17),
(276, 9, 21),
(277, 9, 22),
(278, 9, 39),
(279, 10, 10),
(280, 10, 28),
(281, 10, 34),
(282, 10, 40);

--
-- Déchargement des données de la table `adswishlist`
--

INSERT INTO `adswishlist` (`IdWishlistAd`, `IdUser`, `IdAd`, `Liked`) VALUES
(2, 2, 4, 1),
(3, 3, 5, 1),
(4, 4, 6, 1),
(5, 5, 7, 1),
(6, 6, 8, 1),
(7, 7, 9, 1),
(8, 8, 10, 1),
(9, 9, 11, 1),
(10, 10, 12, 1),
(11, 11, 13, 1),
(12, 12, 14, 1),
(13, 13, 15, 1),
(14, 14, 16, 1),
(15, 15, 17, 1),
(16, 1, 1, 1),
(17, 17, 19, 1),
(18, 18, 20, 1),
(19, 19, 1, 1),
(20, 20, 2, 1),
(21, 1, 1, 1);

--
-- Déchargement des données de la table `boostadspacks`
--

INSERT INTO `boostadspacks` (`IdBoost`, `Title`, `Price`, `Discount`, `MaxDuration`, `Sliders`, `SideBar`, `Footer`, `RelatedPost`, `FirstLogin`, `OrdersCount`, `Links`, `Active`, `CreatedAt`) VALUES
(1, 'Bronze Boost', 13.00, 1.00, 8, 1, 0, 1, 1, 0, 1, 1, 1, '2026-07-02 09:00:00'),
(2, 'Silver Boost', 16.00, 2.00, 9, 0, 1, 0, 1, 0, 2, 1, 1, '2026-07-03 09:00:00'),
(3, 'Gold Boost', 19.00, 3.00, 10, 1, 0, 1, 1, 0, 3, 1, 1, '2026-07-04 09:00:00'),
(4, 'Platinum Boost', 22.00, 4.00, 11, 0, 1, 0, 1, 0, 4, 1, 1, '2026-07-05 09:00:00'),
(5, 'Starter Pack', 25.00, 5.00, 12, 1, 0, 1, 1, 0, 5, 1, 1, '2026-07-06 09:00:00'),
(6, 'Weekly Boost', 28.00, 6.00, 13, 0, 1, 0, 1, 0, 6, 1, 1, '2026-07-07 09:00:00'),
(7, 'Monthly Boost', 31.00, 7.00, 14, 1, 0, 1, 1, 0, 7, 1, 1, '2026-07-08 09:00:00'),
(8, 'Premium Boost', 34.00, 8.00, 15, 0, 1, 0, 1, 0, 8, 1, 1, '2026-07-09 09:00:00'),
(9, 'Featured Ad', 37.00, 9.00, 16, 1, 0, 1, 1, 0, 9, 1, 1, '2026-07-10 09:00:00'),
(10, 'Top Ad', 40.00, 10.00, 17, 0, 1, 0, 1, 0, 10, 1, 1, '2026-07-11 09:00:00'),
(11, 'Sidebar Ad', 43.00, 11.00, 18, 1, 0, 1, 1, 0, 11, 1, 1, '2026-07-12 09:00:00'),
(12, 'Footer Ad', 46.00, 12.00, 19, 0, 1, 0, 1, 0, 12, 1, 1, '2026-07-13 09:00:00'),
(13, 'Homepage Boost', 49.00, 13.00, 20, 1, 0, 1, 1, 0, 13, 1, 1, '2026-07-14 09:00:00'),
(14, 'Category Boost', 52.00, 14.00, 7, 0, 1, 0, 1, 0, 14, 1, 1, '2026-07-15 09:00:00'),
(15, 'VIP Pack', 55.00, 15.00, 8, 1, 0, 1, 1, 0, 15, 1, 1, '2026-07-16 09:00:00'),
(16, 'Business Pack', 58.00, 16.00, 9, 0, 1, 0, 1, 0, 16, 1, 1, '2026-07-17 09:00:00'),
(17, 'Trial Boost', 61.00, 17.00, 10, 1, 0, 1, 1, 0, 17, 1, 1, '2026-07-18 09:00:00'),
(18, 'Flash Boost', 64.00, 18.00, 11, 0, 1, 0, 1, 0, 18, 1, 1, '2026-07-19 09:00:00'),
(19, 'Weekend Boost', 67.00, 19.00, 12, 1, 0, 1, 1, 0, 19, 1, 1, '2026-07-20 09:00:00'),
(20, 'Ultimate Pack', 70.00, 20.00, 13, 0, 1, 0, 1, 0, 20, 1, 1, '2026-07-21 09:00:00');

--
-- Déchargement des données de la table `boosts`
--

INSERT INTO `boosts` (`IdBoost`, `TitleBoost`, `Price`, `Discount`, `MaxDurationPerDay`, `InSliders`, `InSideBar`, `InFooter`, `InRelatedPost`, `InFirstLogin`, `HasLinks`, `Orders`) VALUES
(1, 'Bronze Boost Plan', 10, '1%', 7, 1, 0, 1, 1, 0, 1, 1),
(2, 'Silver Boost Plan', 12, '2%', 7, 0, 1, 0, 1, 0, 1, 2),
(3, 'Gold Boost Plan', 14, '3%', 7, 1, 0, 1, 1, 0, 1, 3),
(4, 'Platinum Boost Plan', 16, '4%', 7, 0, 1, 0, 1, 0, 1, 4),
(5, 'Starter Pack Plan', 18, '5%', 7, 1, 0, 1, 1, 0, 1, 5),
(6, 'Weekly Boost Plan', 20, '6%', 7, 0, 1, 0, 1, 0, 1, 6),
(7, 'Monthly Boost Plan', 22, '7%', 7, 1, 0, 1, 1, 0, 1, 7),
(8, 'Premium Boost Plan', 24, '8%', 7, 0, 1, 0, 1, 0, 1, 8),
(9, 'Featured Ad Plan', 26, '9%', 7, 1, 0, 1, 1, 0, 1, 9),
(10, 'Top Ad Plan', 28, '10%', 7, 0, 1, 0, 1, 0, 1, 10),
(11, 'Sidebar Ad Plan', 30, '11%', 7, 1, 0, 1, 1, 0, 1, 11),
(12, 'Footer Ad Plan', 32, '12%', 7, 0, 1, 0, 1, 0, 1, 12),
(13, 'Homepage Boost Plan', 34, '13%', 7, 1, 0, 1, 1, 0, 1, 13),
(14, 'Category Boost Plan', 36, '14%', 7, 0, 1, 0, 1, 0, 1, 14),
(15, 'VIP Pack Plan', 38, '15%', 7, 1, 0, 1, 1, 0, 1, 15),
(16, 'Business Pack Plan', 40, '16%', 7, 0, 1, 0, 1, 0, 1, 16),
(17, 'Trial Boost Plan', 42, '17%', 7, 1, 0, 1, 1, 0, 1, 17),
(18, 'Flash Boost Plan', 44, '18%', 7, 0, 1, 0, 1, 0, 1, 18),
(19, 'Weekend Boost Plan', 46, '19%', 7, 1, 0, 1, 1, 0, 1, 19),
(20, 'Ultimate Pack Plan', 48, '20%', 7, 0, 1, 0, 1, 0, 1, 20);

--
-- Déchargement des données de la table `brands`
--

INSERT INTO `brands` (`IdBrand`, `Title`, `Description`, `Image`, `Active`) VALUES
(1, 'Apple', 'Technology brand', 'apple.png', 1),
(2, 'Samsung', 'Electronics brand', 'samsung.png', 1),
(3, 'Huawei', 'Technology brand', 'huawei.png', 1),
(4, 'Dell', 'Computer brand', 'dell.png', 1),
(5, 'HP', 'Computer brand', 'hp.png', 1),
(6, 'Nike', 'Sports brand', 'nike.png', 1),
(7, 'Adidas', 'Sports brand', 'adidas.png', 1),
(8, 'Toyota', 'Car brand', 'toyota.png', 1),
(9, 'BMW', 'Car brand', 'bmw.png', 1),
(10, 'Zara', 'Fashion brand', 'zara.png', 1),
(11, 'Apple', 'Technology brand', 'apple.png', 1),
(12, 'Samsung', 'Electronics brand', 'samsung.png', 1),
(13, 'Huawei', 'Technology brand', 'huawei.png', 1),
(14, 'Dell', 'Computer brand', 'dell.png', 1),
(15, 'HP', 'Computer brand', 'hp.png', 1),
(16, 'Nike', 'Sportswear brand', 'nike.png', 1),
(17, 'Adidas', 'Sportswear brand', 'adidas.png', 1),
(18, 'Toyota', 'Automobile brand', 'toyota.png', 1),
(19, 'BMW', 'Automobile brand', 'bmw.png', 1),
(20, 'Zara', 'Fashion brand', 'zara.png', 1),
(21, 'Sony', 'Electronics brand', 'sony.png', 1),
(22, 'LG', 'Electronics brand', 'lg.png', 1),
(23, 'Xiaomi', 'Technology brand', 'xiaomi.png', 1),
(24, 'Lenovo', 'Computer brand', 'lenovo.png', 1),
(25, 'Puma', 'Sportswear brand', 'puma.png', 1),
(26, 'Mercedes-Benz', 'Automobile brand', 'mercedes-benz.png', 1),
(27, 'Peugeot', 'Automobile brand', 'peugeot.png', 1),
(28, 'H&M', 'Fashion brand', 'hm.png', 1),
(29, 'Canon', 'Camera brand', 'canon.png', 1),
(30, 'Bose', 'Audio brand', 'bose.png', 1);

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`IdCateg`, `idparent`, `TitleEn`, `TitleFr`, `TitleAr`, `Description`, `Image`, `idtypecat`, `Active`) VALUES
(2, 11, 'Phones', 'Téléphones', 'هواتف', 'Smartphones and phones', 'phones.jpg', 1, 1),
(3, 11, 'Computers', 'Ordinateurs', 'حاسوب', 'Computers', 'computers.jpg', 1, 1),
(5, 0, 'Vehicles', 'Véhicules', 'سيارات', 'Vehicles', 'cars.jpg', 3, 1),
(6, 0, 'Home & Furniture', 'Maison & Meubles', 'منزل', 'Home products', 'home.jpg', 4, 1),
(8, 0, 'Sports & Fitness', 'Sports & Fitness', 'رياضة', 'Sports products', 'sports.jpg', 6, 1),
(9, 0, 'Books & Media', 'Livres & Médias', 'كتب', 'Books', 'books.jpg', 8, 1),
(11, 0, 'Electronics', 'Electronics', 'إلكترونيات', 'Electronics products and items', 'electronics.jpg', 11, 1),
(17, 0, 'Beauty & Care', 'Beauty & Care', 'تجميل وعناية', 'Beauty & Care products and items', 'beauty.jpg', 17, 1),
(20, 0, 'Food & Grocery', 'Food & Grocery', 'أغذية', 'Food & Grocery products and items', 'food.jpg', 20, 1),
(21, 0, 'Toys & Games', 'Toys & Games', 'ألعاب', 'Toys & Games products and items', 'toys.jpg', 21, 1),
(22, 0, 'Health & Wellness', 'Health & Wellness', 'صحة وعافية', 'Health & Wellness products and items', 'health.jpg', 22, 1),
(23, 6, 'Garden & Outdoor', 'Garden & Outdoor', 'حديقة وخارج المنزل', 'Garden & Outdoor products and items', 'garden.jpg', 23, 1),
(24, 0, 'Musical Instruments', 'Musical Instruments', 'آلات موسيقية', 'Musical Instruments products and items', 'musical.jpg', 24, 1),
(25, 0, 'Pet Supplies', 'Pet Supplies', 'مستلزمات حيوانات', 'Pet Supplies products and items', 'pet.jpg', 25, 1),
(26, 0, 'Office Supplies', 'Office Supplies', 'لوازم مكتبية', 'Office Supplies products and items', 'office.jpg', 26, 1),
(27, 0, 'Baby Products', 'Baby Products', 'منتجات أطفال', 'Baby Products products and items', 'baby.jpg', 27, 1),
(28, 0, 'Jewelry & Watches', 'Jewelry & Watches', 'مجوهرات وساعات', 'Jewelry & Watches products and items', 'jewelry.jpg', 28, 1),
(29, 0, 'Art & Crafts', 'Art & Crafts', 'فنون وحرف', 'Art & Crafts products and items', 'art.jpg', 29, 1);

--
-- Déchargement des données de la table `causes`
--

INSERT INTO `causes` (`IdCause`, `Title`, `Description`, `Email`, `Type`, `Active`, `CreatedAt`) VALUES
(1, 'Technical Issue', 'Support request regarding technical issue', 'support@tijara.tn', 'support', 1, '2026-07-02 09:00:00'),
(2, 'Payment Problem', 'Support request regarding payment problem', 'support@tijara.tn', 'support', 1, '2026-07-03 09:00:00'),
(3, 'Account Suspended', 'Support request regarding account suspended', 'support@tijara.tn', 'support', 1, '2026-07-04 09:00:00'),
(4, 'Delivery Delay', 'Support request regarding delivery delay', 'support@tijara.tn', 'support', 1, '2026-07-05 09:00:00'),
(5, 'Refund Request', 'Support request regarding refund request', 'support@tijara.tn', 'support', 1, '2026-07-06 09:00:00'),
(6, 'Product Defect', 'Support request regarding product defect', 'support@tijara.tn', 'support', 1, '2026-07-07 09:00:00'),
(7, 'Wrong Item Received', 'Support request regarding wrong item received', 'support@tijara.tn', 'support', 1, '2026-07-08 09:00:00'),
(8, 'Order Cancellation', 'Support request regarding order cancellation', 'support@tijara.tn', 'support', 1, '2026-07-09 09:00:00'),
(9, 'Login Issue', 'Support request regarding login issue', 'support@tijara.tn', 'support', 1, '2026-07-10 09:00:00'),
(10, 'Password Reset', 'Support request regarding password reset', 'support@tijara.tn', 'support', 1, '2026-07-11 09:00:00'),
(11, 'Verification Problem', 'Support request regarding verification problem', 'support@tijara.tn', 'support', 1, '2026-07-12 09:00:00'),
(12, 'Chat Not Working', 'Support request regarding chat not working', 'support@tijara.tn', 'support', 1, '2026-07-13 09:00:00'),
(13, 'App Crash', 'Support request regarding app crash', 'support@tijara.tn', 'support', 1, '2026-07-14 09:00:00'),
(14, 'Slow Loading', 'Support request regarding slow loading', 'support@tijara.tn', 'support', 1, '2026-07-15 09:00:00'),
(15, 'Missing Feature', 'Support request regarding missing feature', 'support@tijara.tn', 'support', 1, '2026-07-16 09:00:00'),
(16, 'Ad Not Approved', 'Support request regarding ad not approved', 'support@tijara.tn', 'support', 1, '2026-07-17 09:00:00'),
(17, 'Category Suggestion', 'Support request regarding category suggestion', 'support@tijara.tn', 'support', 1, '2026-07-18 09:00:00'),
(18, 'Language Support', 'Support request regarding language support', 'support@tijara.tn', 'support', 1, '2026-07-19 09:00:00'),
(19, 'Bug Report', 'Support request regarding bug report', 'support@tijara.tn', 'support', 1, '2026-07-20 09:00:00'),
(20, 'Partnership Request', 'Support request regarding partnership request', 'support@tijara.tn', 'support', 1, '2026-07-21 09:00:00');

--
-- Déchargement des données de la table `causesreports`
--

INSERT INTO `causesreports` (`IdCauseReport`, `TitleCauseEn`, `TitleCauseAr`, `TitleCauseFr`, `GroupName`, `Active`) VALUES
(1, 'Spam', 'Spam', 'Spam', 'Report', 1),
(2, 'Fraud', 'Fraud', 'Fraud', 'Report', 1),
(3, 'Inappropriate Content', 'Inappropriate Content', 'Inappropriate Content', 'Report', 1),
(4, 'Fake Product', 'Fake Product', 'Fake Product', 'Report', 1),
(5, 'Offensive Language', 'Offensive Language', 'Offensive Language', 'Report', 1),
(6, 'Duplicate Ad', 'Duplicate Ad', 'Duplicate Ad', 'Report', 1),
(7, 'Wrong Category', 'Wrong Category', 'Wrong Category', 'Report', 1),
(8, 'Scam', 'Scam', 'Scam', 'Report', 1),
(9, 'Copyright Violation', 'Copyright Violation', 'Copyright Violation', 'Report', 1),
(10, 'Harassment', 'Harassment', 'Harassment', 'Report', 1),
(11, 'Violence', 'Violence', 'Violence', 'Report', 1),
(12, 'Nudity', 'Nudity', 'Nudity', 'Report', 1),
(13, 'Misleading Price', 'Misleading Price', 'Misleading Price', 'Report', 1),
(14, 'Broken Link', 'Broken Link', 'Broken Link', 'Report', 1),
(15, 'Illegal Item', 'Illegal Item', 'Illegal Item', 'Report', 1),
(16, 'Counterfeit', 'Counterfeit', 'Counterfeit', 'Report', 1),
(17, 'Hate Speech', 'Hate Speech', 'Hate Speech', 'Report', 1),
(18, 'Privacy Violation', 'Privacy Violation', 'Privacy Violation', 'Report', 1),
(19, 'Impersonation', 'Impersonation', 'Impersonation', 'Report', 1),
(20, 'Other', 'Other', 'Other', 'Report', 1);

--
-- Déchargement des données de la table `chatmessages`
--

INSERT INTO `chatmessages` (`IdChatMessage`, `IdChat`, `Message`, `CreateDate`, `IdUserSender`, `Report`, `AdminReview`, `Active`) VALUES
(1, 1, 'Hello, is this item still available?', '2026-07-02 09:00:00', 1, 'none', 'reviewed', 1),
(2, 2, 'Yes, it\'s still available.', '2026-07-03 09:00:00', 2, 'none', 'reviewed', 1),
(3, 3, 'Can you do a better price?', '2026-07-04 09:00:00', 3, 'none', 'reviewed', 1),
(4, 4, 'I can offer a small discount.', '2026-07-05 09:00:00', 4, 'none', 'reviewed', 1),
(5, 5, 'When can I pick it up?', '2026-07-06 09:00:00', 5, 'none', 'reviewed', 1),
(6, 6, 'Tomorrow afternoon works for me.', '2026-07-07 09:00:00', 6, 'none', 'reviewed', 1),
(7, 7, 'Is delivery possible?', '2026-07-08 09:00:00', 7, 'none', 'reviewed', 1),
(8, 8, 'Yes, delivery is available.', '2026-07-09 09:00:00', 8, 'none', 'reviewed', 1),
(9, 9, 'Thank you for the quick reply.', '2026-07-10 09:00:00', 9, 'none', 'reviewed', 1),
(10, 10, 'You\'re welcome, happy to help.', '2026-07-11 09:00:00', 10, 'none', 'reviewed', 1),
(11, 11, 'Do you have other colors?', '2026-07-12 09:00:00', 11, 'none', 'reviewed', 1),
(12, 12, 'Let me check and get back to you.', '2026-07-13 09:00:00', 12, 'none', 'reviewed', 1),
(13, 13, 'Great, looking forward to it.', '2026-07-14 09:00:00', 13, 'none', 'reviewed', 1),
(14, 14, 'Payment sent, please confirm.', '2026-07-15 09:00:00', 14, 'none', 'reviewed', 1),
(15, 15, 'Confirmed, thank you!', '2026-07-16 09:00:00', 15, 'none', 'reviewed', 1),
(16, 16, 'Item shipped today.', '2026-07-17 09:00:00', 16, 'none', 'reviewed', 1),
(17, 17, 'Received, thanks a lot!', '2026-07-18 09:00:00', 17, 'none', 'reviewed', 1),
(18, 18, 'Can I get an invoice?', '2026-07-19 09:00:00', 18, 'none', 'reviewed', 1),
(19, 19, 'Sure, sending it now.', '2026-07-20 09:00:00', 19, 'none', 'reviewed', 1),
(20, 20, 'Deal closed, thanks!', '2026-07-21 09:00:00', 20, 'none', 'reviewed', 1);

--
-- Déchargement des données de la table `chats`
--

INSERT INTO `chats` (`IdChat`, `IdUserSender`, `IdUserReciver`, `CreatedAt`, `AdminReview`, `Active`) VALUES
(1, 1, 2, '2026-07-02 09:00:00', 'Reviewed - no issues', 1),
(2, 2, 3, '2026-07-03 09:00:00', 'Reviewed - no issues', 1),
(3, 3, 4, '2026-07-04 09:00:00', 'Reviewed - no issues', 1),
(4, 4, 5, '2026-07-05 09:00:00', 'Reviewed - no issues', 1),
(5, 5, 6, '2026-07-06 09:00:00', 'Reviewed - no issues', 1),
(6, 6, 7, '2026-07-07 09:00:00', 'Reviewed - no issues', 1),
(7, 7, 8, '2026-07-08 09:00:00', 'Reviewed - no issues', 1),
(8, 8, 9, '2026-07-09 09:00:00', 'Reviewed - no issues', 1),
(9, 9, 10, '2026-07-10 09:00:00', 'Reviewed - no issues', 1),
(10, 10, 11, '2026-07-11 09:00:00', 'Reviewed - no issues', 1),
(11, 11, 12, '2026-07-12 09:00:00', 'Reviewed - no issues', 1),
(12, 12, 13, '2026-07-13 09:00:00', 'Reviewed - no issues', 1),
(13, 13, 14, '2026-07-14 09:00:00', 'Reviewed - no issues', 1),
(14, 14, 15, '2026-07-15 09:00:00', 'Reviewed - no issues', 1),
(15, 15, 16, '2026-07-16 09:00:00', 'Reviewed - no issues', 1),
(16, 16, 17, '2026-07-17 09:00:00', 'Reviewed - no issues', 1),
(17, 17, 18, '2026-07-18 09:00:00', 'Reviewed - no issues', 1),
(18, 18, 19, '2026-07-19 09:00:00', 'Reviewed - no issues', 1),
(19, 19, 20, '2026-07-20 09:00:00', 'Reviewed - no issues', 1),
(20, 20, 1, '2026-07-21 09:00:00', 'Reviewed - no issues', 1);

--
-- Déchargement des données de la table `cities`
--

INSERT INTO `cities` (`IdCity`, `Title`, `IdCountry`, `TitleEn`, `TitleAr`, `Image`, `Active`, `CreatedAt`) VALUES
(1, 'Tunis', 1, 'Tunis', 'تونس', NULL, 1, '2026-07-11 12:35:39'),
(2, 'Sousse', 1, 'Sousse', 'سوسة', NULL, 1, '2026-07-11 12:35:39'),
(3, 'Sfax', 1, 'Sfax', 'صفاقس', NULL, 1, '2026-07-11 12:35:39'),
(4, 'Monastir', 1, 'Monastir', 'المنستير', NULL, 1, '2026-07-11 12:35:39'),
(5, 'Ariana', 1, 'Ariana', 'أريانة', NULL, 1, '2026-07-11 12:35:39'),
(6, 'Paris', 2, 'Paris', 'باريس', NULL, 1, '2026-07-11 12:35:39'),
(7, 'Berlin', 3, 'Berlin', 'برلين', NULL, 1, '2026-07-11 12:35:39'),
(8, 'Rome', 4, 'Rome', 'روما', NULL, 1, '2026-07-11 12:35:39'),
(9, 'Madrid', 5, 'Madrid', 'مدريد', NULL, 1, '2026-07-11 12:35:39'),
(10, 'London', 7, 'London', 'لندن', NULL, 1, '2026-07-11 12:35:39'),
(11, 'Tunis', 11, 'Tunis', 'تونس', 'tunis.jpg', 1, '2026-07-02 09:00:00'),
(12, 'La Marsa', 11, 'La Marsa', 'المرسى', 'la_marsa.jpg', 1, '2026-07-03 09:00:00'),
(13, 'Sousse', 11, 'Sousse', 'سوسة', 'sousse.jpg', 1, '2026-07-04 09:00:00'),
(14, 'Monastir', 11, 'Monastir', 'المنستير', 'monastir.jpg', 1, '2026-07-05 09:00:00'),
(15, 'Sfax', 11, 'Sfax', 'صفاقس', 'sfax.jpg', 1, '2026-07-06 09:00:00'),
(16, 'Ariana', 11, 'Ariana', 'أريانة', 'ariana.jpg', 1, '2026-07-07 09:00:00'),
(17, 'Nabeul', 11, 'Nabeul', 'نابل', 'nabeul.jpg', 1, '2026-07-08 09:00:00'),
(18, 'Bizerte', 11, 'Bizerte', 'بنزرت', 'bizerte.jpg', 1, '2026-07-09 09:00:00'),
(19, 'Hammamet', 11, 'Hammamet', 'الحمامات', 'hammamet.jpg', 1, '2026-07-10 09:00:00'),
(20, 'Djerba', 11, 'Djerba', 'جربة', 'djerba.jpg', 1, '2026-07-11 09:00:00'),
(21, 'Gabes', 11, 'Gabes', 'قابس', 'gabes.jpg', 1, '2026-07-12 09:00:00'),
(22, 'Kairouan', 11, 'Kairouan', 'القيروان', 'kairouan.jpg', 1, '2026-07-13 09:00:00'),
(23, 'Gafsa', 11, 'Gafsa', 'قفصة', 'gafsa.jpg', 1, '2026-07-14 09:00:00'),
(24, 'Mahdia', 11, 'Mahdia', 'المهدية', 'mahdia.jpg', 1, '2026-07-15 09:00:00'),
(25, 'Kasserine', 11, 'Kasserine', 'القصرين', 'kasserine.jpg', 1, '2026-07-16 09:00:00'),
(26, 'Sidi Bouzid', 11, 'Sidi Bouzid', 'سيدي بوزيد', 'sidi_bouzid.jpg', 1, '2026-07-17 09:00:00'),
(27, 'Tozeur', 11, 'Tozeur', 'توزر', 'tozeur.jpg', 1, '2026-07-18 09:00:00'),
(28, 'Zarzis', 11, 'Zarzis', 'جرجيس', 'zarzis.jpg', 1, '2026-07-19 09:00:00'),
(29, 'Ben Arous', 11, 'Ben Arous', 'بن عروس', 'ben_arous.jpg', 1, '2026-07-20 09:00:00'),
(30, 'Manouba', 11, 'Manouba', 'منوبة', 'manouba.jpg', 1, '2026-07-21 09:00:00');

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`IdComment`, `IdUser`, `Comment`, `IdReplyComment`, `Date`, `IdCourse`, `IdLesson`, `IdMeet`, `Active`) VALUES
(1, 1, 'Great tutorial, very clear!', 0, '2026-07-02', 1, 1, 1, 1),
(2, 2, 'Thanks for sharing this.', 0, '2026-07-03', 1, 1, 1, 1),
(3, 3, 'Very helpful content.', 0, '2026-07-04', 1, 1, 1, 1),
(4, 4, 'I learned a lot from this.', 0, '2026-07-05', 1, 1, 1, 1),
(5, 5, 'Could you explain more about this part?', 0, '2026-07-06', 1, 1, 1, 1),
(6, 6, 'Awesome explanation.', 0, '2026-07-07', 1, 1, 1, 1),
(7, 7, 'This helped me solve my issue.', 0, '2026-07-08', 1, 1, 1, 1),
(8, 8, 'Well structured lesson.', 0, '2026-07-09', 1, 1, 1, 1),
(9, 9, 'Looking forward to the next one.', 0, '2026-07-10', 1, 1, 1, 1),
(10, 10, 'Nice presentation.', 0, '2026-07-11', 1, 1, 1, 1),
(11, 11, 'Very informative session.', 0, '2026-07-12', 1, 1, 1, 1),
(12, 12, 'Thanks for the detailed answer.', 0, '2026-07-13', 1, 1, 1, 1),
(13, 13, 'Good pace and clarity.', 0, '2026-07-14', 1, 1, 1, 1),
(14, 14, 'Appreciate the effort.', 0, '2026-07-15', 1, 1, 1, 1),
(15, 15, 'This was exactly what I needed.', 0, '2026-07-16', 1, 1, 1, 1),
(16, 16, 'Excellent breakdown of the topic.', 0, '2026-07-17', 1, 1, 1, 1),
(17, 17, 'Clear and concise, thank you.', 0, '2026-07-18', 1, 1, 1, 1),
(18, 18, 'Really enjoyed this meeting.', 0, '2026-07-19', 1, 1, 1, 1),
(19, 19, 'Great insights shared.', 0, '2026-07-20', 1, 1, 1, 1),
(20, 20, 'Very useful discussion.', 0, '2026-07-21', 1, 1, 1, 1);

--
-- Déchargement des données de la table `countries`
--

INSERT INTO `countries` (`IdCountry`, `country_code`, `country_enName`, `country_arName`, `country_enNationality`, `country_arNationality`, `Active`, `Title`, `Flag`, `Code`, `PhoneCode`, `CreatedAt`) VALUES
(1, 'TN', 'Tunisia', 'تونس', 'Tunisian', 'تونسي', 1, 'Tunisia', 'tn.png', 'TN', '+216', '2026-07-11 12:35:39'),
(2, 'FR', 'France', 'فرنسا', 'French', 'فرنسي', 1, 'France', 'fr.png', 'FR', '+33', '2026-07-11 12:35:39'),
(3, 'DE', 'Germany', 'ألمانيا', 'German', 'ألماني', 1, 'Germany', 'de.png', 'DE', '+49', '2026-07-11 12:35:39'),
(4, 'IT', 'Italy', 'إيطاليا', 'Italian', 'إيطالي', 1, 'Italy', 'it.png', 'IT', '+39', '2026-07-11 12:35:39'),
(5, 'ES', 'Spain', 'إسبانيا', 'Spanish', 'إسباني', 1, 'Spain', 'es.png', 'ES', '+34', '2026-07-11 12:35:39'),
(6, 'US', 'USA', 'الولايات المتحدة', 'American', 'أمريكي', 1, 'United States', 'us.png', 'US', '+1', '2026-07-11 12:35:39'),
(7, 'GB', 'United Kingdom', 'بريطانيا', 'British', 'بريطاني', 1, 'United Kingdom', 'gb.png', 'GB', '+44', '2026-07-11 12:35:39'),
(8, 'TR', 'Turkey', 'تركيا', 'Turkish', 'تركي', 1, 'Turkey', 'tr.png', 'TR', '+90', '2026-07-11 12:35:39'),
(9, 'MA', 'Morocco', 'المغرب', 'Moroccan', 'مغربي', 1, 'Morocco', 'ma.png', 'MA', '+212', '2026-07-11 12:35:39'),
(10, 'DZ', 'Algeria', 'الجزائر', 'Algerian', 'جزائري', 1, 'Algeria', 'dz.png', 'DZ', '+213', '2026-07-11 12:35:39'),
(11, 'TN', 'Tunisia', 'تونس', 'Tunisian', 'تونسي', 1, 'Tunisia', 'tn.png', 'TN', '+216', '2026-07-02 09:00:00'),
(12, 'FR', 'France', 'فرنسا', 'French', 'فرنسي', 1, 'France', 'fr.png', 'FR', '+33', '2026-07-03 09:00:00'),
(13, 'DE', 'Germany', 'ألمانيا', 'German', 'ألماني', 1, 'Germany', 'de.png', 'DE', '+49', '2026-07-04 09:00:00'),
(14, 'IT', 'Italy', 'إيطاليا', 'Italian', 'إيطالي', 1, 'Italy', 'it.png', 'IT', '+39', '2026-07-05 09:00:00'),
(15, 'ES', 'Spain', 'إسبانيا', 'Spanish', 'إسباني', 1, 'Spain', 'es.png', 'ES', '+34', '2026-07-06 09:00:00'),
(16, 'US', 'United States', 'الولايات المتحدة', 'American', 'أمريكي', 1, 'United States', 'us.png', 'US', '+1', '2026-07-07 09:00:00'),
(17, 'GB', 'United Kingdom', 'بريطانيا', 'British', 'بريطاني', 1, 'United Kingdom', 'gb.png', 'GB', '+44', '2026-07-08 09:00:00'),
(18, 'TR', 'Turkey', 'تركيا', 'Turkish', 'تركي', 1, 'Turkey', 'tr.png', 'TR', '+90', '2026-07-09 09:00:00'),
(19, 'MA', 'Morocco', 'المغرب', 'Moroccan', 'مغربي', 1, 'Morocco', 'ma.png', 'MA', '+212', '2026-07-10 09:00:00'),
(20, 'DZ', 'Algeria', 'الجزائر', 'Algerian', 'جزائري', 1, 'Algeria', 'dz.png', 'DZ', '+213', '2026-07-11 09:00:00'),
(21, 'EG', 'Egypt', 'مصر', 'Egyptian', 'مصري', 1, 'Egypt', 'eg.png', 'EG', '+20', '2026-07-12 09:00:00'),
(22, 'LY', 'Libya', 'ليبيا', 'Libyan', 'ليبي', 1, 'Libya', 'ly.png', 'LY', '+218', '2026-07-13 09:00:00'),
(23, 'QA', 'Qatar', 'قطر', 'Qatari', 'قطري', 1, 'Qatar', 'qa.png', 'QA', '+974', '2026-07-14 09:00:00'),
(24, 'AE', 'United Arab Emirates', 'الإمارات', 'Emirati', 'إماراتي', 1, 'United Arab Emirates', 'ae.png', 'AE', '+971', '2026-07-15 09:00:00'),
(25, 'SA', 'Saudi Arabia', 'السعودية', 'Saudi', 'سعودي', 1, 'Saudi Arabia', 'sa.png', 'SA', '+966', '2026-07-16 09:00:00'),
(26, 'CA', 'Canada', 'كندا', 'Canadian', 'كندي', 1, 'Canada', 'ca.png', 'CA', '+1', '2026-07-17 09:00:00'),
(27, 'BE', 'Belgium', 'بلجيكا', 'Belgian', 'بلجيكي', 1, 'Belgium', 'be.png', 'BE', '+32', '2026-07-18 09:00:00'),
(28, 'NL', 'Netherlands', 'هولندا', 'Dutch', 'هولندي', 1, 'Netherlands', 'nl.png', 'NL', '+31', '2026-07-19 09:00:00'),
(29, 'CH', 'Switzerland', 'سويسرا', 'Swiss', 'سويسري', 1, 'Switzerland', 'ch.png', 'CH', '+41', '2026-07-20 09:00:00'),
(30, 'JP', 'Japan', 'اليابان', 'Japanese', 'ياباني', 1, 'Japan', 'jp.png', 'JP', '+81', '2026-07-21 09:00:00');

--
-- Déchargement des données de la table `countriesfull`
--

INSERT INTO `countriesfull` (`IdCountry`, `NameEN`, `NameFR`, `NameAR`, `NameDE`, `NameES`, `NameCH`, `NameRU`, `CodeCountry2`, `CodeCountry3`, `Flag`, `MAP`, `PhoneCode`, `Continent`, `Active`) VALUES
(1, 'Tunisia', 'Tunisia', 'تونس', 'Tunisia', 'Tunisia', 'Tunisia', 'Tunisia', 'TN', 'TNN', 'tn_flag.svg', 'tn_map.svg', '+216', 'Africa', 1),
(2, 'France', 'France', 'فرنسا', 'France', 'France', 'France', 'France', 'FR', 'FRN', 'fr_flag.svg', 'fr_map.svg', '+33', 'Europe', 1),
(3, 'Germany', 'Germany', 'ألمانيا', 'Germany', 'Germany', 'Germany', 'Germany', 'DE', 'DEN', 'de_flag.svg', 'de_map.svg', '+49', 'Europe', 1),
(4, 'Italy', 'Italy', 'إيطاليا', 'Italy', 'Italy', 'Italy', 'Italy', 'IT', 'ITN', 'it_flag.svg', 'it_map.svg', '+39', 'Europe', 1),
(5, 'Spain', 'Spain', 'إسبانيا', 'Spain', 'Spain', 'Spain', 'Spain', 'ES', 'ESN', 'es_flag.svg', 'es_map.svg', '+34', 'Europe', 1),
(6, 'United States', 'United States', 'الولايات المتحدة', 'United States', 'United States', 'United States', 'United States', 'US', 'USN', 'us_flag.svg', 'us_map.svg', '+1', 'North America', 1),
(7, 'United Kingdom', 'United Kingdom', 'بريطانيا', 'United Kingdom', 'United Kingdom', 'United Kingdom', 'United Kingdom', 'GB', 'GBN', 'gb_flag.svg', 'gb_map.svg', '+44', 'Europe', 1),
(8, 'Turkey', 'Turkey', 'تركيا', 'Turkey', 'Turkey', 'Turkey', 'Turkey', 'TR', 'TRN', 'tr_flag.svg', 'tr_map.svg', '+90', 'Asia', 1),
(9, 'Morocco', 'Morocco', 'المغرب', 'Morocco', 'Morocco', 'Morocco', 'Morocco', 'MA', 'MAN', 'ma_flag.svg', 'ma_map.svg', '+212', 'Africa', 1),
(10, 'Algeria', 'Algeria', 'الجزائر', 'Algeria', 'Algeria', 'Algeria', 'Algeria', 'DZ', 'DZN', 'dz_flag.svg', 'dz_map.svg', '+213', 'Africa', 1),
(11, 'Egypt', 'Egypt', 'مصر', 'Egypt', 'Egypt', 'Egypt', 'Egypt', 'EG', 'EGN', 'eg_flag.svg', 'eg_map.svg', '+20', 'Africa', 1),
(12, 'Libya', 'Libya', 'ليبيا', 'Libya', 'Libya', 'Libya', 'Libya', 'LY', 'LYN', 'ly_flag.svg', 'ly_map.svg', '+218', 'Africa', 1),
(13, 'Qatar', 'Qatar', 'قطر', 'Qatar', 'Qatar', 'Qatar', 'Qatar', 'QA', 'QAN', 'qa_flag.svg', 'qa_map.svg', '+974', 'Asia', 1),
(14, 'United Arab Emirates', 'United Arab Emirates', 'الإمارات', 'United Arab Emirates', 'United Arab Emirates', 'United Arab Emirates', 'United Arab Emirates', 'AE', 'AEN', 'ae_flag.svg', 'ae_map.svg', '+971', 'Asia', 1),
(15, 'Saudi Arabia', 'Saudi Arabia', 'السعودية', 'Saudi Arabia', 'Saudi Arabia', 'Saudi Arabia', 'Saudi Arabia', 'SA', 'SAN', 'sa_flag.svg', 'sa_map.svg', '+966', 'Asia', 1),
(16, 'Canada', 'Canada', 'كندا', 'Canada', 'Canada', 'Canada', 'Canada', 'CA', 'CAN', 'ca_flag.svg', 'ca_map.svg', '+1', 'North America', 1),
(17, 'Belgium', 'Belgium', 'بلجيكا', 'Belgium', 'Belgium', 'Belgium', 'Belgium', 'BE', 'BEN', 'be_flag.svg', 'be_map.svg', '+32', 'Europe', 1),
(18, 'Netherlands', 'Netherlands', 'هولندا', 'Netherlands', 'Netherlands', 'Netherlands', 'Netherlands', 'NL', 'NLN', 'nl_flag.svg', 'nl_map.svg', '+31', 'Europe', 1),
(19, 'Switzerland', 'Switzerland', 'سويسرا', 'Switzerland', 'Switzerland', 'Switzerland', 'Switzerland', 'CH', 'CHN', 'ch_flag.svg', 'ch_map.svg', '+41', 'Europe', 1),
(20, 'Japan', 'Japan', 'اليابان', 'Japan', 'Japan', 'Japan', 'Japan', 'JP', 'JPN', 'jp_flag.svg', 'jp_map.svg', '+81', 'Asia', 1);

--
-- Déchargement des données de la table `coupons`
--

INSERT INTO `coupons` (`IdCoupon`, `Title`, `Description`, `DateStart`, `DateEnd`, `Price`, `NumberOfCoupon`, `Used`, `Active`, `CreatedAt`) VALUES
(1, 'SUMMER10', 'Discount coupon code SUMMER10', '2026-07-02 09:00:00', '2026-08-01 09:00:00', 6.00, 100, 1, 1, '2026-07-02 09:00:00'),
(2, 'WELCOME15', 'Discount coupon code WELCOME15', '2026-07-03 09:00:00', '2026-08-02 09:00:00', 7.00, 100, 2, 1, '2026-07-03 09:00:00'),
(3, 'FLASH20', 'Discount coupon code FLASH20', '2026-07-04 09:00:00', '2026-08-03 09:00:00', 8.00, 100, 3, 1, '2026-07-04 09:00:00'),
(4, 'VIP25', 'Discount coupon code VIP25', '2026-07-05 09:00:00', '2026-08-04 09:00:00', 9.00, 100, 4, 1, '2026-07-05 09:00:00'),
(5, 'NEWUSER5', 'Discount coupon code NEWUSER5', '2026-07-06 09:00:00', '2026-08-05 09:00:00', 10.00, 100, 5, 1, '2026-07-06 09:00:00'),
(6, 'EID2026', 'Discount coupon code EID2026', '2026-07-07 09:00:00', '2026-08-06 09:00:00', 11.00, 100, 6, 1, '2026-07-07 09:00:00'),
(7, 'BLACKFRIDAY30', 'Discount coupon code BLACKFRIDAY30', '2026-07-08 09:00:00', '2026-08-07 09:00:00', 12.00, 100, 7, 1, '2026-07-08 09:00:00'),
(8, 'RAMADAN10', 'Discount coupon code RAMADAN10', '2026-07-09 09:00:00', '2026-08-08 09:00:00', 13.00, 100, 8, 1, '2026-07-09 09:00:00'),
(9, 'STUDENT15', 'Discount coupon code STUDENT15', '2026-07-10 09:00:00', '2026-08-09 09:00:00', 14.00, 100, 9, 1, '2026-07-10 09:00:00'),
(10, 'LOYAL20', 'Discount coupon code LOYAL20', '2026-07-11 09:00:00', '2026-08-10 09:00:00', 15.00, 100, 10, 1, '2026-07-11 09:00:00'),
(11, 'WEEKEND10', 'Discount coupon code WEEKEND10', '2026-07-12 09:00:00', '2026-08-11 09:00:00', 16.00, 100, 11, 1, '2026-07-12 09:00:00'),
(12, 'FREESHIP', 'Discount coupon code FREESHIP', '2026-07-13 09:00:00', '2026-08-12 09:00:00', 17.00, 100, 12, 1, '2026-07-13 09:00:00'),
(13, 'BUNDLE15', 'Discount coupon code BUNDLE15', '2026-07-14 09:00:00', '2026-08-13 09:00:00', 18.00, 100, 13, 1, '2026-07-14 09:00:00'),
(14, 'SEASON20', 'Discount coupon code SEASON20', '2026-07-15 09:00:00', '2026-08-14 09:00:00', 19.00, 100, 14, 1, '2026-07-15 09:00:00'),
(15, 'FIRSTORDER', 'Discount coupon code FIRSTORDER', '2026-07-16 09:00:00', '2026-08-15 09:00:00', 20.00, 100, 15, 1, '2026-07-16 09:00:00'),
(16, 'BIGDEAL25', 'Discount coupon code BIGDEAL25', '2026-07-17 09:00:00', '2026-08-16 09:00:00', 21.00, 100, 16, 1, '2026-07-17 09:00:00'),
(17, 'MEGA30', 'Discount coupon code MEGA30', '2026-07-18 09:00:00', '2026-08-17 09:00:00', 22.00, 100, 17, 1, '2026-07-18 09:00:00'),
(18, 'SPECIAL10', 'Discount coupon code SPECIAL10', '2026-07-19 09:00:00', '2026-08-18 09:00:00', 23.00, 100, 18, 1, '2026-07-19 09:00:00'),
(19, 'CLEARANCE15', 'Discount coupon code CLEARANCE15', '2026-07-20 09:00:00', '2026-08-19 09:00:00', 24.00, 100, 19, 1, '2026-07-20 09:00:00'),
(20, 'SUPER20', 'Discount coupon code SUPER20', '2026-07-21 09:00:00', '2026-08-20 09:00:00', 25.00, 100, 20, 1, '2026-07-21 09:00:00');

--
-- Déchargement des données de la table `deals`
--

INSERT INTO `deals` (`IdDeal`, `titleDeal`, `descriptionDeal`, `detailsDeal`, `priceDeal`, `discountDeal`, `quantity`, `datePublication`, `dateEnd`, `imageDeal`, `idtypecat`, `idCateg`, `idUser`, `idState`, `idPrize`, `locationDeal`, `active`, `colors`, `likes`, `liked`, `telephone`, `email`, `ownerdeals`, `brand`, `startDate`, `TotalCount`) VALUES
(11, 'iPhone 15 Pro Deal', 'Special discount on iPhone 15 Pro', 'Limited time offer', '3825', '6%', '4', '2026-07-02', '2026-07-22', 'iphone_15_pro_deal.jpg', 11, 12, 11, 11, 11, 'Tunis', 1, 'Black', 11, 1, '20000001', 'ahmed.benali@gmail.com', 'Ahmed Ben Ali', 'Apple', '2026-07-02', 105),
(12, 'Samsung Galaxy S24 Deal', 'Special discount on Samsung Galaxy S24', 'Limited time offer', '2720', '7%', '5', '2026-07-03', '2026-07-23', 'samsung_galaxy_s24_deal.jpg', 12, 12, 12, 12, 12, 'La Marsa', 1, 'Gray', 12, 1, '20000002', 'sarra.trabelsi@gmail.com', 'Sarra Trabelsi', 'Samsung', '2026-07-03', 110),
(13, 'Laptop HP ProBook 450 Deal', 'Special discount on Laptop HP ProBook 450', 'Limited time offer', '2380', '8%', '6', '2026-07-04', '2026-07-24', 'laptop_hp_probook_450_deal.jpg', 13, 13, 13, 13, 13, 'Sousse', 1, 'Silver', 13, 1, '20000003', 'ali.mansour@gmail.com', 'Ali Mansour', 'HP', '2026-07-04', 115),
(14, 'AirPods Pro 2 Deal', 'Special discount on AirPods Pro 2', 'Limited time offer', '765', '9%', '7', '2026-07-05', '2026-07-25', 'airpods_pro_2_deal.jpg', 14, 11, 14, 14, 14, 'Monastir', 1, 'White', 14, 1, '20000004', 'meriem.khalil@gmail.com', 'Meriem Khalil', 'Apple', '2026-07-05', 120),
(15, 'Apple Watch Series 9 Deal', 'Special discount on Apple Watch Series 9', 'Limited time offer', '1232', '10%', '8', '2026-07-06', '2026-07-26', 'apple_watch_series_9_deal.jpg', 15, 11, 15, 15, 15, 'Sfax', 1, 'Black', 15, 1, '20000005', 'youssef.kefi@gmail.com', 'Youssef Kefi', 'Apple', '2026-07-06', 125),
(16, 'Canon EOS R50 Deal', 'Special discount on Canon EOS R50', 'Limited time offer', '1870', '11%', '9', '2026-07-07', '2026-07-27', 'canon_eos_r50_deal.jpg', 16, 11, 16, 16, 16, 'Ariana', 1, 'Black', 16, 1, '20000006', 'nour.jaziri@gmail.com', 'Nour Jaziri', 'Canon', '2026-07-07', 130),
(17, 'PlayStation 5 Deal', 'Special discount on PlayStation 5', 'Limited time offer', '2125', '12%', '10', '2026-07-08', '2026-07-28', 'playstation_5_deal.jpg', 17, 11, 17, 17, 17, 'Nabeul', 1, 'White', 17, 1, '20000007', 'lina.haddad@gmail.com', 'Lina Haddad', 'Sony', '2026-07-08', 135),
(18, 'JBL Flip 6 Speaker Deal', 'Special discount on JBL Flip 6 Speaker', 'Limited time offer', '212', '13%', '11', '2026-07-09', '2026-07-29', 'jbl_flip_6_speaker_deal.jpg', 18, 11, 18, 18, 18, 'Bizerte', 1, 'Blue', 18, 1, '20000008', 'hatem.ali@gmail.com', 'Hatem Ali', 'JBL', '2026-07-09', 140),
(19, 'Samsung Galaxy Tab A9 Deal', 'Special discount on Samsung Galaxy Tab A9', 'Limited time offer', '595', '14%', '12', '2026-07-10', '2026-07-30', 'samsung_galaxy_tab_a9_deal.jpg', 19, 11, 19, 19, 19, 'Hammamet', 1, 'Black', 19, 1, '20000009', 'amel.saidi@gmail.com', 'Amel Saidi', 'Samsung', '2026-07-10', 145),
(20, 'Logitech G213 Keyboard Deal', 'Special discount on Logitech G213 Keyboard', 'Limited time offer', '153', '15%', '3', '2026-07-11', '2026-07-31', 'logitech_g213_keyboard_deal.jpg', 20, 13, 20, 20, 20, 'Djerba', 1, 'Black', 20, 1, '20000010', 'omar.gharbi@gmail.com', 'Omar Gharbi', 'Logitech', '2026-07-11', 150),
(21, 'MacBook Air M2 Deal', 'Special discount on MacBook Air M2', 'Limited time offer', '3060', '16%', '4', '2026-07-12', '2026-08-01', 'macbook_air_m2_deal.jpg', 21, 13, 21, 21, 21, 'Gabes', 1, 'Silver', 21, 1, '20000011', 'salma.bouazizi@gmail.com', 'Salma Bouazizi', 'Apple', '2026-07-12', 155),
(22, 'Xiaomi Redmi Note 13 Deal', 'Special discount on Xiaomi Redmi Note 13', 'Limited time offer', '765', '17%', '5', '2026-07-13', '2026-08-02', 'xiaomi_redmi_note_13_deal.jpg', 22, 12, 22, 22, 22, 'Kairouan', 1, 'Blue', 22, 1, '20000012', 'karim.chaabane@gmail.com', 'Karim Chaabane', 'Xiaomi', '2026-07-13', 160),
(23, 'Dell XPS 13 Deal', 'Special discount on Dell XPS 13', 'Limited time offer', '2805', '18%', '6', '2026-07-14', '2026-08-03', 'dell_xps_13_deal.jpg', 23, 13, 23, 23, 23, 'Gafsa', 1, 'Silver', 23, 1, '20000013', 'ines.ferjani@gmail.com', 'Ines Ferjani', 'Dell', '2026-07-14', 165),
(24, 'Sony WH-1000XM5 Deal', 'Special discount on Sony WH-1000XM5', 'Limited time offer', '935', '19%', '7', '2026-07-15', '2026-08-04', 'sony_wh-1000xm5_deal.jpg', 24, 11, 24, 24, 24, 'Mahdia', 1, 'Black', 24, 1, '20000014', 'walid.snoussi@gmail.com', 'Walid Snoussi', 'Sony', '2026-07-15', 170),
(25, 'Nintendo Switch OLED Deal', 'Special discount on Nintendo Switch OLED', 'Limited time offer', '1360', '5%', '8', '2026-07-16', '2026-08-05', 'nintendo_switch_oled_deal.jpg', 25, 11, 25, 25, 25, 'Kasserine', 1, 'Red', 25, 1, '20000015', 'rim.abidi@gmail.com', 'Rim Abidi', 'Nintendo', '2026-07-16', 175),
(26, 'Lenovo ThinkPad X1 Deal', 'Special discount on Lenovo ThinkPad X1', 'Limited time offer', '3315', '6%', '9', '2026-07-17', '2026-08-06', 'lenovo_thinkpad_x1_deal.jpg', 26, 13, 26, 26, 26, 'Sidi Bouzid', 1, 'Black', 26, 1, '20000016', 'mohamed.triki@gmail.com', 'Mohamed Triki', 'Lenovo', '2026-07-17', 180),
(27, 'GoPro Hero 12 Deal', 'Special discount on GoPro Hero 12', 'Limited time offer', '1105', '7%', '10', '2026-07-18', '2026-08-07', 'gopro_hero_12_deal.jpg', 27, 11, 27, 27, 27, 'Tozeur', 1, 'Black', 27, 1, '20000017', 'yasmine.zouari@gmail.com', 'Yasmine Zouari', 'GoPro', '2026-07-18', 185),
(28, 'Fitbit Charge 6 Deal', 'Special discount on Fitbit Charge 6', 'Limited time offer', '297', '8%', '11', '2026-07-19', '2026-08-08', 'fitbit_charge_6_deal.jpg', 28, 11, 28, 28, 28, 'Zarzis', 1, 'Black', 28, 1, '20000018', 'anis.guesmi@gmail.com', 'Anis Guesmi', 'Fitbit', '2026-07-19', 190),
(29, 'Bose SoundLink Speaker Deal', 'Special discount on Bose SoundLink Speaker', 'Limited time offer', '467', '9%', '12', '2026-07-20', '2026-08-09', 'bose_soundlink_speaker_deal.jpg', 29, 11, 29, 29, 29, 'Ben Arous', 1, 'Gray', 29, 1, '20000019', 'farah.mejri@gmail.com', 'Farah Mejri', 'Bose', '2026-07-20', 195),
(30, 'Huawei MatePad 11 Deal', 'Special discount on Huawei MatePad 11', 'Limited time offer', '1020', '10%', '3', '2026-07-21', '2026-08-10', 'huawei_matepad_11_deal.jpg', 30, 11, 30, 30, 30, 'Manouba', 1, 'Gray', 30, 1, '20000020', 'bilel.rezgui@gmail.com', 'Bilel Rezgui', 'Huawei', '2026-07-21', 200);

--
-- Déchargement des données de la table `dealswishlist`
--

INSERT INTO `dealswishlist` (`IdWishlistDeal`, `IdUser`, `IdDeal`, `Liked`) VALUES
(1, 1, 3, 1),
(2, 2, 4, 1),
(3, 3, 5, 1),
(4, 4, 6, 1),
(5, 5, 7, 1),
(6, 6, 8, 1),
(7, 7, 9, 1),
(8, 8, 10, 1),
(9, 9, 11, 1),
(10, 10, 12, 1),
(11, 11, 13, 1),
(12, 12, 14, 1),
(13, 13, 15, 1),
(14, 14, 16, 1),
(15, 15, 17, 1),
(16, 16, 18, 1),
(17, 17, 19, 1),
(18, 18, 20, 1),
(19, 19, 1, 1),
(20, 20, 2, 1);

--
-- Déchargement des données de la table `deliveries`
--

INSERT INTO `deliveries` (`IdDelivery`, `IdOrder`, `IdTransport`, `TrackingNumber`, `Status`, `AddressLine`, `City`, `PostalCode`, `Phone`, `DeliveryFee`, `EstimatedAt`, `DeliveredAt`, `Note`, `CreatedAt`, `UpdatedAt`) VALUES
(11, 11, 11, 'TRK0001', 'pending', 'Tunis Centre', 'Tunis', '1010', '20000001', 6.000, '2026-07-04 09:00:00', '2026-07-05 09:00:00', 'Handle with care', '2026-07-02 09:00:00', '2026-07-03 09:00:00'),
(12, 12, 12, 'TRK0002', 'shipping', 'La Marsa Centre', 'La Marsa', '1020', '20000002', 7.000, '2026-07-05 09:00:00', '2026-07-06 09:00:00', 'Handle with care', '2026-07-03 09:00:00', '2026-07-04 09:00:00'),
(13, 13, 13, 'TRK0003', 'delivered', 'Sousse Centre', 'Sousse', '1030', '20000003', 8.000, '2026-07-06 09:00:00', '2026-07-07 09:00:00', 'Handle with care', '2026-07-04 09:00:00', '2026-07-05 09:00:00'),
(14, 14, 14, 'TRK0004', 'pending', 'Monastir Centre', 'Monastir', '1040', '20000004', 9.000, '2026-07-07 09:00:00', '2026-07-08 09:00:00', 'Handle with care', '2026-07-05 09:00:00', '2026-07-06 09:00:00'),
(15, 15, 15, 'TRK0005', 'shipping', 'Sfax Centre', 'Sfax', '1050', '20000005', 10.000, '2026-07-08 09:00:00', '2026-07-09 09:00:00', 'Handle with care', '2026-07-06 09:00:00', '2026-07-07 09:00:00'),
(16, 16, 16, 'TRK0006', 'delivered', 'Ariana Centre', 'Ariana', '1060', '20000006', 11.000, '2026-07-09 09:00:00', '2026-07-10 09:00:00', 'Handle with care', '2026-07-07 09:00:00', '2026-07-08 09:00:00'),
(17, 17, 17, 'TRK0007', 'pending', 'Nabeul Centre', 'Nabeul', '1070', '20000007', 12.000, '2026-07-10 09:00:00', '2026-07-11 09:00:00', 'Handle with care', '2026-07-08 09:00:00', '2026-07-09 09:00:00'),
(18, 18, 18, 'TRK0008', 'shipping', 'Bizerte Centre', 'Bizerte', '1080', '20000008', 13.000, '2026-07-11 09:00:00', '2026-07-12 09:00:00', 'Handle with care', '2026-07-09 09:00:00', '2026-07-10 09:00:00'),
(19, 19, 19, 'TRK0009', 'delivered', 'Hammamet Centre', 'Hammamet', '1090', '20000009', 14.000, '2026-07-12 09:00:00', '2026-07-13 09:00:00', 'Handle with care', '2026-07-10 09:00:00', '2026-07-11 09:00:00'),
(20, 20, 20, 'TRK0010', 'pending', 'Djerba Centre', 'Djerba', '1100', '20000010', 15.000, '2026-07-13 09:00:00', '2026-07-14 09:00:00', 'Handle with care', '2026-07-11 09:00:00', '2026-07-12 09:00:00'),
(21, 21, 21, 'TRK0011', 'shipping', 'Gabes Centre', 'Gabes', '1110', '20000011', 16.000, '2026-07-14 09:00:00', '2026-07-15 09:00:00', 'Handle with care', '2026-07-12 09:00:00', '2026-07-13 09:00:00'),
(22, 22, 22, 'TRK0012', 'delivered', 'Kairouan Centre', 'Kairouan', '1120', '20000012', 17.000, '2026-07-15 09:00:00', '2026-07-16 09:00:00', 'Handle with care', '2026-07-13 09:00:00', '2026-07-14 09:00:00'),
(23, 23, 23, 'TRK0013', 'pending', 'Gafsa Centre', 'Gafsa', '1130', '20000013', 18.000, '2026-07-16 09:00:00', '2026-07-17 09:00:00', 'Handle with care', '2026-07-14 09:00:00', '2026-07-15 09:00:00'),
(24, 24, 24, 'TRK0014', 'shipping', 'Mahdia Centre', 'Mahdia', '1140', '20000014', 19.000, '2026-07-17 09:00:00', '2026-07-18 09:00:00', 'Handle with care', '2026-07-15 09:00:00', '2026-07-16 09:00:00'),
(25, 25, 25, 'TRK0015', 'delivered', 'Kasserine Centre', 'Kasserine', '1150', '20000015', 20.000, '2026-07-18 09:00:00', '2026-07-19 09:00:00', 'Handle with care', '2026-07-16 09:00:00', '2026-07-17 09:00:00'),
(26, 26, 26, 'TRK0016', 'pending', 'Sidi Bouzid Centre', 'Sidi Bouzid', '1160', '20000016', 21.000, '2026-07-19 09:00:00', '2026-07-20 09:00:00', 'Handle with care', '2026-07-17 09:00:00', '2026-07-18 09:00:00'),
(27, 27, 27, 'TRK0017', 'shipping', 'Tozeur Centre', 'Tozeur', '1170', '20000017', 22.000, '2026-07-20 09:00:00', '2026-07-21 09:00:00', 'Handle with care', '2026-07-18 09:00:00', '2026-07-19 09:00:00'),
(28, 28, 28, 'TRK0018', 'delivered', 'Zarzis Centre', 'Zarzis', '1180', '20000018', 23.000, '2026-07-21 09:00:00', '2026-07-22 09:00:00', 'Handle with care', '2026-07-19 09:00:00', '2026-07-20 09:00:00'),
(29, 29, 29, 'TRK0019', 'pending', 'Ben Arous Centre', 'Ben Arous', '1190', '20000019', 24.000, '2026-07-22 09:00:00', '2026-07-23 09:00:00', 'Handle with care', '2026-07-20 09:00:00', '2026-07-21 09:00:00'),
(30, 30, 30, 'TRK0020', 'shipping', 'Manouba Centre', 'Manouba', '1200', '20000020', 25.000, '2026-07-23 09:00:00', '2026-07-24 09:00:00', 'Handle with care', '2026-07-21 09:00:00', '2026-07-22 09:00:00');

--
-- Déchargement des données de la table `emailtokens`
--

INSERT INTO `emailtokens` (`IdToken`, `IdUser`, `Token`, `Type`, `ExpiresAt`, `Used`, `CreatedAt`) VALUES
(1, 2, 'HYVW0K', 'password_reset', '2026-07-11 12:08:54', 1, '2026-07-11 11:08:54'),
(2, 2, '2S0U0X', 'password_reset', '2026-07-13 18:37:19', 1, '2026-07-13 17:37:19');

--
-- Déchargement des données de la table `errors`
--

INSERT INTO `errors` (`IdError`, `IdUser`, `TitleError`, `Req`, `ReqError`, `ExceptionError`, `OtheError`, `Page`, `Action`, `dateTimeError`, `Validate`) VALUES
(1, 1, 'Database connection timeout', 'POST /api/action1', '400 Bad Request', 'Database connection timeout exception', 'none', '/page1', 'action1', '2026-07-02 09:00:00', 0),
(2, 2, 'Invalid input format', 'POST /api/action2', '400 Bad Request', 'Invalid input format exception', 'none', '/page2', 'action2', '2026-07-03 09:00:00', 0),
(3, 3, 'File upload failed', 'POST /api/action3', '400 Bad Request', 'File upload failed exception', 'none', '/page3', 'action3', '2026-07-04 09:00:00', 0),
(4, 4, 'Session expired', 'POST /api/action4', '400 Bad Request', 'Session expired exception', 'none', '/page4', 'action4', '2026-07-05 09:00:00', 0),
(5, 5, 'Payment gateway error', 'POST /api/action5', '400 Bad Request', 'Payment gateway error exception', 'none', '/page5', 'action5', '2026-07-06 09:00:00', 0),
(6, 6, 'Null reference exception', 'POST /api/action6', '400 Bad Request', 'Null reference exception exception', 'none', '/page6', 'action6', '2026-07-07 09:00:00', 0),
(7, 7, 'API rate limit exceeded', 'POST /api/action7', '400 Bad Request', 'API rate limit exceeded exception', 'none', '/page7', 'action7', '2026-07-08 09:00:00', 0),
(8, 8, 'Unauthorized access attempt', 'POST /api/action8', '400 Bad Request', 'Unauthorized access attempt exception', 'none', '/page8', 'action8', '2026-07-09 09:00:00', 0),
(9, 9, 'Cache write failure', 'POST /api/action9', '400 Bad Request', 'Cache write failure exception', 'none', '/page9', 'action9', '2026-07-10 09:00:00', 0),
(10, 10, 'Image resize error', 'POST /api/action10', '400 Bad Request', 'Image resize error exception', 'none', '/page10', 'action10', '2026-07-11 09:00:00', 0),
(11, 11, 'Email delivery failed', 'POST /api/action11', '400 Bad Request', 'Email delivery failed exception', 'none', '/page11', 'action11', '2026-07-12 09:00:00', 0),
(12, 12, 'SMS gateway timeout', 'POST /api/action12', '400 Bad Request', 'SMS gateway timeout exception', 'none', '/page12', 'action12', '2026-07-13 09:00:00', 0),
(13, 13, 'Duplicate entry conflict', 'POST /api/action13', '400 Bad Request', 'Duplicate entry conflict exception', 'none', '/page13', 'action13', '2026-07-14 09:00:00', 0),
(14, 14, 'Foreign key constraint failed', 'POST /api/action14', '400 Bad Request', 'Foreign key constraint failed exception', 'none', '/page14', 'action14', '2026-07-15 09:00:00', 0),
(15, 15, 'Token validation error', 'POST /api/action15', '400 Bad Request', 'Token validation error exception', 'none', '/page15', 'action15', '2026-07-16 09:00:00', 0),
(16, 16, 'Query execution error', 'POST /api/action16', '400 Bad Request', 'Query execution error exception', 'none', '/page16', 'action16', '2026-07-17 09:00:00', 0),
(17, 17, 'Memory limit exceeded', 'POST /api/action17', '400 Bad Request', 'Memory limit exceeded exception', 'none', '/page17', 'action17', '2026-07-18 09:00:00', 0),
(18, 18, 'Third-party API unreachable', 'POST /api/action18', '400 Bad Request', 'Third-party API unreachable exception', 'none', '/page18', 'action18', '2026-07-19 09:00:00', 0),
(19, 19, 'Invalid JSON payload', 'POST /api/action19', '400 Bad Request', 'Invalid JSON payload exception', 'none', '/page19', 'action19', '2026-07-20 09:00:00', 0),
(20, 20, 'Unexpected server error', 'POST /api/action20', '400 Bad Request', 'Unexpected server error exception', 'none', '/page20', 'action20', '2026-07-21 09:00:00', 0);

--
-- Déchargement des données de la table `featurecategories`
--

INSERT INTO `featurecategories` (`IdFC`, `IdCategory`, `IdFeature`) VALUES
(117, 2, 1),
(118, 2, 2),
(119, 2, 3),
(120, 2, 4),
(121, 2, 5),
(122, 2, 6),
(123, 2, 10),
(124, 3, 1),
(125, 3, 2),
(126, 3, 5),
(127, 3, 8),
(128, 3, 9),
(129, 3, 10),
(130, 11, 2),
(131, 11, 3),
(132, 11, 4),
(133, 11, 6),
(134, 11, 7),
(135, 11, 8),
(136, 11, 9),
(137, 11, 10);

--
-- Déchargement des données de la table `features`
--

INSERT INTO `features` (`IdFeature`, `TitleFeature`, `DescriptionFeature`, `UnitFeature`, `ImgFeature`, `Active`) VALUES
(1, 'RAM', 'Memory size', 'GB', NULL, 1),
(2, 'Storage', 'Storage capacity', 'GB', NULL, 1),
(3, 'Color', 'Product color', '', NULL, 1),
(4, 'Battery', 'Battery capacity', 'mAh', NULL, 1),
(5, 'Screen', 'Display size', 'inch', NULL, 1),
(6, 'Camera', 'Camera resolution', 'MP', NULL, 1),
(7, 'Weight', 'Product weight', 'Kg', NULL, 1),
(8, 'Processor', 'CPU model', '', NULL, 1),
(9, 'Material', 'Product material', '', NULL, 1),
(10, 'Warranty', 'Warranty duration', 'Year', NULL, 1);

--
-- Déchargement des données de la table `featuresvalues`
--

INSERT INTO `featuresvalues` (`IdFV`, `ValueFeature`, `IdFeature`, `Active`) VALUES
(1, '4GB', 1, 1),
(2, '8GB', 1, 1),
(3, '16GB', 1, 1),
(4, '32GB', 1, 1),
(5, '128GB', 2, 1),
(6, '256GB', 2, 1),
(7, '512GB', 2, 1),
(8, '1TB', 2, 1),
(9, '2TB', 2, 1),
(10, 'Black', 3, 1),
(11, 'White', 3, 1),
(12, 'Blue', 3, 1),
(13, 'Silver', 3, 1),
(14, '3000mAh', 4, 1),
(15, '4000mAh', 4, 1),
(16, '5000mAh', 4, 1),
(17, '6000mAh', 4, 1),
(18, '5.5', 5, 1),
(19, '6.1', 5, 1),
(20, '6.7', 5, 1),
(21, '15.6', 5, 1),
(22, '12MP', 6, 1),
(23, '48MP', 6, 1),
(24, '50MP', 6, 1),
(25, '108MP', 6, 1),
(26, '0.18Kg', 7, 1),
(27, '0.25Kg', 7, 1),
(28, '1.5Kg', 7, 1),
(29, '4.5Kg', 7, 1),
(30, 'Intel i7', 8, 1),
(31, 'Intel i9', 8, 1),
(32, 'AMD Ryzen 7', 8, 1),
(33, 'Apple A17 Pro', 8, 1),
(34, 'Plastic', 9, 1),
(35, 'Aluminium', 9, 1),
(36, 'Steel', 9, 1),
(37, 'Glass', 9, 1),
(38, '6 Months', 10, 1),
(39, '1 Year', 10, 1),
(40, '2 Years', 10, 1),
(41, '5 Years', 10, 1);

--
-- Déchargement des données de la table `invoices`
--

INSERT INTO `invoices` (`IdInvoice`, `Number`, `IdOrder`, `IdUser`, `IdVendor`, `Subtotal`, `Tax`, `DeliveryFee`, `Total`, `Status`, `IssuedAt`, `PaidAt`) VALUES
(11, 'INV-2026001', 11, 11, 12, 4500.000, 855.000, 6.000, 5361.000, 'paid', '2026-07-02 09:00:00', '2026-07-02 15:00:00'),
(12, 'INV-2026002', 12, 12, 13, 3200.000, 608.000, 7.000, 3815.000, 'paid', '2026-07-03 09:00:00', '2026-07-03 15:00:00'),
(13, 'INV-2026003', 13, 13, 14, 2800.000, 532.000, 8.000, 3340.000, 'issued', '2026-07-04 09:00:00', '2026-07-04 15:00:00'),
(14, 'INV-2026004', 14, 14, 15, 900.000, 171.000, 9.000, 1080.000, 'paid', '2026-07-05 09:00:00', '2026-07-05 15:00:00'),
(15, 'INV-2026005', 15, 15, 16, 1450.000, 275.500, 10.000, 1735.500, 'paid', '2026-07-06 09:00:00', '2026-07-06 15:00:00'),
(16, 'INV-2026006', 16, 16, 17, 2200.000, 418.000, 11.000, 2629.000, 'issued', '2026-07-07 09:00:00', '2026-07-07 15:00:00'),
(17, 'INV-2026007', 17, 17, 18, 2500.000, 475.000, 12.000, 2987.000, 'paid', '2026-07-08 09:00:00', '2026-07-08 15:00:00'),
(18, 'INV-2026008', 18, 18, 19, 250.000, 47.500, 13.000, 310.500, 'paid', '2026-07-09 09:00:00', '2026-07-09 15:00:00'),
(19, 'INV-2026009', 19, 19, 20, 700.000, 133.000, 14.000, 847.000, 'issued', '2026-07-10 09:00:00', '2026-07-10 15:00:00'),
(20, 'INV-2026010', 20, 20, 21, 180.000, 34.200, 15.000, 229.200, 'paid', '2026-07-11 09:00:00', '2026-07-11 15:00:00'),
(21, 'INV-2026011', 21, 21, 22, 3600.000, 684.000, 16.000, 4300.000, 'paid', '2026-07-12 09:00:00', '2026-07-12 15:00:00'),
(22, 'INV-2026012', 22, 22, 23, 900.000, 171.000, 17.000, 1088.000, 'issued', '2026-07-13 09:00:00', '2026-07-13 15:00:00'),
(23, 'INV-2026013', 23, 23, 24, 3300.000, 627.000, 18.000, 3945.000, 'paid', '2026-07-14 09:00:00', '2026-07-14 15:00:00'),
(24, 'INV-2026014', 24, 24, 25, 1100.000, 209.000, 19.000, 1328.000, 'paid', '2026-07-15 09:00:00', '2026-07-15 15:00:00'),
(25, 'INV-2026015', 25, 25, 26, 1600.000, 304.000, 20.000, 1924.000, 'issued', '2026-07-16 09:00:00', '2026-07-16 15:00:00'),
(26, 'INV-2026016', 26, 26, 27, 3900.000, 741.000, 21.000, 4662.000, 'paid', '2026-07-17 09:00:00', '2026-07-17 15:00:00'),
(27, 'INV-2026017', 27, 27, 28, 1300.000, 247.000, 22.000, 1569.000, 'paid', '2026-07-18 09:00:00', '2026-07-18 15:00:00'),
(28, 'INV-2026018', 28, 28, 29, 350.000, 66.500, 23.000, 439.500, 'issued', '2026-07-19 09:00:00', '2026-07-19 15:00:00'),
(29, 'INV-2026019', 29, 29, 30, 550.000, 104.500, 24.000, 678.500, 'paid', '2026-07-20 09:00:00', '2026-07-20 15:00:00'),
(30, 'INV-2026020', 30, 30, 11, 1200.000, 228.000, 25.000, 1453.000, 'paid', '2026-07-21 09:00:00', '2026-07-21 15:00:00');

--
-- Déchargement des données de la table `labels`
--

INSERT INTO `labels` (`IdLabel`, `TitleEn`, `TitleFr`, `TitleAr`, `Color`, `Active`) VALUES
(1, 'Best Seller', 'Best Seller', 'Best Seller', '#FF5733', 1),
(2, 'New Arrival', 'New Arrival', 'New Arrival', '#33A1FF', 1),
(3, 'Limited Offer', 'Limited Offer', 'Limited Offer', '#FFC300', 1),
(4, 'Hot Deal', 'Hot Deal', 'Hot Deal', '#FF3333', 1),
(5, 'Trending', 'Trending', 'Trending', '#9B33FF', 1),
(6, 'Top Rated', 'Top Rated', 'Top Rated', '#33FF57', 1),
(7, 'Sale', 'Sale', 'Sale', '#FF8F33', 1),
(8, 'Exclusive', 'Exclusive', 'Exclusive', '#333BFF', 1),
(9, 'Popular', 'Popular', 'Popular', '#FF33A1', 1),
(10, 'Recommended', 'Recommended', 'Recommended', '#33FFF6', 1),
(11, 'Discounted', 'Discounted', 'Discounted', '#C70039', 1),
(12, 'Verified Seller', 'Verified Seller', 'Verified Seller', '#28A745', 1),
(13, 'Fast Delivery', 'Fast Delivery', 'Fast Delivery', '#17A2B8', 1),
(14, 'Premium', 'Premium', 'Premium', '#6F42C1', 1),
(15, 'Eco Friendly', 'Eco Friendly', 'Eco Friendly', '#8BC34A', 1),
(16, 'Handmade', 'Handmade', 'Handmade', '#A0522D', 1),
(17, 'Imported', 'Imported', 'Imported', '#4682B4', 1),
(18, 'Local Product', 'Local Product', 'Local Product', '#DAA520', 1),
(19, 'Clearance', 'Clearance', 'Clearance', '#DC3545', 1),
(20, 'Featured', 'Featured', 'Featured', '#FFD700', 1);

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`IdLike`, `IdUser`, `TargetType`, `TargetId`, `CreatedAt`) VALUES
(11, 11, 'ad', 1, '2026-07-02 09:00:00'),
(12, 12, 'deal', 2, '2026-07-03 09:00:00'),
(13, 13, 'product', 3, '2026-07-04 09:00:00'),
(14, 14, 'ad', 4, '2026-07-05 09:00:00'),
(15, 15, 'deal', 5, '2026-07-06 09:00:00'),
(16, 16, 'product', 6, '2026-07-07 09:00:00'),
(17, 17, 'ad', 7, '2026-07-08 09:00:00'),
(18, 18, 'deal', 8, '2026-07-09 09:00:00'),
(19, 19, 'product', 9, '2026-07-10 09:00:00'),
(20, 20, 'ad', 10, '2026-07-11 09:00:00'),
(21, 21, 'deal', 11, '2026-07-12 09:00:00'),
(22, 22, 'product', 12, '2026-07-13 09:00:00'),
(23, 23, 'ad', 13, '2026-07-14 09:00:00'),
(24, 24, 'deal', 14, '2026-07-15 09:00:00'),
(25, 25, 'product', 15, '2026-07-16 09:00:00'),
(26, 26, 'ad', 16, '2026-07-17 09:00:00'),
(27, 27, 'deal', 17, '2026-07-18 09:00:00'),
(28, 28, 'product', 18, '2026-07-19 09:00:00'),
(29, 29, 'ad', 19, '2026-07-20 09:00:00'),
(30, 30, 'deal', 20, '2026-07-21 09:00:00');

--
-- Déchargement des données de la table `listpermissions`
--

INSERT INTO `listpermissions` (`IdListPermission`, `TitleEn`, `TitleFr`, `TitleAr`, `Description`, `GroupName`) VALUES
(1, 'View Ads', 'View Ads', 'View Ads', 'Permission to view ads', 'Admin'),
(2, 'Create Ads', 'Create Ads', 'Create Ads', 'Permission to create ads', 'Admin'),
(3, 'Edit Ads', 'Edit Ads', 'Edit Ads', 'Permission to edit ads', 'Admin'),
(4, 'Delete Ads', 'Delete Ads', 'Delete Ads', 'Permission to delete ads', 'Admin'),
(5, 'View Users', 'View Users', 'View Users', 'Permission to view users', 'Admin'),
(6, 'Edit Users', 'Edit Users', 'Edit Users', 'Permission to edit users', 'Admin'),
(7, 'Delete Users', 'Delete Users', 'Delete Users', 'Permission to delete users', 'Admin'),
(8, 'View Orders', 'View Orders', 'View Orders', 'Permission to view orders', 'Admin'),
(9, 'Manage Orders', 'Manage Orders', 'Manage Orders', 'Permission to manage orders', 'Admin'),
(10, 'View Payments', 'View Payments', 'View Payments', 'Permission to view payments', 'Admin'),
(11, 'Manage Payments', 'Manage Payments', 'Manage Payments', 'Permission to manage payments', 'Admin'),
(12, 'View Products', 'View Products', 'View Products', 'Permission to view products', 'Admin'),
(13, 'Edit Products', 'Edit Products', 'Edit Products', 'Permission to edit products', 'Admin'),
(14, 'Delete Products', 'Delete Products', 'Delete Products', 'Permission to delete products', 'Admin'),
(15, 'View Deals', 'View Deals', 'View Deals', 'Permission to view deals', 'Admin'),
(16, 'Manage Deals', 'Manage Deals', 'Manage Deals', 'Permission to manage deals', 'Admin'),
(17, 'View Reports', 'View Reports', 'View Reports', 'Permission to view reports', 'Admin'),
(18, 'Manage Reports', 'Manage Reports', 'Manage Reports', 'Permission to manage reports', 'Admin'),
(19, 'View Settings', 'View Settings', 'View Settings', 'Permission to view settings', 'Admin'),
(20, 'Manage Settings', 'Manage Settings', 'Manage Settings', 'Permission to manage settings', 'Admin');

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`IdMessage`, `IdUserSender`, `IdUserReceiver`, `DateMessage`, `IdMessageReplay`, `Message`, `Active`) VALUES
(1, 1, 2, '2026-07-02', 1, 'Hello, is this item still available?', 1),
(2, 2, 3, '2026-07-03', 2, 'Yes, it\'s still available.', 1),
(3, 3, 4, '2026-07-04', 3, 'Can you do a better price?', 1),
(4, 4, 5, '2026-07-05', 4, 'I can offer a small discount.', 1),
(5, 5, 6, '2026-07-06', 5, 'When can I pick it up?', 1),
(6, 6, 7, '2026-07-07', 6, 'Tomorrow afternoon works for me.', 1),
(7, 7, 8, '2026-07-08', 7, 'Is delivery possible?', 1),
(8, 8, 9, '2026-07-09', 8, 'Yes, delivery is available.', 1),
(9, 9, 10, '2026-07-10', 9, 'Thank you for the quick reply.', 1),
(10, 10, 11, '2026-07-11', 10, 'You\'re welcome, happy to help.', 1),
(11, 11, 12, '2026-07-12', 11, 'Do you have other colors?', 1),
(12, 12, 13, '2026-07-13', 12, 'Let me check and get back to you.', 1),
(13, 13, 14, '2026-07-14', 13, 'Great, looking forward to it.', 1),
(14, 14, 15, '2026-07-15', 14, 'Payment sent, please confirm.', 1),
(15, 15, 16, '2026-07-16', 15, 'Confirmed, thank you!', 1),
(16, 16, 17, '2026-07-17', 16, 'Item shipped today.', 1),
(17, 17, 18, '2026-07-18', 17, 'Received, thanks a lot!', 1),
(18, 18, 19, '2026-07-19', 18, 'Can I get an invoice?', 1),
(19, 19, 20, '2026-07-20', 19, 'Sure, sending it now.', 1),
(20, 20, 1, '2026-07-21', 20, 'Deal closed, thanks!', 1);

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2026_07_11_104322_create_oauth_auth_codes_table', 1),
(2, '2026_07_11_104323_create_oauth_access_tokens_table', 1),
(3, '2026_07_11_104324_create_oauth_refresh_tokens_table', 1),
(4, '2026_07_11_104325_create_oauth_clients_table', 1),
(5, '2026_07_11_104326_create_oauth_device_codes_table', 1);

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`IdNotification`, `Title`, `Description`, `Date`, `Type`, `IsRead`, `IdUser`) VALUES
(11, 'Welcome', 'Welcome to Tijara Marketplace', '2026-07-02', 'system', 1, 11),
(12, 'Order Confirmed', 'Your order has been confirmed', '2026-07-03', 'order', 0, 12),
(13, 'Payment Received', 'Your payment was successfully received', '2026-07-04', 'payment', 1, 13),
(14, 'Order Shipped', 'Your order has been shipped', '2026-07-05', 'delivery', 0, 14),
(15, 'New Offers', 'Check out our new promotions', '2026-07-06', 'marketing', 1, 15),
(16, 'Leave a Review', 'Please rate your recent purchase', '2026-07-07', 'review', 0, 16),
(17, 'Wallet Updated', 'Your wallet balance has been updated', '2026-07-08', 'wallet', 1, 17),
(18, 'New Message', 'You have received a new message', '2026-07-09', 'chat', 0, 18),
(19, 'Password Changed', 'Your password was changed successfully', '2026-07-10', 'security', 1, 19),
(20, 'Coupon Available', 'A new coupon is available for you', '2026-07-11', 'coupon', 0, 20),
(21, 'Ad Approved', 'Your ad has been approved', '2026-07-12', 'ad', 1, 21),
(22, 'Deal Ending Soon', 'A deal you liked is ending soon', '2026-07-13', 'deal', 0, 22),
(23, 'Delivery Update', 'Your package is out for delivery', '2026-07-14', 'delivery', 1, 23),
(24, 'Account Verified', 'Your account has been verified', '2026-07-15', 'system', 0, 24),
(25, 'New Follower', 'Someone started following your shop', '2026-07-16', 'social', 1, 25),
(26, 'Price Drop', 'An item in your wishlist dropped in price', '2026-07-17', 'marketing', 0, 26),
(27, 'Refund Processed', 'Your refund has been processed', '2026-07-18', 'payment', 1, 27),
(28, 'Invoice Ready', 'Your invoice is ready to download', '2026-07-19', 'invoice', 0, 28),
(29, 'Support Reply', 'Support replied to your ticket', '2026-07-20', 'support', 1, 29),
(30, 'Points Earned', 'You earned loyalty points on your order', '2026-07-21', 'wallet', 0, 30);

--
-- Déchargement des données de la table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('3ec29e578ec885ca6b721df09715cdc9fb6f696dfa40d108e0c1daf4b3174beb865af9e23f155665', 1, '019f50c9-fac0-735a-8fd0-74696b3cd00d', 'auth_token', '[]', 0, '2026-07-11 10:04:03', '2026-07-11 10:04:03', '2027-07-11 11:04:03'),
('430e999f1004bd64cf6f4fadf9285d212a43c7ef4329ea429b313b16a1c4377d4e45f32a2daf0de0', 2, '019f50c9-fac0-735a-8fd0-74696b3cd00d', 'auth_token', '[]', 0, '2026-07-11 10:07:11', '2026-07-11 10:07:11', '2027-07-11 11:07:11'),
('4c14a81abfdc0f31b4449c8be3104266112b01303ce268314164e4ab2ea24605175383a9019b9221', 1, '019f50c9-fac0-735a-8fd0-74696b3cd00d', 'auth_token', '[]', 0, '2026-07-11 10:05:06', '2026-07-11 10:05:06', '2027-07-11 11:05:06'),
('fb2ec6d1ff8de05c5ea07e89a2f92d70c5862f0d342f83bc693b116809f39fe1f08a7e27e40f4720', 2, '019f50c9-fac0-735a-8fd0-74696b3cd00d', 'auth_token', '[]', 0, '2026-07-11 10:13:35', '2026-07-11 10:13:35', '2027-07-11 11:13:35');

--
-- Déchargement des données de la table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `owner_type`, `owner_id`, `name`, `secret`, `provider`, `redirect_uris`, `grant_types`, `revoked`, `created_at`, `updated_at`) VALUES
('019f50c9-9932-707e-aaa6-544d3ffa5da6', NULL, NULL, 'Laravel', '$2y$12$81.ZhxCtW4sPrwvYT5OnF.VJeJkEHBpx1TQI8zvfQYJaU1NtqfdhG', 'users', '[]', '[\"personal_access\"]', 0, '2026-07-11 09:46:57', '2026-07-11 09:46:57'),
('019f50c9-fac0-735a-8fd0-74696b3cd00d', NULL, NULL, 'Laravel', '$2y$12$cJwf8u5Qc4gIqM/cKxQqzunLlya5H5JU0MuC/0B6GZQzJPLd16eTm', 'users', '[]', '[\"personal_access\"]', 0, '2026-07-11 09:47:22', '2026-07-11 09:47:22');

--
-- Déchargement des données de la table `orderdetails`
--

INSERT INTO `orderdetails` (`IdOrderDeatils`, `IdUser`, `IdProduct`, `IdState`, `IdCountry`, `IdOrder`, `ZipCode`, `Address`, `Email`, `Telephone`, `FirstName`, `LastName`, `Quantity`, `TotalAmount`, `DateTimeCommand`, `Active`) VALUES
(11, 11, 11, 11, 11, 11, 1010, 'Tunis Centre', 'ahmed.benali@gmail.com', '20000001', 'Ahmed', 'Ben Ali', 2, '4500', '2026-07-02 10:00:00', 1),
(12, 12, 12, 12, 11, 12, 1020, 'La Marsa Centre', 'sarra.trabelsi@gmail.com', '20000002', 'Sarra', 'Trabelsi', 3, '3200', '2026-07-03 10:00:00', 1),
(13, 13, 13, 13, 11, 13, 1030, 'Sousse Centre', 'ali.mansour@gmail.com', '20000003', 'Ali', 'Mansour', 1, '2800', '2026-07-04 10:00:00', 1),
(14, 14, 14, 14, 11, 14, 1040, 'Monastir Centre', 'meriem.khalil@gmail.com', '20000004', 'Meriem', 'Khalil', 2, '900', '2026-07-05 10:00:00', 1),
(15, 15, 15, 15, 11, 15, 1050, 'Sfax Centre', 'youssef.kefi@gmail.com', '20000005', 'Youssef', 'Kefi', 3, '1450', '2026-07-06 10:00:00', 1),
(16, 16, 16, 16, 11, 16, 1060, 'Ariana Centre', 'nour.jaziri@gmail.com', '20000006', 'Nour', 'Jaziri', 1, '2200', '2026-07-07 10:00:00', 1),
(17, 17, 17, 17, 11, 17, 1070, 'Nabeul Centre', 'lina.haddad@gmail.com', '20000007', 'Lina', 'Haddad', 2, '2500', '2026-07-08 10:00:00', 1),
(18, 18, 18, 18, 11, 18, 1080, 'Bizerte Centre', 'hatem.ali@gmail.com', '20000008', 'Hatem', 'Ali', 3, '250', '2026-07-09 10:00:00', 1),
(19, 19, 19, 19, 11, 19, 1090, 'Hammamet Centre', 'amel.saidi@gmail.com', '20000009', 'Amel', 'Saidi', 1, '700', '2026-07-10 10:00:00', 1),
(20, 20, 20, 20, 11, 20, 1100, 'Djerba Centre', 'omar.gharbi@gmail.com', '20000010', 'Omar', 'Gharbi', 2, '180', '2026-07-11 10:00:00', 1),
(21, 21, 21, 21, 11, 21, 1110, 'Gabes Centre', 'salma.bouazizi@gmail.com', '20000011', 'Salma', 'Bouazizi', 3, '3600', '2026-07-12 10:00:00', 1),
(22, 22, 22, 22, 11, 22, 1120, 'Kairouan Centre', 'karim.chaabane@gmail.com', '20000012', 'Karim', 'Chaabane', 1, '900', '2026-07-13 10:00:00', 1),
(23, 23, 23, 23, 11, 23, 1130, 'Gafsa Centre', 'ines.ferjani@gmail.com', '20000013', 'Ines', 'Ferjani', 2, '3300', '2026-07-14 10:00:00', 1),
(24, 24, 24, 24, 11, 24, 1140, 'Mahdia Centre', 'walid.snoussi@gmail.com', '20000014', 'Walid', 'Snoussi', 3, '1100', '2026-07-15 10:00:00', 1),
(25, 25, 25, 25, 11, 25, 1150, 'Kasserine Centre', 'rim.abidi@gmail.com', '20000015', 'Rim', 'Abidi', 1, '1600', '2026-07-16 10:00:00', 1),
(26, 26, 26, 26, 11, 26, 1160, 'Sidi Bouzid Centre', 'mohamed.triki@gmail.com', '20000016', 'Mohamed', 'Triki', 2, '3900', '2026-07-17 10:00:00', 1),
(27, 27, 27, 27, 11, 27, 1170, 'Tozeur Centre', 'yasmine.zouari@gmail.com', '20000017', 'Yasmine', 'Zouari', 3, '1300', '2026-07-18 10:00:00', 1),
(28, 28, 28, 28, 11, 28, 1180, 'Zarzis Centre', 'anis.guesmi@gmail.com', '20000018', 'Anis', 'Guesmi', 1, '350', '2026-07-19 10:00:00', 1),
(29, 29, 29, 29, 11, 29, 1190, 'Ben Arous Centre', 'farah.mejri@gmail.com', '20000019', 'Farah', 'Mejri', 2, '550', '2026-07-20 10:00:00', 1),
(30, 30, 30, 30, 11, 30, 1200, 'Manouba Centre', 'bilel.rezgui@gmail.com', '20000020', 'Bilel', 'Rezgui', 3, '1200', '2026-07-21 10:00:00', 1);

INSERT INTO `orderdetails`
(`IdOrderDeatils`, `IdUser`, `IdProduct`, `IdState`, `IdCountry`, `IdOrder`,
 `ZipCode`, `Address`, `Email`, `Telephone`, `FirstName`, `LastName`,
 `Quantity`, `TotalAmount`, `DateTimeCommand`, `Active`)
VALUES

-- Order 12 (Sarra Trabelsi) -> 2 products total
(31, 12, 2, 12, 11, 12,
 1020, 'La Marsa Centre', 'sarra.trabelsi@gmail.com', '20000002', 'Sarra', 'Trabelsi',
 2, '240', '2026-07-03 10:00:00', 1),

-- Order 13 (Ali Mansour) -> 3 products total
(32, 13, 3, 13, 11, 13,
 1030, 'Sousse Centre', 'ali.mansour@gmail.com', '20000003', 'Ali', 'Mansour',
 1, '550', '2026-07-04 10:00:00', 1),
(33, 13, 9, 13, 11, 13,
 1030, 'Sousse Centre', 'ali.mansour@gmail.com', '20000003', 'Ali', 'Mansour',
 3, '285', '2026-07-04 10:00:00', 1),

-- Order 17 (Lina Haddad) -> 4 products total  ★ use this one to test
(34, 17, 6, 17, 11, 17,
 1070, 'Nabeul Centre', 'lina.haddad@gmail.com', '20000007', 'Lina', 'Haddad',
 1, '420', '2026-07-08 10:00:00', 1),
(35, 17, 8, 17, 11, 17,
 1070, 'Nabeul Centre', 'lina.haddad@gmail.com', '20000007', 'Lina', 'Haddad',
 1, '1200', '2026-07-08 10:00:00', 1),
(36, 17, 15, 17, 11, 17,
 1070, 'Nabeul Centre', 'lina.haddad@gmail.com', '20000007', 'Lina', 'Haddad',
 2, '700', '2026-07-08 10:00:00', 1),

-- Order 16 (Nour Jaziri) -> 5 products total
(37, 16, 4, 16, 11, 16,
 1060, 'Ariana Centre', 'nour.jaziri@gmail.com', '20000006', 'Nour', 'Jaziri',
 1, '2700', '2026-07-07 10:00:00', 1),
(38, 16, 7, 16, 11, 16,
 1060, 'Ariana Centre', 'nour.jaziri@gmail.com', '20000006', 'Nour', 'Jaziri',
 1, '3200', '2026-07-07 10:00:00', 1),
(39, 16, 10, 16, 11, 16,
 1060, 'Ariana Centre', 'nour.jaziri@gmail.com', '20000006', 'Nour', 'Jaziri',
 1, '3400', '2026-07-07 10:00:00', 1),
(40, 16, 11, 16, 11, 16,
 1060, 'Ariana Centre', 'nour.jaziri@gmail.com', '20000006', 'Nour', 'Jaziri',
 1, '1800', '2026-07-07 10:00:00', 1);
--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`IdOrder`, `IdUser`, `IdDeal`, `IdState`, `DateTimeCommand`, `Active`) VALUES
(11, 11, 11, 11, '2026-07-02 10:00:00', 1),
(12, 12, 12, 12, '2026-07-03 10:00:00', 1),
(13, 13, 13, 13, '2026-07-04 10:00:00', 1),
(14, 14, 14, 14, '2026-07-05 10:00:00', 1),
(15, 15, 15, 15, '2026-07-06 10:00:00', 1),
(16, 16, 16, 16, '2026-07-07 10:00:00', 1),
(17, 17, 17, 17, '2026-07-08 10:00:00', 1),
(18, 18, 18, 18, '2026-07-09 10:00:00', 1),
(19, 19, 19, 19, '2026-07-10 10:00:00', 1),
(20, 20, 20, 20, '2026-07-11 10:00:00', 1),
(21, 21, 21, 21, '2026-07-12 10:00:00', 1),
(22, 22, 22, 22, '2026-07-13 10:00:00', 1),
(23, 23, 23, 23, '2026-07-14 10:00:00', 1),
(24, 24, 24, 24, '2026-07-15 10:00:00', 1),
(25, 25, 25, 25, '2026-07-16 10:00:00', 1),
(26, 26, 26, 26, '2026-07-17 10:00:00', 1),
(27, 27, 27, 27, '2026-07-18 10:00:00', 1),
(28, 28, 28, 28, '2026-07-19 10:00:00', 1),
(29, 29, 29, 29, '2026-07-20 10:00:00', 1),
(30, 30, 30, 30, '2026-07-21 10:00:00', 1);

--
-- Déchargement des données de la table `payments`
--

INSERT INTO `payments` (`IdPayment`, `IdUser`, `IdOrder`, `Amount`, `Method`, `Status`, `Reference`, `TransactionId`, `CreatedAt`, `PaidAt`) VALUES
(11, 11, 11, 4500.000, 'cash', 'paid', 'PAY001', 'TX001', '2026-07-02 09:00:00', '2026-07-02 14:00:00'),
(12, 12, 12, 3200.000, 'bank', 'paid', 'PAY002', 'TX002', '2026-07-03 09:00:00', '2026-07-03 14:00:00'),
(13, 13, 13, 2800.000, 'card', 'pending', 'PAY003', 'TX003', '2026-07-04 09:00:00', '2026-07-04 14:00:00'),
(14, 14, 14, 900.000, 'cash', 'paid', 'PAY004', 'TX004', '2026-07-05 09:00:00', '2026-07-05 14:00:00'),
(15, 15, 15, 1450.000, 'bank', 'paid', 'PAY005', 'TX005', '2026-07-06 09:00:00', '2026-07-06 14:00:00'),
(16, 16, 16, 2200.000, 'card', 'pending', 'PAY006', 'TX006', '2026-07-07 09:00:00', '2026-07-07 14:00:00'),
(17, 17, 17, 2500.000, 'cash', 'paid', 'PAY007', 'TX007', '2026-07-08 09:00:00', '2026-07-08 14:00:00'),
(18, 18, 18, 250.000, 'bank', 'paid', 'PAY008', 'TX008', '2026-07-09 09:00:00', '2026-07-09 14:00:00'),
(19, 19, 19, 700.000, 'card', 'pending', 'PAY009', 'TX009', '2026-07-10 09:00:00', '2026-07-10 14:00:00'),
(20, 20, 20, 180.000, 'cash', 'paid', 'PAY010', 'TX010', '2026-07-11 09:00:00', '2026-07-11 14:00:00'),
(21, 21, 21, 3600.000, 'bank', 'paid', 'PAY011', 'TX011', '2026-07-12 09:00:00', '2026-07-12 14:00:00'),
(22, 22, 22, 900.000, 'card', 'pending', 'PAY012', 'TX012', '2026-07-13 09:00:00', '2026-07-13 14:00:00'),
(23, 23, 23, 3300.000, 'cash', 'paid', 'PAY013', 'TX013', '2026-07-14 09:00:00', '2026-07-14 14:00:00'),
(24, 24, 24, 1100.000, 'bank', 'paid', 'PAY014', 'TX014', '2026-07-15 09:00:00', '2026-07-15 14:00:00'),
(25, 25, 25, 1600.000, 'card', 'pending', 'PAY015', 'TX015', '2026-07-16 09:00:00', '2026-07-16 14:00:00'),
(26, 26, 26, 3900.000, 'cash', 'paid', 'PAY016', 'TX016', '2026-07-17 09:00:00', '2026-07-17 14:00:00'),
(27, 27, 27, 1300.000, 'bank', 'paid', 'PAY017', 'TX017', '2026-07-18 09:00:00', '2026-07-18 14:00:00'),
(28, 28, 28, 350.000, 'card', 'pending', 'PAY018', 'TX018', '2026-07-19 09:00:00', '2026-07-19 14:00:00'),
(29, 29, 29, 550.000, 'cash', 'paid', 'PAY019', 'TX019', '2026-07-20 09:00:00', '2026-07-20 14:00:00'),
(30, 30, 30, 1200.000, 'bank', 'paid', 'PAY020', 'TX020', '2026-07-21 09:00:00', '2026-07-21 14:00:00');

--
-- Déchargement des données de la table `permissions`
--

INSERT INTO `permissions` (`IdPermission`, `IdRole`, `IdListPermission`, `PermissionDate`, `Resource`, `CanRead`, `CanCreate`, `CanUpdate`, `CanDelete`) VALUES
(1, 1, 1, '2026-07-02', 'Ads', 1, 1, 1, 0),
(2, 2, 2, '2026-07-03', 'Users', 1, 0, 0, 1),
(3, 3, 3, '2026-07-04', 'Orders', 1, 1, 1, 0),
(4, 4, 4, '2026-07-05', 'Payments', 1, 0, 0, 1),
(5, 5, 5, '2026-07-06', 'Products', 1, 1, 1, 0),
(6, 6, 6, '2026-07-07', 'Deals', 1, 0, 0, 1),
(7, 7, 7, '2026-07-08', 'Reports', 1, 1, 1, 0),
(8, 8, 8, '2026-07-09', 'Settings', 1, 0, 0, 1),
(9, 9, 9, '2026-07-10', 'Coupons', 1, 1, 1, 0),
(10, 10, 10, '2026-07-11', 'Invoices', 1, 0, 0, 1),
(11, 11, 11, '2026-07-12', 'Deliveries', 1, 1, 1, 0),
(12, 12, 12, '2026-07-13', 'Wallets', 1, 0, 0, 1),
(13, 13, 13, '2026-07-14', 'Reviews', 1, 1, 1, 0),
(14, 14, 14, '2026-07-15', 'Comments', 1, 0, 0, 1),
(15, 15, 15, '2026-07-16', 'Categories', 1, 1, 1, 0),
(16, 16, 16, '2026-07-17', 'Brands', 1, 0, 0, 1),
(17, 17, 17, '2026-07-18', 'Features', 1, 1, 1, 0),
(18, 18, 18, '2026-07-19', 'Prizes', 1, 0, 0, 1),
(19, 19, 19, '2026-07-20', 'Chats', 1, 1, 1, 0),
(20, 20, 20, '2026-07-21', 'Notifications', 1, 0, 0, 1);

--
-- Déchargement des données de la table `pointpackets`
--

INSERT INTO `pointpackets` (`IdPacket`, `Title`, `Description`, `PointsCount`, `Price`, `Discount`, `Active`, `CreatedAt`) VALUES
(1, 'Starter Points', 'Starter Points bundle for loyal customers', 100, 6.00, 1.00, 1, '2026-07-02 09:00:00'),
(2, 'Basic Points', 'Basic Points bundle for loyal customers', 200, 7.00, 2.00, 1, '2026-07-03 09:00:00'),
(3, 'Standard Points', 'Standard Points bundle for loyal customers', 300, 8.00, 3.00, 1, '2026-07-04 09:00:00'),
(4, 'Premium Points', 'Premium Points bundle for loyal customers', 400, 9.00, 4.00, 1, '2026-07-05 09:00:00'),
(5, 'Gold Points', 'Gold Points bundle for loyal customers', 500, 10.00, 5.00, 1, '2026-07-06 09:00:00'),
(6, 'Silver Points', 'Silver Points bundle for loyal customers', 600, 11.00, 6.00, 1, '2026-07-07 09:00:00'),
(7, 'Bronze Points', 'Bronze Points bundle for loyal customers', 700, 12.00, 7.00, 1, '2026-07-08 09:00:00'),
(8, 'Mega Points', 'Mega Points bundle for loyal customers', 800, 13.00, 8.00, 1, '2026-07-09 09:00:00'),
(9, 'Ultra Points', 'Ultra Points bundle for loyal customers', 900, 14.00, 9.00, 1, '2026-07-10 09:00:00'),
(10, 'Value Pack', 'Value Pack bundle for loyal customers', 1000, 15.00, 10.00, 1, '2026-07-11 09:00:00'),
(11, 'Bonus Pack', 'Bonus Pack bundle for loyal customers', 1100, 16.00, 11.00, 1, '2026-07-12 09:00:00'),
(12, 'Extra Points', 'Extra Points bundle for loyal customers', 1200, 17.00, 12.00, 1, '2026-07-13 09:00:00'),
(13, 'Loyalty Pack', 'Loyalty Pack bundle for loyal customers', 1300, 18.00, 13.00, 1, '2026-07-14 09:00:00'),
(14, 'Reward Pack', 'Reward Pack bundle for loyal customers', 1400, 19.00, 14.00, 1, '2026-07-15 09:00:00'),
(15, 'VIP Points', 'VIP Points bundle for loyal customers', 1500, 20.00, 15.00, 1, '2026-07-16 09:00:00'),
(16, 'Trial Points', 'Trial Points bundle for loyal customers', 1600, 21.00, 16.00, 1, '2026-07-17 09:00:00'),
(17, 'Weekly Points', 'Weekly Points bundle for loyal customers', 1700, 22.00, 17.00, 1, '2026-07-18 09:00:00'),
(18, 'Monthly Points', 'Monthly Points bundle for loyal customers', 1800, 23.00, 18.00, 1, '2026-07-19 09:00:00'),
(19, 'Seasonal Pack', 'Seasonal Pack bundle for loyal customers', 1900, 24.00, 19.00, 1, '2026-07-20 09:00:00'),
(20, 'Ultimate Points', 'Ultimate Points bundle for loyal customers', 2000, 25.00, 20.00, 1, '2026-07-21 09:00:00');

--
-- Déchargement des données de la table `prizes`
--

INSERT INTO `prizes` (`idPrize`, `image`, `title`, `description`, `idUser`, `active`, `datePublication`) VALUES
(11, 'gift1.jpg', 'Apple Gift Pack', 'Win a Apple branded gift pack', 11, 1, '2026-07-02'),
(12, 'gift2.jpg', 'Samsung Gift Pack', 'Win a Samsung branded gift pack', 12, 1, '2026-07-03'),
(13, 'gift3.jpg', 'Huawei Gift Pack', 'Win a Huawei branded gift pack', 13, 1, '2026-07-04'),
(14, 'gift4.jpg', 'Dell Gift Pack', 'Win a Dell branded gift pack', 14, 1, '2026-07-05'),
(15, 'gift5.jpg', 'HP Gift Pack', 'Win a HP branded gift pack', 15, 1, '2026-07-06'),
(16, 'gift6.jpg', 'Nike Gift Pack', 'Win a Nike branded gift pack', 16, 1, '2026-07-07'),
(17, 'gift7.jpg', 'Adidas Gift Pack', 'Win a Adidas branded gift pack', 17, 1, '2026-07-08'),
(18, 'gift8.jpg', 'Toyota Gift Pack', 'Win a Toyota branded gift pack', 18, 1, '2026-07-09'),
(19, 'gift9.jpg', 'BMW Gift Pack', 'Win a BMW branded gift pack', 19, 1, '2026-07-10'),
(20, 'gift10.jpg', 'Zara Gift Pack', 'Win a Zara branded gift pack', 20, 1, '2026-07-11'),
(21, 'gift11.jpg', 'Sony Gift Pack', 'Win a Sony branded gift pack', 21, 1, '2026-07-12'),
(22, 'gift12.jpg', 'LG Gift Pack', 'Win a LG branded gift pack', 22, 1, '2026-07-13'),
(23, 'gift13.jpg', 'Xiaomi Gift Pack', 'Win a Xiaomi branded gift pack', 23, 1, '2026-07-14'),
(24, 'gift14.jpg', 'Lenovo Gift Pack', 'Win a Lenovo branded gift pack', 24, 1, '2026-07-15'),
(25, 'gift15.jpg', 'Puma Gift Pack', 'Win a Puma branded gift pack', 25, 1, '2026-07-16'),
(26, 'gift16.jpg', 'Mercedes-Benz Gift Pack', 'Win a Mercedes-Benz branded gift pack', 26, 1, '2026-07-17'),
(27, 'gift17.jpg', 'Peugeot Gift Pack', 'Win a Peugeot branded gift pack', 27, 1, '2026-07-18'),
(28, 'gift18.jpg', 'H&M Gift Pack', 'Win a H&M branded gift pack', 28, 1, '2026-07-19'),
(29, 'gift19.jpg', 'Canon Gift Pack', 'Win a Canon branded gift pack', 29, 1, '2026-07-20'),
(30, 'gift20.jpg', 'Bose Gift Pack', 'Win a Bose branded gift pack', 30, 1, '2026-07-21');

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`IdProduct`, `CodeBarProduct`, `CodeProduct`, `ReferenceProduct`, `TitleProduct`, `DescriptionProduct`, `QuantityProduct`, `PriceProduct`, `TvaProduct`, `IdPricesDelevery`, `ImageProduct`, `VideoProduct`, `IdPrize`, `IdCateg`, `IdUser`, `IdCountrie`, `Active`) VALUES
(2, '619000000002', 'PRD002', 'REF002', 'Football Adidas', 'Official football size 5', 35, '120', '19', 1, 'football.jpg', 'football.mp4', 8, 2, 2, 1, 1),
(3, '619000000003', 'PRD003', 'REF003', 'Microwave Samsung', '23L microwave oven', 10, '550', '19', 1, 'microwave.jpg', 'microwave.mp4', 5, 6, 1, 1, 1),
(4, '619000000004', 'PRD004', 'REF004', 'Dell Inspiron 15', '15.6-inch laptop', 8, '2700', '19', 1, 'dell15.jpg', 'dell15.mp4', 2, 3, 2, 1, 1),
(6, '619000000006', 'PRD006', 'REF006', 'Nike Air Max', 'Running shoes', 22, '420', '19', 1, 'nike.jpg', 'nike.mp4', 7, 8, 2, 1, 1),
(7, '619000000007', 'PRD007', 'REF007', 'Canon EOS R50', 'Mirrorless camera', 6, '3200', '19', 1, 'canon.jpg', 'canon.mp4', 4, 11, 1, 1, 1),
(8, '619000000008', 'PRD008', 'REF008', 'Galaxy Watch 7', 'Samsung smartwatch', 15, '1200', '19', 1, 'watch7.jpg', 'watch7.mp4', 6, 11, 2, 1, 1),
(9, '619000000009', 'PRD009', 'REF009', 'Clean Code', 'Programming book', 40, '95', '19', 1, '[\"cleancode.jpg\",\"assets\\/products\\/images\\/6a5cc7f633fdf_1784465398.jpg\"]', 'cleancode.mp4', 1, 9, 1, 1, 1),
(10, '619000000010', 'PRD010', 'REF010', 'Samsung Galaxy S24', 'Android smartphone', 18, '3400', '19', 1, 's24.jpg', '[\"s24.mp4\",\"assets\\/products\\/videos\\/6a5cc86ea4705_1784465518.mp4\"]', 9, 2, 2, 1, 1),
(11, '619000000011', 'PRD011', 'REF011', 'Mountain Bike', '26-inch bicycle', 5, '1800', '19', 1, 'bike.jpg', 'bike.mp4', 5, 8, 1, 1, 1),
(12, '619000000012', 'PRD012', 'REF012', 'Air Fryer Philips', 'Healthy cooking appliance', 14, '480', '19', 1, 'airfryer.jpg', 'airfryer.mp4', 3, 6, 2, 1, 1),
(13, '619000000013', 'PRD013', 'REF013', 'PlayStation 5', 'Gaming console', 9, '2400', '19', 1, 'ps5.jpg', 'ps5.mp4', 8, 11, 1, 1, 1),
(14, '619000000014', 'PRD014', 'REF014', 'Leather Jacket', 'Men leather jacket', 11, '390', '19', 1, 'jacket.jpg', 'jacket.mp4', 2, 28, 2, 1, 1),
(15, '619000000015', 'PRD015', 'REF015', 'Car Dash Camera', 'Full HD dashcam', 20, '350', '19', 1, 'dashcam.jpg', 'dashcam.mp4', 6, 5, 1, 1, 1),
(16, '619000000016', 'PRD016', 'REF016', 'MacBook Air M3', 'Apple laptop', 7, '5200', '19', 1, 'macbook.jpg', 'macbook.mp4', 4, 3, 2, 1, 1),
(17, '619000000017', 'PRD017', 'REF017', 'Bluetooth Speaker JBL', 'Portable speaker', 30, '260', '19', 1, 'speaker.jpg', 'speaker.mp4', 7, 11, 1, 1, 1);

--
-- Déchargement des données de la table `productsfeaturevalues`
--

INSERT INTO `productsfeaturevalues` (`IdProductFeatureValue`, `IdProduct`, `IdFV`) VALUES
(275, 1, 2),
(276, 1, 6),
(277, 1, 10),
(278, 1, 16),
(279, 1, 20),
(280, 1, 23),
(281, 1, 40),
(282, 2, 2),
(283, 2, 6),
(284, 2, 10),
(285, 2, 15),
(286, 2, 19),
(287, 2, 24),
(288, 2, 40),
(289, 3, 2),
(290, 3, 7),
(291, 3, 21),
(292, 3, 30),
(293, 3, 35),
(294, 3, 40),
(295, 4, 11),
(296, 4, 14),
(297, 4, 27),
(298, 4, 34),
(299, 4, 39),
(300, 5, 1),
(301, 5, 10),
(302, 5, 15),
(303, 5, 18),
(304, 5, 35),
(305, 5, 39),
(306, 6, 10),
(307, 6, 25),
(308, 6, 28),
(309, 6, 35),
(310, 6, 40),
(311, 7, 8),
(312, 7, 11),
(314, 7, 29),
(313, 7, 32),
(315, 7, 34),
(316, 7, 39),
(317, 8, 12),
(318, 8, 15),
(319, 8, 27),
(320, 8, 34),
(321, 8, 38),
(322, 9, 2),
(323, 9, 5),
(324, 9, 10),
(325, 9, 17),
(326, 9, 21),
(327, 9, 22),
(328, 9, 39),
(329, 10, 10),
(330, 10, 28),
(331, 10, 34),
(332, 10, 40),
(262, 11, 13),
(258, 11, 35),
(261, 11, 47),
(260, 11, 57),
(257, 12, 13),
(254, 12, 35),
(255, 12, 47),
(252, 12, 52),
(269, 13, 11),
(270, 13, 14),
(209, 13, 20),
(221, 13, 30),
(212, 13, 35),
(224, 13, 40),
(215, 13, 47),
(217, 13, 52),
(247, 14, 13),
(244, 14, 35),
(245, 14, 57),
(272, 14, 73),
(251, 15, 13),
(249, 15, 35),
(250, 15, 47),
(248, 15, 52),
(235, 16, 1),
(237, 16, 7),
(239, 16, 24),
(273, 16, 45),
(242, 16, 47),
(243, 16, 52),
(228, 17, 7),
(207, 17, 13),
(210, 17, 20),
(222, 17, 30),
(213, 17, 35),
(225, 17, 40),
(216, 17, 47),
(218, 17, 52);

--
-- Déchargement des données de la table `productwishlist`
--

INSERT INTO `productwishlist` (`IdWishlistProduct`, `IdUser`, `IdProduct`, `Liked`) VALUES
(11, 11, 12, 1),
(12, 12, 13, 1),
(13, 13, 14, 1),
(14, 14, 15, 1),
(15, 15, 16, 1),
(16, 16, 17, 1),
(17, 17, 18, 1),
(18, 18, 19, 1),
(19, 19, 20, 1),
(20, 20, 21, 1),
(21, 21, 22, 1),
(22, 22, 23, 1),
(23, 23, 24, 1),
(24, 24, 25, 1),
(25, 25, 26, 1),
(26, 26, 27, 1),
(27, 27, 28, 1),
(28, 28, 29, 1),
(29, 29, 30, 1),
(30, 30, 11, 1);

--
-- Déchargement des données de la table `ratings`
--

INSERT INTO `ratings` (`IdRating`, `IdUser`, `Rating`, `CommentRating`, `Date`, `TableName`, `IdTable`, `Active`) VALUES
(11, 11, 4, 'Very good quality for the price.', '2026-07-02', 'ads', 11, 1),
(12, 12, 5, 'Trusted seller, fast response.', '2026-07-03', 'deals', 12, 1),
(13, 13, 3, 'Average, could be better.', '2026-07-04', 'products', 13, 1),
(14, 14, 4, 'Great deal, worth it.', '2026-07-05', 'ads', 14, 1),
(15, 15, 5, 'Nice packaging and fast delivery.', '2026-07-06', 'deals', 15, 1),
(16, 16, 3, 'Recommended seller, no issues.', '2026-07-07', 'products', 16, 1),
(17, 17, 4, 'Good value overall.', '2026-07-08', 'ads', 17, 1),
(18, 18, 5, 'Perfect condition as described.', '2026-07-09', 'deals', 18, 1),
(19, 19, 3, 'Amazing experience, will buy again.', '2026-07-10', 'products', 19, 1),
(20, 20, 4, 'Satisfied with the purchase.', '2026-07-11', 'ads', 20, 1),
(21, 21, 5, 'Works as expected, no complaints.', '2026-07-12', 'deals', 21, 1),
(22, 22, 3, 'Fast shipping and great communication.', '2026-07-13', 'products', 22, 1),
(23, 23, 4, 'Quality matches the description.', '2026-07-14', 'ads', 23, 1),
(24, 24, 5, 'Would buy from this seller again.', '2026-07-15', 'deals', 24, 1),
(25, 25, 3, 'Good customer service.', '2026-07-16', 'products', 25, 1),
(26, 26, 4, 'Product arrived on time and intact.', '2026-07-17', 'ads', 26, 1),
(27, 27, 5, 'Solid build quality.', '2026-07-18', 'deals', 27, 1),
(28, 28, 3, 'Reasonable price for features.', '2026-07-19', 'products', 28, 1),
(29, 29, 4, 'Definitely a five star experience.', '2026-07-20', 'ads', 29, 1),
(30, 30, 5, 'Excellent product, highly recommend!', '2026-07-21', 'deals', 30, 1);

--
-- Déchargement des données de la table `reports`
--

INSERT INTO `reports` (`IdReport`, `IdUser`, `IdCauseReport`, `Subject`, `Description`, `Date`, `State`, `TypeTable`, `IdTable`, `IdProduct`) VALUES
(1, 1, 1, 'Ad contains fake information', 'Ad contains fake information - details attached', '2026-07-02', 1, 'Products', 1, 'PRD001'),
(2, 2, 2, 'Seller not responding', 'Seller not responding - details attached', '2026-07-03', 1, 'Deals', 2, 'PRD002'),
(3, 3, 3, 'Item never delivered', 'Item never delivered - details attached', '2026-07-04', 1, 'Ads', 3, 'PRD003'),
(4, 4, 4, 'Received wrong item', 'Received wrong item - details attached', '2026-07-05', 1, 'Products', 4, 'PRD004'),
(5, 5, 5, 'Product not as described', 'Product not as described - details attached', '2026-07-06', 1, 'Deals', 5, 'PRD005'),
(6, 6, 6, 'Suspicious payment request', 'Suspicious payment request - details attached', '2026-07-07', 1, 'Ads', 6, 'PRD006'),
(7, 7, 7, 'Duplicate listing found', 'Duplicate listing found - details attached', '2026-07-08', 1, 'Products', 7, 'PRD007'),
(8, 8, 8, 'Inappropriate images used', 'Inappropriate images used - details attached', '2026-07-09', 1, 'Deals', 8, 'PRD008'),
(9, 9, 9, 'Price manipulation suspected', 'Price manipulation suspected - details attached', '2026-07-10', 1, 'Ads', 9, 'PRD009'),
(10, 10, 10, 'User account impersonation', 'User account impersonation - details attached', '2026-07-11', 1, 'Products', 10, 'PRD010'),
(11, 11, 11, 'Spam messages received', 'Spam messages received - details attached', '2026-07-12', 1, 'Deals', 11, 'PRD011'),
(12, 12, 12, 'Broken product delivered', 'Broken product delivered - details attached', '2026-07-13', 1, 'Ads', 12, 'PRD012'),
(13, 13, 13, 'Late delivery beyond promised date', 'Late delivery beyond promised date - details attached', '2026-07-14', 1, 'Products', 13, 'PRD013'),
(14, 14, 14, 'Refund not processed', 'Refund not processed - details attached', '2026-07-15', 1, 'Deals', 14, 'PRD014'),
(15, 15, 15, 'Coupon not applied correctly', 'Coupon not applied correctly - details attached', '2026-07-16', 1, 'Ads', 15, 'PRD015'),
(16, 16, 16, 'Category mismatch in listing', 'Category mismatch in listing - details attached', '2026-07-17', 1, 'Products', 16, 'PRD016'),
(17, 17, 17, 'Contact info missing', 'Contact info missing - details attached', '2026-07-18', 1, 'Deals', 17, 'PRD017'),
(18, 18, 18, 'Ad still active after sale', 'Ad still active after sale - details attached', '2026-07-19', 1, 'Ads', 18, 'PRD018'),
(19, 19, 19, 'Harassment in chat messages', 'Harassment in chat messages - details attached', '2026-07-20', 1, 'Products', 19, 'PRD019'),
(20, 20, 20, 'Counterfeit product suspected', 'Counterfeit product suspected - details attached', '2026-07-21', 1, 'Deals', 20, 'PRD020');

--
-- Déchargement des données de la table `reviews`
--

INSERT INTO `reviews` (`IdReview`, `IdUser`, `TargetType`, `TargetId`, `Rating`, `Comment`, `Active`, `CreatedAt`) VALUES
(11, 11, 'ad', 1, 4, 'Excellent product, highly recommend!', 1, '2026-07-11 17:04:06'),
(12, 12, 'deal', 2, 5, 'Very good quality for the price.', 1, '2026-07-11 17:04:06'),
(13, 13, 'product', 3, 3, 'Trusted seller, fast response.', 1, '2026-07-11 17:04:06'),
(14, 14, 'ad', 4, 4, 'Average, could be better.', 1, '2026-07-11 17:04:06'),
(15, 15, 'deal', 5, 5, 'Great deal, worth it.', 1, '2026-07-11 17:04:06'),
(16, 16, 'product', 6, 3, 'Nice packaging and fast delivery.', 1, '2026-07-11 17:04:06'),
(17, 17, 'ad', 7, 4, 'Recommended seller, no issues.', 1, '2026-07-11 17:04:06'),
(18, 18, 'deal', 8, 5, 'Good value overall.', 1, '2026-07-11 17:04:06'),
(19, 19, 'product', 9, 3, 'Perfect condition as described.', 1, '2026-07-11 17:04:06'),
(20, 20, 'ad', 10, 4, 'Amazing experience, will buy again.', 1, '2026-07-11 17:04:06'),
(21, 21, 'deal', 11, 5, 'Satisfied with the purchase.', 1, '2026-07-11 17:04:06'),
(22, 22, 'product', 12, 3, 'Works as expected, no complaints.', 1, '2026-07-11 17:04:06'),
(23, 23, 'ad', 13, 4, 'Fast shipping and great communication.', 1, '2026-07-11 17:04:06'),
(24, 24, 'deal', 14, 5, 'Quality matches the description.', 1, '2026-07-11 17:04:06'),
(25, 25, 'product', 15, 3, 'Would buy from this seller again.', 1, '2026-07-11 17:04:06'),
(26, 26, 'ad', 16, 4, 'Good customer service.', 1, '2026-07-11 17:04:06'),
(27, 27, 'deal', 17, 5, 'Product arrived on time and intact.', 1, '2026-07-11 17:04:06'),
(28, 28, 'product', 18, 3, 'Solid build quality.', 1, '2026-07-11 17:04:06'),
(29, 29, 'ad', 19, 4, 'Reasonable price for features.', 1, '2026-07-11 17:04:06'),
(30, 30, 'deal', 20, 5, 'Definitely a five star experience.', 1, '2026-07-11 17:04:06');

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`IdRole`, `RoleUser`, `Active`) VALUES
(1, 'User', 1),
(2, 'Entreprise', 1),
(3, 'Admin', 1),
(4, 'Moderator', 1),
(5, 'Vendor', 1),
(6, 'Customer', 1),
(7, 'Partner', 1),
(8, 'Manager', 1),
(9, 'Support', 1),
(10, 'Guest', 1),
(11, 'User', 1),
(12, 'Entreprise', 1),
(13, 'Admin', 1),
(14, 'Moderator', 1),
(15, 'Vendor', 1),
(16, 'Customer', 1),
(17, 'Support', 1),
(18, 'Manager', 1),
(19, 'Editor', 1),
(20, 'Analyst', 1),
(21, 'Driver', 1),
(22, 'Cashier', 1),
(23, 'Supervisor', 1),
(24, 'Auditor', 1),
(25, 'Contributor', 1),
(26, 'Reviewer', 1),
(27, 'Distributor', 1),
(28, 'Franchisee', 1),
(29, 'Partner', 1),
(30, 'Guest', 1);

--
-- Déchargement des données de la table `smslogs`
--

INSERT INTO `smslogs` (`IdSms`, `Recipient`, `Message`, `Status`, `Provider`, `SentAt`, `Error`) VALUES
(1, '20000001', 'Your Tijara verification code is 100001', 'sent', 'Twilio', '2026-07-02 09:00:00', 'none'),
(2, '20000002', 'Your Tijara verification code is 100002', 'sent', 'Twilio', '2026-07-03 09:00:00', 'none'),
(3, '20000003', 'Your Tijara verification code is 100003', 'sent', 'Twilio', '2026-07-04 09:00:00', 'none'),
(4, '20000004', 'Your Tijara verification code is 100004', 'sent', 'Twilio', '2026-07-05 09:00:00', 'none'),
(5, '20000005', 'Your Tijara verification code is 100005', 'sent', 'Twilio', '2026-07-06 09:00:00', 'none'),
(6, '20000006', 'Your Tijara verification code is 100006', 'sent', 'Twilio', '2026-07-07 09:00:00', 'none'),
(7, '20000007', 'Your Tijara verification code is 100007', 'sent', 'Twilio', '2026-07-08 09:00:00', 'none'),
(8, '20000008', 'Your Tijara verification code is 100008', 'sent', 'Twilio', '2026-07-09 09:00:00', 'none'),
(9, '20000009', 'Your Tijara verification code is 100009', 'sent', 'Twilio', '2026-07-10 09:00:00', 'none'),
(10, '20000010', 'Your Tijara verification code is 100010', 'sent', 'Twilio', '2026-07-11 09:00:00', 'none'),
(11, '20000011', 'Your Tijara verification code is 100011', 'sent', 'Twilio', '2026-07-12 09:00:00', 'none'),
(12, '20000012', 'Your Tijara verification code is 100012', 'sent', 'Twilio', '2026-07-13 09:00:00', 'none'),
(13, '20000013', 'Your Tijara verification code is 100013', 'sent', 'Twilio', '2026-07-14 09:00:00', 'none'),
(14, '20000014', 'Your Tijara verification code is 100014', 'sent', 'Twilio', '2026-07-15 09:00:00', 'none'),
(15, '20000015', 'Your Tijara verification code is 100015', 'sent', 'Twilio', '2026-07-16 09:00:00', 'none'),
(16, '20000016', 'Your Tijara verification code is 100016', 'sent', 'Twilio', '2026-07-17 09:00:00', 'none'),
(17, '20000017', 'Your Tijara verification code is 100017', 'sent', 'Twilio', '2026-07-18 09:00:00', 'none'),
(18, '20000018', 'Your Tijara verification code is 100018', 'sent', 'Twilio', '2026-07-19 09:00:00', 'none'),
(19, '20000019', 'Your Tijara verification code is 100019', 'sent', 'Twilio', '2026-07-20 09:00:00', 'none'),
(20, '20000020', 'Your Tijara verification code is 100020', 'sent', 'Twilio', '2026-07-21 09:00:00', 'none');

--
-- Déchargement des données de la table `states`
--

INSERT INTO `states` (`IdState`, `NameEN`, `NameFR`, `NameAR`, `NameDE`, `NameES`, `NameCH`, `NameRU`, `CodeState`, `CityPostalCode`, `Flag`, `MAP`, `PhoneCode`, `CountriesName`, `IdCountry`, `Active`) VALUES
(11, 'Tunis', 'Tunis', 'تونس', 'Tunis', 'Tunis', 'Tunis', 'Tunis', 'TN11', '1000', 'tn.png', 'https://maps.example.tn/tunis', '+216', 'Tunisia', 11, 1),
(12, 'Ariana', 'Ariana', 'أريانة', 'Ariana', 'Ariana', 'Ariana', 'Ariana', 'TN12', '2080', 'tn.png', 'https://maps.example.tn/ariana', '+216', 'Tunisia', 11, 1),
(13, 'Ben Arous', 'Ben Arous', 'بن عروس', 'Ben Arous', 'Ben Arous', 'Ben Arous', 'Ben Arous', 'TN13', '2013', 'tn.png', 'https://maps.example.tn/ben-arous', '+216', 'Tunisia', 11, 1),
(14, 'Manouba', 'Manouba', 'منوبة', 'Manouba', 'Manouba', 'Manouba', 'Manouba', 'TN14', '2010', 'tn.png', 'https://maps.example.tn/manouba', '+216', 'Tunisia', 11, 1),
(15, 'Nabeul', 'Nabeul', 'نابل', 'Nabeul', 'Nabeul', 'Nabeul', 'Nabeul', 'TN21', '8000', 'tn.png', 'https://maps.example.tn/nabeul', '+216', 'Tunisia', 11, 1),
(16, 'Zaghouan', 'Zaghouan', 'زغوان', 'Zaghouan', 'Zaghouan', 'Zaghouan', 'Zaghouan', 'TN22', '1100', 'tn.png', 'https://maps.example.tn/zaghouan', '+216', 'Tunisia', 11, 1),
(17, 'Bizerte', 'Bizerte', 'بنزرت', 'Bizerte', 'Bizerte', 'Bizerte', 'Bizerte', 'TN23', '7000', 'tn.png', 'https://maps.example.tn/bizerte', '+216', 'Tunisia', 11, 1),
(18, 'Beja', 'Beja', 'باجة', 'Beja', 'Beja', 'Beja', 'Beja', 'TN31', '9000', 'tn.png', 'https://maps.example.tn/beja', '+216', 'Tunisia', 11, 1),
(19, 'Jendouba', 'Jendouba', 'جندوبة', 'Jendouba', 'Jendouba', 'Jendouba', 'Jendouba', 'TN32', '8100', 'tn.png', 'https://maps.example.tn/jendouba', '+216', 'Tunisia', 11, 1),
(20, 'Kef', 'Kef', 'الكاف', 'Kef', 'Kef', 'Kef', 'Kef', 'TN33', '7100', 'tn.png', 'https://maps.example.tn/kef', '+216', 'Tunisia', 11, 1),
(21, 'Siliana', 'Siliana', 'سليانة', 'Siliana', 'Siliana', 'Siliana', 'Siliana', 'TN34', '6100', 'tn.png', 'https://maps.example.tn/siliana', '+216', 'Tunisia', 11, 1),
(22, 'Kairouan', 'Kairouan', 'القيروان', 'Kairouan', 'Kairouan', 'Kairouan', 'Kairouan', 'TN41', '3100', 'tn.png', 'https://maps.example.tn/kairouan', '+216', 'Tunisia', 11, 1),
(23, 'Kasserine', 'Kasserine', 'القصرين', 'Kasserine', 'Kasserine', 'Kasserine', 'Kasserine', 'TN42', '1200', 'tn.png', 'https://maps.example.tn/kasserine', '+216', 'Tunisia', 11, 1),
(24, 'Sidi Bouzid', 'Sidi Bouzid', 'سيدي بوزيد', 'Sidi Bouzid', 'Sidi Bouzid', 'Sidi Bouzid', 'Sidi Bouzid', 'TN43', '9100', 'tn.png', 'https://maps.example.tn/sidi-bouzid', '+216', 'Tunisia', 11, 1),
(25, 'Sample Title', 'Sample Title', 'Sample Title', 'Sample Title', 'Sample Title', 'Sample Title', 'Sample Title', 'CODE001', 'CODE001', 'sample.jpg', 'sample.jpg', 'CODE001', '10', 1, 1),
(26, 'Monastir', 'Monastir', 'المنستير', 'Monastir', 'Monastir', 'Monastir', 'Monastir', 'TN52', '5000', 'tn.png', 'https://maps.example.tn/monastir', '+216', 'Tunisia', 11, 1),
(27, 'Mahdia', 'Mahdia', 'المهدية', 'Mahdia', 'Mahdia', 'Mahdia', 'Mahdia', 'TN53', '5100', 'tn.png', 'https://maps.example.tn/mahdia', '+216', 'Tunisia', 11, 1),
(28, 'Sfax', 'Sfax', 'صفاقس', 'Sfax', 'Sfax', 'Sfax', 'Sfax', 'TN61', '3000', 'tn.png', 'https://maps.example.tn/sfax', '+216', 'Tunisia', 11, 1),
(29, 'Gabes', 'Gabes', 'قابس', 'Gabes', 'Gabes', 'Gabes', 'Gabes', 'TN71', '6000', 'tn.png', 'https://maps.example.tn/gabes', '+216', 'Tunisia', 11, 1),
(30, 'Medenine', 'Medenine', 'مدنين', 'Medenine', 'Medenine', 'Medenine', 'Medenine', 'TN72', '4100', 'tn.png', 'https://maps.example.tn/medenine', '+216', 'Tunisia', 11, 1);

--
-- Déchargement des données de la table `tags`
--

INSERT INTO `tags` (`IdUser`, `Tag`, `IdLangue`, `Active`) VALUES
(1, 'electronics', 1, 1),
(2, 'smartphone', 1, 1),
(3, 'laptop', 1, 1),
(4, 'fashion', 1, 1),
(5, 'shoes', 1, 1),
(6, 'watches', 1, 1),
(7, 'gaming', 1, 1),
(8, 'camera', 1, 1),
(9, 'audio', 1, 1),
(10, 'tablet', 1, 1),
(11, 'homeappliance', 1, 1),
(12, 'beauty', 1, 1),
(13, 'sports', 1, 1),
(14, 'kitchen', 1, 1),
(15, 'furniture', 1, 1),
(16, 'books', 1, 1),
(17, 'toys', 1, 1),
(18, 'travel', 1, 1),
(19, 'jewelry', 1, 1),
(20, 'fitness', 1, 1);

--
-- Déchargement des données de la table `transports`
--

INSERT INTO `transports` (`IdTransport`, `Name`, `Logo`, `Phone`, `Email`, `DeliveryFee`, `FreeFrom`, `Zones`, `Active`, `CreatedAt`) VALUES
(11, 'Aramex', 'aramex.png', '71000001', 'aramex@delivery.tn', 6.000, 85.000, 'Tunisie', 1, '2026-07-02 09:00:00'),
(12, 'DHL', 'dhl.png', '71000002', 'dhl@delivery.tn', 7.000, 90.000, 'Tunisie', 1, '2026-07-03 09:00:00'),
(13, 'La Poste Tunisienne', 'la_poste_tunisienne.png', '71000003', 'lapostetunisienne@delivery.tn', 8.000, 95.000, 'Tunisie', 1, '2026-07-04 09:00:00'),
(14, 'Rapid Poste', 'rapid_poste.png', '71000004', 'rapidposte@delivery.tn', 9.000, 100.000, 'Tunisie', 1, '2026-07-05 09:00:00'),
(15, 'FedEx', 'fedex.png', '71000005', 'fedex@delivery.tn', 10.000, 105.000, 'Tunisie', 1, '2026-07-06 09:00:00'),
(16, 'Yalidine', 'yalidine.png', '71000006', 'yalidine@delivery.tn', 11.000, 110.000, 'Tunisie', 1, '2026-07-07 09:00:00'),
(17, 'UPS', 'ups.png', '71000007', 'ups@delivery.tn', 12.000, 115.000, 'Tunisie', 1, '2026-07-08 09:00:00'),
(18, 'Chronopost', 'chronopost.png', '71000008', 'chronopost@delivery.tn', 13.000, 120.000, 'Tunisie', 1, '2026-07-09 09:00:00'),
(19, 'Colissimo', 'colissimo.png', '71000009', 'colissimo@delivery.tn', 14.000, 125.000, 'Tunisie', 1, '2026-07-10 09:00:00'),
(20, 'Mylerz', 'mylerz.png', '71000010', 'mylerz@delivery.tn', 15.000, 130.000, 'Tunisie', 1, '2026-07-11 09:00:00'),
(21, 'Speedaf', 'speedaf.png', '71000011', 'speedaf@delivery.tn', 16.000, 135.000, 'Tunisie', 1, '2026-07-12 09:00:00'),
(22, 'First Delivery', 'first_delivery.png', '71000012', 'firstdelivery@delivery.tn', 17.000, 140.000, 'Tunisie', 1, '2026-07-13 09:00:00'),
(23, 'J&T Express', 'jandt_express.png', '71000013', 'j&texpress@delivery.tn', 18.000, 145.000, 'Tunisie', 1, '2026-07-14 09:00:00'),
(24, 'Tunisia Express', 'tunisia_express.png', '71000014', 'tunisiaexpress@delivery.tn', 19.000, 150.000, 'Tunisie', 1, '2026-07-15 09:00:00'),
(25, 'Sama Delivery', 'sama_delivery.png', '71000015', 'samadelivery@delivery.tn', 20.000, 155.000, 'Tunisie', 1, '2026-07-16 09:00:00'),
(26, 'Best Delivery', 'best_delivery.png', '71000016', 'bestdelivery@delivery.tn', 21.000, 160.000, 'Tunisie', 1, '2026-07-17 09:00:00'),
(27, 'Smart Delivery', 'smart_delivery.png', '71000017', 'smartdelivery@delivery.tn', 22.000, 165.000, 'Tunisie', 1, '2026-07-18 09:00:00'),
(28, 'Express Plus', 'express_plus.png', '71000018', 'expressplus@delivery.tn', 23.000, 170.000, 'Tunisie', 1, '2026-07-19 09:00:00'),
(29, 'Wefast', 'wefast.png', '71000019', 'wefast@delivery.tn', 24.000, 175.000, 'Tunisie', 1, '2026-07-20 09:00:00'),
(30, 'TNT Express', 'tnt_express.png', '71000020', 'tntexpress@delivery.tn', 25.000, 180.000, 'Tunisie', 1, '2026-07-21 09:00:00');

--
-- Déchargement des données de la table `typecategory`
--

INSERT INTO `typecategory` (`Idtypecat`, `Title`) VALUES
(1, 'Electronics'),
(2, 'Fashion'),
(3, 'Vehicles'),
(4, 'Home'),
(5, 'Beauty'),
(6, 'Sports'),
(7, 'Services'),
(8, 'Books'),
(9, 'Food'),
(10, 'Other'),
(11, 'Electronics'),
(12, 'Fashion'),
(13, 'Vehicles'),
(14, 'Home'),
(15, 'Beauty'),
(16, 'Sports'),
(17, 'Services'),
(18, 'Books'),
(19, 'Food'),
(20, 'Toys'),
(21, 'Health'),
(22, 'Garden'),
(23, 'Music'),
(24, 'Pets'),
(25, 'Office'),
(26, 'Baby'),
(27, 'Jewelry'),
(28, 'Art'),
(29, 'Travel'),
(30, 'Other');

--
-- Déchargement des données de la table `userfollows`
--

INSERT INTO `userfollows` (`IdFollow`, `IdUser`, `IdVendor`, `CreatedAt`) VALUES
(1, 1, 2, '2026-07-02 09:00:00'),
(2, 2, 3, '2026-07-03 09:00:00'),
(3, 3, 4, '2026-07-04 09:00:00'),
(4, 4, 5, '2026-07-05 09:00:00'),
(5, 5, 6, '2026-07-06 09:00:00'),
(6, 6, 7, '2026-07-07 09:00:00'),
(7, 7, 8, '2026-07-08 09:00:00'),
(8, 8, 9, '2026-07-09 09:00:00'),
(9, 9, 10, '2026-07-10 09:00:00'),
(10, 10, 11, '2026-07-11 09:00:00'),
(11, 11, 12, '2026-07-12 09:00:00'),
(12, 12, 13, '2026-07-13 09:00:00'),
(13, 13, 14, '2026-07-14 09:00:00'),
(14, 14, 15, '2026-07-15 09:00:00'),
(15, 15, 16, '2026-07-16 09:00:00'),
(16, 16, 17, '2026-07-17 09:00:00'),
(17, 17, 18, '2026-07-18 09:00:00'),
(18, 18, 19, '2026-07-19 09:00:00'),
(19, 19, 20, '2026-07-20 09:00:00'),
(20, 20, 1, '2026-07-21 09:00:00');

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`IdUser`, `Username`, `FirstName`, `LastName`, `BirthDate`, `Gender`, `Email`, `ICN`, `Telephone`, `Password`, `IdRole`, `FacebookId`, `GoogleId`, `RefreshToken`, `ProfilePicture`, `CreationDate`, `IsVerified`, `IsPremuim`, `PremiumExpiry`, `IdentityPicture`, `IsBusinessAccount`, `ICNBusiness`, `BusinessVerificationPicture`, `IdState`, `IdCountry`, `Location`, `LastConnection`, `Active`, `City`, `EmailConfirmed`) VALUES
(1, '3isa', 'isa', 'lah', NULL, NULL, '3isa@gmail.com', NULL, '20764119', '$2y$12$rRVNl5dNUA5zKBPSz87ygOFSTva3520VqSAlVg4Xzn1B3ADGey8vK', NULL, NULL, NULL, NULL, NULL, '2026-07-11 11:04:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
(2, '3isa', 'isa', 'lah', NULL, NULL, 'aissa.lahiouel@polytechnicien.tn', NULL, '20764119', '$2y$12$w9oUyzFozqH0AZalJiEl0uBhTUlTHooPODCOd9NRKm9uhXQe4ikhu', NULL, NULL, NULL, NULL, NULL, '2026-07-11 11:07:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
(11, 'ahmed.benali', 'Ahmed', 'Ben Ali', '1985-02-11', 'Female', 'ahmed.benali@gmail.com', '10000001', '20000001', '$2y$12$hashedpassword1', 11, 'fb.com/ahmed.benali', 'ahmed.benali@gmail.com', 'rtok_000001abcdef', 'ahmed.benali_profile.jpg', '2026-07-01 09:00:00', 1, 0, '2027-12-31', 'ahmed.benali_id_card.jpg', 0, 'RC20001', 'ahmed.benali_business_doc.jpg', 11, 11, 'Tunis, Tunisia', '2026-07-02', 1, 'Tunis', 1),
(12, 'sarra.trabelsi', 'Sarra', 'Trabelsi', '1990-03-12', 'Male', 'sarra.trabelsi@gmail.com', '10000002', '20000002', '$2y$12$hashedpassword2', 11, 'fb.com/sarra.trabelsi', 'sarra.trabelsi@gmail.com', 'rtok_000002abcdef', 'sarra.trabelsi_profile.jpg', '2026-07-02 09:00:00', 1, 0, '2027-12-31', 'sarra.trabelsi_id_card.jpg', 0, 'RC20002', 'sarra.trabelsi_business_doc.jpg', 12, 11, 'La Marsa, Tunisia', '2026-07-03', 1, 'La Marsa', 1),
(13, 'ali.mansour', 'Ali', 'Mansour', '1988-04-13', 'Female', 'ali.mansour@gmail.com', '10000003', '20000003', '$2y$12$hashedpassword3', 12, 'fb.com/ali.mansour', 'ali.mansour@gmail.com', 'rtok_000003abcdef', 'ali.mansour_profile.jpg', '2026-07-03 09:00:00', 1, 1, '2027-12-31', 'ali.mansour_id_card.jpg', 1, 'RC20003', 'ali.mansour_business_doc.jpg', 13, 11, 'Sousse, Tunisia', '2026-07-04', 1, 'Sousse', 1),
(14, 'meriem.khalil', 'Meriem', 'Khalil', '1993-05-14', 'Male', 'meriem.khalil@gmail.com', '10000004', '20000004', '$2y$12$hashedpassword4', 12, 'fb.com/meriem.khalil', 'meriem.khalil@gmail.com', 'rtok_000004abcdef', 'meriem.khalil_profile.jpg', '2026-07-04 09:00:00', 1, 1, '2027-12-31', 'meriem.khalil_id_card.jpg', 1, 'RC20004', 'meriem.khalil_business_doc.jpg', 14, 11, 'Monastir, Tunisia', '2026-07-05', 1, 'Monastir', 1),
(15, 'youssef.kefi', 'Youssef', 'Kefi', '1987-06-15', 'Female', 'youssef.kefi@gmail.com', '10000005', '20000005', '$2y$12$hashedpassword5', 13, 'fb.com/youssef.kefi', 'youssef.kefi@gmail.com', 'rtok_000005abcdef', 'youssef.kefi_profile.jpg', '2026-07-05 09:00:00', 1, 0, '2027-12-31', 'youssef.kefi_id_card.jpg', 0, 'RC20005', 'youssef.kefi_business_doc.jpg', 15, 11, 'Sfax, Tunisia', '2026-07-06', 1, 'Sfax', 1),
(16, 'nour.jaziri', 'Nour', 'Jaziri', '1995-07-16', 'Male', 'nour.jaziri@gmail.com', '10000006', '20000006', '$2y$12$hashedpassword6', 11, 'fb.com/nour.jaziri', 'nour.jaziri@gmail.com', 'rtok_000006abcdef', 'nour.jaziri_profile.jpg', '2026-07-06 09:00:00', 1, 0, '2027-12-31', 'nour.jaziri_id_card.jpg', 0, 'RC20006', 'nour.jaziri_business_doc.jpg', 16, 11, 'Ariana, Tunisia', '2026-07-07', 1, 'Ariana', 1),
(17, 'lina.haddad', 'Lina', 'Haddad', '1991-08-17', 'Female', 'lina.haddad@gmail.com', '10000007', '20000007', '$2y$12$hashedpassword7', 11, 'fb.com/lina.haddad', 'lina.haddad@gmail.com', 'rtok_000007abcdef', 'lina.haddad_profile.jpg', '2026-07-07 09:00:00', 1, 0, '2027-12-31', 'lina.haddad_id_card.jpg', 0, 'RC20007', 'lina.haddad_business_doc.jpg', 17, 11, 'Nabeul, Tunisia', '2026-07-08', 1, 'Nabeul', 1),
(18, 'hatem.ali', 'Hatem', 'Ali', '1989-09-18', 'Male', 'hatem.ali@gmail.com', '10000008', '20000008', '$2y$12$hashedpassword8', 12, 'fb.com/hatem.ali', 'hatem.ali@gmail.com', 'rtok_000008abcdef', 'hatem.ali_profile.jpg', '2026-07-08 09:00:00', 1, 1, '2027-12-31', 'hatem.ali_id_card.jpg', 1, 'RC20008', 'hatem.ali_business_doc.jpg', 18, 11, 'Bizerte, Tunisia', '2026-07-09', 1, 'Bizerte', 1),
(19, 'amel.saidi', 'Amel', 'Saidi', '1996-01-19', 'Female', 'amel.saidi@gmail.com', '10000009', '20000009', '$2y$12$hashedpassword9', 11, 'fb.com/amel.saidi', 'amel.saidi@gmail.com', 'rtok_000009abcdef', 'amel.saidi_profile.jpg', '2026-07-09 09:00:00', 1, 0, '2027-12-31', 'amel.saidi_id_card.jpg', 0, 'RC20009', 'amel.saidi_business_doc.jpg', 19, 11, 'Hammamet, Tunisia', '2026-07-10', 1, 'Hammamet', 1),
(20, 'omar.gharbi', 'Omar', 'Gharbi', '1984-02-20', 'Male', 'omar.gharbi@gmail.com', '10000010', '20000010', '$2y$12$hashedpassword10', 11, 'fb.com/omar.gharbi', 'omar.gharbi@gmail.com', 'rtok_000010abcdef', 'omar.gharbi_profile.jpg', '2026-07-10 09:00:00', 1, 0, '2027-12-31', 'omar.gharbi_id_card.jpg', 0, 'RC20010', 'omar.gharbi_business_doc.jpg', 20, 11, 'Djerba, Tunisia', '2026-07-11', 1, 'Djerba', 1),
(21, 'salma.bouazizi', 'Salma', 'Bouazizi', '1992-03-21', 'Female', 'salma.bouazizi@gmail.com', '10000011', '20000011', '$2y$12$hashedpassword11', 11, 'fb.com/salma.bouazizi', 'salma.bouazizi@gmail.com', 'rtok_000011abcdef', 'salma.bouazizi_profile.jpg', '2026-07-11 09:00:00', 1, 0, '2027-12-31', 'salma.bouazizi_id_card.jpg', 0, 'RC20011', 'salma.bouazizi_business_doc.jpg', 21, 11, 'Gabes, Tunisia', '2026-07-12', 1, 'Gabes', 1),
(22, 'karim.chaabane', 'Karim', 'Chaabane', '1986-04-22', 'Male', 'karim.chaabane@gmail.com', '10000012', '20000012', '$2y$12$hashedpassword12', 12, 'fb.com/karim.chaabane', 'karim.chaabane@gmail.com', 'rtok_000012abcdef', 'karim.chaabane_profile.jpg', '2026-07-12 09:00:00', 1, 1, '2027-12-31', 'karim.chaabane_id_card.jpg', 1, 'RC20012', 'karim.chaabane_business_doc.jpg', 22, 11, 'Kairouan, Tunisia', '2026-07-13', 1, 'Kairouan', 1),
(23, 'ines.ferjani', 'Ines', 'Ferjani', '1994-05-23', 'Female', 'ines.ferjani@gmail.com', '10000013', '20000013', '$2y$12$hashedpassword13', 11, 'fb.com/ines.ferjani', 'ines.ferjani@gmail.com', 'rtok_000013abcdef', 'ines.ferjani_profile.jpg', '2026-07-13 09:00:00', 1, 0, '2027-12-31', 'ines.ferjani_id_card.jpg', 0, 'RC20013', 'ines.ferjani_business_doc.jpg', 23, 11, 'Gafsa, Tunisia', '2026-07-14', 1, 'Gafsa', 1),
(24, 'walid.snoussi', 'Walid', 'Snoussi', '1990-06-24', 'Male', 'walid.snoussi@gmail.com', '10000014', '20000014', '$2y$12$hashedpassword14', 11, 'fb.com/walid.snoussi', 'walid.snoussi@gmail.com', 'rtok_000014abcdef', 'walid.snoussi_profile.jpg', '2026-07-14 09:00:00', 1, 0, '2027-12-31', 'walid.snoussi_id_card.jpg', 0, 'RC20014', 'walid.snoussi_business_doc.jpg', 24, 11, 'Mahdia, Tunisia', '2026-07-15', 1, 'Mahdia', 1),
(25, 'rim.abidi', 'Rim', 'Abidi', '1997-07-25', 'Female', 'rim.abidi@gmail.com', '10000015', '20000015', '$2y$12$hashedpassword15', 11, 'fb.com/rim.abidi', 'rim.abidi@gmail.com', 'rtok_000015abcdef', 'rim.abidi_profile.jpg', '2026-07-15 09:00:00', 1, 0, '2027-12-31', 'rim.abidi_id_card.jpg', 0, 'RC20015', 'rim.abidi_business_doc.jpg', 25, 11, 'Kasserine, Tunisia', '2026-07-16', 1, 'Kasserine', 1),
(26, 'mohamed.triki', 'Mohamed', 'Triki', '1983-08-26', 'Male', 'mohamed.triki@gmail.com', '10000016', '20000016', '$2y$12$hashedpassword16', 12, 'fb.com/mohamed.triki', 'mohamed.triki@gmail.com', 'rtok_000016abcdef', 'mohamed.triki_profile.jpg', '2026-07-16 09:00:00', 1, 1, '2027-12-31', 'mohamed.triki_id_card.jpg', 1, 'RC20016', 'mohamed.triki_business_doc.jpg', 26, 11, 'Sidi Bouzid, Tunisia', '2026-07-17', 1, 'Sidi Bouzid', 1),
(27, 'yasmine.zouari', 'Yasmine', 'Zouari', '1998-09-27', 'Female', 'yasmine.zouari@gmail.com', '10000017', '20000017', '$2y$12$hashedpassword17', 11, 'fb.com/yasmine.zouari', 'yasmine.zouari@gmail.com', 'rtok_000017abcdef', 'yasmine.zouari_profile.jpg', '2026-07-17 09:00:00', 1, 0, '2027-12-31', 'yasmine.zouari_id_card.jpg', 0, 'RC20017', 'yasmine.zouari_business_doc.jpg', 27, 11, 'Tozeur, Tunisia', '2026-07-18', 1, 'Tozeur', 1),
(28, 'anis.guesmi', 'Anis', 'Guesmi', '1985-01-10', 'Male', 'anis.guesmi@gmail.com', '10000018', '20000018', '$2y$12$hashedpassword18', 11, 'fb.com/anis.guesmi', 'anis.guesmi@gmail.com', 'rtok_000018abcdef', 'anis.guesmi_profile.jpg', '2026-07-18 09:00:00', 1, 0, '2027-12-31', 'anis.guesmi_id_card.jpg', 0, 'RC20018', 'anis.guesmi_business_doc.jpg', 28, 11, 'Zarzis, Tunisia', '2026-07-19', 1, 'Zarzis', 1),
(29, 'farah.mejri', 'Farah', 'Mejri', '1991-02-11', 'Female', 'farah.mejri@gmail.com', '10000019', '20000019', '$2y$12$hashedpassword19', 11, 'fb.com/farah.mejri', 'farah.mejri@gmail.com', 'rtok_000019abcdef', 'farah.mejri_profile.jpg', '2026-07-19 09:00:00', 1, 0, '2027-12-31', 'farah.mejri_id_card.jpg', 0, 'RC20019', 'farah.mejri_business_doc.jpg', 29, 11, 'Ben Arous, Tunisia', '2026-07-20', 1, 'Ben Arous', 1),
(30, 'bilel.rezgui', 'Bilel', 'Rezgui', '1988-03-12', 'Male', 'bilel.rezgui@gmail.com', '10000020', '20000020', '$2y$12$hashedpassword20', 12, 'fb.com/bilel.rezgui', 'bilel.rezgui@gmail.com', 'rtok_000020abcdef', 'bilel.rezgui_profile.jpg', '2026-07-20 09:00:00', 1, 1, '2027-12-31', 'bilel.rezgui_id_card.jpg', 1, 'RC20020', 'bilel.rezgui_business_doc.jpg', 30, 11, 'Manouba, Tunisia', '2026-07-21', 1, 'Manouba', 1);

--
-- Déchargement des données de la table `wallets`
--

INSERT INTO `wallets` (`IdWallet`, `IdUser`, `ICN`, `NbrJeton`, `MoneyBudget`, `MoneyBlocked`, `MoneyTransfered`, `Active`) VALUES
(11, 11, 'ICN001', 60, 230.000, 5.000, 10.000, 1),
(12, 12, 'ICN002', 70, 260.000, 10.000, 20.000, 1),
(13, 13, 'ICN003', 80, 290.000, 15.000, 30.000, 1),
(14, 14, 'ICN004', 90, 320.000, 20.000, 40.000, 1),
(15, 15, 'ICN005', 100, 350.000, 25.000, 50.000, 1),
(16, 16, 'ICN006', 110, 380.000, 30.000, 60.000, 1),
(17, 17, 'ICN007', 120, 410.000, 35.000, 70.000, 1),
(18, 18, 'ICN008', 130, 440.000, 40.000, 80.000, 1),
(19, 19, 'ICN009', 140, 470.000, 45.000, 90.000, 1),
(20, 20, 'ICN010', 150, 500.000, 50.000, 100.000, 1),
(21, 21, 'ICN011', 160, 530.000, 55.000, 110.000, 1),
(22, 22, 'ICN012', 170, 560.000, 60.000, 120.000, 1),
(23, 23, 'ICN013', 180, 590.000, 65.000, 130.000, 1),
(24, 24, 'ICN014', 190, 620.000, 70.000, 140.000, 1),
(25, 25, 'ICN015', 200, 650.000, 75.000, 150.000, 1),
(26, 26, 'ICN016', 210, 680.000, 80.000, 160.000, 1),
(27, 27, 'ICN017', 220, 710.000, 85.000, 170.000, 1),
(28, 28, 'ICN018', 230, 740.000, 90.000, 180.000, 1),
(29, 29, 'ICN019', 240, 770.000, 95.000, 190.000, 1),
(30, 30, 'ICN020', 250, 800.000, 100.000, 200.000, 1);

--
-- Déchargement des données de la table `winners`
--

INSERT INTO `winners` (`IdWinner`, `IdPrize`, `IdUser`, `DateWin`) VALUES
(1, 1, 2, '2026-07-02'),
(2, 2, 3, '2026-07-03'),
(3, 3, 4, '2026-07-04'),
(4, 4, 5, '2026-07-05'),
(5, 5, 6, '2026-07-06'),
(6, 6, 7, '2026-07-07'),
(7, 7, 8, '2026-07-08'),
(8, 8, 9, '2026-07-09'),
(9, 9, 10, '2026-07-10'),
(10, 10, 11, '2026-07-11'),
(11, 11, 12, '2026-07-12'),
(12, 12, 13, '2026-07-13'),
(13, 13, 14, '2026-07-14'),
(14, 14, 15, '2026-07-15'),
(15, 15, 16, '2026-07-16'),
(16, 16, 17, '2026-07-17'),
(17, 17, 18, '2026-07-18'),
(18, 18, 19, '2026-07-19'),
(19, 19, 20, '2026-07-20'),
(20, 20, 1, '2026-07-21');

--
-- Déchargement des données de la table `wishlistads`
--

INSERT INTO `wishlistads` (`IdWish`, `IdUser`, `IdAd`, `CreatedAt`) VALUES
(11, 11, 12, '2026-07-02 09:00:00'),
(12, 12, 13, '2026-07-03 09:00:00'),
(13, 13, 14, '2026-07-04 09:00:00'),
(14, 14, 15, '2026-07-05 09:00:00'),
(15, 15, 16, '2026-07-06 09:00:00'),
(16, 16, 17, '2026-07-07 09:00:00'),
(17, 17, 18, '2026-07-08 09:00:00'),
(18, 18, 19, '2026-07-09 09:00:00'),
(19, 19, 20, '2026-07-10 09:00:00'),
(20, 20, 21, '2026-07-11 09:00:00'),
(21, 21, 22, '2026-07-12 09:00:00'),
(22, 22, 23, '2026-07-13 09:00:00'),
(23, 23, 24, '2026-07-14 09:00:00'),
(24, 24, 25, '2026-07-15 09:00:00'),
(25, 25, 26, '2026-07-16 09:00:00'),
(26, 26, 27, '2026-07-17 09:00:00'),
(27, 27, 28, '2026-07-18 09:00:00'),
(28, 28, 29, '2026-07-19 09:00:00'),
(29, 29, 30, '2026-07-20 09:00:00'),
(30, 30, 11, '2026-07-21 09:00:00');

--
-- Déchargement des données de la table `wishlistdeals`
--

INSERT INTO `wishlistdeals` (`IdWish`, `IdUser`, `IdDeal`, `CreatedAt`) VALUES
(11, 11, 12, '2026-07-02 09:00:00'),
(12, 12, 13, '2026-07-03 09:00:00'),
(13, 13, 14, '2026-07-04 09:00:00'),
(14, 14, 15, '2026-07-05 09:00:00'),
(15, 15, 16, '2026-07-06 09:00:00'),
(16, 16, 17, '2026-07-07 09:00:00'),
(17, 17, 18, '2026-07-08 09:00:00'),
(18, 18, 19, '2026-07-09 09:00:00'),
(19, 19, 20, '2026-07-10 09:00:00'),
(20, 20, 21, '2026-07-11 09:00:00'),
(21, 21, 22, '2026-07-12 09:00:00'),
(22, 22, 23, '2026-07-13 09:00:00'),
(23, 23, 24, '2026-07-14 09:00:00'),
(24, 24, 25, '2026-07-15 09:00:00'),
(25, 25, 26, '2026-07-16 09:00:00'),
(26, 26, 27, '2026-07-17 09:00:00'),
(27, 27, 28, '2026-07-18 09:00:00'),
(28, 28, 29, '2026-07-19 09:00:00'),
(29, 29, 30, '2026-07-20 09:00:00'),
(30, 30, 11, '2026-07-21 09:00:00');

INSERT INTO Vendors
(
    CompanyName,
    TradeName,
    TaxNumber,
    VATNumber,
    Address,
    City,
    Country,
    PostalCode,
    Telephone,
    Mobile,
    Email,
    Website,
    Logo,
    BankName,
    BankAccount,
    IBAN,
    SWIFT,
    Active,
    CreatedAt,
    UpdatedAt
)
VALUES
(
    'TIJARA Technologies',
    'TIJARA',
    '1485926PAM000',
    'TN1485926',
    'Avenue Habib Bourguiba',
    'Sousse',
    'Tunisia',
    '4000',
    '73200000',
    '98403689',
    'contact@tijara.tn',
    'https://tijara.tn',
    'vendors/default-logo.png',
    'BIAT',
    '123456789012345',
    'TN5901000601234567890123',
    'BIATTNTT',
    1,
    NOW(),
    NOW()
);

UPDATE Coupons
SET
    Used = CASE
        WHEN Title = 'BLACKFRIDAY30' THEN 1
        ELSE 0
    END,

    Active = CASE
        WHEN Title = 'WELCOME15' THEN 0
        ELSE 1
    END,

    DateStart = CASE
        WHEN Title = 'SUMMER10' THEN '2026-06-01 00:00:00'          -- Expired
        WHEN Title = 'VIP25' THEN '2026-08-01 00:00:00'             -- Not active yet
        ELSE '2026-07-01 00:00:00'                                  -- Active
    END,

    DateEnd = CASE
        WHEN Title = 'SUMMER10' THEN '2026-07-15 23:59:59'          -- Expired
        WHEN Title = 'VIP25' THEN '2026-09-01 23:59:59'
        ELSE '2026-08-31 23:59:59'
    END;

    SET FOREIGN_KEY_CHECKS = 0;

-- ===================================
-- ACTIVATE DATA
-- ===================================

UPDATE Products SET Active = 1;

UPDATE Deals SET active = 1;

UPDATE Prizes SET active = 1;

UPDATE Ads SET Active = 1;

-- ===================================
-- CONNECT DEALS -> PRODUCTS
-- ===================================

UPDATE Deals d
JOIN Products p
ON d.titleDeal LIKE CONCAT('%', p.TitleProduct, '%')
SET d.IdProduct = p.IdProduct;

-- ===================================
-- CONNECT PRIZES -> DEALS
-- ===================================

UPDATE Prizes p
JOIN Deals d
ON d.idPrize = p.idPrize
SET p.IdDeal = d.IdDeal;

-- ===================================
-- CONNECT PRODUCTS -> PRIZES
-- ===================================

UPDATE Products p
JOIN Deals d
ON p.IdProduct = d.IdProduct
SET p.IdPrize = d.idPrize;

-- ===================================
-- SYNCHRONIZE USERS
-- ===================================

UPDATE Deals d
JOIN Products p
ON d.IdProduct = p.IdProduct
SET d.idUser = p.IdUser;

-- ===================================
-- SYNCHRONIZE CATEGORIES
-- ===================================

UPDATE Deals d
JOIN Products p
ON d.IdProduct = p.IdProduct
SET d.idCateg = p.IdCateg;

-- ===================================
-- SYNCHRONIZE PRIZE OWNER
-- ===================================

UPDATE Prizes p
JOIN Deals d
ON p.IdDeal = d.IdDeal
SET p.idUser = d.idUser;

SET FOREIGN_KEY_CHECKS = 1;


ALTER TABLE `roles` ADD UNIQUE KEY `uq_role_name` (`RoleUser`);

UPDATE `users` SET `IdRole` = 1  WHERE `IdRole` = 11; -- User
UPDATE `users` SET `IdRole` = 2  WHERE `IdRole` = 12; -- Entreprise
UPDATE `users` SET `IdRole` = 3  WHERE `IdRole` = 13; -- Admin
UPDATE `users` SET `IdRole` = 4  WHERE `IdRole` = 14; -- Moderator
UPDATE `users` SET `IdRole` = 5  WHERE `IdRole` = 15; -- Vendor
UPDATE `users` SET `IdRole` = 6  WHERE `IdRole` = 16; -- Customer
UPDATE `users` SET `IdRole` = 7  WHERE `IdRole` = 29; -- Partner
UPDATE `users` SET `IdRole` = 8  WHERE `IdRole` = 18; -- Manager
UPDATE `users` SET `IdRole` = 9  WHERE `IdRole` = 17; -- Support
UPDATE `users` SET `IdRole` = 10 WHERE `IdRole` = 30; -- Guest

DELETE FROM `roles` WHERE `IdRole` IN (11, 12, 13, 14, 15, 16, 17, 18, 29, 30);

COMMIT;
SET FOREIGN_KEY_CHECKS = 1;
