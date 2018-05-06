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
  `data_prognoza` datetime NOT NULL,
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
  PRIMARY KEY (`id_runda`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `seturi_note` (
  `id_set_note` int(11) NOT NULL,
  `valoare_nota` int(11) NOT NULL,
  `id_student` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `inbox` (
  `id_mesaj` int(11) NOT NULL AUTO_INCREMENT,
  `nume` varchar(100) NOT NULL,
  `prenume` varchar(100) NOT NULL,
  `an` int(11) NOT NULL,
  `grupa` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mesaj` varchar(500) NOT NULL,
  `data_mesaj` datetime NOT NULL,
  PRIMARY KEY (`id_mesaj`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

