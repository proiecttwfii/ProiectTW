CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `parola` varchar(100) NOT NULL,
  `nume` varchar(100) NOT NULL,
  `prenume` varchar(100) NOT NULL,
  `an` int(11) NOT NULL,
  `semestru` int(11) NOT NULL,
  `grupa` varchar(35) NOT NULL,
  `admin` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

CREATE TABLE `prognoze` (
  `id_prognoza` int(11) NOT NULL AUTO_INCREMENT,
  `id_runda` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `prognoza_student` double NOT NULL,
  `data_prognoza` date NOT NULL,
  PRIMARY KEY (`id_prognoza`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `materie` (
  `id_materie` int(11) NOT NULL AUTO_INCREMENT,
  `nume_materie` varchar(100) NOT NULL,
  `an` int(11) NOT NULL,
  `semestru` int(11) NOT NULL,
  PRIMARY KEY (`id_materie`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `runde` (
  `id_runda` int(11) NOT NULL AUTO_INCREMENT,
  `id_materie` int(11) NOT NULL,
  `nume_runda` varchar(100) NOT NULL,
  `id_set_note` int(11) NOT NULL,
  `runda_activa` tinyint(4) NOT NULL,
  `data_stop_runda` date DEFAULT NULL,
  PRIMARY KEY (`id_runda`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `seturi_note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_set_note` int(11) NOT NULL,
  `email_student` varchar(255) NOT NULL,
  `valoare_nota` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=169 DEFAULT CHARSET=latin1;

CREATE TABLE `inbox` (
  `id_mesaj` int(11) NOT NULL AUTO_INCREMENT,
  `nume` varchar(100) NOT NULL,
  `prenume` varchar(100) NOT NULL,
  `an` int(11) NOT NULL,
  `grupa` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `data_mesaj` date NOT NULL,
  PRIMARY KEY (`id_mesaj`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `accounts` (`id`,`email`,`parola`,`nume`,`prenume`,`an`,`semestru`,`grupa`,`admin`) VALUES (1,'ion.ionescu@info.uaic.ro','123','Ionescu','Ion Marian',2,2,'A4',0);
INSERT INTO `accounts` (`id`,`email`,`parola`,`nume`,`prenume`,`an`,`semestru`,`grupa`,`admin`) VALUES (2,'admin@info.uaic.ro','123','-','-',0,0,'-',1);
INSERT INTO `accounts` (`id`,`email`,`parola`,`nume`,`prenume`,`an`,`semestru`,`grupa`,`admin`) VALUES (3,'mihaela.burban@info.uaic.ro','123','Burban','Mihaela',2,2,'A6',0);
INSERT INTO `accounts` (`id`,`email`,`parola`,`nume`,`prenume`,`an`,`semestru`,`grupa`,`admin`) VALUES (4,'mihai.popescu@info.uaic.ro','123','Popescu','Mihai',2,2,'B1',0);
INSERT INTO `accounts` (`id`,`email`,`parola`,`nume`,`prenume`,`an`,`semestru`,`grupa`,`admin`) VALUES (5,'mirela.popa@info.uaic.ro','123','Popa','Mirela',2,2,'B1',0);
INSERT INTO `accounts` (`id`,`email`,`parola`,`nume`,`prenume`,`an`,`semestru`,`grupa`,`admin`) VALUES (6,'andrei.aionanei@info.uaic.ro','123','Aioanei','Andrei',2,2,'B5',0);
INSERT INTO `accounts` (`id`,`email`,`parola`,`nume`,`prenume`,`an`,`semestru`,`grupa`,`admin`) VALUES (7,'ioan.maria@info.uaic.ro','123','Maria','Ioan',2,2,'B4',0);

INSERT INTO `inbox` (`id_mesaj`,`nume`,`prenume`,`an`,`grupa`,`email`,`data_mesaj`) VALUES (1,'Zaharia','Rober',2,'A3','robert.zaharia@info.uaic.ro','2018-05-23');
INSERT INTO `inbox` (`id_mesaj`,`nume`,`prenume`,`an`,`grupa`,`email`,`data_mesaj`) VALUES (2,'Eminovici','Andreea',2,'B2','andreea.eminovici@info.uaic.ro','2018-04-13');
INSERT INTO `inbox` (`id_mesaj`,`nume`,`prenume`,`an`,`grupa`,`email`,`data_mesaj`) VALUES (3,'Postolache','Vlad',2,'B7','vlad.postolache@info.uaic.ro','2018-04-06');

INSERT INTO `materie` (`id_materie`,`nume_materie`,`an`,`semestru`) VALUES (1,'Retele de calculatoare',2,1);
INSERT INTO `materie` (`id_materie`,`nume_materie`,`an`,`semestru`) VALUES (2,'Baze de date',2,1);
INSERT INTO `materie` (`id_materie`,`nume_materie`,`an`,`semestru`) VALUES (4,'Algoritmica grafurilor',2,1);
INSERT INTO `materie` (`id_materie`,`nume_materie`,`an`,`semestru`) VALUES (6,'Principii ale limbajelor de programare ',2,1);
INSERT INTO `materie` (`id_materie`,`nume_materie`,`an`,`semestru`) VALUES (7,'Algoritmi genetici',2,1);
INSERT INTO `materie` (`id_materie`,`nume_materie`,`an`,`semestru`) VALUES (11,'Pedagogie II ',2,1);
INSERT INTO `materie` (`id_materie`,`nume_materie`,`an`,`semestru`) VALUES (12,'Tehnologii WEB',2,2);
INSERT INTO `materie` (`id_materie`,`nume_materie`,`an`,`semestru`) VALUES (18,'Introducere in criptografie',2,2);
INSERT INTO `materie` (`id_materie`,`nume_materie`,`an`,`semestru`) VALUES (22,'Didactica informaticii',2,2);
INSERT INTO `materie` (`id_materie`,`nume_materie`,`an`,`semestru`) VALUES (3,'Limbaje formale, automate si compilatoare',2,1);
INSERT INTO `materie` (`id_materie`,`nume_materie`,`an`,`semestru`) VALUES (5,'Calculabilitate, decidabilitate si complexitate ',2,1);
INSERT INTO `materie` (`id_materie`,`nume_materie`,`an`,`semestru`) VALUES (8,'Limba engleza III',2,1);
INSERT INTO `materie` (`id_materie`,`nume_materie`,`an`,`semestru`) VALUES (9,'Sport',2,1);
INSERT INTO `materie` (`id_materie`,`nume_materie`,`an`,`semestru`) VALUES (10,'	Programare competitiva III',2,1);
INSERT INTO `materie` (`id_materie`,`nume_materie`,`an`,`semestru`) VALUES (13,'Programare avansata',2,2);
INSERT INTO `materie` (`id_materie`,`nume_materie`,`an`,`semestru`) VALUES (14,'Ingineria Programarii',2,2);
INSERT INTO `materie` (`id_materie`,`nume_materie`,`an`,`semestru`) VALUES (15,'Practica SGBD',2,2);
INSERT INTO `materie` (`id_materie`,`nume_materie`,`an`,`semestru`) VALUES (16,'Programare functionala ',2,2);
INSERT INTO `materie` (`id_materie`,`nume_materie`,`an`,`semestru`) VALUES (17,'Modele continue si Matlab ',2,2);
INSERT INTO `materie` (`id_materie`,`nume_materie`,`an`,`semestru`) VALUES (19,'Limba engleza IV',2,2);
INSERT INTO `materie` (`id_materie`,`nume_materie`,`an`,`semestru`) VALUES (20,'Sport',2,2);
INSERT INTO `materie` (`id_materie`,`nume_materie`,`an`,`semestru`) VALUES (21,'Programare competitiva IV',2,2);

INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (1,1,1,7,'2018-03-20');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (2,1,2,5,'2018-06-20');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (3,2,1,8.5,'2018-06-20');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (4,3,3,9,'2018-09-20');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (5,3,1,8,'2018-09-20');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (6,4,5,6,'2018-09-20');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (7,4,1,9,'2018-08-20');

INSERT INTO `runde` (`id_runda`,`id_materie`,`nume_runda`,`id_set_note`, `runda_activa`,`data_stop_runda`) VALUES (1,15,'Test 1 ',2, 1, '2018-03-20');
INSERT INTO `runde` (`id_runda`,`id_materie`,`nume_runda`,`id_set_note`, `runda_activa`,`data_stop_runda`) VALUES (2,17,'Test 1',3, 0, '2018-03-20');
INSERT INTO `runde` (`id_runda`,`id_materie`,`nume_runda`,`id_set_note`, `runda_activa`,`data_stop_runda`) VALUES (3,19,'Eseu',4, 1, '2018-03-20');
INSERT INTO `runde` (`id_runda`,`id_materie`,`nume_runda`,`id_set_note`, `runda_activa`,`data_stop_runda`) VALUES (4,17,'Test 2',5, 0, '2018-03-20');
