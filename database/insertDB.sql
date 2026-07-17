-- seed_part1.sql
-- Compatible MySQL / phpMyAdmin
-- TijaraDB26 sample data - Part 1

SET FOREIGN_KEY_CHECKS = 0;

INSERT INTO roles (IdRole, RoleUser, Active) VALUES
(1,'User',1),
(2,'Entreprise',1),
(3,'Admin',1);


INSERT INTO typecategory (Idtypecat, Title) VALUES
(1,'Electronics'),
(2,'Fashion'),
(3,'Vehicles'),
(4,'Home'),
(5,'Beauty'),
(6,'Sports'),
(7,'Services'),
(8,'Books'),
(9,'Food'),
(10,'Other');

INSERT INTO countries (IdCountry, country_code, country_enName, country_arName, country_enNationality, country_arNationality, Active, Title, Flag, Code, PhoneCode) VALUES
(1,'TN','Tunisia','تونس','Tunisian','تونسي',1,'Tunisia','tn.png','TN','+216'),
(2,'FR','France','فرنسا','French','فرنسي',1,'France','fr.png','FR','+33'),
(3,'DE','Germany','ألمانيا','German','ألماني',1,'Germany','de.png','DE','+49'),
(4,'IT','Italy','إيطاليا','Italian','إيطالي',1,'Italy','it.png','IT','+39'),
(5,'ES','Spain','إسبانيا','Spanish','إسباني',1,'Spain','es.png','ES','+34'),
(6,'US','USA','الولايات المتحدة','American','أمريكي',1,'United States','us.png','US','+1'),
(7,'GB','United Kingdom','بريطانيا','British','بريطاني',1,'United Kingdom','gb.png','GB','+44'),
(8,'TR','Turkey','تركيا','Turkish','تركي',1,'Turkey','tr.png','TR','+90'),
(9,'MA','Morocco','المغرب','Moroccan','مغربي',1,'Morocco','ma.png','MA','+212'),
(10,'DZ','Algeria','الجزائر','Algerian','جزائري',1,'Algeria','dz.png','DZ','+213');

INSERT INTO states (IdState, NameEN, NameFR, NameAR, CodeState, IdCountry, Active) VALUES
(1,'Tunis','Tunis','تونس','TN01',1,1),
(2,'Sousse','Sousse','سوسة','TN02',1,1),
(3,'Sfax','Sfax','صفاقس','TN03',1,1),
(4,'Monastir','Monastir','المنستير','TN04',1,1),
(5,'Ariana','Ariana','أريانة','TN05',1,1),
(6,'Paris','Paris','باريس','FR01',2,1),
(7,'Berlin','Berlin','برلين','DE01',3,1),
(8,'Rome','Rome','روما','IT01',4,1),
(9,'Madrid','Madrid','مدريد','ES01',5,1),
(10,'London','London','لندن','GB01',7,1);

INSERT INTO cities (IdCity, Title, IdCountry, TitleEn, TitleAr, Active) VALUES
(1,'Tunis',1,'Tunis','تونس',1),
(2,'Sousse',1,'Sousse','سوسة',1),
(3,'Sfax',1,'Sfax','صفاقس',1),
(4,'Monastir',1,'Monastir','المنستير',1),
(5,'Ariana',1,'Ariana','أريانة',1),
(6,'Paris',2,'Paris','باريس',1),
(7,'Berlin',3,'Berlin','برلين',1),
(8,'Rome',4,'Rome','روما',1),
(9,'Madrid',5,'Madrid','مدريد',1),
(10,'London',7,'London','لندن',1);

INSERT INTO brands (IdBrand, Title, Description, Image, Active) VALUES
(1,'Apple','Technology brand','apple.png',1),
(2,'Samsung','Electronics brand','samsung.png',1),
(3,'Huawei','Technology brand','huawei.png',1),
(4,'Dell','Computer brand','dell.png',1),
(5,'HP','Computer brand','hp.png',1),
(6,'Nike','Sports brand','nike.png',1),
(7,'Adidas','Sports brand','adidas.png',1),
(8,'Toyota','Car brand','toyota.png',1),
(9,'BMW','Car brand','bmw.png',1),
(10,'Zara','Fashion brand','zara.png',1);

INSERT INTO categories (IdCateg, idparent, TitleEn, TitleFr, TitleAr, Description, Image, idtypecat, Active) VALUES
(1,0,'Electronics','Electronique','إلكترونيات','Electronic products','electronics.jpg',1,1),
(2,0,'Phones','Téléphones','هواتف','Smartphones and phones','phones.jpg',1,1),
(3,0,'Computers','Ordinateurs','حاسوب','Computers','computers.jpg',1,1),
(4,0,'Fashion','Mode','ملابس','Fashion products','fashion.jpg',2,1),
(5,0,'Vehicles','Véhicules','سيارات','Vehicles','cars.jpg',3,1),
(6,0,'Home','Maison','منزل','Home products','home.jpg',4,1),
(7,0,'Beauty','Beauté','جمال','Beauty products','beauty.jpg',5,1),
(8,0,'Sports','Sports','رياضة','Sports products','sports.jpg',6,1),
(9,0,'Books','Livres','كتب','Books','books.jpg',8,1),
(10,0,'Food','Alimentation','غذاء','Food products','food.jpg',9,1);


UPDATE categories
SET idparent = CASE IdCateg
    WHEN 1 THEN 2
    WHEN 2 THEN 0
    WHEN 3 THEN 1
    WHEN 4 THEN 2
    WHEN 5 THEN 1
    WHEN 6 THEN 0
    WHEN 7 THEN 2
    WHEN 8 THEN 1
    WHEN 9 THEN 0
    WHEN 10 THEN 2
END
WHERE IdCateg IN (1,2,3,4,5,6,7,8,9,10);

INSERT INTO users (IdUser, Username, FirstName, LastName, Email, Telephone, Password, IdRole, CreationDate, Active, EmailConfirmed) VALUES
(1,'user1','Ahmed','Ben Ali','ahmed@test.com','20000001','$2y$12$password',1,'2026-07-07 10:00:00',1,1),
(2,'user2','Sarra','Trabelsi','sarra@test.com','20000002','$2y$12$password',1,'2026-07-07 10:01:00',1,1),
(3,'vendor1','Ali','Mansour','ali@shop.com','20000003','$2y$12$password',2,'2026-07-07 10:02:00',1,1),
(4,'vendor2','Meriem','Khalil','meriem@shop.com','20000004','$2y$12$password',2,'2026-07-07 10:03:00',1,1),
(5,'admin','Admin','User','admin@tijara.com','20000005','$2y$12$password',3,'2026-07-07 10:04:00',1,1),
(6,'user6','Hatem','Ali','hatem@test.com','20000006','$2y$12$password',1,'2026-07-07 10:05:00',1,1),
(7,'user7','Amel','Saidi','amel@test.com','20000007','$2y$12$password',1,'2026-07-07 10:06:00',1,1),
(8,'vendor3','Youssef','Kefi','youssef@shop.com','20000008','$2y$12$password',2,'2026-07-07 10:07:00',1,1),
(9,'user9','Nour','Jaziri','nour@test.com','20000009','$2y$12$password',1,'2026-07-07 10:08:00',1,1),
(10,'user10','Lina','Haddad','lina@test.com','20000010','$2y$12$password',1,'2026-07-07 10:09:00',1,1);



-- =========================
-- PRODUCTS
-- =========================
INSERT INTO products
(IdProduct, CodeBarProduct, CodeProduct, ReferenceProduct, TitleProduct, DescriptionProduct, QuantityProduct, ColorProduct, PriceProduct, TvaProduct, IdPricesDelevery, ImageProduct, VideoProduct, IdPrize, IdCateorie, IdUser, IdCountrie, Active)
VALUES
(1,'619000000001','PRD001','REF001','iPhone 15 Pro','Smartphone Apple 256GB',10,'Black','4500','19',1,'iphone15.jpg',NULL,NULL,2,1,1,1),
(2,'619000000002','PRD002','REF002','Samsung Galaxy S24','Smartphone Samsung AMOLED',15,'Gray','3200','19',1,'s24.jpg',NULL,NULL,2,2,1,1),
(3,'619000000003','PRD003','REF003','Laptop HP ProBook','Laptop professionnel',8,'Silver','2800','19',1,'hp.jpg',NULL,NULL,2,3,2,1),
(4,'619000000004','PRD004','REF004','AirPods Pro','Wireless headphones',20,'White','900','19',1,'airpods.jpg',NULL,NULL,2,4,1,1),
(5,'619000000005','PRD005','REF005','Smart Watch','Montre connectée',25,'Black','450','19',1,'watch.jpg',NULL,NULL,2,5,1,1),
(6,'619000000006','PRD006','REF006','Canon Camera','Digital camera',6,'Black','2200','19',1,'canon.jpg',NULL,NULL,2,1,2,1),
(7,'619000000007','PRD007','REF007','PlayStation 5','Gaming console',12,'White','2500','19',1,'ps5.jpg',NULL,NULL,2,2,1,1),
(8,'619000000008','PRD008','REF008','Bluetooth Speaker','Portable speaker',30,'Blue','250','19',1,'speaker.jpg',NULL,NULL,2,3,2,1),
(9,'619000000009','PRD009','REF009','Tablet Android','10 inch tablet',18,'Black','700','19',1,'tablet.jpg',NULL,NULL,2,4,1,1),
(10,'619000000010','PRD010','REF010','Keyboard Gaming','RGB keyboard',40,'Black','180','19',1,'keyboard.jpg',NULL,NULL,2,5,2,1);

-- =========================
-- ADS
-- =========================
INSERT INTO ads
(IdAd,TitleAd,DescriptionAd,DetailsAd,PriceAd,DatePublication,ImageAd,IdCateg,IdUser,IdCountry,LocationAd,Color,Brand,Ownerads,Telephone,Email,Active,Type)
VALUES
(1,'iPhone 15 Pro Sale','New iPhone available','256GB unlocked','4500','2026-07-01','iphone15.jpg',2,1,1,'Tunis','Black','Apple','Aya Store','20764119','aya@gmail.com',1,'annonce'),
(2,'Samsung S24','Samsung phone sale','Brand new','3200','2026-07-02','s24.jpg',2,2,1,'Sousse','Gray','Samsung','Mobile Shop','22000000','shop@gmail.com',1,'annonce'),
(3,'HP Laptop','Professional laptop','8GB RAM','2800','2026-07-03','hp.jpg',3,2,1,'Sfax','Silver','HP','Tech Store','22111111','tech@gmail.com',1,'annonce'),
(4,'AirPods Pro','Original headset','Wireless','900','2026-07-04','airpods.jpg',4,1,1,'Monastir','White','Apple','Aya Store','20764119','aya@gmail.com',1,'annonce'),
(5,'Smart Watch','Connected watch','New model','450','2026-07-05','watch.jpg',5,1,1,'Nabeul','Black','Huawei','Digital Shop','22333333','digital@gmail.com',1,'annonce'),
(6,'Canon Camera','Camera offer','Professional camera','2200','2026-07-05','canon.jpg',2,2,1,'Tunis','Black','Canon','Photo Store','22444444','photo@gmail.com',1,'annonce'),
(7,'PS5 Console','Gaming console','Latest version','2500','2026-07-06','ps5.jpg',2,1,1,'Tunis','White','Sony','Game Store','22555555','game@gmail.com',1,'annonce'),
(8,'Speaker Bluetooth','Portable speaker','High quality','250','2026-07-06','speaker.jpg',3,2,1,'Bizerte','Blue','JBL','Sound Shop','22666666','sound@gmail.com',1,'annonce'),
(9,'Android Tablet','Tablet offer','10 inch screen','700','2026-07-07','tablet.jpg',4,1,1,'Gabes','Black','Lenovo','Tablet Shop','22777777','tablet@gmail.com',1,'annonce'),
(10,'Gaming Keyboard','RGB keyboard','Mechanical keys','180','2026-07-07','keyboard.jpg',5,2,1,'Kairouan','Black','Logitech','PC Store','22888888','pc@gmail.com',1,'annonce');

-- =========================
-- DEALS
-- =========================
INSERT INTO deals
(IdDeal,titleDeal,descriptionDeal,detailsDeal,priceDeal,discountDeal,quantity,datePublication,dateEnd,imageDeal,idtypecat,idCateg,idUser,locationDeal,active,brand)
VALUES
(1,'Summer Phone Deal','Phone discount','Limited offer','3000','10%',5,'2026-07-01','2026-07-20','deal1.jpg',1,2,1,'Tunis',1,'Samsung'),
(2,'Laptop Discount','Laptop promotion','Special price','2500','15%',3,'2026-07-02','2026-07-21','deal2.jpg',1,3,2,'Sousse',1,'HP'),
(3,'Audio Deal','Headphones offer','New products','700','20%',10,'2026-07-03','2026-07-22','deal3.jpg',1,4,1,'Sfax',1,'Apple'),
(4,'Camera Deal','Camera sale','Professional','1900','10%',4,'2026-07-04','2026-07-23','deal4.jpg',1,2,2,'Tunis',1,'Canon'),
(5,'Gaming Deal','Console offer','Gaming pack','2300','5%',8,'2026-07-05','2026-07-24','deal5.jpg',1,2,1,'Nabeul',1,'Sony'),
(6,'Watch Deal','Smart watch offer','Discount','400','10%',20,'2026-07-06','2026-07-25','deal6.jpg',1,5,2,'Monastir',1,'Huawei'),
(7,'Tablet Deal','Tablet promotion','Good price','600','12%',7,'2026-07-06','2026-07-26','deal7.jpg',1,4,1,'Bizerte',1,'Lenovo'),
(8,'Keyboard Deal','PC accessories','Gaming','150','10%',15,'2026-07-07','2026-07-27','deal8.jpg',1,5,2,'Gabes',1,'Logitech'),
(9,'Speaker Deal','Music offer','Bluetooth','200','15%',12,'2026-07-07','2026-07-28','deal9.jpg',1,3,1,'Sousse',1,'JBL'),
(10,'Tech Pack','Complete pack','Electronics','5000','20%',2,'2026-07-07','2026-07-29','deal10.jpg',1,2,2,'Tunis',1,'Tech');

-- =========================
-- PRIZES
-- =========================
INSERT INTO prizes (idPrize,image,title,description,idUser,active,datePublication) VALUES
(1,'gift1.jpg','Gift 1','Electronic gift',1,1,'2026-07-01'),
(2,'gift2.jpg','Gift 2','Phone gift',2,1,'2026-07-02'),
(3,'gift3.jpg','Gift 3','Accessory gift',1,1,'2026-07-03'),
(4,'gift4.jpg','Gift 4','Camera gift',2,1,'2026-07-04'),
(5,'gift5.jpg','Gift 5','Gaming gift',1,1,'2026-07-05'),
(6,'gift6.jpg','Gift 6','Watch gift',2,1,'2026-07-06'),
(7,'gift7.jpg','Gift 7','Tablet gift',1,1,'2026-07-07'),
(8,'gift8.jpg','Gift 8','Speaker gift',2,1,'2026-07-07'),
(9,'gift9.jpg','Gift 9','Keyboard gift',1,1,'2026-07-07'),
(10,'gift10.jpg','Gift 10','Tech gift',2,1,'2026-07-07');

-- =========================
-- FEATURES
-- =========================
INSERT INTO features (IdFeature,TitleFeature,DescriptionFeature,UnitFeature,Active) VALUES
(1,'RAM','Memory size','GB',1),
(2,'Storage','Storage capacity','GB',1),
(3,'Color','Product color','',1),
(4,'Battery','Battery capacity','mAh',1),
(5,'Screen','Display size','inch',1),
(6,'Camera','Camera resolution','MP',1),
(7,'Weight','Product weight','Kg',1),
(8,'Processor','CPU model','',1),
(9,'Material','Product material','',1),
(10,'Warranty','Warranty duration','Year',1);

INSERT INTO featurecategories (IdFC,IdCategory,IdFeature) VALUES
(1,2,1),(2,2,2),(3,2,3),(4,3,4),(5,3,5),
(6,4,6),(7,4,7),(8,5,8),(9,5,9),(10,5,10);

INSERT INTO featuresvalues (IdFV,ValueFeature,IdFeature,Active) VALUES
(1,'8GB',1,1),(2,'256GB',2,1),(3,'Black',3,1),(4,'5000mAh',4,1),
(5,'6.5 inch',5,1),(6,'48MP',6,1),(7,'1.5Kg',7,1),
(8,'Intel i7',8,1),(9,'Aluminium',9,1),(10,'2 Years',10,1);



-- =========================
-- TRANSPORTS
-- =========================
INSERT INTO transports
(IdTransport, Name, Logo, Phone, Email, DeliveryFee, FreeFrom, Zones, Active)
VALUES
(1,'Aramex','aramex.png','70123456','contact@aramex.tn',8.000,100.000,'Tunisie',1),
(2,'DHL','dhl.png','71234567','contact@dhl.tn',10.000,150.000,'Tunisie',1),
(3,'RapidPost','rapidpost.png','71345678','contact@rapidpost.tn',5.000,80.000,'Tunisie',1),
(4,'FedEx','fedex.png','71456789','contact@fedex.tn',12.000,200.000,'Tunisie',1),
(5,'Yalidine','yalidine.png','71567890','contact@yalidine.tn',6.000,120.000,'Tunisie',1),
(6,'Tunisia Express','tex.png','71678901','contact@tex.tn',7.000,100.000,'Tunisie',1),
(7,'Sama Delivery','sama.png','71789012','contact@sama.tn',4.000,70.000,'Sousse,Tunis',1),
(8,'Best Delivery','best.png','71890123','contact@best.tn',9.000,140.000,'Tunisie',1),
(9,'Smart Delivery','smart.png','71901234','contact@smart.tn',5.500,90.000,'Tunisie',1),
(10,'Express Plus','express.png','72012345','contact@express.tn',11.000,180.000,'Tunisie',1);

-- =========================
-- ORDERS
-- =========================
INSERT INTO orders
(IdOrder, IdUser, IdDeal, IdState, DateTimeCommand, Active)
VALUES
(1,1,NULL,1,'2026-07-01 10:00:00',1),
(2,2,NULL,2,'2026-07-02 11:00:00',1),
(3,3,NULL,3,'2026-07-03 12:00:00',1),
(4,4,NULL,4,'2026-07-04 13:00:00',1),
(5,5,NULL,5,'2026-07-05 14:00:00',1),
(6,1,NULL,1,'2026-07-06 15:00:00',1),
(7,2,NULL,2,'2026-07-06 16:00:00',1),
(8,3,NULL,3,'2026-07-06 17:00:00',1),
(9,4,NULL,4,'2026-07-07 09:00:00',1),
(10,5,NULL,5,'2026-07-07 10:00:00',1);

-- =========================
-- ORDER DETAILS
-- =========================
INSERT INTO orderdetails
(IdOrderDeatils, IdUser, IdProduct, IdState, IdCountry, IdOrder, ZipCode, Address, Email, Telephone, FirstName, LastName, Quantity, TotalAmount, DateTimeCommand, Active)
VALUES
(1,1,1,1,1,1,4000,'Sousse Centre','user1@mail.com','20000001','Ahmed','Ben Ali',1,'4500','2026-07-01 10:00:00',1),
(2,2,2,2,1,2,1000,'Tunis Centre','user2@mail.com','20000002','Ali','Trabelsi',2,'8000','2026-07-02 11:00:00',1),
(3,3,1,3,1,3,3000,'Sfax Centre','user3@mail.com','20000003','Sara','Kefi',1,'4500','2026-07-03 12:00:00',1),
(4,4,2,4,1,4,5000,'Monastir','user4@mail.com','20000004','Aya','Attia',1,'3200','2026-07-04 13:00:00',1),
(5,5,1,5,1,5,8000,'Gabes','user5@mail.com','20000005','Omar','Jaziri',3,'13500','2026-07-05 14:00:00',1),
(6,1,2,1,1,6,4000,'Sousse','user1@mail.com','20000001','Ahmed','Ben Ali',1,'3200','2026-07-06 15:00:00',1),
(7,2,1,2,1,7,1000,'Tunis','user2@mail.com','20000002','Ali','Trabelsi',1,'4500','2026-07-06 16:00:00',1),
(8,3,2,3,1,8,3000,'Sfax','user3@mail.com','20000003','Sara','Kefi',2,'6400','2026-07-06 17:00:00',1),
(9,4,1,4,1,9,5000,'Monastir','user4@mail.com','20000004','Aya','Attia',1,'4500','2026-07-07 09:00:00',1),
(10,5,2,5,1,10,8000,'Gabes','user5@mail.com','20000005','Omar','Jaziri',1,'3200','2026-07-07 10:00:00',1);

-- =========================
-- PAYMENTS
-- =========================
INSERT INTO payments
(IdPayment, IdUser, IdOrder, Amount, Method, Status, Reference, TransactionId)
VALUES
(1,1,1,4500.000,'card','paid','PAY001','TX001'),
(2,2,2,8000.000,'cash','pending','PAY002','TX002'),
(3,3,3,4500.000,'card','paid','PAY003','TX003'),
(4,4,4,3200.000,'bank','paid','PAY004','TX004'),
(5,5,5,13500.000,'card','paid','PAY005','TX005'),
(6,1,6,3200.000,'cash','pending','PAY006','TX006'),
(7,2,7,4500.000,'card','paid','PAY007','TX007'),
(8,3,8,6400.000,'bank','paid','PAY008','TX008'),
(9,4,9,4500.000,'card','pending','PAY009','TX009'),
(10,5,10,3200.000,'cash','paid','PAY010','TX010');

-- =========================
-- DELIVERIES
-- =========================
INSERT INTO deliveries
(IdDelivery, IdOrder, IdTransport, TrackingNumber, Status, AddressLine, City, PostalCode, Phone, DeliveryFee)
VALUES
(1,1,1,'TRK0001','delivered','Sousse Centre','Sousse','4000','20000001',8.000),
(2,2,2,'TRK0002','pending','Tunis Centre','Tunis','1000','20000002',10.000),
(3,3,3,'TRK0003','delivered','Sfax Centre','Sfax','3000','20000003',5.000),
(4,4,4,'TRK0004','shipping','Monastir','Monastir','5000','20000004',12.000),
(5,5,5,'TRK0005','pending','Gabes','Gabes','8000','20000005',6.000),
(6,6,1,'TRK0006','shipping','Sousse','Sousse','4000','20000001',8.000),
(7,7,2,'TRK0007','delivered','Tunis','Tunis','1000','20000002',10.000),
(8,8,3,'TRK0008','pending','Sfax','Sfax','3000','20000003',5.000),
(9,9,4,'TRK0009','shipping','Monastir','Monastir','5000','20000004',12.000),
(10,10,5,'TRK0010','pending','Gabes','Gabes','8000','20000005',6.000);

-- =========================
-- INVOICES
-- =========================
INSERT INTO invoices
(IdInvoice, Number, IdOrder, IdUser, IdVendor, Subtotal, Tax, DeliveryFee, Total, Status)
VALUES
(1,'INV-0001',1,1,NULL,4500.000,855.000,8.000,5363.000,'paid'),
(2,'INV-0002',2,2,NULL,8000.000,1520.000,10.000,9530.000,'issued'),
(3,'INV-0003',3,3,NULL,4500.000,855.000,5.000,5360.000,'paid'),
(4,'INV-0004',4,4,NULL,3200.000,608.000,12.000,3820.000,'paid'),
(5,'INV-0005',5,5,NULL,13500.000,2565.000,6.000,16071.000,'paid'),
(6,'INV-0006',6,1,NULL,3200.000,608.000,8.000,3816.000,'issued'),
(7,'INV-0007',7,2,NULL,4500.000,855.000,10.000,5365.000,'paid'),
(8,'INV-0008',8,3,NULL,6400.000,1216.000,5.000,7621.000,'paid'),
(9,'INV-0009',9,4,NULL,4500.000,855.000,12.000,5367.000,'issued'),
(10,'INV-0010',10,5,NULL,3200.000,608.000,6.000,3814.000,'paid');

-- =========================
-- WALLETS
-- =========================
INSERT INTO wallets
(IdWallet, IdUser, ICN, NbrJeton, MoneyBudget, MoneyBlocked, MoneyTransfered, Active)
VALUES
(1,1,'ICN001',100,500.000,0.000,100.000,1),
(2,2,'ICN002',200,800.000,50.000,200.000,1),
(3,3,'ICN003',150,600.000,20.000,150.000,1),
(4,4,'ICN004',300,1200.000,100.000,300.000,1),
(5,5,'ICN005',250,900.000,0.000,250.000,1),
(6,1,'ICN006',50,200.000,0.000,50.000,1),
(7,2,'ICN007',80,350.000,10.000,80.000,1),
(8,3,'ICN008',120,450.000,0.000,120.000,1),
(9,4,'ICN009',90,300.000,20.000,90.000,1),
(10,5,'ICN010',70,250.000,0.000,70.000,1);

-- seed_part4.sql
SET FOREIGN_KEY_CHECKS=0;
START TRANSACTION;
INSERT INTO reviews (IdReview,IdUser,TargetType,TargetId,Rating,Comment,Active) VALUES (1,1,'product',1,5,'Excellent',1),(2,2,'product',2,4,'Very good',1),(3,3,'ad',1,5,'Trusted seller',1),(4,4,'product',1,3,'Average',1),(5,5,'deal',1,5,'Great deal',1),(6,1,'product',2,4,'Nice',1),(7,2,'ad',2,5,'Recommended',1),(8,3,'product',1,4,'Good',1),(9,4,'deal',2,5,'Perfect',1),(10,5,'product',2,5,'Amazing',1);
INSERT INTO ratings (IdRating,IdUser,Rating,CommentRating,Date,TableName,IdTable,Active) VALUES (1,1,5,'Excellent','2026-07-01','products',1,1),(2,2,4,'Good','2026-07-02','products',2,1),(3,3,5,'Top','2026-07-03','ads',1,1),(4,4,3,'OK','2026-07-04','products',1,1),(5,5,5,'Perfect','2026-07-05','deals',1,1),(6,1,4,'Nice','2026-07-06','products',2,1),(7,2,5,'Fast','2026-07-06','ads',2,1),(8,3,4,'Good','2026-07-06','products',1,1),(9,4,5,'Excellent','2026-07-07','deals',2,1),(10,5,5,'Super','2026-07-07','products',2,1);
INSERT INTO notifications (IdNotification,Title,Description,Date,Type,IsRead,IdUser) VALUES (1,'Welcome','Welcome to Tijara','2026-07-01','system',0,1),(2,'Order','Order confirmed','2026-07-02','order',1,2),(3,'Payment','Payment received','2026-07-03','payment',0,3),(4,'Delivery','Order shipped','2026-07-04','delivery',0,4),(5,'Promo','New offers','2026-07-05','marketing',1,5),(6,'Review','Leave a review','2026-07-06','review',0,1),(7,'Wallet','Wallet updated','2026-07-06','wallet',1,2),(8,'Message','New message','2026-07-06','chat',0,3),(9,'Security','Password changed','2026-07-07','security',1,4),(10,'Coupon','Coupon available','2026-07-07','coupon',0,5);
INSERT INTO likes (IdLike,IdUser,TargetType,TargetId) VALUES (1,1,'product',1),(2,2,'product',2),(3,3,'ad',1),(4,4,'deal',1),(5,5,'product',2),(6,1,'ad',2),(7,2,'deal',2),(8,3,'product',1),(9,4,'product',2),(10,5,'ad',1);
INSERT INTO wishlistads (IdWish,IdUser,IdAd) VALUES (1,1,1),(2,2,2),(3,3,3),(4,4,4),(5,5,5),(6,1,6),(7,2,7),(8,3,8),(9,4,9),(10,5,10);
INSERT INTO wishlistdeals (IdWish,IdUser,IdDeal) VALUES (1,1,1),(2,2,2),(3,3,3),(4,4,4),(5,5,5),(6,1,6),(7,2,7),(8,3,8),(9,4,9),(10,5,10);
INSERT INTO productwishlist (IdWishlistProduct,IdUser,IdProduct,Liked) VALUES (1,1,1,1),(2,2,2,1),(3,3,1,1),(4,4,2,1),(5,5,1,1),(6,1,2,1),(7,2,1,1),(8,3,2,1),(9,4,1,1),(10,5,2,1);
INSERT INTO adlikes (IdLike,IdAd,IdUser) VALUES (1,1,1),(2,2,2),(3,3,3),(4,4,4),(5,5,5),(6,6,1),(7,7,2),(8,8,3),(9,9,4),(10,10,5);
COMMIT;
SET FOREIGN_KEY_CHECKS=1;

-- =========================
-- Update products (IdProduct 11 -> 31)
-- =========================
UPDATE `products` SET `IdFeature`=1,  `IdFV`=1  WHERE `IdProduct`=11;
UPDATE `products` SET `IdFeature`=2,  `IdFV`=2  WHERE `IdProduct`=12;
UPDATE `products` SET `IdFeature`=5,  `IdFV`=5  WHERE `IdProduct`=13;
UPDATE `products` SET `IdFeature`=7,  `IdFV`=7  WHERE `IdProduct`=14;
UPDATE `products` SET `IdFeature`=10, `IdFV`=10 WHERE `IdProduct`=15;
UPDATE `products` SET `IdFeature`=6,  `IdFV`=6  WHERE `IdProduct`=16;
UPDATE `products` SET `IdFeature`=9,  `IdFV`=9  WHERE `IdProduct`=17;
UPDATE `products` SET `IdFeature`=3,  `IdFV`=3  WHERE `IdProduct`=18;
UPDATE `products` SET `IdFeature`=5,  `IdFV`=5  WHERE `IdProduct`=19;
UPDATE `products` SET `IdFeature`=3,  `IdFV`=3  WHERE `IdProduct`=20;

UPDATE `products` SET `IdFeature`=1,  `IdFV`=1  WHERE `IdProduct`=21;
UPDATE `products` SET `IdFeature`=2,  `IdFV`=2  WHERE `IdProduct`=22;
UPDATE `products` SET `IdFeature`=5,  `IdFV`=5  WHERE `IdProduct`=23;
UPDATE `products` SET `IdFeature`=7,  `IdFV`=7  WHERE `IdProduct`=24;
UPDATE `products` SET `IdFeature`=10, `IdFV`=10 WHERE `IdProduct`=25;
UPDATE `products` SET `IdFeature`=6,  `IdFV`=6  WHERE `IdProduct`=26;
UPDATE `products` SET `IdFeature`=9,  `IdFV`=9  WHERE `IdProduct`=27;
UPDATE `products` SET `IdFeature`=3,  `IdFV`=3  WHERE `IdProduct`=28;
UPDATE `products` SET `IdFeature`=5,  `IdFV`=5  WHERE `IdProduct`=29;
UPDATE `products` SET `IdFeature`=3,  `IdFV`=3  WHERE `IdProduct`=30;

UPDATE `products` SET `IdFeature`=1,  `IdFV`=1  WHERE `IdProduct`=31;

-- =========================
-- Update ads (IdAd 11 -> 31)
-- =========================
UPDATE `ads` SET `IdFeature`=1,  `IdFV`=1  WHERE `IdAd`=11;
UPDATE `ads` SET `IdFeature`=2,  `IdFV`=2  WHERE `IdAd`=12;
UPDATE `ads` SET `IdFeature`=5,  `IdFV`=5  WHERE `IdAd`=13;
UPDATE `ads` SET `IdFeature`=7,  `IdFV`=7  WHERE `IdAd`=14;
UPDATE `ads` SET `IdFeature`=10, `IdFV`=10 WHERE `IdAd`=15;
UPDATE `ads` SET `IdFeature`=6,  `IdFV`=6  WHERE `IdAd`=16;
UPDATE `ads` SET `IdFeature`=9,  `IdFV`=9  WHERE `IdAd`=17;
UPDATE `ads` SET `IdFeature`=3,  `IdFV`=3  WHERE `IdAd`=18;
UPDATE `ads` SET `IdFeature`=5,  `IdFV`=5  WHERE `IdAd`=19;
UPDATE `ads` SET `IdFeature`=3,  `IdFV`=3  WHERE `IdAd`=20;

UPDATE `ads` SET `IdFeature`=1,  `IdFV`=1  WHERE `IdAd`=21;
UPDATE `ads` SET `IdFeature`=2,  `IdFV`=2  WHERE `IdAd`=22;
UPDATE `ads` SET `IdFeature`=5,  `IdFV`=5  WHERE `IdAd`=23;
UPDATE `ads` SET `IdFeature`=7,  `IdFV`=7  WHERE `IdAd`=24;
UPDATE `ads` SET `IdFeature`=10, `IdFV`=10 WHERE `IdAd`=25;
UPDATE `ads` SET `IdFeature`=6,  `IdFV`=6  WHERE `IdAd`=26;
UPDATE `ads` SET `IdFeature`=9,  `IdFV`=9  WHERE `IdAd`=27;
UPDATE `ads` SET `IdFeature`=3,  `IdFV`=3  WHERE `IdAd`=28;
UPDATE `ads` SET `IdFeature`=5,  `IdFV`=5  WHERE `IdAd`=29;
UPDATE `ads` SET `IdFeature`=3,  `IdFV`=3  WHERE `IdAd`=30;

UPDATE `ads` SET `IdFeature`=1,  `IdFV`=1  WHERE `IdAd`=31;


COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
