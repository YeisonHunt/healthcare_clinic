DROP TABLE citas;

CREATE TABLE `citas` (
  `idCita` int(11) NOT NULL AUTO_INCREMENT,
  `diaC` date DEFAULT NULL,
  `horaInicio` time DEFAULT NULL,
  `horaFin` time NOT NULL,
  `tituloCita` varchar(50) NOT NULL,
  `pacientes_idPaciente` int(11) NOT NULL,
  PRIMARY KEY (`idCita`,`pacientes_idPaciente`),
  KEY `fk_citas_pacientes1_idx` (`pacientes_idPaciente`),
  CONSTRAINT `fk_citas_pacientes1` FOREIGN KEY (`pacientes_idPaciente`) REFERENCES `pacientes` (`idPaciente`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE creditos;

CREATE TABLE `creditos` (
  `idCredito` int(11) NOT NULL AUTO_INCREMENT,
  `des` varchar(3000) NOT NULL,
  `fecha` date NOT NULL,
  `fechaMod` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deuda` decimal(10,0) NOT NULL,
  `pacientes_idPaciente` int(11) NOT NULL,
  PRIMARY KEY (`idCredito`),
  UNIQUE KEY `pacientes_idPaciente` (`pacientes_idPaciente`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO creditos VALUES("1","2 de Procedimiento Suero, 4 Tabletas de Amoxacilina, 4 Suertos Anti-envejecimiento.\n[Abonó ]: Fecha: 06/03/2017","2017-03-05","2017-03-06 17:34:14","93000","40");
INSERT INTO creditos VALUES("2","3 Tratamientos contra el colesterol\n[Abonó]: Fecha: 05/03/2017","2018-00-00","2017-03-05 22:59:09","172017","11");
INSERT INTO creditos VALUES("4","Deuda Cancelada!","2017-03-27","2017-03-27 11:22:45","0","48");



DROP TABLE frases;

CREATE TABLE `frases` (
  `idFrases` int(11) NOT NULL,
  `frase` varchar(450) DEFAULT NULL,
  `tiempo` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idFrases`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE historiaclinica;

CREATE TABLE `historiaclinica` (
  `idHistoriaClinica` int(11) NOT NULL AUTO_INCREMENT,
  `motivoH` varchar(500) DEFAULT NULL,
  `preDistolica` int(11) DEFAULT NULL,
  `preSistolica` int(11) DEFAULT NULL,
  `frecCardiaca` int(11) DEFAULT NULL,
  `frecRespiratoria` int(11) DEFAULT NULL,
  `pacientes_idPaciente` int(11) NOT NULL DEFAULT '0',
  `tiempo` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fecha` date NOT NULL,
  PRIMARY KEY (`idHistoriaClinica`,`pacientes_idPaciente`),
  KEY `fk_historiaClinica_pacientes_idx` (`pacientes_idPaciente`),
  CONSTRAINT `fk_historiaClinica_pacientes` FOREIGN KEY (`pacientes_idPaciente`) REFERENCES `pacientes` (`idPaciente`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO historiaclinica VALUES("3","   Dolor abdominal causado por gastritis crónica.","80","120","60","70","40","2017-03-03 15:23:45","2017-02-22");
INSERT INTO historiaclinica VALUES("4"," Esta es la segunda historia 2","77","118","60","60","40","2017-03-03 15:24:05","2017-02-23");
INSERT INTO historiaclinica VALUES("5"," Prueba de motivo 3","120","120","120","120","13","2017-03-03 15:24:18","2017-02-22");
INSERT INTO historiaclinica VALUES("6","Historia Clinica para paciente","80","120","60","70","41","2017-03-03 15:24:37","2017-03-21");
INSERT INTO historiaclinica VALUES("7","Dolor en el brazo posible fractura","100","140","120","89","40","2017-03-03 18:28:21","2017-03-03");
INSERT INTO historiaclinica VALUES("8","Dolor estomcal causado por gastritis en la boca del estómago.","100","100","120","90","40","2017-03-04 00:29:01","2017-03-04");
INSERT INTO historiaclinica VALUES("9","Enfermedad crónica gastritis. ñ","80","125","71","70","40","2017-03-10 14:45:43","2017-03-10");



DROP TABLE medicamentos;

CREATE TABLE `medicamentos` (
  `idMedicamento` int(11) NOT NULL AUTO_INCREMENT,
  `descripcionM` varchar(300) DEFAULT NULL,
  `formaFarmaM` varchar(200) DEFAULT NULL,
  `necesidadM` varchar(200) DEFAULT NULL,
  `precio` varchar(50) DEFAULT NULL,
  `tiempo` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idMedicamento`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO medicamentos VALUES("1","Diclofenaco","Frasco","2 cucharadas cada 8 horas","7.900","2017-02-24 14:20:49");
INSERT INTO medicamentos VALUES("2","Amoxacilina","Ampolla","1 ampolleta cada 3 días","15.000","2017-02-24 14:21:08");
INSERT INTO medicamentos VALUES("3","Cloruro de Sodio","Frasco","1 cucharadita cada 2 horas","12.450","2017-02-24 14:21:18");
INSERT INTO medicamentos VALUES("4","Complejo B","Ampolla","2 ampollas cada 2 días","27.000","2017-02-24 14:21:47");
INSERT INTO medicamentos VALUES("5","Suero dietético","Frasco","1 vaso cada 3 horas","35.000","2017-02-24 14:21:56");
INSERT INTO medicamentos VALUES("6","Sulfato ferroso","Pastas","1 cada 8 horas","12.800","2017-02-24 20:25:30");



DROP TABLE mtemporal;

CREATE TABLE `mtemporal` (
  `idM` int(11) NOT NULL AUTO_INCREMENT,
  `dM` varchar(120) NOT NULL,
  `fM` varchar(120) NOT NULL,
  `nM` varchar(120) NOT NULL,
  `cM` int(11) NOT NULL,
  `tiempo` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE pacientes;

CREATE TABLE `pacientes` (
  `idPaciente` int(11) NOT NULL AUTO_INCREMENT,
  `cedulaP` bigint(40) DEFAULT NULL,
  `nombreP` varchar(65) DEFAULT NULL,
  `apellidoP` varchar(65) DEFAULT NULL,
  `dirP` varchar(300) DEFAULT NULL,
  `celP` bigint(30) DEFAULT NULL,
  `profesion` varchar(90) DEFAULT NULL,
  `peso` varchar(45) DEFAULT NULL,
  `fechaNaciP` date DEFAULT NULL,
  `estaturaP` varchar(45) DEFAULT NULL,
  `rhP` varchar(45) DEFAULT NULL,
  `genero` varchar(45) DEFAULT NULL,
  `alergias` varchar(500) DEFAULT NULL,
  `discapacidades` varchar(450) DEFAULT NULL,
  `eps` varchar(80) DEFAULT NULL,
  `tiempo` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hasHistoria` int(11) NOT NULL,
  `hasCredito` int(11) NOT NULL,
  PRIMARY KEY (`idPaciente`),
  UNIQUE KEY `cedulaP` (`cedulaP`)
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8;

INSERT INTO pacientes VALUES("13","36113277","Olga Lucía ","Garzón","Isnos Calle 8 #4-39","3203488788","Educadora","60","1975-01-05","1.63","O+","F","Ninguna","oeo","Emcosalud","2017-03-05 17:36:37","1","0");
INSERT INTO pacientes VALUES("39","108425875721","Adriana","Fernanez","Barrio Villa Docente","23143123","Estudiante","99","1900-04-27","1.64","A+","F","Ninguna","Ninguna","Elfasalud","2017-03-26 11:06:53","0","0");
INSERT INTO pacientes VALUES("40","12312312","Deisy","Velasco Pillmúe","Alto Grande","312341231","Estudiante","50","1997-06-26","1.52","O+","F","Ninguna","Ninguna","Ensanar","2017-03-05 15:35:34","1","1");
INSERT INTO pacientes VALUES("41","5555","Paciente ","Prueba","Los Hoyos- Popayán","3126665889","Estudiante","89","2010-12-19","1.82","A-","M","Ninguna","Ninguna","Ninguna","2017-03-10 14:36:36","1","1");
INSERT INTO pacientes VALUES("42","498194587","Juan Pablo","Lizarazo Cortés","111-38- 113.020 NE PARK","0","Por definir","110","1994-01-06","0.00","O+","M","Ninguna","Ninguna","Por definir","2017-03-26 11:07:03","0","0");
INSERT INTO pacientes VALUES("43","956","Lorena","Silva Cerón","CALLE1 #8A 25B/ PARAISO","3142209214","Por definir","49","1999-01-06","1.58","B+","F","Ninguna","Ninguna","Por definir","2017-03-26 11:06:50","0","0");
INSERT INTO pacientes VALUES("44","10192","Miguel Angel","Samudio","CALLE 63 A SUR #86-20","7836121","Por definir","100","1996-01-06","1.82","O+","M","Ninguna","Ninguna","Ninguna","2017-03-26 10:11:51","0","0");
INSERT INTO pacientes VALUES("45","1112008","Santiago ","Torres Paladines","V/ CASCAJAL TIMANA","3202092866","No ocupa","18","2014-01-06","0.50","O+","M","Ninguna","Ninguna","Por definir","2017-03-26 10:14:29","0","0");
INSERT INTO pacientes VALUES("46","21932","Ismenia","Guacaneme Orjuela","V/ BETANIA PALESTINA","3208032340","Por definir","50","1961-01-06","1.55","O+","M","Ninguna","Ninguna","Por definir","2017-03-26 10:16:13","0","0");
INSERT INTO pacientes VALUES("47","250202","Weimar Leandro","Obando Correa","CAR 2 # 9-14 B / AGUA BLANCA PITALITO","3202401660","Por definir","30","2009-01-06","1.30","O+","M","Ninguna","Ninguna","Por definir","2017-03-26 10:18:09","0","0");
INSERT INTO pacientes VALUES("48","4052000","Yeimi Natalia","Yepes Pasaje","V/ CAÑAVERAL ISNOS","3144731598","Estudiante","29","2003-01-06","1.30","O+","F","Ninguna","Ninguna","Por definir","2017-03-27 10:50:13","0","1");
INSERT INTO pacientes VALUES("49","11111","Jhojan Felipe","Araque García","V/ CAFARNAUN","3136301606","No ocupa","15","2011-01-06","0.40","A+","M","Ninguna","Ninguna","Por definir","2017-03-26 11:06:43","0","0");
INSERT INTO pacientes VALUES("50","6102007","Paula Estefanía","Aguirre Huertas","CRA 89 A","7786875","No ocupa","19","2012-01-06","0.60","O+","F","Ninguna","Ninguna","Por definir","2017-03-26 10:43:31","0","0");
INSERT INTO pacientes VALUES("51","8052006","Dana Carolina","Paladines Samboni","V/ MORTIÑO ISNOS","3204421470","Estudiante","19","2009-01-06","1.00","O+","F","Ninguna","Ninguna","Por definir","2017-03-26 10:44:47","0","0");
INSERT INTO pacientes VALUES("52","90508","Justin Alejandro","Fonseca","CRA 80 M # 72 C 16","3102334220","No ocupa","43","2013-01-06","0.30","O+","M","Ninguna","Ninguna","Ninguna","2017-03-26 10:47:40","0","0");
INSERT INTO pacientes VALUES("53","1627296","Libardo ","Toledo Peña","V/ EL TIGRE PITALITO","3134830334","Por definir","78","1960-01-06","1.65","A+","M","Ninguna","Ninguna","Por definir","2017-03-26 10:49:14","0","0");
INSERT INTO pacientes VALUES("54","1000002250","Rafael Arturo","Puentes Quintero","CRA 80 M # 72 C 16","3102234220","Estudiante","43","2004-01-06","1.45","O+","M","Ninguna","Ninguna","Por definir","2017-03-26 10:56:57","0","0");
INSERT INTO pacientes VALUES("55","1000119384","Cristian Camilo","Romero López","CALLE 62 SUR No 82 A 23 B/ BOSA LA PAZ","3115095346","Estudiante","62","2003-01-06","1.60","A+","M","Ninguna","Ninguna","Por definir","2017-03-26 10:58:36","0","0");
INSERT INTO pacientes VALUES("56","1000134220","Brandon Sebastian","Campos Lozcano","CRA 81 F # 66-21","7759226","Estudiante","63","2003-01-06","1.65","O+","M","Ninguna","Ninguna","Por definir","2017-03-26 11:06:36","0","0");
INSERT INTO pacientes VALUES("57","1000239854","Andre Guisseppe","Deantonillo Pinilla","CRA 80 C # 75- 64 SUR 3 PISO","7794752","Estudiante","31","2004-06-01","1.43","O+","M","Ninguna","Ninguna","Por definir","2017-03-26 11:08:14","0","0");
INSERT INTO pacientes VALUES("58","1000336719","Juan David ","Briceño Carvajal","CAR 4 ESTE 10 -34 B/ LOS CAMBULOS","3114434113","Estudiante","24","2007-01-06","1.30","O+","M","Ninguna","Ninguna","Por definir","2017-03-26 11:10:57","0","0");
INSERT INTO pacientes VALUES("59","1001173892","Catalina","Rodriguez Vargas","CALLE 44 SUR # 7 A 29 ESTE","3103890655","Estudiante","36","2004-06-01","1.50","O+","F","Ninguna","Ninguna","Por definir","2017-03-26 11:12:11","0","0");
INSERT INTO pacientes VALUES("60","10022001","Wilson Damian","Samboní Anacona","V/ EL MIRADOR","3132172850","Estudiante","25","2005-06-01","1.25","O+","M","Ninguna","Ninguna","Por definir","2017-03-26 11:21:46","0","0");
INSERT INTO pacientes VALUES("61","1004209227","Claudia Martiza","Campo Ijají","CAR 6B No 5 - 54 B/ LAS BRISAS TIMANA","3124468381","Por definir","56","1995-06-01","1.54","O+","F","Ninguna","Ninguna","Por definir","2017-03-26 11:27:32","0","0");
INSERT INTO pacientes VALUES("62","1004209293","Leidy Lorena","Peña Muñoz","V/ CAMENSO TIMANA","3114547541","Estudiante","41","2003-06-01","1.40","O+","F","Ninguna","Ninguna","Por definir","2017-03-26 11:31:10","0","0");
INSERT INTO pacientes VALUES("63","1004417609","Luz Meri ","Bolaños Bolaños","CALLE 19 N0 8 - 63B/ CRISTO REY","3207911044","Por definir","48","1996-01-06","1.53","O+","F","Ninguna","Ninguna","Por definir","2017-03-26 11:44:42","0","0");
INSERT INTO pacientes VALUES("64","1004440042","Yeferson Ricardo ","Buesaquillo Guaca","CAR 4 SUR#2-16 B/ LA VIRGINIA","3203717243","Por definir","60","1992-06-01","1.72","O+","M","Ninguna","Ninguna","Por definir","2017-03-26 11:50:02","0","0");
INSERT INTO pacientes VALUES("65","1004441032","Hugo Fernando ","López Cerón","V/ RODRIGO LARA","3212467710","Por definir","61","1994-06-01","1.70","O+","M","Ninguna","Ninguna","Por definir","2017-03-26 11:52:39","0","0");
INSERT INTO pacientes VALUES("66","1004441100","Katerin ","Muñoz Gironza","V/ CIENEGA CHIQUITA ISNOS","3123486228","Por definir","48","1996-01-06","1.47","A+","F","Ninguna","Ninguna","Por definir","2017-03-26 11:55:25","0","0");
INSERT INTO pacientes VALUES("67","1004441437","Sandra Patricia","Noguera Andrade","V/ PALMERIRAS ISNOS","3114805090","Ama de casa","60","1994-06-01","1.55","O+","F","Ninguna","Ninguna","Por definir","2017-03-26 12:19:22","0","0");
INSERT INTO pacientes VALUES("68","1004442003","Martin Julian","Urbano Murcia","CALLE 11 N0 1E- 14 B / CAMBULOS","3134337944","Por definir","55","1995-01-01","1.66","O+","M","Ninguna","Ninguna","Ninguna","2017-03-26 12:23:44","0","0");
INSERT INTO pacientes VALUES("69","1007935107","Duverney","Aranda Argote","V/COREJIMIENTO SANADOLFO","3204158173","Por definir","76","1995-01-01","1.75","O+","M","Ninguna","Ninguna","Ninguna","2017-03-26 12:29:33","0","0");
INSERT INTO pacientes VALUES("70","1012325137","Haron M","Martinez","CALLE 62 N 81 D77","5787390","Por definir","87","1992-01-01","1.82","O+","M","Ninguna","Ninguna","Ninguna","2017-03-26 12:38:57","0","0");
INSERT INTO pacientes VALUES("71","1012359867","Vivi Johana ","León Suarez","CRA81 F N 65B 35 SUR","7772610","Por definir","66","1996-01-01","1.52","O+","F","Ninguna","Ninguna","Ninguna","2017-03-26 12:41:34","0","0");
INSERT INTO pacientes VALUES("72","1012379637","Jeimmy Katterine","Urrea Caño","CALLE78 SUR N 78F 15 INT79","7404603","Por definir","53","1997-01-01","1.62","O+","F","Ninguna","Ninguna","Ninguna","2017-03-26 12:44:51","0","0");
INSERT INTO pacientes VALUES("73","1012387646","Leidy Carolina","López Peres","CALLE77A SUR N 85A-71INT128","7405952","Por definir","55","1996-01-01","1.49","O+","F","Ninguna","Ninguna","Ninguna","2017-03-26 12:45:38","0","0");
INSERT INTO pacientes VALUES("74","1012396674","Karen Charlotte","Deantonillo Pinilla","CRA 80 C # 65 -74 SUR","3144564282","Estudiante","79","1996-01-01","1.60","O+","F","Ninguna","Ninguna","Ninguna","2017-03-26 14:09:34","0","0");
INSERT INTO pacientes VALUES("75","1013583993","Milena ","Garavito Arango","CRA 82 A N 64-37","3214693105","Por definir","61","0000-00-00","1.55","O+","F","Ninguna","Ninguna","Ninguna","2017-03-26 14:12:52","0","0");
INSERT INTO pacientes VALUES("76","1013624963","Marlen Katerine","Realpe Cerón","CALLE 7 No 3 -08 B/ CRISTO REY ISNOS","31125492992","Por definir","57","1993-01-01","1.64","A+","F","Ninguna","Ninguna","Ninguna","2017-03-26 14:19:26","0","0");
INSERT INTO pacientes VALUES("77","1014182650","Maritza ","Toledo Araújo","CALLE 15B N0 35 25 B/ LAS ORQUIDEAS","3115874991","Por definir","54","1990-01-01","1.58","O+","F","Ninguna","Ninguna","Ninguna","2017-03-26 14:26:39","0","0");
INSERT INTO pacientes VALUES("78","1015403033","Jorge Andrés ","Sapuy Ome","V/ CASANSA TIMANA","3124183133","Por definir","80","0000-00-00","1.64","A+","M","Ninguna","Ninguna","Ninguna","2017-03-26 14:55:52","0","0");
INSERT INTO pacientes VALUES("79","1015415856","Ingrid Johanna","Astudillo Claros","CALLE 5 # 5-14 B/ CENTRO PITALITO","3138970895","Por definir","38","1995-01-01","1.46","B+","F","Leche","Ninguna","Ninguna","2017-03-26 14:58:34","0","0");
INSERT INTO pacientes VALUES("80","1015440775","Ximena Andrea","Capera Moreno","CRA 115 # 152 D 45","3183271293","Estudiante","94","1995-01-01","1.67","A+","F","Ninguna","Ninguna","Ninguna","2017-03-26 15:10:54","0","0");
INSERT INTO pacientes VALUES("85","121269387","Melquicedec","Caicedo Uni","Isnos","3203449821","Agricultor","67","1972-06-27","1.72","O+","M","Ninguna","Ninguna","Emcosalud","2017-03-06 03:29:28","0","1");
INSERT INTO pacientes VALUES("87","10160272","Jose Horacio","Vega Rodriguez","CAR 3 N0 ETRE 5 -Y 6 AVENIDA EL ESTUDIANTE","3103330738","Por definir","71","1956-01-01","1.72","O+","M","Ninguna","Ninguna","Ninguna","2017-03-26 16:38:41","0","0");
INSERT INTO pacientes VALUES("88","1016037950","Sandra Milena","Fernández Guaca","V/ BELEN DE ISNOS","3144740241","Por definir","60","1993-01-01","1.56","O+","F","Ninguna","Ninguna","Ninguna","2017-03-26 20:50:22","0","0");
INSERT INTO pacientes VALUES("92","1016080327","Librador ","Murcia Artunduaga","CAR 1B 6 06 B/ AGUA BLANCA","3142438612","Estudiante","78","1994-01-01","1.74","O+","M","Ninguna","Ninguna","Ninguna","2017-03-26 21:11:54","0","0");
INSERT INTO pacientes VALUES("93","1018420406","Eliana","Martinez Guzmán","CAR 4 # 1A-07 B/ TRINIDAD PITALITO","3208618440","Estudiante","68","1994-01-01","1.56","A+","F","Ninguna","Ninguna","Ninguna","2017-03-26 21:20:12","0","0");
INSERT INTO pacientes VALUES("94","1018429408","Vivian Lorena","Ordoñez Erazo","CALLE 9 SUR N0 4-55 B/ CCOLINAS DELA TERRAZA","3102028421","Por definir","58","1994-01-01","1.56","O+","F","Ninguna","Ninguna","Ninguna","2017-03-26 21:27:37","0","0");
INSERT INTO pacientes VALUES("96","1018476856","Erika Daniela","Ariza Lozano","CALLE 72 B No 89A - 01 B/VILLAS DEL PROGRESO","3102043096","Por definir","53","1997-01-01","1.55","O+","M","Ninguna","Ninguna","Ninguna","2017-03-26 21:49:23","0","0");
INSERT INTO pacientes VALUES("97","1020744977","Cristina","Legarda Benavides","V/ JERUSALEN","3208649764","Por definir","59","1993-01-01","1.58","O+","F","Ninguna","Ninguna","Ninguna","2017-03-26 22:16:53","0","0");
INSERT INTO pacientes VALUES("98","1020756828","Camilo Eduardo"," Castro Suarez","CALLE 107 N0 20 -15 B/ CHCO NAVARRA","3213245258","Por definir","67","1993-01-01","1.77","O+","M","Ninguna","Ninguna","Ninguna","2017-03-26 22:28:34","0","0");
INSERT INTO pacientes VALUES("99","1020807793","Mariana","Buenaventura Cifuentes","CAR 17 No 95 78 B/ CHICO APT 401","3208790720","Por definir","55","1996-01-01","1.64","O+","F","Ninguna","Ninguna","Ninguna","2017-03-26 22:30:24","0","0");
INSERT INTO pacientes VALUES("100","1022333527","Luz Angela ","Cepeda Rodriguez","CALLE 66BSUR No 81G-05 B/ BOSA ANTO","3166284835","Por definir","71","1990-01-01","1.52","O+","F","Ninguna","Ninguna","Ninguna","2017-03-26 22:32:18","0","0");
INSERT INTO pacientes VALUES("101","1022340308","Maria Carolina","Reyes Avila","CAR 80A No 10 B  23 B/LAGOS DE CASTILLA","3213961181","Por definir","68","1992-01-01","1.60","O+","F","Ninguna","Ninguna","Ninguna","2017-03-26 22:39:37","0","0");
INSERT INTO pacientes VALUES("102","1022344558","Fabián ","Vega Tello","B/CANDELARIA ISNOS","3142568634","Por definir","53","1993-01-01","1.65","O+","M","Ninguna","Ninguna","Ninguna","2017-03-28 10:22:26","0","0");
INSERT INTO pacientes VALUES("103","1022347262","Karina ","Puentes Galindo","CALLE 16 No 4 - 41 B/ GUADUALES","3142935601","Por definir","61","1990-01-01","1.55","O+","F","Ninguna","Ninguna","Ninguna","2017-03-28 10:23:31","0","0");
INSERT INTO pacientes VALUES("104","1022375870","Ricardo Ernesto ","Clavijo Lizarazo","CALLE63 SUR # 80 I 29","7821751","Por definir","106","1993-01-01","1.95","A+","M","Ninguna","Ninguna","Ninguna","2017-03-28 10:24:32","0","0");
INSERT INTO pacientes VALUES("107","1022379792","Caroline ","Figueredo","CRA 81B # 63-32","3112367323","Por definir","60","1995-01-01","1.57","O+","F","Ninguna","Ninguna","Ninguna","2017-03-28 10:26:33","0","0");
INSERT INTO pacientes VALUES("108","1022960194","Marcela","Devia Aquiti","V/ MONTE CRISTO BRUCELAS","3142949890","Por definir","52","1990-01-01","1.53","A+","F","Levaduras","Ninguna","Ninguna","2017-03-28 10:28:09","0","0");
INSERT INTO pacientes VALUES("109","1023898826","Katerine","Torres Muñoz","CALLE 12 A No 71B 40 B/ VILLA ALSACIA","3125754827","Por definir","60","1991-01-01","1.60","O+","F","Ninguna","Ninguna","Ninguna","2017-03-28 10:29:54","0","0");
INSERT INTO pacientes VALUES("110","1024486312","Lorena","Maldonado","CALLE 56 A # 72 F 24","7193125","Por definir","69","1992-01-01","1.60","A+","F","Ninguna","Ninguna","Ninguna","2017-03-28 10:31:25","0","0");
INSERT INTO pacientes VALUES("111","1025146232","Erwin","Ortega Jurado","CAR 6 N0 6-23 B/ COLICEO","3144809494","Por definir","10","2014-01-01","0.80","O+","M","Ninguna","Ninguna","Ninguna","2017-03-28 10:32:17","0","0");
INSERT INTO pacientes VALUES("112","1026267872","Eliana del rocio","Calderón Gómez","CALLE 2 # 5- 54 B/ TRINIDAD PITALITO","3125265777","Por definir","50","1994-01-01","1.60","O+","F","Leche","Ninguna","Ninguna","2017-03-28 10:33:45","0","0");
INSERT INTO pacientes VALUES("113","1026274245","Martha Ximena ","Morales Yague","CALLE 1 No 5 - 10 B/ TRINIDAD","3143971100","Por definir","64","1994-01-01","1.64","O+","F","Ninguna","Ninguna","Ninguna","2017-03-28 10:35:44","0","0");
INSERT INTO pacientes VALUES("114","1026277642","Rosmy Yurani","Carvajal Correa","CAR 40 No 5A - 71B/ PRIMAVERA","3124894630","Por definir","69","1994-01-01","1.56","O+","F","Ninguna","Ninguna","Ninguna","2017-03-28 10:37:06","0","0");
INSERT INTO pacientes VALUES("115","1026581551","Jenny Paola","Romero Castro","CALLE 7 C # 2 B 20 ESTE","3144642961","Por definir","50","1996-01-01","1.55","O+","F","Ninguna","Ninguna","Ninguna","2017-03-28 10:39:09","0","0");
INSERT INTO pacientes VALUES("116","1027283381","Ximena ","Càrednas Anacona","V/ ARGELIA SAN AGUSTIN","3134681949","Por definir","10","2013-01-01","0.50","O+","F","Ninguna","Ninguna","Ninguna","2017-03-28 10:41:07","0","0");
INSERT INTO pacientes VALUES("117","1029142203","Isabela ","Fernández López","CALLE 49 SUR # 87 A 18","8127214","Por definir","19","2010-01-01","1.00","O+","F","Ninguna","Ninguna","Ninguna","2017-03-28 10:43:23","0","0");
INSERT INTO pacientes VALUES("118","1029142204","Valentina ","Fernández López","CALLE 49 SUR # 87 A 18","8127214","No ocupa","20","2010-01-01","1.00","O+","F","Ninguna","Ninguna","Ninguna","2017-03-28 10:44:18","0","0");
INSERT INTO pacientes VALUES("119","1029560791","Sebastian Andrés","Murcia Lara","CALLE 20 # 13-17 B / LA CONSOLATA","3138932706","Por definir","10","2015-01-01","1.00","A+","M","Ninguna","Ninguna","Por definir","2017-03-28 10:54:03","0","0");
INSERT INTO pacientes VALUES("120","1029883683","Juliana Valentina","Torres Yate","CALLE 6 No 20- 29 B/ LAS AMERICAS","3124111903","Por definir","15","2014-01-01","0.5","O+","F","Ninguna","Ninguna","Ninguna","2017-03-28 10:49:43","0","0");
INSERT INTO pacientes VALUES("121","1029884766","Ibeth Sofìa","Capera Muñoz","SAN AGUSTIN B/ KENEDI","3133662697","Por definir","12","2014-01-01","1.00","O+","F","Ninguna","Ninguna","Ninguna","2017-03-28 10:51:01","0","0");
INSERT INTO pacientes VALUES("122","1030548596","Leidy Paola","García Salinas","CAR 19 N0 62 A - 30 SUR B/ ACACIAS BOGOTA","3112253750","Por definir","71","1987-01-01","1.69","B+","F","Ninguna","Ninguna","Ninguna","2017-03-28 11:07:39","0","0");
INSERT INTO pacientes VALUES("123","1030559002","Laura ","Argote Cadena","CRA 72 D # 54B 08","7193125","Por definir","50","1994-01-01","1.58","O-","F","Ninguna","Ninguna","Ninguna","2017-03-28 11:09:06","0","0");
INSERT INTO pacientes VALUES("124","1030563799","Luz Aide","Rodriguez Alvarez","CALLE 3D No2 - 48 B / LEON 13","3138887139","Por definir","64","1994-01-01","1.65","O+","F","Ninguna","Ninguna","Ninguna","2017-03-28 11:10:02","0","0");
INSERT INTO pacientes VALUES("125","1030609925","Jessica ","Sabala Rojas","CALLE 40 F SUR # 74 D 16 INT 3 303","3002816710","Por definir","50","1996-01-01","1.55","O+","F","Ninguna","Ninguna","Ninguna","2017-03-28 11:10:59","0","0");
INSERT INTO pacientes VALUES("152","4926610","luis maria","hermida murcia","car 1a # 2 41 b/ quinche","3204836810","comerciante","65","1934-07-09","154","B+","M","Ninguna","Ninguna","cafesalud","2017-03-02 17:47:24","1","0");
INSERT INTO pacientes VALUES("153","36290346","ELI JOHANNA","VARGAS CERON","CONDOMINIO CANDELARIA","3212062599","comerciante","81","1981-01-17","1.67","O+","F","A TI","TODAS","cafesalud","2017-02-28 11:36:34","1","0");
INSERT INTO pacientes VALUES("154","1094929247","MONICA ","ALEJANDRA ","CALLE 15 # 2E 43 B/ ANTONIO NARANJO","3204394356","INDEPENDIENTE","84","1992-05-27","164","O+","F","Ninguna","Ninguna","NO TIENE","2017-02-28 17:42:36","0","0");
INSERT INTO pacientes VALUES("155","1061790827","VIVIANA LIZETH","CÓRDOBA SANCHEZ","CAR 1C 19 65 B/ VILLA SOFIA","3218790815","ESTUDIANTE","63","1996-05-09","160","B+","F","RINITIS","Ninguna","CAFESALUD","2017-03-01 15:58:11","1","0");
INSERT INTO pacientes VALUES("156","4880434","JOSELITO","MEDINA","V/ BUENA VISTA ASEVEDO","3124306915","AGRICULTOR","69","1943-07-28","1.64","O+","M","Ninguna","Ninguna","SOLSALUD","2017-03-02 09:52:42","1","0");
INSERT INTO pacientes VALUES("157","26548947","FAUSTINA","ORTIZ","CALLE 2 N 6 60 PALESTINA","3213337204","AMA DE CASA","66","1947-10-25","150","A+","F","Ninguna","Ninguna","COMFAMILIAR","2017-03-02 09:51:57","1","0");
INSERT INTO pacientes VALUES("158","4928860","MARINO","ADARME","V/SANTA FE BRUSELAS","3115819603","AGRICULTOR","54","1949-07-10","161","O+","M","Ninguna","Ninguna","ASMESALUD","2017-03-02 10:46:53","1","0");
INSERT INTO pacientes VALUES("159","26435193","ALICIA","CHAVARRO ROJAS","CALLE 21 # 30 36 B/ EL JARDIN NEIVA","3152373483","PROFESORA PENSIONADA","49","1940-03-08","150","O+","F","Ninguna","Ninguna","EMCOSALUD","2017-03-02 12:03:11","1","0");
INSERT INTO pacientes VALUES("160","26549296","FLORENCIA ","PARRA GASCA","BRUCELAS CABECERAS","3134291005","AMA DE CASA","55","1929-05-10","153","O+","F","Ninguna","Ninguna","CAFESALUD","2017-03-03 23:08:31","1","0");
INSERT INTO pacientes VALUES("161","55207819","EMILCE CONSTANZA","CLAROS CHAUX","ACEVEDO","3125024513","ESTILISTA","48","1982-11-25","155","O+","F","Ninguna","Ninguna","COMFAMILIAR","2017-03-03 09:53:49","0","0");
INSERT INTO pacientes VALUES("162","36113365","MARIA NORALBA ","ORDOÑEZ","V/ GUACAS ISNOS","3114868523","AMA DE CASA","55","1973-11-07","148","O+","F","Ninguna","Ninguna","COMFAMILIAR","2017-03-03 10:20:18","0","0");
INSERT INTO pacientes VALUES("163","26554434","SANDRA MILENA ","MORA","PALESTINA","3147863224","COMERCIANTE","58","1980-03-29","163","O+","F","Ninguna","Ninguna","COMFAMILIAR","2017-03-06 15:15:13","1","0");
INSERT INTO pacientes VALUES("164","12168919","OSCAR HUMBERTO","MURCIA ORDOÑEZ","CALLE 1 # 5 38 B/ TRINIDAD","3103026158","COMERCIANTE","90","1971-01-17","170","O+","M","Ninguna","Ninguna","CAFESALUD","2017-03-07 15:39:23","1","0");
INSERT INTO pacientes VALUES("165","12170001","LUIS YAMID","BELTRAN BENAVIDES","V/ YARUMAL ISNOS","3107801689","AGRICULTOR","68","1978-05-16","165","O+","M","AL TRIMETROPIM","Ninguna","COMFAMILIAR","2017-03-07 17:06:21","1","0");
INSERT INTO pacientes VALUES("166","26482409","MARLENI","CARVAJAL BOBADILLA","CAR 1B 26 - 31 B/ AGUA BLANCA","3125678984","AMA DE CASA","60","1962-07-02","150","O-","F","RINITIS","Ninguna","ASMED SALUD","2017-03-08 16:44:42","1","0");
INSERT INTO pacientes VALUES("167","1083888329","ALVARO JAVIER","MOSQUERA UNI","CALE 18 - 05 B/ SIMON BOLIVAR","3133831323","COMERCIANTE","68","1990-04-20","180","A+","M","RINITIS","Ninguna","COMPARTA","2017-03-09 15:30:05","1","0");
INSERT INTO pacientes VALUES("168","19343941","MIGUEL ","RINCON MARTINEZ","DORADA PUTUMAYO","3206879088","COMERCIO","124","1956-05-06","165","B+","M","Ninguna","Ninguna","ENSANAR","2017-03-10 16:31:01","1","0");
INSERT INTO pacientes VALUES("169","1019907322","JAVIER ALEJANDRO","GOMEZ TOORES","CALLE 130C 59D 75 APT 16 06 TORRE 2","3112764524","ESTUDIANTE","13","2012-12-19","104","O+","M","RINITIS ALERGICA","Ninguna","CAFESALUD","2017-03-11 08:10:32","1","0");
INSERT INTO pacientes VALUES("170","79751039","JAVIER EDUARDO ","GOMEZ GIRALDO","CALLE 130C 59D 75 APT 16 06 TORRE 2","3138159448","ABOGADO","66","1973-11-02","173","A+","M","Ninguna","Ninguna","COMPENSAR","2017-03-11 08:33:38","1","0");
INSERT INTO pacientes VALUES("171","52787288","KEIDA JUANA","BORJA RINCON","CALE 128 D BIS 87 - 79 B/ SUBA RINCON","3205918749","OFIOS VARIOS","89","1978-10-15","155","A+","F","IBUPROFENO.","Ninguna","COMFACUNDI","2017-03-11 08:36:39","0","0");



DROP TABLE procedimientos;

CREATE TABLE `procedimientos` (
  `idPro` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` varchar(120) DEFAULT '1',
  `descripcionPro` varchar(450) DEFAULT NULL,
  `formaFarma` varchar(120) NOT NULL,
  `necesidad` varchar(120) DEFAULT NULL,
  `tiempo` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tipoProcedimiento_idTipo` int(11) NOT NULL,
  PRIMARY KEY (`idPro`,`tipoProcedimiento_idTipo`),
  KEY `fk_procedimientos_tipoProcedimiento1_idx` (`tipoProcedimiento_idTipo`),
  CONSTRAINT `fk_procedimientos_tipoProcedimiento1` FOREIGN KEY (`tipoProcedimiento_idTipo`) REFERENCES `tipoprocedimiento` (`idTipo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;

INSERT INTO procedimientos VALUES("1","1","Cloruro de sodio 9% ó Lactato según necesidad","Frasco o bolsa","500 ó 200 ml","2017-02-24 16:56:16","2");
INSERT INTO procedimientos VALUES("2","1","Bryonal LHA","Ampolla","2 ml","2017-02-21 21:19:47","2");
INSERT INTO procedimientos VALUES("3","1","Discolver LHA","Ampolla ","2 ml","2017-02-21 21:19:47","2");
INSERT INTO procedimientos VALUES("4","1","Tranic LHA","Ampolla","2 ml","2017-02-21 21:19:47","2");
INSERT INTO procedimientos VALUES("5","1","Calhose LHA ","Ampolla ","2 ml","2017-02-21 21:19:47","2");
INSERT INTO procedimientos VALUES("6","1","Rutox LHA","Ampolla ","2 ml","2017-02-21 21:19:47","2");
INSERT INTO procedimientos VALUES("7","1","Magnesio sulfato","Ampolla","10 ml","2017-02-21 21:19:47","2");
INSERT INTO procedimientos VALUES("8","1","Bicarbonato de Sodio","Ampolla ","10 ml","2017-02-21 21:19:47","2");
INSERT INTO procedimientos VALUES("9","1","Oligomax LHA","Vial","10 ml","2017-02-21 21:19:47","2");
INSERT INTO procedimientos VALUES("10","1","Procaina Clohidrato 2%","Frasco","2 ml","2017-02-21 21:19:47","2");
INSERT INTO procedimientos VALUES("11","1","Cloruro de Sodio 9% o Lactáto según necesidad","Frasco o bolsa","500 ó 250 ml","2017-02-24 21:41:01","3");
INSERT INTO procedimientos VALUES("12","1","Echinal LHA","Ampolla","2 ml","2017-02-24 21:41:01","3");
INSERT INTO procedimientos VALUES("13","1","Vintox LHA","Ampolla","2 ml","2017-02-24 21:41:01","3");
INSERT INTO procedimientos VALUES("14","1","Azuphur LHA","Ampolla","2 ml","2017-02-24 21:41:01","3");
INSERT INTO procedimientos VALUES("15","1","Nuxvom LHA","Ampolla","2 ml","2017-02-24 21:41:01","3");
INSERT INTO procedimientos VALUES("16","1","Magnesio","Ampolla","10 ml","2017-02-24 21:41:49","3");
INSERT INTO procedimientos VALUES("17","1","Oligomax LHA","Vial","10 ml","2017-02-24 21:41:49","3");
INSERT INTO procedimientos VALUES("18","1","Ácido ascórbico","Frasco o ampolla","5 gr","2017-02-24 21:43:03","3");
INSERT INTO procedimientos VALUES("19","1","Procaína clorhidrato 2%","Frasco","2 ml","2017-02-24 21:43:03","3");
INSERT INTO procedimientos VALUES("20","1","Cloruro de Sodio 9% ó Lactato según necesidad","Frasco o Bolsa","500 ó 200 ml","2017-02-24 21:56:21","4");
INSERT INTO procedimientos VALUES("21","1","Hamadron LHA","Ampolla","2 ml","2017-02-24 21:56:21","4");
INSERT INTO procedimientos VALUES("22","1","Barycar LHA","Ampolla"," 2 ml","2017-02-24 21:57:44","4");
INSERT INTO procedimientos VALUES("23","1","Plazar LHA","Ampolla","2 ml","2017-02-24 21:57:44","4");
INSERT INTO procedimientos VALUES("24","1","Cedronal LHA","Ampolla","2 ml","2017-02-24 21:58:27","4");
INSERT INTO procedimientos VALUES("25","1","Trarnic LHA","Ampolla","2 ml","2017-02-24 21:58:27","4");
INSERT INTO procedimientos VALUES("26","1","Procaína clorhidrato 1%","Frasco ","2 ml","2017-02-24 21:59:20","4");
INSERT INTO procedimientos VALUES("27","1","Magnesio","Ampolla","10 ml","2017-02-24 21:59:56","4");
INSERT INTO procedimientos VALUES("28","1","Potasio","","","2017-02-24 23:37:18","4");
INSERT INTO procedimientos VALUES("29","1","Oligomax LHA","Vial","10 ml","2017-02-24 22:00:28","4");
INSERT INTO procedimientos VALUES("30","1","Complejo B","Frasco o Ampolla ","2 ml","2017-02-24 22:01:24","4");
INSERT INTO procedimientos VALUES("31","1","Acido ascórbico","","","2017-02-24 22:05:12","4");
INSERT INTO procedimientos VALUES("34","1","Cloruro de sodio 9% ó lactato según necesidad","Frasco o bolsa","500 ó 250 ml","2017-02-24 22:08:19","5");
INSERT INTO procedimientos VALUES("35","1","Agnamar MR","Ampolla ","2 ml","2017-02-24 22:08:19","5");
INSERT INTO procedimientos VALUES("36","1","Emzym LHA","Ampolla","2 ml","2017-02-24 22:09:03","5");
INSERT INTO procedimientos VALUES("37","1","Plazar LHA","Ampolla ","2 ml","2017-02-24 22:09:03","5");
INSERT INTO procedimientos VALUES("38","1","Glanthy LHA","Ampolla","2 ml","2017-02-24 22:25:38","5");
INSERT INTO procedimientos VALUES("39","1","Barycar LHA","Ampolla","2 ml","2017-02-24 22:10:06","5");
INSERT INTO procedimientos VALUES("42","1","Testes LHA (Masculino)","Ampolla"," 2 ml","2017-02-24 22:15:43","5");
INSERT INTO procedimientos VALUES("43","1","Ovafem (Femenino)","Ampolla","2 ml","2017-02-24 22:15:43","5");
INSERT INTO procedimientos VALUES("44","1","Magnesio sultafo","Ampolla","10 ml","2017-02-24 22:16:21","5");
INSERT INTO procedimientos VALUES("45","1","Potasio ","Ampolla","10 ml","2017-02-24 22:16:21","5");
INSERT INTO procedimientos VALUES("46","1","Oligomax LHA ","Vial","10 ml","2017-02-24 22:17:32","5");
INSERT INTO procedimientos VALUES("47","1","Complejo B","Frasco ó Ampolla","2 ml","2017-02-24 22:17:32","5");
INSERT INTO procedimientos VALUES("48","1","Procaína clorhidrato 1 %","Frasco","2 ml","2017-02-24 22:17:53","5");
INSERT INTO procedimientos VALUES("49","1","Cloruro de sodio 9% ó Lactáto según necesidad","Frasco ó Bolsa","500 ó 250 ml","2017-02-24 22:25:20","6");
INSERT INTO procedimientos VALUES("50","1","Glanthy LHA","Ampolla ","2 ml","2017-02-24 22:25:20","6");
INSERT INTO procedimientos VALUES("51","1","Fusorbes LHA","Ampolla","2 ml","2017-02-24 22:26:36","6");
INSERT INTO procedimientos VALUES("52","1","Grader LHA","Ampolla"," 2 ml","2017-02-24 22:26:36","6");
INSERT INTO procedimientos VALUES("53","1","Potasio","Ampolla","10 ml","2017-02-24 22:27:07","6");
INSERT INTO procedimientos VALUES("54","1","Oligomax LHA","Vial","10 ml","2017-02-24 22:27:07","6");
INSERT INTO procedimientos VALUES("55","1","Ácido ascórbico","Frasco","5 gr","2017-02-24 22:27:36","6");
INSERT INTO procedimientos VALUES("56","1","Cloruro de sodio 9% o lactáto según necesidad","Frasco o bolsa","500 ml","2017-02-24 22:29:36","7");
INSERT INTO procedimientos VALUES("57","1","Trarnic LHA","Ampolla","2 ml","2017-02-24 22:29:36","7");
INSERT INTO procedimientos VALUES("58","1","Berbull LHA","Ampolla","2 ml","2017-02-24 22:30:18","7");
INSERT INTO procedimientos VALUES("59","1","Scrolyn LHA","Ampolla","2 ml","2017-02-24 22:30:18","7");
INSERT INTO procedimientos VALUES("60","1","Nuxvom LHA","Ampolla","2 ml","2017-02-24 22:31:05","7");
INSERT INTO procedimientos VALUES("61","1","Bicarbonato de sodio","Ampolla","2 ml","2017-02-24 22:31:05","7");
INSERT INTO procedimientos VALUES("62","1","Oligomax LHA","Vial","10 ml","2017-02-24 22:31:42","7");
INSERT INTO procedimientos VALUES("63","1","Ácido ascórbico","Frasco o ampolla","5 gr","2017-02-24 22:31:42","7");
INSERT INTO procedimientos VALUES("64","1","Cloruro de sodio 9% ó Lactato según necesidad","Frasco ó bolsa","500 ó 250 ml","2017-02-24 22:33:29","8");
INSERT INTO procedimientos VALUES("65","1","Lycop LHA","Ampolla","2 ml","2017-02-24 22:33:29","8");
INSERT INTO procedimientos VALUES("66","1","Apimel LHA","Ampolla ","2 ml","2017-02-24 22:35:14","8");
INSERT INTO procedimientos VALUES("67","1","Berbull LHA","Ampolla ","2 ml","2017-02-24 22:35:14","8");
INSERT INTO procedimientos VALUES("68","1","Chimall LHA","Ampolla","2 ml","2017-02-24 22:36:05","8");
INSERT INTO procedimientos VALUES("69","1","Galdepur LHA","Ampolla ","2 ml","2017-02-24 22:36:05","8");
INSERT INTO procedimientos VALUES("70","1","Bicarbonato de sodio","Ampolla","10 ml","2017-02-24 22:36:44","8");
INSERT INTO procedimientos VALUES("71","1","Oligomax LHA","Vial ","10 ml","2017-02-24 22:36:44","8");
INSERT INTO procedimientos VALUES("72","1","Procaína clorhidrato 2%","Frasco","2 ml","2017-02-24 22:37:38","8");
INSERT INTO procedimientos VALUES("73","1","Ácido ascórbico","Frasco o ampolla","5 gr","2017-02-24 22:37:38","8");
INSERT INTO procedimientos VALUES("76","1","Cloruro de sodio 9% o lactato según necesidad","Frasco ó Bolsa","250 ml","2017-02-24 22:39:32","9");
INSERT INTO procedimientos VALUES("77","1","Emzym LHA","Ampolla","2 ml","2017-02-24 22:39:32","9");
INSERT INTO procedimientos VALUES("78","1","Galdepur LHA","Ampolla","2 ml","2017-02-24 22:40:47","9");
INSERT INTO procedimientos VALUES("79","1","Nuxvom LHA","Ampolla","2 ml","2017-02-24 22:40:47","9");
INSERT INTO procedimientos VALUES("80","1","Berbull LHA","Ampolla","2 ml","2017-02-24 22:42:00","9");
INSERT INTO procedimientos VALUES("81","1","Procaína clorhidrato 1%","Frasco","2 ml","2017-02-24 22:42:00","9");
INSERT INTO procedimientos VALUES("82","1","Bicarbonato de sodio","Ampolla","10 ml","2017-02-24 22:42:38","9");
INSERT INTO procedimientos VALUES("83","1","Ácido ascórbico","Frasco ó Ampolla","5 gr","2017-02-24 22:42:38","9");
INSERT INTO procedimientos VALUES("84","1","Oligomax LHA","Vial","10 ml","2017-02-24 22:43:17","9");
INSERT INTO procedimientos VALUES("85","1","Complejo B","Frasco ó Ampolla","2 ml","2017-02-24 22:43:17","9");
INSERT INTO procedimientos VALUES("86","1","Cloruro de sodio 9% o lactato según necesidad","Frasco ó bolsa","500 ó 250 ml","2017-02-24 22:45:50","10");
INSERT INTO procedimientos VALUES("87","1","Galdepur LHA","Ampolla ","2 ml","2017-02-24 22:45:50","10");
INSERT INTO procedimientos VALUES("88","1","Emzym LHA","Ampolla","2 ml","2017-02-24 22:46:25","10");
INSERT INTO procedimientos VALUES("89","1","Nuxvom LHA","Ampolla","2 ml","2017-02-24 22:46:25","10");
INSERT INTO procedimientos VALUES("90","1","Scrolyn LHA","Ampolla","2 ml","2017-02-24 22:47:12","10");
INSERT INTO procedimientos VALUES("91","1","Potasio","Ampolla","10 ml","2017-02-24 22:47:12","10");
INSERT INTO procedimientos VALUES("92","1","Bicarbonato de sodio","Ampolla","20 ml","2017-02-24 22:47:59","10");
INSERT INTO procedimientos VALUES("93","1","Oligomax LHA ","Vial","10 ml","2017-02-24 22:47:59","10");
INSERT INTO procedimientos VALUES("94","1","Ácido ascórbico","Frasco","10 gr","2017-02-24 22:49:10","10");
INSERT INTO procedimientos VALUES("95","1","Procaína clorhidrato 2%","Frasco","2 ml","2017-02-24 22:49:10","10");
INSERT INTO procedimientos VALUES("96","1","Cloruro de sodio 9% o Lactato según necesidad","Frasco o Bolsa","500 ó 250 ml","2017-03-09 17:00:14","1");
INSERT INTO procedimientos VALUES("97","1","Mucsan LHA","Ampolla","2 ml","2017-03-09 17:00:14","1");
INSERT INTO procedimientos VALUES("98","1","Colozyn LHA","Ampolla","2 ml","2017-03-09 17:01:22","1");
INSERT INTO procedimientos VALUES("99","1","Scrolyn LHA","Ampolla ","2 ml","2017-03-09 17:01:22","1");
INSERT INTO procedimientos VALUES("100","1","Nuxvom LHA","Ampolla","2 ml","2017-03-09 17:08:10","1");
INSERT INTO procedimientos VALUES("101","1","Epache LHA ","Ampolla","2 ml","2017-03-09 17:08:10","1");
INSERT INTO procedimientos VALUES("102","1","Magnesio Sulfato","Ampolla","10 ml","2017-03-09 17:09:15","1");
INSERT INTO procedimientos VALUES("103","1","Potasio","A criterio médico","A criterio","2017-03-09 17:09:15","1");
INSERT INTO procedimientos VALUES("104","1","Oligomax LHA","Vial","10 ml","2017-03-09 17:10:42","1");
INSERT INTO procedimientos VALUES("105","1","Procaína Clorhidrato 2%","Frasco","2 ml","2017-03-09 17:10:42","1");



DROP TABLE procedimientot;

CREATE TABLE `procedimientot` (
  `idProT` int(11) NOT NULL AUTO_INCREMENT,
  `cantidadT` varchar(200) NOT NULL,
  `descripcionT` text NOT NULL,
  `formaFarmaT` varchar(200) NOT NULL,
  `necesidadT` varchar(200) NOT NULL,
  PRIMARY KEY (`idProT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE tipoprocedimiento;

CREATE TABLE `tipoprocedimiento` (
  `idTipo` int(11) NOT NULL AUTO_INCREMENT,
  `tituloTipo` varchar(120) NOT NULL,
  `tiempo` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idTipo`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO tipoprocedimiento VALUES("1","Suero Digestivo y Hepático ","2017-02-21 21:11:52");
INSERT INTO tipoprocedimiento VALUES("2","Suero Sistema Osteo-articular","2017-02-21 21:11:52");
INSERT INTO tipoprocedimiento VALUES("3","Sistema Inmuno Regulador","2017-02-21 21:11:52");
INSERT INTO tipoprocedimiento VALUES("4","Suero Cardiovascular","2017-02-21 21:11:52");
INSERT INTO tipoprocedimiento VALUES("5","Suerto Anti-envejecimiento ","2017-02-21 21:11:52");
INSERT INTO tipoprocedimiento VALUES("6","Suerto Anti-obesidad","2017-02-21 21:11:52");
INSERT INTO tipoprocedimiento VALUES("7","Suero pre & post Quirúrgico","2017-02-21 21:11:52");
INSERT INTO tipoprocedimiento VALUES("8","Suero Renal y vías Urinarias","2017-02-21 21:11:52");
INSERT INTO tipoprocedimiento VALUES("9","Suero para desintoxicación","2017-02-21 21:11:52");
INSERT INTO tipoprocedimiento VALUES("10","Suero Inmuno-estimulante en enfermedades degenerativas","2017-02-21 21:11:52");



DROP TABLE usuarios;

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `rol` int(11) DEFAULT NULL,
  `tiempo` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO usuarios VALUES("1","carlos","carlos312","1","2017-02-21 21:11:30");
INSERT INTO usuarios VALUES("2","ayudante","ayudante","2","2017-02-21 21:11:30");



