
CREATE TABLE `csomagoloanyag` (
  `ID` int(11) NOT NULL,
  `TIpus` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `Mennyiseg` float DEFAULT NULL,
  `Megjegyzes` varchar(2000) CHARACTER SET utf8 DEFAULT NULL,
  `Datum` date DEFAULT NULL,
  `Szamlaszam` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `Forgalom` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `Deleted` int(11) DEFAULT '0',
  `MegrendelesTetelID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `faanyag` (
  `ID` int(11) NOT NULL,
  `Fatipus` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `Mennyiseg` float DEFAULT NULL,
  `Beszallito` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `Szamlaszam` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `Szallitolevelszam` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `Datum` date DEFAULT NULL,
  `Megjegyzes` varchar(2000) CHARACTER SET utf8 DEFAULT NULL,
  `Nedvesseg` float DEFAULT NULL,
  `Forgalom` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `Deleted` int(11) DEFAULT '0',
  `FaanyagID` int(11) DEFAULT NULL,
  `MegrendelesTetelID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `megrendeles` (
  `ID` int(11) NOT NULL,
  `RogzitesDatum` date DEFAULT NULL,
  `Felvette` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `RogzitetteID` int(11) DEFAULT NULL,
  `Tipus` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `MegrendeloID` int(11) DEFAULT NULL,
  `Statusz` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `SzallitasVarhatoDatuma` date DEFAULT NULL,
  `SzallitasTenylegesDatuma` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `Vegosszeg` float DEFAULT NULL,
  `Penznem` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `FizetesiHatarido` date DEFAULT NULL,
  `FizetesStatusza` varchar(45) CHARACTER SET utf8 DEFAULT 'fizetésre vár',
  `Szamlaszam` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `Fuvardij` float DEFAULT NULL,
  `Megjegyzes` mediumtext CHARACTER SET utf8,
  `KertDatum` date DEFAULT NULL,
  `MegrendeloNev` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `MegrendeloCim` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `MegrendeloTel` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `KapcsolattartoNev` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `KapcsolattartoTel` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `SzallitasiCim` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `Prioritas` int(11) DEFAULT NULL,
  `Deleted` int(11) DEFAULT '0',
  `SzallitasStatusza` varchar(45) CHARACTER SET utf8 DEFAULT 'gyártás alatt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `megrendeles_tetel` (
  `ID` int(11) NOT NULL,
  `MegrendelesID` int(11) DEFAULT NULL,
  `Fafaj` varchar(45) DEFAULT NULL,
  `Hossz` varchar(45) DEFAULT NULL,
  `Huratmero` varchar(45) DEFAULT NULL,
  `Csomagolas` varchar(45) DEFAULT NULL,
  `Mennyiseg` float DEFAULT NULL,
  `MennyisegStd` float DEFAULT NULL,
  `Nedvesseg` varchar(45) DEFAULT NULL,
  `Deleted` int(11) DEFAULT '0',
  `GyartasStatusza` varchar(45) DEFAULT NULL,
  `GyartasDatuma` date DEFAULT NULL,
  `GyartasVarhatoDatuma` date DEFAULT NULL,
  `Ar` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `megrendelo` (
  `ID` int(11) NOT NULL,
  `MegrendeloNev` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `Kepviselo` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `Adoszam` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `Telefonszam` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `Fax` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `Email` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `SzamlazasiCim` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `SzallitasiCim` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `Jelszo` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `RegisztraltDatum` datetime DEFAULT NULL,
  `UtolsoBelepes` datetime DEFAULT NULL,
  `Aktiv` int(11) DEFAULT '1',
  `Deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `naplo` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Timestamp` datetime DEFAULT NULL,
  `Action` varchar(2000) CHARACTER SET utf8 DEFAULT NULL,
  `OldValue` varchar(2000) CHARACTER SET utf8 DEFAULT NULL,
  `NewValue` varchar(2000) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `UserName` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `TeljesNev` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `Password` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `Email` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `LastLogin` datetime DEFAULT NULL,
  `Jogok` varchar(2000) CHARACTER SET utf8 DEFAULT NULL,
  `Aktiv` int(11) DEFAULT '1',
  `Deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



ALTER TABLE `csomagoloanyag`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `faanyag`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `megrendeles`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `megrendeles_tetel`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `megrendelo`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `naplo`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `csomagoloanyag`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `faanyag`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `megrendeles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `megrendeles_tetel`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `megrendelo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
ALTER TABLE `naplo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;


ALTER TABLE `megrendeles`
  ADD COLUMN `FizetesDatuma` DATE NULL AFTER `FizetesiHatarido`;

ALTER TABLE `megrendeles`
  ADD COLUMN `SzallitolevelSzam` VARCHAR(45) NULL AFTER `SzallitasStatusza`,
  ADD COLUMN `CMR` VARCHAR(45) NULL AFTER `SzallitolevelSzam`,
  ADD COLUMN `EKAER` VARCHAR(45) NULL AFTER `CMR`;

ALTER TABLE `megrendeles`
  ADD COLUMN `Fuvarozo` VARCHAR(45) NULL AFTER `EKAER`;

ALTER TABLE `faanyag`
  ADD COLUMN `CMR` VARCHAR(45) NULL AFTER `MegrendelesTetelID`,
  ADD COLUMN `EKAER` VARCHAR(45) NULL AFTER `CMR`,
  ADD COLUMN `Fuvarozo` VARCHAR(45) NULL AFTER `EKAER`;

ALTER TABLE `nemestrinus`.`megrendeles`
  ADD COLUMN `Gyarto` VARCHAR(45) NULL DEFAULT 'Ihartü' AFTER `Fuvarozo`,
  ADD COLUMN `KulsoGyartasStatusza` VARCHAR(45) NULL DEFAULT 'gyártásra vár' AFTER `Gyarto`;

CREATE TABLE `nemestrinus`.`arlista` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `Fafaj` VARCHAR(45) NULL,
  `Csomagolas` VARCHAR(45) NULL,
  `Ar` FLOAT NULL,
  `Penznem` VARCHAR(45) NULL DEFAULT 'HUF',
  PRIMARY KEY (`ID`));

ALTER TABLE `nemestrinus`.`arlista`
  ADD COLUMN `Tipus` VARCHAR(45) NULL DEFAULT 'lakossagi' AFTER `Penznem`;

--
-- Beszallitok kulon kezelese
--

CREATE TABLE `beszallito` (
  `ID` int(11) NOT NULL,
  `Cegnev` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `Szekhely` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `EUTR_EGE` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Adoszam` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Telefonszam` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Fax` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Kapcsolattarto` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `beszallito`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `beszallito`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `faanyag` ADD `BeszallitoID` INT  NULL AFTER `Fuvarozo`;

ALTER TABLE `faanyag`
  ADD `KNkod` VARCHAR(150) NULL AFTER `BeszallitoID`,
  ADD `KitermelesHelye` VARCHAR(150) NULL AFTER `KNkod`,
  ADD `ImportSzarmazas` VARCHAR(500) NULL AFTER `KitermelesHelye`;

ALTER TABLE `megrendelo` ADD `EUTR` VARCHAR(150) NULL AFTER `Deleted`;
