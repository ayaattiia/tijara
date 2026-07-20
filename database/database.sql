-- ============================================================
-- database.sql
-- TijaraDB26 - Structure only (tables, indexes, auto_increment, foreign keys)
-- Extracted verbatim from the current XAMPP / phpMyAdmin export
-- (1784541173833_tijaradb.sql) so it matches the live `tijaradb`
-- database exactly.
-- Compatible MySQL 5.7+/8.0 and MariaDB (XAMPP / phpMyAdmin)
-- ============================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET NAMES utf8mb4;
SET time_zone = "+00:00";
SET FOREIGN_KEY_CHECKS = 0;

CREATE DATABASE IF NOT EXISTS `tijaradb` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tijaradb`;

-- ============================================================
-- TABLES
-- ============================================================

--
-- Base de données : `tijaradb`
--

-- --------------------------------------------------------

--
-- Structure de la table `adcomments`
--

CREATE TABLE `adcomments` (
  `IdComment` bigint(20) NOT NULL,
  `IdAd` bigint(20) NOT NULL,
  `IdUser` bigint(20) NOT NULL,
  `Content` varchar(1000) NOT NULL,
  `CreatedAt` datetime DEFAULT current_timestamp(),
  `Active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `adlikes`
--

CREATE TABLE `adlikes` (
  `IdLike` bigint(20) NOT NULL,
  `IdAd` bigint(20) NOT NULL,
  `IdUser` bigint(20) NOT NULL,
  `CreatedAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `adminsettings`
--

CREATE TABLE `adminsettings` (
  `Key` varchar(100) NOT NULL,
  `Value` longtext DEFAULT NULL,
  `UpdatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ads`
--

CREATE TABLE `ads` (
  `IdAd` bigint(20) NOT NULL,
  `TitleAd` varchar(250) DEFAULT NULL,
  `DescriptionAd` text DEFAULT NULL,
  `DetailsAd` text DEFAULT NULL,
  `PriceAd` varchar(250) DEFAULT NULL,
  `DatePublication` varchar(50) DEFAULT NULL,
  `ImageAd` text DEFAULT NULL,
  `VideoAd` text DEFAULT NULL,
  `IdCateg` int(11) DEFAULT NULL,
  `IdUser` bigint(20) DEFAULT NULL,
  `IdState` bigint(20) DEFAULT NULL,
  `IdCountry` bigint(20) DEFAULT NULL,
  `LocationAd` varchar(250) DEFAULT NULL,
  `DateEnd` varchar(50) DEFAULT NULL,
  `Brand` varchar(50) DEFAULT NULL,
  `Ownerads` varchar(250) DEFAULT NULL,
  `Telephone` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `StartDate` varchar(50) DEFAULT NULL,
  `Active` int(11) DEFAULT NULL,
  `Type` varchar(20) DEFAULT 'annonce'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `adsfeaturevalues`
--

CREATE TABLE `adsfeaturevalues` (
  `IdAdFeatureValue` bigint(20) NOT NULL,
  `IdAd` bigint(20) NOT NULL,
  `IdFV` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `adswishlist`
--

CREATE TABLE `adswishlist` (
  `IdWishlistAd` bigint(20) NOT NULL,
  `IdUser` bigint(20) DEFAULT NULL,
  `IdAd` bigint(20) DEFAULT NULL,
  `Liked` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `boostadspacks`
--

CREATE TABLE `boostadspacks` (
  `IdBoost` bigint(20) NOT NULL,
  `Title` varchar(200) NOT NULL,
  `Price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `Discount` decimal(5,2) NOT NULL DEFAULT 0.00,
  `MaxDuration` int(11) NOT NULL DEFAULT 7,
  `Sliders` tinyint(1) NOT NULL DEFAULT 0,
  `SideBar` tinyint(1) NOT NULL DEFAULT 0,
  `Footer` tinyint(1) NOT NULL DEFAULT 0,
  `RelatedPost` tinyint(1) NOT NULL DEFAULT 0,
  `FirstLogin` tinyint(1) NOT NULL DEFAULT 0,
  `OrdersCount` int(11) NOT NULL DEFAULT 0,
  `Links` tinyint(1) NOT NULL DEFAULT 0,
  `Active` tinyint(1) NOT NULL DEFAULT 1,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `boosts`
--

CREATE TABLE `boosts` (
  `IdBoost` int(11) NOT NULL,
  `TitleBoost` longtext NOT NULL,
  `Price` float NOT NULL,
  `Discount` longtext DEFAULT NULL,
  `MaxDurationPerDay` int(11) DEFAULT NULL,
  `InSliders` int(11) DEFAULT NULL,
  `InSideBar` int(11) DEFAULT NULL,
  `InFooter` int(11) DEFAULT NULL,
  `InRelatedPost` int(11) DEFAULT NULL,
  `InFirstLogin` int(11) DEFAULT NULL,
  `HasLinks` int(11) DEFAULT NULL,
  `Orders` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `brands`
--

CREATE TABLE `brands` (
  `IdBrand` bigint(20) NOT NULL,
  `Title` longtext NOT NULL,
  `Description` longtext NOT NULL,
  `Image` longtext DEFAULT NULL,
  `Active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `IdCateg` int(11) NOT NULL,
  `idparent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `TitleEn` varchar(250) DEFAULT NULL,
  `TitleFr` varchar(250) DEFAULT NULL,
  `TitleAr` varchar(250) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Image` text DEFAULT NULL,
  `idtypecat` int(11) DEFAULT NULL,
  `Active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `causes`
--

CREATE TABLE `causes` (
  `IdCause` bigint(20) NOT NULL,
  `Title` varchar(200) NOT NULL,
  `Description` varchar(1000) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Type` varchar(50) DEFAULT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT 1,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `causesreports`
--

CREATE TABLE `causesreports` (
  `IdCauseReport` int(11) NOT NULL,
  `TitleCauseEn` varchar(250) DEFAULT NULL,
  `TitleCauseAr` varchar(250) DEFAULT NULL,
  `TitleCauseFr` varchar(250) DEFAULT NULL,
  `GroupName` varchar(250) DEFAULT NULL,
  `Active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `chatmessages`
--

CREATE TABLE `chatmessages` (
  `IdChatMessage` bigint(20) NOT NULL,
  `IdChat` bigint(20) DEFAULT NULL,
  `Message` text DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `IdUserSender` bigint(20) DEFAULT NULL,
  `Report` text DEFAULT NULL,
  `AdminReview` text DEFAULT NULL,
  `Active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `chats`
--

CREATE TABLE `chats` (
  `IdChat` int(11) NOT NULL,
  `IdUserSender` bigint(20) DEFAULT NULL,
  `IdUserReciver` bigint(20) DEFAULT NULL,
  `CreatedAt` datetime DEFAULT NULL,
  `AdminReview` text DEFAULT NULL,
  `Active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cities`
--

CREATE TABLE `cities` (
  `IdCity` bigint(20) NOT NULL,
  `Title` varchar(200) NOT NULL,
  `IdCountry` bigint(20) DEFAULT NULL,
  `TitleEn` varchar(200) DEFAULT NULL,
  `TitleAr` varchar(200) DEFAULT NULL,
  `Image` varchar(500) DEFAULT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT 1,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `IdComment` bigint(20) NOT NULL,
  `IdUser` bigint(20) DEFAULT NULL,
  `Comment` text DEFAULT NULL,
  `IdReplyComment` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `IdCourse` bigint(20) DEFAULT NULL,
  `IdLesson` bigint(20) DEFAULT NULL,
  `IdMeet` bigint(20) DEFAULT NULL,
  `Active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `countries`
--

CREATE TABLE `countries` (
  `IdCountry` bigint(20) NOT NULL,
  `country_code` varchar(250) DEFAULT '',
  `country_enName` varchar(100) DEFAULT '',
  `country_arName` varchar(100) DEFAULT '',
  `country_enNationality` varchar(100) DEFAULT '',
  `country_arNationality` varchar(100) DEFAULT '',
  `Active` int(11) DEFAULT NULL,
  `Title` varchar(200) DEFAULT NULL,
  `Flag` varchar(500) DEFAULT NULL,
  `Code` varchar(10) DEFAULT NULL,
  `PhoneCode` varchar(10) DEFAULT NULL,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `countriesfull`
--

CREATE TABLE `countriesfull` (
  `IdCountry` int(11) NOT NULL,
  `NameEN` varchar(200) NOT NULL,
  `NameFR` varchar(200) NOT NULL,
  `NameAR` varchar(200) DEFAULT NULL,
  `NameDE` varchar(200) DEFAULT NULL,
  `NameES` varchar(200) DEFAULT NULL,
  `NameCH` varchar(200) DEFAULT NULL,
  `NameRU` varchar(200) DEFAULT NULL,
  `CodeCountry2` char(2) DEFAULT NULL,
  `CodeCountry3` char(3) DEFAULT NULL,
  `Flag` longtext DEFAULT NULL,
  `MAP` longtext DEFAULT NULL,
  `PhoneCode` char(10) DEFAULT NULL,
  `Continent` varchar(250) DEFAULT NULL,
  `Active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `coupons`
--

CREATE TABLE `coupons` (
  `IdCoupon` bigint(20) NOT NULL,
  `Title` varchar(200) NOT NULL,
  `Description` varchar(1000) DEFAULT NULL,
  `DateStart` datetime DEFAULT NULL,
  `DateEnd` datetime DEFAULT NULL,
  `Price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `NumberOfCoupon` int(11) NOT NULL DEFAULT 0,
  `Used` int(11) NOT NULL DEFAULT 0,
  `Active` tinyint(1) NOT NULL DEFAULT 1,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `deals`
--

CREATE TABLE `deals` (
  `IdDeal` int(11) NOT NULL,
  `titleDeal` varchar(250) DEFAULT NULL,
  `descriptionDeal` text DEFAULT NULL,
  `detailsDeal` text DEFAULT NULL,
  `priceDeal` varchar(250) DEFAULT NULL,
  `discountDeal` varchar(250) DEFAULT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `datePublication` varchar(250) DEFAULT NULL,
  `dateEnd` varchar(250) DEFAULT NULL,
  `imageDeal` text DEFAULT NULL,
  `idtypecat` int(11) DEFAULT NULL,
  `idCateg` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idState` bigint(20) DEFAULT NULL,
  `idPrize` bigint(20) DEFAULT NULL,
  `locationDeal` varchar(250) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `colors` varchar(250) DEFAULT NULL,
  `likes` int(11) DEFAULT NULL,
  `liked` int(11) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `ownerdeals` varchar(50) DEFAULT NULL,
  `brand` varchar(250) DEFAULT NULL,
  `startDate` varchar(250) DEFAULT NULL,
  `TotalCount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `dealswishlist`
--

CREATE TABLE `dealswishlist` (
  `IdWishlistDeal` bigint(20) NOT NULL,
  `IdUser` bigint(20) DEFAULT NULL,
  `IdDeal` bigint(20) DEFAULT NULL,
  `Liked` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `deliveries`
--

CREATE TABLE `deliveries` (
  `IdDelivery` bigint(20) NOT NULL,
  `IdOrder` bigint(20) NOT NULL,
  `IdTransport` int(11) DEFAULT NULL,
  `TrackingNumber` varchar(100) DEFAULT NULL,
  `Status` varchar(30) NOT NULL DEFAULT 'pending',
  `AddressLine` varchar(500) DEFAULT NULL,
  `City` varchar(150) DEFAULT NULL,
  `PostalCode` varchar(20) DEFAULT NULL,
  `Phone` varchar(40) DEFAULT NULL,
  `DeliveryFee` decimal(18,3) DEFAULT 0.000,
  `EstimatedAt` datetime DEFAULT NULL,
  `DeliveredAt` datetime DEFAULT NULL,
  `Note` varchar(500) DEFAULT NULL,
  `CreatedAt` datetime DEFAULT current_timestamp(),
  `UpdatedAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `emailtokens`
--

CREATE TABLE `emailtokens` (
  `IdToken` bigint(20) NOT NULL,
  `IdUser` bigint(20) NOT NULL,
  `Token` varchar(200) NOT NULL,
  `Type` varchar(30) NOT NULL DEFAULT 'email_confirm',
  `ExpiresAt` datetime NOT NULL,
  `Used` tinyint(1) DEFAULT 0,
  `CreatedAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `errors`
--

CREATE TABLE `errors` (
  `IdError` bigint(20) NOT NULL,
  `IdUser` bigint(20) DEFAULT NULL,
  `TitleError` longtext DEFAULT NULL,
  `Req` longtext DEFAULT NULL,
  `ReqError` longtext DEFAULT NULL,
  `ExceptionError` longtext DEFAULT NULL,
  `OtheError` longtext DEFAULT NULL,
  `Page` longtext DEFAULT NULL,
  `Action` longtext DEFAULT NULL,
  `dateTimeError` datetime DEFAULT NULL,
  `Validate` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `featurecategories`
--

CREATE TABLE `featurecategories` (
  `IdFC` bigint(20) NOT NULL,
  `IdCategory` int(11) DEFAULT NULL,
  `IdFeature` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `features`
--

CREATE TABLE `features` (
  `IdFeature` bigint(20) NOT NULL,
  `TitleFeature` longtext DEFAULT NULL,
  `DescriptionFeature` longtext DEFAULT NULL,
  `UnitFeature` longtext DEFAULT NULL,
  `ImgFeature` longblob DEFAULT NULL,
  `Active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `featuresvalues`
--

CREATE TABLE `featuresvalues` (
  `IdFV` bigint(20) NOT NULL,
  `ValueFeature` longtext DEFAULT NULL,
  `IdFeature` bigint(20) DEFAULT NULL,
  `Active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `invoices`
--

CREATE TABLE `invoices` (
  `IdInvoice` bigint(20) NOT NULL,
  `Number` varchar(50) NOT NULL,
  `IdOrder` bigint(20) NOT NULL,
  `IdUser` bigint(20) NOT NULL,
  `IdVendor` bigint(20) DEFAULT NULL,
  `Subtotal` decimal(18,3) NOT NULL,
  `Tax` decimal(18,3) DEFAULT 0.000,
  `DeliveryFee` decimal(18,3) DEFAULT 0.000,
  `Total` decimal(18,3) NOT NULL,
  `Status` varchar(30) DEFAULT 'issued',
  `IssuedAt` datetime DEFAULT current_timestamp(),
  `PaidAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `labels`
--

CREATE TABLE `labels` (
  `IdLabel` int(11) NOT NULL,
  `TitleEn` varchar(250) DEFAULT NULL,
  `TitleFr` varchar(250) DEFAULT NULL,
  `TitleAr` varchar(250) DEFAULT NULL,
  `Color` varchar(250) DEFAULT NULL,
  `Active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `IdLike` bigint(20) NOT NULL,
  `IdUser` bigint(20) NOT NULL,
  `TargetType` varchar(20) NOT NULL,
  `TargetId` bigint(20) NOT NULL,
  `CreatedAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `listpermissions`
--

CREATE TABLE `listpermissions` (
  `IdListPermission` int(11) NOT NULL,
  `TitleEn` varchar(250) DEFAULT NULL,
  `TitleFr` varchar(250) DEFAULT NULL,
  `TitleAr` varchar(250) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `GroupName` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `IdMessage` bigint(20) NOT NULL,
  `IdUserSender` bigint(20) DEFAULT NULL,
  `IdUserReceiver` bigint(20) DEFAULT NULL,
  `DateMessage` date DEFAULT NULL,
  `IdMessageReplay` bigint(20) DEFAULT NULL,
  `Message` text DEFAULT NULL,
  `Active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `IdNotification` int(11) NOT NULL,
  `Title` varchar(250) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Type` varchar(250) DEFAULT NULL,
  `IsRead` int(11) DEFAULT NULL,
  `IdUser` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` char(80) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` char(80) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` char(36) NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` char(36) NOT NULL,
  `owner_type` varchar(255) DEFAULT NULL,
  `owner_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(255) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect_uris` text NOT NULL,
  `grant_types` text NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `oauth_device_codes`
--

CREATE TABLE `oauth_device_codes` (
  `id` char(80) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` char(36) NOT NULL,
  `user_code` char(8) NOT NULL,
  `scopes` text NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `user_approved_at` datetime DEFAULT NULL,
  `last_polled_at` datetime DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` char(80) NOT NULL,
  `access_token_id` char(80) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `IdOrderDeatils` bigint(20) NOT NULL,
  `IdUser` bigint(20) DEFAULT NULL,
  `IdProduct` bigint(20) DEFAULT NULL,
  `IdState` bigint(20) DEFAULT NULL,
  `IdCountry` bigint(20) DEFAULT NULL,
  `IdOrder` bigint(20) DEFAULT NULL,
  `ZipCode` int(11) DEFAULT NULL,
  `Address` varchar(250) DEFAULT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `Telephone` varchar(250) DEFAULT NULL,
  `FirstName` varchar(250) DEFAULT NULL,
  `LastName` varchar(250) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `TotalAmount` varchar(50) DEFAULT NULL,
  `DateTimeCommand` varchar(50) DEFAULT NULL,
  `Active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `IdOrder` bigint(20) NOT NULL,
  `IdUser` bigint(20) DEFAULT NULL,
  `IdDeal` bigint(20) DEFAULT NULL,
  `IdState` bigint(20) DEFAULT NULL,
  `DateTimeCommand` datetime DEFAULT NULL,
  `Active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `payments`
--

CREATE TABLE `payments` (
  `IdPayment` bigint(20) NOT NULL,
  `IdUser` bigint(20) NOT NULL,
  `IdOrder` bigint(20) DEFAULT NULL,
  `Amount` decimal(18,3) NOT NULL,
  `Method` varchar(40) NOT NULL,
  `Status` varchar(30) NOT NULL DEFAULT 'pending',
  `Reference` varchar(100) DEFAULT NULL,
  `TransactionId` varchar(150) DEFAULT NULL,
  `CreatedAt` datetime DEFAULT current_timestamp(),
  `PaidAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `IdPermission` bigint(20) NOT NULL,
  `IdRole` int(11) DEFAULT NULL,
  `IdListPermission` int(11) DEFAULT NULL,
  `PermissionDate` date DEFAULT NULL,
  `Resource` varchar(100) DEFAULT NULL,
  `CanRead` tinyint(1) DEFAULT 0,
  `CanCreate` tinyint(1) DEFAULT 0,
  `CanUpdate` tinyint(1) DEFAULT 0,
  `CanDelete` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pointpackets`
--

CREATE TABLE `pointpackets` (
  `IdPacket` bigint(20) NOT NULL,
  `Title` varchar(200) NOT NULL,
  `Description` varchar(1000) DEFAULT NULL,
  `PointsCount` int(11) NOT NULL DEFAULT 0,
  `Price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `Discount` decimal(5,2) NOT NULL DEFAULT 0.00,
  `Active` tinyint(1) NOT NULL DEFAULT 1,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `prizes`
--

CREATE TABLE `prizes` (
  `idPrize` int(11) NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `idUser` bigint(20) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `datePublication` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `IdProduct` bigint(20) NOT NULL,
  `CodeBarProduct` varchar(250) DEFAULT NULL,
  `CodeProduct` varchar(250) DEFAULT NULL,
  `ReferenceProduct` varchar(250) DEFAULT NULL,
  `TitleProduct` varchar(250) DEFAULT NULL,
  `DescriptionProduct` varchar(250) DEFAULT NULL,
  `QuantityProduct` int(11) DEFAULT NULL,
  `PriceProduct` text DEFAULT NULL,
  `TvaProduct` varchar(250) DEFAULT NULL,
  `IdPricesDelevery` bigint(20) DEFAULT NULL,
  `ImageProduct` text DEFAULT NULL,
  `VideoProduct` text DEFAULT NULL,
  `IdPrize` bigint(20) DEFAULT NULL,
  `IdCateg` int(11) NOT NULL,
  `IdUser` bigint(20) DEFAULT NULL,
  `IdCountrie` bigint(20) DEFAULT NULL,
  `Active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `productsfeaturevalues`
--

CREATE TABLE `productsfeaturevalues` (
  `IdProductFeatureValue` int(11) NOT NULL,
  `IdProduct` int(11) NOT NULL,
  `IdFV` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `productwishlist`
--

CREATE TABLE `productwishlist` (
  `IdWishlistProduct` bigint(20) NOT NULL,
  `IdUser` bigint(20) DEFAULT NULL,
  `IdProduct` bigint(20) DEFAULT NULL,
  `Liked` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ratings`
--

CREATE TABLE `ratings` (
  `IdRating` bigint(20) NOT NULL,
  `IdUser` bigint(20) DEFAULT NULL,
  `Rating` bigint(20) DEFAULT NULL,
  `CommentRating` longtext DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `TableName` varchar(250) DEFAULT NULL,
  `IdTable` bigint(20) DEFAULT NULL,
  `Active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reports`
--

CREATE TABLE `reports` (
  `IdReport` int(11) NOT NULL,
  `IdUser` bigint(20) DEFAULT NULL,
  `IdCauseReport` int(11) DEFAULT NULL,
  `Subject` varchar(250) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `State` int(11) DEFAULT NULL,
  `TypeTable` varchar(250) DEFAULT NULL,
  `IdTable` bigint(20) DEFAULT NULL,
  `IdProduct` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

CREATE TABLE `reviews` (
  `IdReview` bigint(20) NOT NULL,
  `IdUser` bigint(20) NOT NULL,
  `TargetType` varchar(20) NOT NULL,
  `TargetId` bigint(20) NOT NULL,
  `Rating` tinyint(4) NOT NULL DEFAULT 5,
  `Comment` varchar(1000) DEFAULT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT 1,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `IdRole` int(11) NOT NULL,
  `RoleUser` varchar(20) DEFAULT NULL,
  `Active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `smslogs`
--

CREATE TABLE `smslogs` (
  `IdSms` bigint(20) NOT NULL,
  `Recipient` varchar(40) NOT NULL,
  `Message` varchar(500) NOT NULL,
  `Status` varchar(30) DEFAULT 'queued',
  `Provider` varchar(50) DEFAULT NULL,
  `SentAt` datetime DEFAULT current_timestamp(),
  `Error` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `states`
--

CREATE TABLE `states` (
  `IdState` bigint(20) NOT NULL,
  `NameEN` varchar(250) DEFAULT NULL,
  `NameFR` varchar(250) DEFAULT NULL,
  `NameAR` varchar(250) DEFAULT NULL,
  `NameDE` varchar(50) DEFAULT NULL,
  `NameES` varchar(250) DEFAULT NULL,
  `NameCH` char(250) DEFAULT NULL,
  `NameRU` char(250) DEFAULT NULL,
  `CodeState` varchar(50) DEFAULT NULL,
  `CityPostalCode` varchar(50) DEFAULT NULL,
  `Flag` varchar(50) DEFAULT NULL,
  `MAP` varchar(250) DEFAULT NULL,
  `PhoneCode` varchar(50) DEFAULT NULL,
  `CountriesName` varchar(250) DEFAULT NULL,
  `IdCountry` bigint(20) DEFAULT NULL,
  `Active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `IdUser` bigint(20) DEFAULT NULL,
  `Tag` text DEFAULT NULL,
  `IdLangue` bigint(20) DEFAULT NULL,
  `Active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `transports`
--

CREATE TABLE `transports` (
  `IdTransport` int(11) NOT NULL,
  `Name` varchar(150) NOT NULL,
  `Logo` varchar(500) DEFAULT NULL,
  `Phone` varchar(40) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `DeliveryFee` decimal(18,3) DEFAULT 0.000,
  `FreeFrom` decimal(18,3) DEFAULT NULL,
  `Zones` varchar(500) DEFAULT NULL,
  `Active` tinyint(1) DEFAULT 1,
  `CreatedAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `typecategory`
--

CREATE TABLE `typecategory` (
  `Idtypecat` int(11) NOT NULL,
  `Title` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `userfollows`
--

CREATE TABLE `userfollows` (
  `IdFollow` bigint(20) NOT NULL,
  `IdUser` bigint(20) NOT NULL,
  `IdVendor` bigint(20) NOT NULL,
  `CreatedAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `IdUser` bigint(20) NOT NULL,
  `Username` varchar(250) DEFAULT NULL,
  `FirstName` varchar(250) DEFAULT NULL,
  `LastName` varchar(250) DEFAULT NULL,
  `BirthDate` varchar(50) DEFAULT NULL,
  `Gender` varchar(250) DEFAULT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `ICN` varchar(250) DEFAULT NULL,
  `Telephone` varchar(50) DEFAULT NULL,
  `Password` text DEFAULT NULL,
  `IdRole` int(11) DEFAULT NULL,
  `FacebookId` text DEFAULT NULL,
  `GoogleId` text DEFAULT NULL,
  `RefreshToken` text DEFAULT NULL,
  `ProfilePicture` text DEFAULT NULL,
  `CreationDate` varchar(50) DEFAULT NULL,
  `IsVerified` int(11) DEFAULT NULL,
  `IsPremuim` int(11) DEFAULT NULL,
  `PremiumExpiry` date DEFAULT NULL,
  `IdentityPicture` text DEFAULT NULL,
  `IsBusinessAccount` int(11) DEFAULT NULL,
  `ICNBusiness` varchar(250) DEFAULT NULL,
  `BusinessVerificationPicture` text DEFAULT NULL,
  `IdState` bigint(20) DEFAULT NULL,
  `IdCountry` bigint(20) DEFAULT NULL,
  `Location` text DEFAULT NULL,
  `LastConnection` date DEFAULT NULL,
  `Active` int(11) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `EmailConfirmed` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `wallets`
--

CREATE TABLE `wallets` (
  `IdWallet` int(11) NOT NULL,
  `IdUser` bigint(20) DEFAULT NULL,
  `ICN` varchar(250) DEFAULT NULL,
  `NbrJeton` bigint(20) DEFAULT NULL,
  `MoneyBudget` decimal(18,3) DEFAULT NULL,
  `MoneyBlocked` decimal(18,3) DEFAULT NULL,
  `MoneyTransfered` decimal(18,3) DEFAULT NULL,
  `Active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `winners`
--

CREATE TABLE `winners` (
  `IdWinner` bigint(20) NOT NULL,
  `IdPrize` bigint(20) DEFAULT NULL,
  `IdUser` bigint(20) DEFAULT NULL,
  `DateWin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `wishlistads`
--

CREATE TABLE `wishlistads` (
  `IdWish` bigint(20) NOT NULL,
  `IdUser` bigint(20) NOT NULL,
  `IdAd` bigint(20) NOT NULL,
  `CreatedAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `wishlistdeals`
--

CREATE TABLE `wishlistdeals` (
  `IdWish` bigint(20) NOT NULL,
  `IdUser` bigint(20) NOT NULL,
  `IdDeal` bigint(20) NOT NULL,
  `CreatedAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- ============================================================
-- INDEXES / PRIMARY KEYS
-- ============================================================

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adcomments`
--
ALTER TABLE `adcomments`
  ADD PRIMARY KEY (`IdComment`);

--
-- Index pour la table `adlikes`
--
ALTER TABLE `adlikes`
  ADD PRIMARY KEY (`IdLike`),
  ADD UNIQUE KEY `UQ_AdLikes` (`IdAd`,`IdUser`);

--
-- Index pour la table `adminsettings`
--
ALTER TABLE `adminsettings`
  ADD PRIMARY KEY (`Key`);

--
-- Index pour la table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`IdAd`),
  ADD KEY `FK_Ads_Categories` (`IdCateg`),
  ADD KEY `FK_Ads_Users` (`IdUser`);

--
-- Index pour la table `adsfeaturevalues`
--
ALTER TABLE `adsfeaturevalues`
  ADD PRIMARY KEY (`IdAdFeatureValue`),
  ADD UNIQUE KEY `uniq_ad_fv` (`IdAd`,`IdFV`),
  ADD KEY `IdAd` (`IdAd`),
  ADD KEY `IdFV` (`IdFV`);

--
-- Index pour la table `adswishlist`
--
ALTER TABLE `adswishlist`
  ADD PRIMARY KEY (`IdWishlistAd`);

--
-- Index pour la table `boostadspacks`
--
ALTER TABLE `boostadspacks`
  ADD PRIMARY KEY (`IdBoost`);

--
-- Index pour la table `boosts`
--
ALTER TABLE `boosts`
  ADD PRIMARY KEY (`IdBoost`);

--
-- Index pour la table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`IdBrand`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`IdCateg`),
  ADD KEY `FK_Categories_typecategory` (`idtypecat`);

--
-- Index pour la table `causes`
--
ALTER TABLE `causes`
  ADD PRIMARY KEY (`IdCause`);

--
-- Index pour la table `causesreports`
--
ALTER TABLE `causesreports`
  ADD PRIMARY KEY (`IdCauseReport`);

--
-- Index pour la table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`IdChat`);

--
-- Index pour la table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`IdCity`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`IdComment`);

--
-- Index pour la table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`IdCountry`);

--
-- Index pour la table `countriesfull`
--
ALTER TABLE `countriesfull`
  ADD PRIMARY KEY (`IdCountry`);

--
-- Index pour la table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`IdCoupon`);

--
-- Index pour la table `deals`
--
ALTER TABLE `deals`
  ADD PRIMARY KEY (`IdDeal`);

--
-- Index pour la table `dealswishlist`
--
ALTER TABLE `dealswishlist`
  ADD PRIMARY KEY (`IdWishlistDeal`);

--
-- Index pour la table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`IdDelivery`);

--
-- Index pour la table `emailtokens`
--
ALTER TABLE `emailtokens`
  ADD PRIMARY KEY (`IdToken`),
  ADD UNIQUE KEY `UQ_EmailTokens_Token` (`Token`);

--
-- Index pour la table `errors`
--
ALTER TABLE `errors`
  ADD PRIMARY KEY (`IdError`);

--
-- Index pour la table `featurecategories`
--
ALTER TABLE `featurecategories`
  ADD PRIMARY KEY (`IdFC`),
  ADD KEY `FK_FeatureCategories_Categories_IdCategory` (`IdCategory`),
  ADD KEY `FK_FeatureCategories_Features_IdFeature` (`IdFeature`);

--
-- Index pour la table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`IdFeature`);

--
-- Index pour la table `featuresvalues`
--
ALTER TABLE `featuresvalues`
  ADD PRIMARY KEY (`IdFV`);

--
-- Index pour la table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`IdInvoice`),
  ADD UNIQUE KEY `UQ_Invoices_Number` (`Number`);

--
-- Index pour la table `labels`
--
ALTER TABLE `labels`
  ADD PRIMARY KEY (`IdLabel`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`IdLike`),
  ADD UNIQUE KEY `UQ_Likes` (`IdUser`,`TargetType`,`TargetId`);

--
-- Index pour la table `listpermissions`
--
ALTER TABLE `listpermissions`
  ADD PRIMARY KEY (`IdListPermission`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`IdMessage`),
  ADD KEY `FK_Messages_Users` (`IdUserReceiver`),
  ADD KEY `FK_Messages_Users1` (`IdUserSender`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`IdNotification`);

--
-- Index pour la table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Index pour la table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Index pour la table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_owner_type_owner_id_index` (`owner_type`,`owner_id`);

--
-- Index pour la table `oauth_device_codes`
--
ALTER TABLE `oauth_device_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `oauth_device_codes_user_code_unique` (`user_code`),
  ADD KEY `oauth_device_codes_user_id_index` (`user_id`),
  ADD KEY `oauth_device_codes_client_id_index` (`client_id`);

--
-- Index pour la table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Index pour la table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`IdOrderDeatils`),
  ADD KEY `FK_OrderDetails_Countries` (`IdCountry`),
  ADD KEY `FK_OrderDetails_Orders` (`IdOrder`),
  ADD KEY `FK_OrderDetails_States` (`IdState`),
  ADD KEY `FK_OrderDetails_Users` (`IdUser`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`IdOrder`);

--
-- Index pour la table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`IdPayment`);

--
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`IdPermission`);

--
-- Index pour la table `pointpackets`
--
ALTER TABLE `pointpackets`
  ADD PRIMARY KEY (`IdPacket`);

--
-- Index pour la table `prizes`
--
ALTER TABLE `prizes`
  ADD PRIMARY KEY (`idPrize`),
  ADD KEY `FK_Prizes_Users` (`idUser`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`IdProduct`),
  ADD KEY `FK_Products_Categories` (`IdCateg`);

--
-- Index pour la table `productsfeaturevalues`
--
ALTER TABLE `productsfeaturevalues`
  ADD PRIMARY KEY (`IdProductFeatureValue`),
  ADD UNIQUE KEY `uniq_product_fv` (`IdProduct`,`IdFV`),
  ADD KEY `idx_pfv_product` (`IdProduct`),
  ADD KEY `idx_pfv_fv` (`IdFV`);

--
-- Index pour la table `productwishlist`
--
ALTER TABLE `productwishlist`
  ADD PRIMARY KEY (`IdWishlistProduct`);

--
-- Index pour la table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`IdRating`);

--
-- Index pour la table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`IdReport`),
  ADD KEY `FK_Reports_CausesReports` (`IdCauseReport`),
  ADD KEY `FK_Reports_Users` (`IdUser`);

--
-- Index pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`IdReview`),
  ADD UNIQUE KEY `UQ_Reviews` (`IdUser`,`TargetType`,`TargetId`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`IdRole`);

--
-- Index pour la table `smslogs`
--
ALTER TABLE `smslogs`
  ADD PRIMARY KEY (`IdSms`);

--
-- Index pour la table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`IdState`),
  ADD KEY `FK_States_Countries` (`IdCountry`);

--
-- Index pour la table `transports`
--
ALTER TABLE `transports`
  ADD PRIMARY KEY (`IdTransport`);

--
-- Index pour la table `typecategory`
--
ALTER TABLE `typecategory`
  ADD PRIMARY KEY (`Idtypecat`);

--
-- Index pour la table `userfollows`
--
ALTER TABLE `userfollows`
  ADD PRIMARY KEY (`IdFollow`),
  ADD UNIQUE KEY `UQ_UserFollows` (`IdUser`,`IdVendor`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`IdUser`),
  ADD KEY `FK_Users_Countries` (`IdCountry`),
  ADD KEY `FK_Users_Role` (`IdRole`),
  ADD KEY `FK_Users_States` (`IdState`);

--
-- Index pour la table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`IdWallet`),
  ADD KEY `FK_Wallets_Users` (`IdUser`);

--
-- Index pour la table `winners`
--
ALTER TABLE `winners`
  ADD PRIMARY KEY (`IdWinner`);

--
-- Index pour la table `wishlistads`
--
ALTER TABLE `wishlistads`
  ADD PRIMARY KEY (`IdWish`),
  ADD UNIQUE KEY `UQ_WishlistAds` (`IdUser`,`IdAd`);

--
-- Index pour la table `wishlistdeals`
--
ALTER TABLE `wishlistdeals`
  ADD PRIMARY KEY (`IdWish`),
  ADD UNIQUE KEY `UQ_WishlistDeals` (`IdUser`,`IdDeal`);


-- ============================================================
-- AUTO_INCREMENT
-- ============================================================

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adcomments`
--
ALTER TABLE `adcomments`
  MODIFY `IdComment` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `adlikes`
--
ALTER TABLE `adlikes`
  MODIFY `IdLike` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `ads`
--
ALTER TABLE `ads`
  MODIFY `IdAd` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `adsfeaturevalues`
--
ALTER TABLE `adsfeaturevalues`
  MODIFY `IdAdFeatureValue` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=283;

--
-- AUTO_INCREMENT pour la table `adswishlist`
--
ALTER TABLE `adswishlist`
  MODIFY `IdWishlistAd` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `boostadspacks`
--
ALTER TABLE `boostadspacks`
  MODIFY `IdBoost` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `boosts`
--
ALTER TABLE `boosts`
  MODIFY `IdBoost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `brands`
--
ALTER TABLE `brands`
  MODIFY `IdBrand` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `IdCateg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `causes`
--
ALTER TABLE `causes`
  MODIFY `IdCause` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `causesreports`
--
ALTER TABLE `causesreports`
  MODIFY `IdCauseReport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `chats`
--
ALTER TABLE `chats`
  MODIFY `IdChat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `cities`
--
ALTER TABLE `cities`
  MODIFY `IdCity` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `IdComment` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `countries`
--
ALTER TABLE `countries`
  MODIFY `IdCountry` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `countriesfull`
--
ALTER TABLE `countriesfull`
  MODIFY `IdCountry` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `IdCoupon` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `deals`
--
ALTER TABLE `deals`
  MODIFY `IdDeal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `dealswishlist`
--
ALTER TABLE `dealswishlist`
  MODIFY `IdWishlistDeal` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `IdDelivery` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `emailtokens`
--
ALTER TABLE `emailtokens`
  MODIFY `IdToken` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `errors`
--
ALTER TABLE `errors`
  MODIFY `IdError` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `featurecategories`
--
ALTER TABLE `featurecategories`
  MODIFY `IdFC` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT pour la table `features`
--
ALTER TABLE `features`
  MODIFY `IdFeature` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `featuresvalues`
--
ALTER TABLE `featuresvalues`
  MODIFY `IdFV` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT pour la table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `IdInvoice` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `labels`
--
ALTER TABLE `labels`
  MODIFY `IdLabel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `IdLike` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `listpermissions`
--
ALTER TABLE `listpermissions`
  MODIFY `IdListPermission` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `IdMessage` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `IdNotification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `IdOrderDeatils` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `IdOrder` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `payments`
--
ALTER TABLE `payments`
  MODIFY `IdPayment` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `IdPermission` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `pointpackets`
--
ALTER TABLE `pointpackets`
  MODIFY `IdPacket` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `prizes`
--
ALTER TABLE `prizes`
  MODIFY `idPrize` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `IdProduct` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `productsfeaturevalues`
--
ALTER TABLE `productsfeaturevalues`
  MODIFY `IdProductFeatureValue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;

--
-- AUTO_INCREMENT pour la table `productwishlist`
--
ALTER TABLE `productwishlist`
  MODIFY `IdWishlistProduct` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `IdRating` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `reports`
--
ALTER TABLE `reports`
  MODIFY `IdReport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `IdReview` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `smslogs`
--
ALTER TABLE `smslogs`
  MODIFY `IdSms` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `states`
--
ALTER TABLE `states`
  MODIFY `IdState` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `transports`
--
ALTER TABLE `transports`
  MODIFY `IdTransport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `typecategory`
--
ALTER TABLE `typecategory`
  MODIFY `Idtypecat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `userfollows`
--
ALTER TABLE `userfollows`
  MODIFY `IdFollow` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `IdUser` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `IdWallet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `winners`
--
ALTER TABLE `winners`
  MODIFY `IdWinner` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `wishlistads`
--
ALTER TABLE `wishlistads`
  MODIFY `IdWish` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `wishlistdeals`
--
ALTER TABLE `wishlistdeals`
  MODIFY `IdWish` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;


-- ============================================================
-- FOREIGN KEY CONSTRAINTS
-- ============================================================

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ads`
--
ALTER TABLE `ads`
  ADD CONSTRAINT `FK_Ads_Categories` FOREIGN KEY (`IdCateg`) REFERENCES `categories` (`IdCateg`),
  ADD CONSTRAINT `FK_Ads_Users` FOREIGN KEY (`IdUser`) REFERENCES `users` (`IdUser`);

--
-- Contraintes pour la table `adsfeaturevalues`
--
ALTER TABLE `adsfeaturevalues`
  ADD CONSTRAINT `fk_afv_ad` FOREIGN KEY (`IdAd`) REFERENCES `ads` (`IdAd`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_afv_fv` FOREIGN KEY (`IdFV`) REFERENCES `featuresvalues` (`IdFV`) ON DELETE CASCADE;

--
-- Contraintes pour la table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `FK_Categories_typecategory` FOREIGN KEY (`idtypecat`) REFERENCES `typecategory` (`Idtypecat`);

--
-- Contraintes pour la table `featurecategories`
--
ALTER TABLE `featurecategories`
  ADD CONSTRAINT `FK_FeatureCategories_Categories_IdCategory` FOREIGN KEY (`IdCategory`) REFERENCES `categories` (`IdCateg`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_FeatureCategories_Features_IdFeature` FOREIGN KEY (`IdFeature`) REFERENCES `features` (`IdFeature`) ON DELETE CASCADE;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `FK_Messages_Users` FOREIGN KEY (`IdUserReceiver`) REFERENCES `users` (`IdUser`),
  ADD CONSTRAINT `FK_Messages_Users1` FOREIGN KEY (`IdUserSender`) REFERENCES `users` (`IdUser`);

--
-- Contraintes pour la table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `FK_OrderDetails_Countries` FOREIGN KEY (`IdCountry`) REFERENCES `countries` (`IdCountry`),
  ADD CONSTRAINT `FK_OrderDetails_Orders` FOREIGN KEY (`IdOrder`) REFERENCES `orders` (`IdOrder`),
  ADD CONSTRAINT `FK_OrderDetails_States` FOREIGN KEY (`IdState`) REFERENCES `states` (`IdState`),
  ADD CONSTRAINT `FK_OrderDetails_Users` FOREIGN KEY (`IdUser`) REFERENCES `users` (`IdUser`);

--
-- Contraintes pour la table `prizes`
--
ALTER TABLE `prizes`
  ADD CONSTRAINT `FK_Prizes_Users` FOREIGN KEY (`idUser`) REFERENCES `users` (`IdUser`);

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_Products_Categories` FOREIGN KEY (`IdCateg`) REFERENCES `categories` (`IdCateg`);

--
-- Contraintes pour la table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `FK_Reports_CausesReports` FOREIGN KEY (`IdCauseReport`) REFERENCES `causesreports` (`IdCauseReport`),
  ADD CONSTRAINT `FK_Reports_Users` FOREIGN KEY (`IdUser`) REFERENCES `users` (`IdUser`);

--
-- Contraintes pour la table `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `FK_States_Countries` FOREIGN KEY (`IdCountry`) REFERENCES `countries` (`IdCountry`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_Users_Countries` FOREIGN KEY (`IdCountry`) REFERENCES `countries` (`IdCountry`),
  ADD CONSTRAINT `FK_Users_Role` FOREIGN KEY (`IdRole`) REFERENCES `roles` (`IdRole`),
  ADD CONSTRAINT `FK_Users_States` FOREIGN KEY (`IdState`) REFERENCES `states` (`IdState`);

--
-- Contraintes pour la table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `FK_Wallets_Users` FOREIGN KEY (`IdUser`) REFERENCES `users` (`IdUser`);


SET FOREIGN_KEY_CHECKS = 1;
