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
INSERT INTO `accounts` (`id`,`email`,`parola`,`nume`,`prenume`,`an`,`semestru`,`grupa`,`admin`) VALUES (8,'horia.popa@info.uaic.ro','123','Popa','Horia',2,2,'B6',0);
INSERT INTO `accounts` (`id`,`email`,`parola`,`nume`,`prenume`,`an`,`semestru`,`grupa`,`admin`) VALUES (9,'bucur.mihai@info.uaic.ro','123','Bucur','Mihai',2,2,'A1',0);
INSERT INTO `accounts` (`id`,`email`,`parola`,`nume`,`prenume`,`an`,`semestru`,`grupa`,`admin`) VALUES (10,'dragomir.alexandru@info.uaic.ro','123','Dragomir','Alexandru',2,2,'A5',0);
INSERT INTO `accounts` (`id`,`email`,`parola`,`nume`,`prenume`,`an`,`semestru`,`grupa`,`admin`) VALUES (11,'silviu.barbu@info.uaic.ro','123','Barbu','Silviu',2,2,'A2',0);
INSERT INTO `accounts` (`id`,`email`,`parola`,`nume`,`prenume`,`an`,`semestru`,`grupa`,`admin`) VALUES (12,'ion.paraschiv@info.uaic.ro','123','Paraschiv','Ion',2,2,'B2',0);
INSERT INTO `accounts` (`id`,`email`,`parola`,`nume`,`prenume`,`an`,`semestru`,`grupa`,`admin`) VALUES (13,'marius.cristian@info.uaic.ro','123','Cristian','Marius',2,2,'A3',0);
INSERT INTO `accounts` (`id`,`email`,`parola`,`nume`,`prenume`,`an`,`semestru`,`grupa`,`admin`) VALUES (14,'marian.nastase@info.uaic.ro','123','Nastase','Marian',2,2,'A6',0);
INSERT INTO `accounts` (`id`,`email`,`parola`,`nume`,`prenume`,`an`,`semestru`,`grupa`,`admin`) VALUES (15,'flavio.marinescu@info.uaic.ro','123','Marinescu','Flavio',2,2,'A5',0);
INSERT INTO `accounts` (`id`,`email`,`parola`,`nume`,`prenume`,`an`,`semestru`,`grupa`,`admin`) VALUES (16,'patriciu.stefanel@info.uaic.ro','123','Patriciu','Stefanel',2,2,'B4',0);

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

INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (1,1,1,5,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (2,1,3,7,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (3,1,4,8,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (4,1,5,5,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (5,1,6,6,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (6,1,7,7,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (7,1,8,8,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (8,1,9,5,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (9,1,10,6,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (10,1,11,5,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (11,1,12,8,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (12,1,13,7,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (13,1,14,9,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (14,1,15,7,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (15,1,16,9,'2018-06-11');

INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (16,2,1,5,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (17,2,3,7,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (18,2,4,8,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (19,2,5,5,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (20,2,6,6,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (21,2,7,7,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (22,2,8,8,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (23,2,9,5,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (24,2,10,6,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (25,2,11,5,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (26,2,12,8,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (27,2,13,7,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (28,2,14,9,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (29,2,15,7,'2018-06-11');
INSERT INTO `prognoze` (`id_prognoza`,`id_runda`,`id_student`,`prognoza_student`,`data_prognoza`) VALUES (30,2,16,9,'2018-06-11');

