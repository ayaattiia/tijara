    -- ============================================================
    -- TIJARADB26 - Converted from MS SQL Server to MySQL
    -- Compatible with MySQL 5.7+/8.0 and MariaDB (XAMPP / phpMyAdmin)
    -- ============================================================

    SET NAMES utf8mb4;
    SET FOREIGN_KEY_CHECKS = 0;
    SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

    CREATE DATABASE IF NOT EXISTS `TIJARADB` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
    USE `TIJARADB`;

    -- ============================================================
    -- Table: AdComments
    -- ============================================================
    CREATE TABLE `AdComments` (
    `IdComment` BIGINT NOT NULL AUTO_INCREMENT,
    `IdAd` BIGINT NOT NULL,
    `IdUser` BIGINT NOT NULL,
    `Content` VARCHAR(1000) NOT NULL,
    `CreatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `Active` INT DEFAULT 1,
    PRIMARY KEY (`IdComment`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: AdLikes
    -- ============================================================
    CREATE TABLE `AdLikes` (
    `IdLike` BIGINT NOT NULL AUTO_INCREMENT,
    `IdAd` BIGINT NOT NULL,
    `IdUser` BIGINT NOT NULL,
    `CreatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`IdLike`),
    UNIQUE KEY `UQ_AdLikes` (`IdAd`,`IdUser`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: AdminSettings
    -- ============================================================
    CREATE TABLE `AdminSettings` (
    `Key` VARCHAR(100) NOT NULL,
    `Value` LONGTEXT,
    `UpdatedAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`Key`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Ads
    -- ============================================================
    CREATE TABLE `Ads` (
    `IdAd` BIGINT NOT NULL AUTO_INCREMENT,
    `TitleAd` VARCHAR(250) DEFAULT NULL,
    `DescriptionAd` TEXT,
    `DetailsAd` TEXT,
    `PriceAd` VARCHAR(250) DEFAULT NULL,
    `IdPricesDelevery` BIGINT DEFAULT NULL,
    `DatePublication` VARCHAR(50) DEFAULT NULL,
    `ImageAd` TEXT,
    `VideoAd` TEXT,
    `IdCateg` INT DEFAULT NULL,
    `IdUser` BIGINT DEFAULT NULL,
    `IdState` BIGINT DEFAULT NULL,
    `IdCountry` BIGINT DEFAULT NULL,
    `LocationAd` VARCHAR(250) DEFAULT NULL,
    `DateEnd` VARCHAR(50) DEFAULT NULL,
    `Color` VARCHAR(50) DEFAULT NULL,
    `Brand` VARCHAR(50) DEFAULT NULL,
    `Ownerads` VARCHAR(250) DEFAULT NULL,
    `Telephone` VARCHAR(50) DEFAULT NULL,
    `Email` VARCHAR(50) DEFAULT NULL,
    `StartDate` VARCHAR(50) DEFAULT NULL,
    `Idtypecat` INT DEFAULT NULL,
    `Active` INT DEFAULT NULL,
    `Type` VARCHAR(20) DEFAULT 'annonce',
    PRIMARY KEY (`IdAd`),
    KEY `FK_Ads_Categories` (`IdCateg`),
    KEY `FK_Ads_Users` (`IdUser`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: AdsWishlist
    -- ============================================================
    CREATE TABLE `AdsWishlist` (
    `IdWishlistAd` BIGINT NOT NULL AUTO_INCREMENT,
    `IdUser` BIGINT DEFAULT NULL,
    `IdAd` BIGINT DEFAULT NULL,
    `Liked` INT DEFAULT NULL,
    PRIMARY KEY (`IdWishlistAd`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: BoostAdsPacks
    -- ============================================================
    CREATE TABLE `BoostAdsPacks` (
    `IdBoost` BIGINT NOT NULL AUTO_INCREMENT,
    `Title` VARCHAR(200) NOT NULL,
    `Price` DECIMAL(10,2) NOT NULL DEFAULT 0,
    `Discount` DECIMAL(5,2) NOT NULL DEFAULT 0,
    `MaxDuration` INT NOT NULL DEFAULT 7,
    `Sliders` TINYINT(1) NOT NULL DEFAULT 0,
    `SideBar` TINYINT(1) NOT NULL DEFAULT 0,
    `Footer` TINYINT(1) NOT NULL DEFAULT 0,
    `RelatedPost` TINYINT(1) NOT NULL DEFAULT 0,
    `FirstLogin` TINYINT(1) NOT NULL DEFAULT 0,
    `OrdersCount` INT NOT NULL DEFAULT 0,
    `Links` TINYINT(1) NOT NULL DEFAULT 0,
    `Active` TINYINT(1) NOT NULL DEFAULT 1,
    `CreatedAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`IdBoost`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Boosts
    -- ============================================================
    CREATE TABLE `Boosts` (
    `IdBoost` INT NOT NULL AUTO_INCREMENT,
    `TitleBoost` LONGTEXT NOT NULL,
    `Price` FLOAT NOT NULL,
    `Discount` LONGTEXT,
    `MaxDurationPerDay` INT DEFAULT NULL,
    `InSliders` INT DEFAULT NULL,
    `InSideBar` INT DEFAULT NULL,
    `InFooter` INT DEFAULT NULL,
    `InRelatedPost` INT DEFAULT NULL,
    `InFirstLogin` INT DEFAULT NULL,
    `HasLinks` INT DEFAULT NULL,
    `Orders` INT DEFAULT NULL,
    PRIMARY KEY (`IdBoost`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Brands
    -- ============================================================
    CREATE TABLE `Brands` (
    `IdBrand` BIGINT NOT NULL AUTO_INCREMENT,
    `Title` LONGTEXT NOT NULL,
    `Description` LONGTEXT NOT NULL,
    `Image` LONGTEXT,
    `Active` INT NOT NULL,
    PRIMARY KEY (`IdBrand`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Categories
    -- ============================================================
    CREATE TABLE `Categories` (
    `IdCateg` INT NOT NULL AUTO_INCREMENT,
    `TitleEn` VARCHAR(250) DEFAULT NULL,
    `TitleFr` VARCHAR(250) DEFAULT NULL,
    `TitleAr` VARCHAR(250) DEFAULT NULL,
    `Description` TEXT,
    `Image` TEXT,
    `idtypecat` INT DEFAULT NULL,
    `Active` INT DEFAULT NULL,
    PRIMARY KEY (`IdCateg`),
    KEY `FK_Categories_typecategory` (`idtypecat`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Causes
    -- ============================================================
    CREATE TABLE `Causes` (
    `IdCause` BIGINT NOT NULL AUTO_INCREMENT,
    `Title` VARCHAR(200) NOT NULL,
    `Description` VARCHAR(1000) DEFAULT NULL,
    `Email` VARCHAR(200) DEFAULT NULL,
    `Type` VARCHAR(50) DEFAULT NULL,
    `Active` TINYINT(1) NOT NULL DEFAULT 1,
    `CreatedAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`IdCause`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: CausesReports
    -- ============================================================
    CREATE TABLE `CausesReports` (
    `IdCauseReport` INT NOT NULL AUTO_INCREMENT,
    `TitleCauseEn` VARCHAR(250) DEFAULT NULL,
    `TitleCauseAr` VARCHAR(250) DEFAULT NULL,
    `TitleCauseFr` VARCHAR(250) DEFAULT NULL,
    `GroupName` VARCHAR(250) DEFAULT NULL,
    `Active` INT DEFAULT NULL,
    PRIMARY KEY (`IdCauseReport`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: ChatMessages
    -- (No PK/AUTO_INCREMENT in original script)
    -- ============================================================
    CREATE TABLE `ChatMessages` (
    `IdChatMessage` BIGINT NOT NULL,
    `IdChat` BIGINT DEFAULT NULL,
    `Message` TEXT,
    `CreateDate` DATETIME DEFAULT NULL,
    `IdUserSender` BIGINT DEFAULT NULL,
    `Report` TEXT,
    `AdminReview` TEXT,
    `Active` INT DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Chats
    -- ============================================================
    CREATE TABLE `Chats` (
    `IdChat` INT NOT NULL AUTO_INCREMENT,
    `IdUserSender` BIGINT DEFAULT NULL,
    `IdUserReciver` BIGINT DEFAULT NULL,
    `CreatedAt` DATETIME DEFAULT NULL,
    `AdminReview` TEXT,
    `Active` INT DEFAULT NULL,
    PRIMARY KEY (`IdChat`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Cities
    -- ============================================================
    CREATE TABLE `Cities` (
    `IdCity` BIGINT NOT NULL AUTO_INCREMENT,
    `Title` VARCHAR(200) NOT NULL,
    `IdCountry` BIGINT DEFAULT NULL,
    `TitleEn` VARCHAR(200) DEFAULT NULL,
    `TitleAr` VARCHAR(200) DEFAULT NULL,
    `Image` VARCHAR(500) DEFAULT NULL,
    `Active` TINYINT(1) NOT NULL DEFAULT 1,
    `CreatedAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`IdCity`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Comments
    -- ============================================================
    CREATE TABLE `Comments` (
    `IdComment` BIGINT NOT NULL AUTO_INCREMENT,
    `IdUser` BIGINT DEFAULT NULL,
    `Comment` TEXT,
    `IdReplyComment` INT DEFAULT NULL,
    `Date` DATE DEFAULT NULL,
    `IdCourse` BIGINT DEFAULT NULL,
    `IdLesson` BIGINT DEFAULT NULL,
    `IdMeet` BIGINT DEFAULT NULL,
    `Active` INT DEFAULT NULL,
    PRIMARY KEY (`IdComment`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Countries
    -- ============================================================
    CREATE TABLE `Countries` (
    `IdCountry` BIGINT NOT NULL AUTO_INCREMENT,
    `country_code` VARCHAR(250) DEFAULT '',
    `country_enName` VARCHAR(100) DEFAULT '',
    `country_arName` VARCHAR(100) DEFAULT '',
    `country_enNationality` VARCHAR(100) DEFAULT '',
    `country_arNationality` VARCHAR(100) DEFAULT '',
    `Active` INT DEFAULT NULL,
    `Title` VARCHAR(200) DEFAULT NULL,
    `Flag` VARCHAR(500) DEFAULT NULL,
    `Code` VARCHAR(10) DEFAULT NULL,
    `PhoneCode` VARCHAR(10) DEFAULT NULL,
    `CreatedAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`IdCountry`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: CountriesFull
    -- ============================================================
    CREATE TABLE `CountriesFull` (
    `IdCountry` INT NOT NULL AUTO_INCREMENT,
    `NameEN` VARCHAR(200) NOT NULL,
    `NameFR` VARCHAR(200) NOT NULL,
    `NameAR` VARCHAR(200) DEFAULT NULL,
    `NameDE` VARCHAR(200) DEFAULT NULL,
    `NameES` VARCHAR(200) DEFAULT NULL,
    `NameCH` VARCHAR(200) DEFAULT NULL,
    `NameRU` VARCHAR(200) DEFAULT NULL,
    `CodeCountry2` CHAR(2) DEFAULT NULL,
    `CodeCountry3` CHAR(3) DEFAULT NULL,
    `Flag` LONGTEXT,
    `MAP` LONGTEXT,
    `PhoneCode` CHAR(10) DEFAULT NULL,
    `Continent` VARCHAR(250) DEFAULT NULL,
    `Active` INT DEFAULT NULL,
    PRIMARY KEY (`IdCountry`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Coupons
    -- ============================================================
    CREATE TABLE `Coupons` (
    `IdCoupon` BIGINT NOT NULL AUTO_INCREMENT,
    `Title` VARCHAR(200) NOT NULL,
    `Description` VARCHAR(1000) DEFAULT NULL,
    `DateStart` DATETIME DEFAULT NULL,
    `DateEnd` DATETIME DEFAULT NULL,
    `Price` DECIMAL(10,2) NOT NULL DEFAULT 0,
    `NumberOfCoupon` INT NOT NULL DEFAULT 0,
    `Used` INT NOT NULL DEFAULT 0,
    `Active` TINYINT(1) NOT NULL DEFAULT 1,
    `CreatedAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`IdCoupon`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Deals
    -- ============================================================
    CREATE TABLE `Deals` (
    `IdDeal` INT NOT NULL AUTO_INCREMENT,
    `titleDeal` VARCHAR(250) DEFAULT NULL,
    `descriptionDeal` TEXT,
    `detailsDeal` TEXT,
    `priceDeal` VARCHAR(250) DEFAULT NULL,
    `discountDeal` VARCHAR(250) DEFAULT NULL,
    `quantity` VARCHAR(50) DEFAULT NULL,
    `datePublication` VARCHAR(250) DEFAULT NULL,
    `dateEnd` VARCHAR(250) DEFAULT NULL,
    `imageDeal` TEXT,
    `idtypecat` INT DEFAULT NULL,
    `idCateg` INT DEFAULT NULL,
    `idUser` INT DEFAULT NULL,
    `idState` BIGINT DEFAULT NULL,
    `idPrize` BIGINT DEFAULT NULL,
    `locationDeal` VARCHAR(250) DEFAULT NULL,
    `active` INT DEFAULT NULL,
    `colors` VARCHAR(250) DEFAULT NULL,
    `likes` INT DEFAULT NULL,
    `liked` INT DEFAULT NULL,
    `telephone` VARCHAR(50) DEFAULT NULL,
    `email` VARCHAR(50) DEFAULT NULL,
    `ownerdeals` VARCHAR(50) DEFAULT NULL,
    `brand` VARCHAR(250) DEFAULT NULL,
    `startDate` VARCHAR(250) DEFAULT NULL,
    `TotalCount` INT DEFAULT NULL,
    PRIMARY KEY (`IdDeal`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: DealsWishlist
    -- ============================================================
    CREATE TABLE `DealsWishlist` (
    `IdWishlistDeal` BIGINT NOT NULL AUTO_INCREMENT,
    `IdUser` BIGINT DEFAULT NULL,
    `IdDeal` BIGINT DEFAULT NULL,
    `Liked` BIGINT DEFAULT NULL,
    PRIMARY KEY (`IdWishlistDeal`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Deliveries
    -- ============================================================
    CREATE TABLE `Deliveries` (
    `IdDelivery` BIGINT NOT NULL AUTO_INCREMENT,
    `IdOrder` BIGINT NOT NULL,
    `IdTransport` INT DEFAULT NULL,
    `TrackingNumber` VARCHAR(100) DEFAULT NULL,
    `Status` VARCHAR(30) NOT NULL DEFAULT 'pending',
    `AddressLine` VARCHAR(500) DEFAULT NULL,
    `City` VARCHAR(150) DEFAULT NULL,
    `PostalCode` VARCHAR(20) DEFAULT NULL,
    `Phone` VARCHAR(40) DEFAULT NULL,
    `DeliveryFee` DECIMAL(18,3) DEFAULT 0,
    `EstimatedAt` DATETIME DEFAULT NULL,
    `DeliveredAt` DATETIME DEFAULT NULL,
    `Note` VARCHAR(500) DEFAULT NULL,
    `CreatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `UpdatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`IdDelivery`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: EmailTokens
    -- ============================================================
    CREATE TABLE `EmailTokens` (
    `IdToken` BIGINT NOT NULL AUTO_INCREMENT,
    `IdUser` BIGINT NOT NULL,
    `Token` VARCHAR(200) NOT NULL,
    `Type` VARCHAR(30) NOT NULL DEFAULT 'email_confirm',
    `ExpiresAt` DATETIME NOT NULL,
    `Used` TINYINT(1) DEFAULT 0,
    `CreatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`IdToken`),
    UNIQUE KEY `UQ_EmailTokens_Token` (`Token`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Errors
    -- ============================================================
    CREATE TABLE `Errors` (
    `IdError` BIGINT NOT NULL AUTO_INCREMENT,
    `IdUser` BIGINT DEFAULT NULL,
    `TitleError` LONGTEXT,
    `Req` LONGTEXT,
    `ReqError` LONGTEXT,
    `ExceptionError` LONGTEXT,
    `OtheError` LONGTEXT,
    `Page` LONGTEXT,
    `Action` LONGTEXT,
    `dateTimeError` DATETIME DEFAULT NULL,
    `Validate` TINYINT(1) DEFAULT NULL,
    PRIMARY KEY (`IdError`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: FeatureCategories
    -- ============================================================
    CREATE TABLE `FeatureCategories` (
    `IdFC` BIGINT NOT NULL AUTO_INCREMENT,
    `IdCategory` INT DEFAULT NULL,
    `IdFeature` BIGINT DEFAULT NULL,
    PRIMARY KEY (`IdFC`),
    KEY `FK_FeatureCategories_Categories_IdCategory` (`IdCategory`),
    KEY `FK_FeatureCategories_Features_IdFeature` (`IdFeature`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Features
    -- ============================================================
    CREATE TABLE `Features` (
    `IdFeature` BIGINT NOT NULL AUTO_INCREMENT,
    `TitleFeature` LONGTEXT,
    `DescriptionFeature` LONGTEXT,
    `UnitFeature` LONGTEXT,
    `ImgFeature` LONGBLOB,
    `Active` INT DEFAULT NULL,
    PRIMARY KEY (`IdFeature`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: FeaturesValues
    -- ============================================================
    CREATE TABLE `FeaturesValues` (
    `IdFV` BIGINT NOT NULL AUTO_INCREMENT,
    `ValueFeature` LONGTEXT,
    `IdFeature` BIGINT DEFAULT NULL,
    `Active` INT DEFAULT NULL,
    PRIMARY KEY (`IdFV`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Invoices
    -- ============================================================
    CREATE TABLE `Invoices` (
    `IdInvoice` BIGINT NOT NULL AUTO_INCREMENT,
    `Number` VARCHAR(50) NOT NULL,
    `IdOrder` BIGINT NOT NULL,
    `IdUser` BIGINT NOT NULL,
    `IdVendor` BIGINT DEFAULT NULL,
    `Subtotal` DECIMAL(18,3) NOT NULL,
    `Tax` DECIMAL(18,3) DEFAULT 0,
    `DeliveryFee` DECIMAL(18,3) DEFAULT 0,
    `Total` DECIMAL(18,3) NOT NULL,
    `Status` VARCHAR(30) DEFAULT 'issued',
    `IssuedAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `PaidAt` DATETIME DEFAULT NULL,
    PRIMARY KEY (`IdInvoice`),
    UNIQUE KEY `UQ_Invoices_Number` (`Number`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Labels
    -- ============================================================
    CREATE TABLE `Labels` (
    `IdLabel` INT NOT NULL AUTO_INCREMENT,
    `TitleEn` VARCHAR(250) DEFAULT NULL,
    `TitleFr` VARCHAR(250) DEFAULT NULL,
    `TitleAr` VARCHAR(250) DEFAULT NULL,
    `Color` VARCHAR(250) DEFAULT NULL,
    `Active` INT DEFAULT NULL,
    PRIMARY KEY (`IdLabel`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Likes
    -- ============================================================
    CREATE TABLE `Likes` (
    `IdLike` BIGINT NOT NULL AUTO_INCREMENT,
    `IdUser` BIGINT NOT NULL,
    `TargetType` VARCHAR(20) NOT NULL,
    `TargetId` BIGINT NOT NULL,
    `CreatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`IdLike`),
    UNIQUE KEY `UQ_Likes` (`IdUser`,`TargetType`,`TargetId`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: ListPermissions
    -- ============================================================
    CREATE TABLE `ListPermissions` (
    `IdListPermission` INT NOT NULL AUTO_INCREMENT,
    `TitleEn` VARCHAR(250) DEFAULT NULL,
    `TitleFr` VARCHAR(250) DEFAULT NULL,
    `TitleAr` VARCHAR(250) DEFAULT NULL,
    `Description` TEXT,
    `GroupName` VARCHAR(250) DEFAULT NULL,
    PRIMARY KEY (`IdListPermission`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Messages
    -- ============================================================
    CREATE TABLE `Messages` (
    `IdMessage` BIGINT NOT NULL AUTO_INCREMENT,
    `IdUserSender` BIGINT DEFAULT NULL,
    `IdUserReceiver` BIGINT DEFAULT NULL,
    `DateMessage` DATE DEFAULT NULL,
    `IdMessageReplay` BIGINT DEFAULT NULL,
    `Message` TEXT,
    `Active` INT DEFAULT NULL,
    PRIMARY KEY (`IdMessage`),
    KEY `FK_Messages_Users` (`IdUserReceiver`),
    KEY `FK_Messages_Users1` (`IdUserSender`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Notifications
    -- ============================================================
    CREATE TABLE `Notifications` (
    `IdNotification` INT NOT NULL AUTO_INCREMENT,
    `Title` VARCHAR(250) DEFAULT NULL,
    `Description` TEXT,
    `Date` DATE DEFAULT NULL,
    `Type` VARCHAR(250) DEFAULT NULL,
    `IsRead` INT DEFAULT NULL,
    `IdUser` BIGINT DEFAULT NULL,
    PRIMARY KEY (`IdNotification`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: OrderDetails
    -- ============================================================
    CREATE TABLE `OrderDetails` (
    `IdOrderDeatils` BIGINT NOT NULL AUTO_INCREMENT,
    `IdUser` BIGINT DEFAULT NULL,
    `IdProduct` BIGINT DEFAULT NULL,
    `IdState` BIGINT DEFAULT NULL,
    `IdCountry` BIGINT DEFAULT NULL,
    `IdOrder` BIGINT DEFAULT NULL,
    `ZipCode` INT DEFAULT NULL,
    `Address` VARCHAR(250) DEFAULT NULL,
    `Email` VARCHAR(250) DEFAULT NULL,
    `Telephone` VARCHAR(250) DEFAULT NULL,
    `FirstName` VARCHAR(250) DEFAULT NULL,
    `LastName` VARCHAR(250) DEFAULT NULL,
    `Quantity` INT DEFAULT NULL,
    `TotalAmount` VARCHAR(50) DEFAULT NULL,
    `DateTimeCommand` VARCHAR(50) DEFAULT NULL,
    `Active` INT DEFAULT NULL,
    PRIMARY KEY (`IdOrderDeatils`),
    KEY `FK_OrderDetails_Countries` (`IdCountry`),
    KEY `FK_OrderDetails_Orders` (`IdOrder`),
    KEY `FK_OrderDetails_States` (`IdState`),
    KEY `FK_OrderDetails_Users` (`IdUser`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Orders
    -- ============================================================
    CREATE TABLE `Orders` (
    `IdOrder` BIGINT NOT NULL AUTO_INCREMENT,
    `IdUser` BIGINT DEFAULT NULL,
    `IdDeal` BIGINT DEFAULT NULL,
    `IdState` BIGINT DEFAULT NULL,
    `DateTimeCommand` DATETIME DEFAULT NULL,
    `Active` INT DEFAULT NULL,
    PRIMARY KEY (`IdOrder`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Payments
    -- ============================================================
    CREATE TABLE `Payments` (
    `IdPayment` BIGINT NOT NULL AUTO_INCREMENT,
    `IdUser` BIGINT NOT NULL,
    `IdOrder` BIGINT DEFAULT NULL,
    `Amount` DECIMAL(18,3) NOT NULL,
    `Method` VARCHAR(40) NOT NULL,
    `Status` VARCHAR(30) NOT NULL DEFAULT 'pending',
    `Reference` VARCHAR(100) DEFAULT NULL,
    `TransactionId` VARCHAR(150) DEFAULT NULL,
    `CreatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `PaidAt` DATETIME DEFAULT NULL,
    PRIMARY KEY (`IdPayment`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Permissions
    -- ============================================================
    CREATE TABLE `Permissions` (
    `IdPermission` BIGINT NOT NULL AUTO_INCREMENT,
    `IdRole` INT DEFAULT NULL,
    `IdListPermission` INT DEFAULT NULL,
    `PermissionDate` DATE DEFAULT NULL,
    `Resource` VARCHAR(100) DEFAULT NULL,
    `CanRead` TINYINT(1) DEFAULT 0,
    `CanCreate` TINYINT(1) DEFAULT 0,
    `CanUpdate` TINYINT(1) DEFAULT 0,
    `CanDelete` TINYINT(1) DEFAULT 0,
    PRIMARY KEY (`IdPermission`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: PointPackets
    -- ============================================================
    CREATE TABLE `PointPackets` (
    `IdPacket` BIGINT NOT NULL AUTO_INCREMENT,
    `Title` VARCHAR(200) NOT NULL,
    `Description` VARCHAR(1000) DEFAULT NULL,
    `PointsCount` INT NOT NULL DEFAULT 0,
    `Price` DECIMAL(10,2) NOT NULL DEFAULT 0,
    `Discount` DECIMAL(5,2) NOT NULL DEFAULT 0,
    `Active` TINYINT(1) NOT NULL DEFAULT 1,
    `CreatedAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`IdPacket`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Prizes
    -- ============================================================
    CREATE TABLE `Prizes` (
    `idPrize` INT NOT NULL AUTO_INCREMENT,
    `image` VARCHAR(250) DEFAULT NULL,
    `title` VARCHAR(250) DEFAULT NULL,
    `description` TEXT,
    `idUser` BIGINT DEFAULT NULL,
    `active` INT DEFAULT NULL,
    `datePublication` VARCHAR(250) DEFAULT NULL,
    PRIMARY KEY (`idPrize`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Products
    -- ============================================================
    CREATE TABLE `Products` (
    `IdProduct` BIGINT NOT NULL AUTO_INCREMENT,
    `CodeBarProduct` VARCHAR(250) DEFAULT NULL,
    `CodeProduct` VARCHAR(250) DEFAULT NULL,
    `ReferenceProduct` VARCHAR(250) DEFAULT NULL,
    `TitleProduct` VARCHAR(250) DEFAULT NULL,
    `DescriptionProduct` VARCHAR(250) DEFAULT NULL,
    `QuantityProduct` INT DEFAULT NULL,
    `ColorProduct` VARCHAR(250) DEFAULT NULL,
    `PriceProduct` TEXT,
    `TvaProduct` VARCHAR(250) DEFAULT NULL,
    `IdPricesDelevery` BIGINT DEFAULT NULL,
    `ImageProduct` TEXT,
    `VideoProduct` TEXT,
    `IdPrize` BIGINT DEFAULT NULL,
    `IdCateorie` BIGINT DEFAULT NULL,
    `IdUser` BIGINT DEFAULT NULL,
    `IdCountrie` BIGINT DEFAULT NULL,
    `Active` INT DEFAULT NULL,
    PRIMARY KEY (`IdProduct`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: ProductWishlist
    -- ============================================================
    CREATE TABLE `ProductWishlist` (
    `IdWishlistProduct` BIGINT NOT NULL AUTO_INCREMENT,
    `IdUser` BIGINT DEFAULT NULL,
    `IdProduct` BIGINT DEFAULT NULL,
    `Liked` INT DEFAULT NULL,
    PRIMARY KEY (`IdWishlistProduct`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Ratings
    -- ============================================================
    CREATE TABLE `Ratings` (
    `IdRating` BIGINT NOT NULL AUTO_INCREMENT,
    `IdUser` BIGINT DEFAULT NULL,
    `Rating` BIGINT DEFAULT NULL,
    `CommentRating` LONGTEXT,
    `Date` DATE DEFAULT NULL,
    `TableName` VARCHAR(250) DEFAULT NULL,
    `IdTable` BIGINT DEFAULT NULL,
    `Active` INT DEFAULT NULL,
    PRIMARY KEY (`IdRating`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Reports
    -- ============================================================
    CREATE TABLE `Reports` (
    `IdReport` INT NOT NULL AUTO_INCREMENT,
    `IdUser` BIGINT DEFAULT NULL,
    `IdCauseReport` INT DEFAULT NULL,
    `Subject` VARCHAR(250) DEFAULT NULL,
    `Description` TEXT,
    `Date` DATE DEFAULT NULL,
    `State` INT DEFAULT NULL,
    `TypeTable` VARCHAR(250) DEFAULT NULL,
    `IdTable` BIGINT DEFAULT NULL,
    `IdProduct` CHAR(10) DEFAULT NULL,
    PRIMARY KEY (`IdReport`),
    KEY `FK_Reports_CausesReports` (`IdCauseReport`),
    KEY `FK_Reports_Users` (`IdUser`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Reviews
    -- ============================================================
    CREATE TABLE `Reviews` (
    `IdReview` BIGINT NOT NULL AUTO_INCREMENT,
    `IdUser` BIGINT NOT NULL,
    `TargetType` VARCHAR(20) NOT NULL,
    `TargetId` BIGINT NOT NULL,
    `Rating` TINYINT NOT NULL DEFAULT 5,
    `Comment` VARCHAR(1000) DEFAULT NULL,
    `Active` TINYINT(1) NOT NULL DEFAULT 1,
    `CreatedAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`IdReview`),
    UNIQUE KEY `UQ_Reviews` (`IdUser`,`TargetType`,`TargetId`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Roles
    -- ============================================================
    CREATE TABLE `Roles` (
    `IdRole` INT NOT NULL,
    `RoleUser` VARCHAR(20) DEFAULT NULL,
    `Active` INT DEFAULT NULL,
    PRIMARY KEY (`IdRole`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: SmsLogs
    -- ============================================================
    CREATE TABLE `SmsLogs` (
    `IdSms` BIGINT NOT NULL AUTO_INCREMENT,
    `Recipient` VARCHAR(40) NOT NULL,
    `Message` VARCHAR(500) NOT NULL,
    `Status` VARCHAR(30) DEFAULT 'queued',
    `Provider` VARCHAR(50) DEFAULT NULL,
    `SentAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `Error` VARCHAR(500) DEFAULT NULL,
    PRIMARY KEY (`IdSms`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: States
    -- ============================================================
    CREATE TABLE `States` (
    `IdState` BIGINT NOT NULL AUTO_INCREMENT,
    `NameEN` VARCHAR(250) DEFAULT NULL,
    `NameFR` VARCHAR(250) DEFAULT NULL,
    `NameAR` VARCHAR(250) DEFAULT NULL,
    `NameDE` VARCHAR(50) DEFAULT NULL,
    `NameES` VARCHAR(250) DEFAULT NULL,
    `NameCH` CHAR(250) DEFAULT NULL,
    `NameRU` CHAR(250) DEFAULT NULL,
    `CodeState` VARCHAR(50) DEFAULT NULL,
    `CityPostalCode` VARCHAR(50) DEFAULT NULL,
    `Flag` VARCHAR(50) DEFAULT NULL,
    `MAP` VARCHAR(250) DEFAULT NULL,
    `PhoneCode` VARCHAR(50) DEFAULT NULL,
    `CountriesName` VARCHAR(250) DEFAULT NULL,
    `IdCountry` BIGINT DEFAULT NULL,
    `Active` INT DEFAULT NULL,
    PRIMARY KEY (`IdState`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Tags
    -- (No PK/AUTO_INCREMENT in original script)
    -- ============================================================
    CREATE TABLE `Tags` (
    `IdUser` BIGINT DEFAULT NULL,
    `Tag` TEXT,
    `IdLangue` BIGINT DEFAULT NULL,
    `Active` INT DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Transports
    -- ============================================================
    CREATE TABLE `Transports` (
    `IdTransport` INT NOT NULL AUTO_INCREMENT,
    `Name` VARCHAR(150) NOT NULL,
    `Logo` VARCHAR(500) DEFAULT NULL,
    `Phone` VARCHAR(40) DEFAULT NULL,
    `Email` VARCHAR(200) DEFAULT NULL,
    `DeliveryFee` DECIMAL(18,3) DEFAULT 0,
    `FreeFrom` DECIMAL(18,3) DEFAULT NULL,
    `Zones` VARCHAR(500) DEFAULT NULL,
    `Active` TINYINT(1) DEFAULT 1,
    `CreatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`IdTransport`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: TypeCategory
    -- ============================================================
    CREATE TABLE `TypeCategory` (
    `Idtypecat` INT NOT NULL AUTO_INCREMENT,
    `Title` VARCHAR(250) DEFAULT NULL,
    PRIMARY KEY (`Idtypecat`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: UserFollows
    -- ============================================================
    CREATE TABLE `UserFollows` (
    `IdFollow` BIGINT NOT NULL AUTO_INCREMENT,
    `IdUser` BIGINT NOT NULL,
    `IdVendor` BIGINT NOT NULL,
    `CreatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`IdFollow`),
    UNIQUE KEY `UQ_UserFollows` (`IdUser`,`IdVendor`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Users
    -- ============================================================
    CREATE TABLE `Users` (
    `IdUser` BIGINT NOT NULL AUTO_INCREMENT,
    `Username` VARCHAR(250) DEFAULT NULL,
    `FirstName` VARCHAR(250) DEFAULT NULL,
    `LastName` VARCHAR(250) DEFAULT NULL,
    `BirthDate` VARCHAR(50) DEFAULT NULL,
    `Gender` VARCHAR(250) DEFAULT NULL,
    `Email` VARCHAR(250) DEFAULT NULL,
    `ICN` VARCHAR(250) DEFAULT NULL,
    `Telephone` VARCHAR(50) DEFAULT NULL,
    `Password` TEXT,
    `IdRole` INT DEFAULT NULL,
    `FacebookId` TEXT,
    `GoogleId` TEXT,
    `RefreshToken` TEXT,
    `ProfilePicture` TEXT,
    `CreationDate` VARCHAR(50) DEFAULT NULL,
    `IsVerified` INT DEFAULT NULL,
    `IsPremuim` INT DEFAULT NULL,
    `PremiumExpiry` DATE DEFAULT NULL,
    `IdentityPicture` TEXT,
    `IsBusinessAccount` INT DEFAULT NULL,
    `ICNBusiness` VARCHAR(250) DEFAULT NULL,
    `BusinessVerificationPicture` TEXT,
    `IdState` BIGINT DEFAULT NULL,
    `IdCountry` BIGINT DEFAULT NULL,
    `Location` TEXT,
    `LastConnection` DATE DEFAULT NULL,
    `Active` INT DEFAULT NULL,
    `City` VARCHAR(100) DEFAULT NULL,
    `EmailConfirmed` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`IdUser`),
    KEY `FK_Users_Countries` (`IdCountry`),
    KEY `FK_Users_Role` (`IdRole`),
    KEY `FK_Users_States` (`IdState`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Wallets
    -- ============================================================
    CREATE TABLE `Wallets` (
    `IdWallet` INT NOT NULL AUTO_INCREMENT,
    `IdUser` BIGINT DEFAULT NULL,
    `ICN` VARCHAR(250) DEFAULT NULL,
    `NbrJeton` BIGINT DEFAULT NULL,
    `MoneyBudget` DECIMAL(18,3) DEFAULT NULL,
    `MoneyBlocked` DECIMAL(18,3) DEFAULT NULL,
    `MoneyTransfered` DECIMAL(18,3) DEFAULT NULL,
    `Active` INT DEFAULT NULL,
    PRIMARY KEY (`IdWallet`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: Winners
    -- ============================================================
    CREATE TABLE `Winners` (
    `IdWinner` BIGINT NOT NULL AUTO_INCREMENT,
    `IdPrize` BIGINT DEFAULT NULL,
    `IdUser` BIGINT DEFAULT NULL,
    `DateWin` DATE DEFAULT NULL,
    PRIMARY KEY (`IdWinner`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: WishlistAds
    -- ============================================================
    CREATE TABLE `WishlistAds` (
    `IdWish` BIGINT NOT NULL AUTO_INCREMENT,
    `IdUser` BIGINT NOT NULL,
    `IdAd` BIGINT NOT NULL,
    `CreatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`IdWish`),
    UNIQUE KEY `UQ_WishlistAds` (`IdUser`,`IdAd`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- Table: WishlistDeals
    -- ============================================================
    CREATE TABLE `WishlistDeals` (
    `IdWish` BIGINT NOT NULL AUTO_INCREMENT,
    `IdUser` BIGINT NOT NULL,
    `IdDeal` BIGINT NOT NULL,
    `CreatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`IdWish`),
    UNIQUE KEY `UQ_WishlistDeals` (`IdUser`,`IdDeal`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- ============================================================
    -- FOREIGN KEY CONSTRAINTS
    -- ============================================================

    ALTER TABLE `Ads`
    ADD CONSTRAINT `FK_Ads_Categories` FOREIGN KEY (`IdCateg`) REFERENCES `Categories` (`IdCateg`),
    ADD CONSTRAINT `FK_Ads_Users` FOREIGN KEY (`IdUser`) REFERENCES `Users` (`IdUser`);

    ALTER TABLE `Categories`
    ADD CONSTRAINT `FK_Categories_typecategory` FOREIGN KEY (`idtypecat`) REFERENCES `TypeCategory` (`Idtypecat`);

    ALTER TABLE `FeatureCategories`
    ADD CONSTRAINT `FK_FeatureCategories_Categories_IdCategory` FOREIGN KEY (`IdCategory`) REFERENCES `Categories` (`IdCateg`) ON DELETE CASCADE,
    ADD CONSTRAINT `FK_FeatureCategories_Features_IdFeature` FOREIGN KEY (`IdFeature`) REFERENCES `Features` (`IdFeature`) ON DELETE CASCADE;

    ALTER TABLE `Messages`
    ADD CONSTRAINT `FK_Messages_Users` FOREIGN KEY (`IdUserReceiver`) REFERENCES `Users` (`IdUser`),
    ADD CONSTRAINT `FK_Messages_Users1` FOREIGN KEY (`IdUserSender`) REFERENCES `Users` (`IdUser`);

    ALTER TABLE `OrderDetails`
    ADD CONSTRAINT `FK_OrderDetails_Countries` FOREIGN KEY (`IdCountry`) REFERENCES `Countries` (`IdCountry`),
    ADD CONSTRAINT `FK_OrderDetails_Orders` FOREIGN KEY (`IdOrder`) REFERENCES `Orders` (`IdOrder`),
    ADD CONSTRAINT `FK_OrderDetails_States` FOREIGN KEY (`IdState`) REFERENCES `States` (`IdState`),
    ADD CONSTRAINT `FK_OrderDetails_Users` FOREIGN KEY (`IdUser`) REFERENCES `Users` (`IdUser`);

    ALTER TABLE `Prizes`
    ADD CONSTRAINT `FK_Prizes_Users` FOREIGN KEY (`idUser`) REFERENCES `Users` (`IdUser`);

    ALTER TABLE `Reports`
    ADD CONSTRAINT `FK_Reports_CausesReports` FOREIGN KEY (`IdCauseReport`) REFERENCES `CausesReports` (`IdCauseReport`),
    ADD CONSTRAINT `FK_Reports_Users` FOREIGN KEY (`IdUser`) REFERENCES `Users` (`IdUser`);

    ALTER TABLE `States`
    ADD CONSTRAINT `FK_States_Countries` FOREIGN KEY (`IdCountry`) REFERENCES `Countries` (`IdCountry`);

    ALTER TABLE `Users`
    ADD CONSTRAINT `FK_Users_Countries` FOREIGN KEY (`IdCountry`) REFERENCES `Countries` (`IdCountry`),
    ADD CONSTRAINT `FK_Users_Role` FOREIGN KEY (`IdRole`) REFERENCES `Roles` (`IdRole`),
    ADD CONSTRAINT `FK_Users_States` FOREIGN KEY (`IdState`) REFERENCES `States` (`IdState`);

    ALTER TABLE `Wallets`
    ADD CONSTRAINT `FK_Wallets_Users` FOREIGN KEY (`IdUser`) REFERENCES `Users` (`IdUser`);


    ALTER TABLE Categories
    ADD COLUMN idparent BIGINT UNSIGNED NOT NULL DEFAULT 0 AFTER IdCateg;



    SET FOREIGN_KEY_CHECKS = 1;
