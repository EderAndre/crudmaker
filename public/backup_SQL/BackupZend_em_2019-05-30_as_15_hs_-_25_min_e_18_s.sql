-- Tabela acoes;


CREATE TABLE `acoes` (
  `id_acao` int(11) NOT NULL AUTO_INCREMENT,
  `id_controle` int(11) NOT NULL,
  `acao` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `rotulo_acao` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `ordem_acao` int(11) NOT NULL DEFAULT '0',
  `mostraMenu` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_acao`)
) ENGINE=InnoDB AUTO_INCREMENT=382 DEFAULT CHARSET=utf8;

INSERT INTO acoes VALUES("3","1","index","Home","1","0","2011-12-16 20:04:22");
INSERT INTO acoes VALUES("4","6","logout","Sair","0","1","2011-12-17 08:02:40");
INSERT INTO acoes VALUES("5","5","index","Lista permissões","0","0","2011-12-17 09:19:34");
INSERT INTO acoes VALUES("6","5","inclui","Incluir Permissão","1","0","2011-12-17 09:19:34");
INSERT INTO acoes VALUES("7","5","altera","Alterar","2","1","2011-12-17 10:57:29");
INSERT INTO acoes VALUES("8","7","index","Lista Ações","0","0","2011-12-17 13:13:59");
INSERT INTO acoes VALUES("9","7","inclui","Incluir Ação","1","0","2011-12-17 13:13:59");
INSERT INTO acoes VALUES("10","7","altera","Alterar","2","1","2011-12-17 13:13:59");
INSERT INTO acoes VALUES("11","7","exclui","Excluir Ação","1","1","2011-12-17 17:24:58");
INSERT INTO acoes VALUES("13","7","excluiarray","Excluir Vários","6","1","2011-12-20 20:08:57");
INSERT INTO acoes VALUES("14","8","index","inicio","1","0","2012-02-18 15:27:36");
INSERT INTO acoes VALUES("15","8","inclui","Novo cadastro","2","0","2012-02-18 18:18:43");
INSERT INTO acoes VALUES("16","8","altera","Altera Cadastro","3","1","2012-02-18 19:52:09");
INSERT INTO acoes VALUES("17","8","alterasenha","Alterar Senha","3","0","2012-02-20 16:45:24");
INSERT INTO acoes VALUES("18","5","excluiarray","Exclui pemissões","3","1","2012-02-24 08:43:56");
INSERT INTO acoes VALUES("19","8","redefinir","Redefine senha","0","1","2012-02-24 09:02:45");
INSERT INTO acoes VALUES("20","8","excluiarray","Excluir","0","1","2012-02-24 09:54:04");
INSERT INTO acoes VALUES("21","10","index","Perfis","0","0","2012-02-24 12:40:05");
INSERT INTO acoes VALUES("22","10","inclui","Novo Perfil","1","0","2012-02-24 13:24:10");
INSERT INTO acoes VALUES("23","10","excluiarray","Excluir perfil","3","1","2012-02-24 13:26:07");
INSERT INTO acoes VALUES("24","10","altera","Alterar","3","1","2012-02-24 13:26:34");
INSERT INTO acoes VALUES("25","10","perm","Permissões de usuári","0","1","2012-02-24 13:57:17");
INSERT INTO acoes VALUES("26","10","alterap","Altera Perm usuário","0","1","2012-02-24 15:25:14");
INSERT INTO acoes VALUES("34","8","cadmult","Múltiplos","4","0","2012-02-28 18:47:45");
INSERT INTO acoes VALUES("35","8","processa","Processar","5","1","2012-02-28 19:19:22");
INSERT INTO acoes VALUES("36","8","teste","ajax","6","1","2012-02-29 21:42:06");
INSERT INTO acoes VALUES("37","8","existe","existe","7","1","2012-02-29 23:53:41");
INSERT INTO acoes VALUES("52","8","alt","Alterar meu Cadastro","11","0","2012-03-02 22:29:40");
INSERT INTO acoes VALUES("69","1","salas","salas","2000","1","2012-03-22 20:24:57");
INSERT INTO acoes VALUES("70","1","index1","Index Administrador","10","1","2012-04-14 17:04:10");
INSERT INTO acoes VALUES("71","1","index3","Index do Servidor","12","1","2012-04-18 12:39:52");
INSERT INTO acoes VALUES("72","1","index2","Index do Gerente","12","1","2012-04-18 12:40:25");
INSERT INTO acoes VALUES("74","1","index4","Index para Consulta","13","1","2012-04-18 12:41:01");
INSERT INTO acoes VALUES("79","10","excluip","Excluir Permissão","90","1","2012-04-18 22:26:53");
INSERT INTO acoes VALUES("80","16","index","Empresa","0","0","2012-10-02 14:56:32");
INSERT INTO acoes VALUES("99","1","calendario","Calendário","8","1","2012-11-29 13:05:22");
INSERT INTO acoes VALUES("100","1","agenda","Agenda do dia","9","1","2012-11-29 13:28:28");
INSERT INTO acoes VALUES("112","19","index","Configurações Gerais","0","0","2012-12-12 12:01:54");
INSERT INTO acoes VALUES("113","19","backup","Backup dos Dados","1","0","2012-12-12 12:02:20");
INSERT INTO acoes VALUES("114","19","delbackup","apagar backup","3","1","2012-12-12 16:03:50");
INSERT INTO acoes VALUES("134","16","dados","Alterar Agência","1","1","2014-07-03 18:39:32");
INSERT INTO acoes VALUES("145","8","admin","Administração","1","0","2014-07-06 00:58:29");
INSERT INTO acoes VALUES("153","19","altera","Altera","99","1","2019-04-03 13:17:19");
INSERT INTO acoes VALUES("155","20","index","Rel 1","1","0","2019-04-04 15:20:42");
INSERT INTO acoes VALUES("156","28","index","Lista","0","0","2019-04-09 15:09:49");
INSERT INTO acoes VALUES("157","28","insert","Incluir","0","0","2019-04-11 11:35:32");
INSERT INTO acoes VALUES("158","28","update","Atualizar","1","1","2019-04-11 11:35:53");
INSERT INTO acoes VALUES("159","28","view","Visualizar","99","1","2019-04-11 12:26:35");
INSERT INTO acoes VALUES("160","28","delete","Excluir","99","1","2019-04-11 14:35:12");
INSERT INTO acoes VALUES("161","29","index","Lista","0","0","2019-04-16 08:42:39");
INSERT INTO acoes VALUES("162","29","view","Visualiza","99","1","2019-04-16 08:42:59");
INSERT INTO acoes VALUES("163","29","delete","Exluir","99","1","2019-04-16 08:43:14");
INSERT INTO acoes VALUES("164","29","update","Alterar","99","1","2019-04-16 08:43:47");
INSERT INTO acoes VALUES("165","29","insert","Incluir","2","0","2019-04-16 08:44:33");
INSERT INTO acoes VALUES("166","29","fields","Campos","99","1","2019-04-16 11:05:22");
INSERT INTO acoes VALUES("167","29","tbexists","Existencia de tabela","99","1","2019-04-17 08:43:44");
INSERT INTO acoes VALUES("245","29","existsfeature","Existencia da feature","99","1","2019-05-02 15:44:30");
INSERT INTO acoes VALUES("246","29","editassets","Editar assets","99","1","2019-05-03 14:10:29");



-- Tabela conexoes;


CREATE TABLE `conexoes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `host` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `dbname` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `pdoType` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `charset` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'UTF-8',
  `factory` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

INSERT INTO conexoes VALUES("2","DB01_consulta","10.244.168.87","user_relatorios","user@relatorios","PUB","dblib","UTF8","Pdo_Mssql","2019-04-11 14:38:29");
INSERT INTO conexoes VALUES("8","Localhost","localhost","root","f3rr31r0","db_apoiador","mysql","UTF8","Pdo_Mysql","2019-04-16 11:43:42");



-- Tabela configs;


CREATE TABLE `configs` (
  `idconfigs` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_rel_config` int(11) DEFAULT NULL,
  `verMeus` tinyint(1) DEFAULT NULL,
  `verQuantosMeus` int(11) DEFAULT NULL,
  `acompanhar_radicais` int(11) DEFAULT NULL,
  `quais_radicais` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `verQuantosRadicais` int(11) DEFAULT NULL,
  PRIMARY KEY (`idconfigs`),
  KEY `iduser` (`id_usuario_rel_config`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO configs VALUES("1","1","1","10","0",null,null);
INSERT INTO configs VALUES("2","4245121","1","10","0",null,null);
INSERT INTO configs VALUES("3","10","1","10","0",null,null);
INSERT INTO configs VALUES("4","12","1","10","0",null,null);
INSERT INTO configs VALUES("5","20","1","10","0",null,null);



-- Tabela empresa;


CREATE TABLE `empresa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `cnpj` varchar(30) CHARACTER SET utf8mb4 DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  `rua` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `numero` varchar(5) CHARACTER SET utf8mb4 DEFAULT NULL,
  `bairro` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `cidade` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `estado` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `cep` varchar(11) CHARACTER SET utf8mb4 DEFAULT NULL,
  `fundacao` date NOT NULL,
  `imagem_inicio` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `inclusao_sistema` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO empresa VALUES("1","Defensoria","19027060","empresa@coisa.com.br",null,null,null,null,null,null,"2010-01-01","f83bdfe6f11044390c2c3206416c560b56978e46.png","2011-12-15 19:48:08");



-- Tabela perfil;


CREATE TABLE `perfil` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `heranca` int(10) DEFAULT NULL,
  `nome` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `pgInicial` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `origem` varchar(45) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'APP',
  `group_ldap` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome_UNIQUE` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

INSERT INTO perfil VALUES("1",null,"admin","index1","APP",null,"2019-01-01 00:00:00");
INSERT INTO perfil VALUES("2",null,"Gerente","index2","APP",null,"2019-01-01 00:00:00");
INSERT INTO perfil VALUES("3",null,"Servidor","index3","APP",null,"2019-01-01 00:00:00");
INSERT INTO perfil VALUES("4",null,"Consulta","index4","APP",null,"2019-01-01 00:00:00");
INSERT INTO perfil VALUES("62","4","ROLE_AAI_SER","index4","LDAP","CN=AAI-SER,OU=USUARIOS,OU=UN-APOIO E ADMINISTRACAO DE INFORMACOES,OU=DIRETORIA DE TECNOLOGIA DA INFORMACAO,OU=DIRECAO GERAL,OU=SUB-ADMINISTRATIVA,OU=DEFENSORIA PUBLICA DO RS,DC=defpub,DC=local","2019-04-10 14:53:25");
INSERT INTO perfil VALUES("63","4","ROLE_ADM_INFO_TI","index4","LDAP","CN=Adm-Info-TI,OU=UN-DESENVOLVIMENTO DE PROJETOS E SISTEMAS,OU=DIRETORIA DE TECNOLOGIA DA INFORMACAO,OU=DIRECAO GERAL,OU=SUB-ADMINISTRATIVA,OU=DEFENSORIA PUBLICA DO RS,DC=defpub,DC=local","2019-04-10 14:53:25");
INSERT INTO perfil VALUES("64","4","ROLE_SMB_OWNCLOUD","index4","LDAP","CN=smb-owncloud,OU=OWNCLOUD,OU=SISTEMAS,OU=DEFENSORIA PUBLICA DO RS,DC=defpub,DC=local","2019-04-10 14:53:25");
INSERT INTO perfil VALUES("65","4","ROLE_VMWARE_DES","index4","LDAP","CN=VMWare-Des,OU=VMWARE,OU=SISTEMAS,OU=DEFENSORIA PUBLICA DO RS,DC=defpub,DC=local","2019-04-10 14:53:25");
INSERT INTO perfil VALUES("66","4","ROLE_PORTAL_SERVIDOR","index4","LDAP","CN=PORTAL-SERVIDOR,OU=PORTAL_DEFENSORIA,OU=SISTEMAS,OU=DEFENSORIA PUBLICA DO RS,DC=defpub,DC=local","2019-04-10 14:53:25");
INSERT INTO perfil VALUES("67","4","ROLE_NAGIOS_DES","index4","LDAP","CN=Nagios-Des,OU=NAGIOS,OU=SISTEMAS,OU=DEFENSORIA PUBLICA DO RS,DC=defpub,DC=local","2019-04-10 14:53:25");
INSERT INTO perfil VALUES("68","4","ROLE_OTRS_LDAP","index4","LDAP","CN=otrs_ldap,OU=OTRS,DC=defpub,DC=local","2019-04-10 14:53:25");
INSERT INTO perfil VALUES("69","4","ROLE_VPN","index4","LDAP","CN=VPN,CN=Users,DC=defpub,DC=local","2019-04-10 14:53:25");
INSERT INTO perfil VALUES("70","4","ROLE_INTRANET_ADM","index4","LDAP","CN=INTRANET-ADM,OU=INTRANET,OU=SISTEMAS,OU=DEFENSORIA PUBLICA DO RS,DC=defpub,DC=local","2019-04-10 14:53:25");
INSERT INTO perfil VALUES("71","4","ROLE_SERVIDORES","index4","LDAP","CN=SERVIDORES,CN=Users,DC=defpub,DC=local","2019-04-10 14:53:25");
INSERT INTO perfil VALUES("72","4","ROLE_DESENVOLVIMENTO_TI","index4","LDAP","CN=desenvolvimento-ti,OU=USUARIOS,OU=UN-DESENVOLVIMENTO DE PROJETOS E SISTEMAS,OU=DIRETORIA DE TECNOLOGIA DA INFORMACAO,OU=DIRECAO GERAL,OU=SUB-ADMINISTRATIVA,OU=DEFENSORIA PUBLICA DO RS,DC=defpub,DC=local","2019-04-10 14:53:25");
INSERT INTO perfil VALUES("73","4","ROLE_API_SSP","index4","LDAP","CN=api_ssp,OU=SSPRS,OU=SISTEMAS,OU=DEFENSORIA PUBLICA DO RS,DC=defpub,DC=local","2019-05-06 14:04:25");
INSERT INTO perfil VALUES("74","4","ROLE_AD_OWNCLOUD","index4","LDAP","CN=ad-owncloud,OU=OWNCLOUD,OU=SISTEMAS,OU=DEFENSORIA PUBLICA DO RS,DC=defpub,DC=local","2019-05-20 09:40:32");
INSERT INTO perfil VALUES("75","4","ROLE_AAI_TER","index4","LDAP","CN=AAI-TER,OU=USUARIOS,OU=UN-APOIO E ADMINISTRACAO DE INFORMACOES,OU=DIRETORIA DE TECNOLOGIA DA INFORMACAO,OU=DIRECAO GERAL,OU=SUB-ADMINISTRATIVA,OU=DEFENSORIA PUBLICA DO RS,DC=defpub,DC=local","2019-05-27 09:49:59");
INSERT INTO perfil VALUES("76","4","ROLE_PROXY_TER","index4","LDAP","CN=PROXY_TER,OU=GRUPOS-PROXY,DC=defpub,DC=local","2019-05-27 09:49:59");
INSERT INTO perfil VALUES("77","4","ROLE_VEEAM_REST_APOIO","index4","LDAP","CN=VEEAM-REST-APOIO,OU=VEEAM,OU=SISTEMAS,OU=DEFENSORIA PUBLICA DO RS,DC=defpub,DC=local","2019-05-30 15:21:13");



-- Tabela perfil_user;


CREATE TABLE `perfil_user` (
  `id_perfil_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_perfil_rel` int(11) NOT NULL,
  `id_user_rel` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_perfil_user`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

INSERT INTO perfil_user VALUES("1","1","1","2019-04-09 11:21:35");
INSERT INTO perfil_user VALUES("2","4","1","2019-04-12 15:12:40");
INSERT INTO perfil_user VALUES("3","4","6","2019-04-12 15:50:32");
INSERT INTO perfil_user VALUES("6","2","6","2019-04-15 14:05:53");
INSERT INTO perfil_user VALUES("44","4","20","2019-04-15 16:47:40");
INSERT INTO perfil_user VALUES("45","62","20","2019-04-15 16:47:40");
INSERT INTO perfil_user VALUES("46","63","20","2019-04-15 16:47:40");
INSERT INTO perfil_user VALUES("47","64","20","2019-04-15 16:47:40");
INSERT INTO perfil_user VALUES("48","65","20","2019-04-15 16:47:40");
INSERT INTO perfil_user VALUES("49","66","20","2019-04-15 16:47:40");
INSERT INTO perfil_user VALUES("50","67","20","2019-04-15 16:47:40");
INSERT INTO perfil_user VALUES("51","68","20","2019-04-15 16:47:41");
INSERT INTO perfil_user VALUES("52","69","20","2019-04-15 16:47:41");
INSERT INTO perfil_user VALUES("53","70","20","2019-04-15 16:47:41");
INSERT INTO perfil_user VALUES("54","71","20","2019-04-15 16:47:41");
INSERT INTO perfil_user VALUES("55","72","20","2019-04-15 16:47:41");
INSERT INTO perfil_user VALUES("56","73","20","2019-05-06 14:04:25");
INSERT INTO perfil_user VALUES("57","4","21","2019-05-20 09:40:32");
INSERT INTO perfil_user VALUES("58","73","21","2019-05-20 09:40:32");
INSERT INTO perfil_user VALUES("59","62","21","2019-05-20 09:40:32");
INSERT INTO perfil_user VALUES("60","74","21","2019-05-20 09:40:32");
INSERT INTO perfil_user VALUES("61","63","21","2019-05-20 09:40:32");
INSERT INTO perfil_user VALUES("62","64","21","2019-05-20 09:40:32");
INSERT INTO perfil_user VALUES("63","65","21","2019-05-20 09:40:32");
INSERT INTO perfil_user VALUES("64","67","21","2019-05-20 09:40:32");
INSERT INTO perfil_user VALUES("65","68","21","2019-05-20 09:40:32");
INSERT INTO perfil_user VALUES("66","71","21","2019-05-20 09:40:32");
INSERT INTO perfil_user VALUES("67","72","21","2019-05-20 09:40:32");
INSERT INTO perfil_user VALUES("68","4","22","2019-05-27 14:03:52");
INSERT INTO perfil_user VALUES("69","73","22","2019-05-27 14:03:52");
INSERT INTO perfil_user VALUES("70","62","22","2019-05-27 14:03:52");
INSERT INTO perfil_user VALUES("71","63","22","2019-05-27 14:03:52");
INSERT INTO perfil_user VALUES("72","64","22","2019-05-27 14:03:52");
INSERT INTO perfil_user VALUES("73","65","22","2019-05-27 14:03:52");
INSERT INTO perfil_user VALUES("74","66","22","2019-05-27 14:03:52");
INSERT INTO perfil_user VALUES("75","67","22","2019-05-27 14:03:52");
INSERT INTO perfil_user VALUES("76","68","22","2019-05-27 14:03:52");
INSERT INTO perfil_user VALUES("77","69","22","2019-05-27 14:03:53");
INSERT INTO perfil_user VALUES("78","70","22","2019-05-27 14:03:53");
INSERT INTO perfil_user VALUES("79","71","22","2019-05-27 14:03:53");
INSERT INTO perfil_user VALUES("80","72","22","2019-05-27 14:03:53");
INSERT INTO perfil_user VALUES("81","77","22","2019-05-30 15:21:13");



-- Tabela perfilfunc;


CREATE TABLE `perfilfunc` (
  `id_perfil_func` int(11) NOT NULL AUTO_INCREMENT,
  `id_perfil_rel` int(11) NOT NULL,
  `id_acao_rel` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_perfil_func`)
) ENGINE=InnoDB AUTO_INCREMENT=643 DEFAULT CHARSET=utf8;

INSERT INTO perfilfunc VALUES("1","1","1","2011-12-15 00:00:00");
INSERT INTO perfilfunc VALUES("2","1","2","2011-12-15 00:00:00");
INSERT INTO perfilfunc VALUES("3","1","3","2011-12-16 20:04:41");
INSERT INTO perfilfunc VALUES("4","1","4","2011-12-17 08:03:10");
INSERT INTO perfilfunc VALUES("5","1","5","2011-12-17 09:20:12");
INSERT INTO perfilfunc VALUES("6","1","6","2011-12-17 09:20:12");
INSERT INTO perfilfunc VALUES("8","1","7","2011-12-17 11:01:15");
INSERT INTO perfilfunc VALUES("9","1","8","2011-12-17 13:14:48");
INSERT INTO perfilfunc VALUES("10","1","9","2011-12-17 13:14:48");
INSERT INTO perfilfunc VALUES("11","1","10","2011-12-17 13:14:48");
INSERT INTO perfilfunc VALUES("12","1","11","2011-12-19 22:25:24");
INSERT INTO perfilfunc VALUES("13","1","13","2011-12-20 20:09:22");
INSERT INTO perfilfunc VALUES("14","1","14","2011-12-20 20:09:22");
INSERT INTO perfilfunc VALUES("15","1","15","2011-12-20 20:09:22");
INSERT INTO perfilfunc VALUES("16","1","16","2011-12-20 20:09:22");
INSERT INTO perfilfunc VALUES("17","1","17","2011-12-20 20:09:22");
INSERT INTO perfilfunc VALUES("18","1","18","2011-12-20 20:09:22");
INSERT INTO perfilfunc VALUES("19","1","19","2012-02-24 20:05:22");
INSERT INTO perfilfunc VALUES("20","1","20","2012-02-24 20:05:22");
INSERT INTO perfilfunc VALUES("22","1","22","2012-02-24 20:05:40");
INSERT INTO perfilfunc VALUES("23","1","23","2012-02-24 20:06:15");
INSERT INTO perfilfunc VALUES("24","1","24","2012-02-24 20:06:15");
INSERT INTO perfilfunc VALUES("25","1","25","2012-02-24 20:06:49");
INSERT INTO perfilfunc VALUES("26","1","26","2012-02-24 20:06:49");
INSERT INTO perfilfunc VALUES("27","1","27","2012-02-24 20:07:50");
INSERT INTO perfilfunc VALUES("28","1","28","2012-02-24 20:10:44");
INSERT INTO perfilfunc VALUES("29","1","29","2012-02-24 20:28:17");
INSERT INTO perfilfunc VALUES("30","1","30","2012-02-24 20:55:31");
INSERT INTO perfilfunc VALUES("31","1","31","2012-02-24 23:42:45");
INSERT INTO perfilfunc VALUES("32","1","32","2012-02-25 06:45:21");
INSERT INTO perfilfunc VALUES("33","1","33","2012-02-25 07:05:10");
INSERT INTO perfilfunc VALUES("34","1","34","2012-02-28 18:47:57");
INSERT INTO perfilfunc VALUES("35","1","35","2012-02-28 19:19:30");
INSERT INTO perfilfunc VALUES("36","1","36","2012-02-29 21:42:41");
INSERT INTO perfilfunc VALUES("37","1","37","2012-02-29 23:54:01");
INSERT INTO perfilfunc VALUES("38","1","38","2012-03-01 13:15:48");
INSERT INTO perfilfunc VALUES("39","1","39","2012-03-01 13:33:18");
INSERT INTO perfilfunc VALUES("40","1","40","2012-03-01 14:22:54");
INSERT INTO perfilfunc VALUES("41","1","41","2012-03-01 14:54:57");
INSERT INTO perfilfunc VALUES("42","1","42","2012-03-01 15:12:29");
INSERT INTO perfilfunc VALUES("43","1","43","2012-03-01 15:32:28");
INSERT INTO perfilfunc VALUES("44","1","44","2012-03-01 18:57:03");
INSERT INTO perfilfunc VALUES("45","1","45","2012-03-01 19:46:47");
INSERT INTO perfilfunc VALUES("46","1","46","2012-03-02 10:02:33");
INSERT INTO perfilfunc VALUES("47","1","47","2012-03-02 13:51:30");
INSERT INTO perfilfunc VALUES("48","1","48","2012-03-02 15:45:39");
INSERT INTO perfilfunc VALUES("49","1","49","2012-03-02 16:12:16");
INSERT INTO perfilfunc VALUES("50","1","50","2012-03-02 16:32:49");
INSERT INTO perfilfunc VALUES("51","1","51","2012-03-02 16:35:30");
INSERT INTO perfilfunc VALUES("52","1","52","2012-03-02 22:29:51");
INSERT INTO perfilfunc VALUES("53","1","53","2012-03-02 23:11:09");
INSERT INTO perfilfunc VALUES("54","1","54","2012-03-03 08:08:38");
INSERT INTO perfilfunc VALUES("55","1","55","2012-03-03 09:08:28");
INSERT INTO perfilfunc VALUES("56","1","56","2012-03-03 09:26:02");
INSERT INTO perfilfunc VALUES("57","1","57","2012-03-03 09:26:02");
INSERT INTO perfilfunc VALUES("58","1","58","2012-03-03 10:06:50");
INSERT INTO perfilfunc VALUES("59","1","59","2012-03-03 10:46:25");
INSERT INTO perfilfunc VALUES("60","1","60","2012-03-05 23:05:01");
INSERT INTO perfilfunc VALUES("61","1","61","2012-03-06 09:01:18");
INSERT INTO perfilfunc VALUES("62","1","62","2012-03-06 10:01:57");
INSERT INTO perfilfunc VALUES("63","1","63","2012-03-06 11:03:42");
INSERT INTO perfilfunc VALUES("73","1","64","2012-03-06 13:06:38");
INSERT INTO perfilfunc VALUES("74","1","65","2012-03-06 15:08:23");
INSERT INTO perfilfunc VALUES("75","1","66","2012-03-06 16:11:42");
INSERT INTO perfilfunc VALUES("77","1","68","2012-03-21 21:22:53");
INSERT INTO perfilfunc VALUES("79","1","69","2012-03-22 20:25:05");
INSERT INTO perfilfunc VALUES("212","1","70","2012-04-14 17:04:25");
INSERT INTO perfilfunc VALUES("220","1","79","2012-04-18 22:27:18");
INSERT INTO perfilfunc VALUES("221","1","67","2012-04-19 08:52:35");
INSERT INTO perfilfunc VALUES("224","1","80","2012-10-02 14:56:55");
INSERT INTO perfilfunc VALUES("225","1","81","2012-10-02 15:04:12");
INSERT INTO perfilfunc VALUES("226","2","3","2012-10-20 16:18:25");
INSERT INTO perfilfunc VALUES("227","2","72","2012-10-20 16:18:25");
INSERT INTO perfilfunc VALUES("228","2","4","2012-10-20 16:18:25");
INSERT INTO perfilfunc VALUES("229","2","82","2012-10-20 16:18:25");
INSERT INTO perfilfunc VALUES("231","1","82","2012-11-20 21:03:30");
INSERT INTO perfilfunc VALUES("233","2","83","2012-11-21 18:10:32");
INSERT INTO perfilfunc VALUES("234","2","84","2012-11-21 19:03:42");
INSERT INTO perfilfunc VALUES("235","2","86","2012-11-21 19:42:47");
INSERT INTO perfilfunc VALUES("236","2","87","2012-11-21 21:05:10");
INSERT INTO perfilfunc VALUES("237","2","88","2012-11-24 16:43:47");
INSERT INTO perfilfunc VALUES("238","2","89","2012-11-28 13:09:00");
INSERT INTO perfilfunc VALUES("239","2","90","2012-11-28 13:26:45");
INSERT INTO perfilfunc VALUES("240","2","91","2012-11-28 15:15:04");
INSERT INTO perfilfunc VALUES("241","2","92","2012-11-28 15:20:10");
INSERT INTO perfilfunc VALUES("242","2","93","2012-11-28 15:20:10");
INSERT INTO perfilfunc VALUES("243","2","94","2012-11-28 16:30:16");
INSERT INTO perfilfunc VALUES("244","2","95","2012-11-28 19:15:14");
INSERT INTO perfilfunc VALUES("245","2","96","2012-11-28 19:15:14");
INSERT INTO perfilfunc VALUES("246","2","97","2012-11-28 19:15:14");
INSERT INTO perfilfunc VALUES("247","2","98","2012-11-28 19:15:14");
INSERT INTO perfilfunc VALUES("250","2","101","2012-11-29 20:20:13");
INSERT INTO perfilfunc VALUES("251","2","102","2012-11-29 22:41:44");
INSERT INTO perfilfunc VALUES("252","2","103","2012-12-01 10:19:58");
INSERT INTO perfilfunc VALUES("253","2","104","2012-12-03 14:53:16");
INSERT INTO perfilfunc VALUES("254","2","105","2012-12-04 09:58:30");
INSERT INTO perfilfunc VALUES("255","2","106","2012-12-04 11:28:28");
INSERT INTO perfilfunc VALUES("256","2","107","2012-12-04 14:53:15");
INSERT INTO perfilfunc VALUES("257","2","108","2012-12-04 15:00:34");
INSERT INTO perfilfunc VALUES("258","2","109","2012-12-04 17:03:15");
INSERT INTO perfilfunc VALUES("259","2","110","2012-12-04 18:01:58");
INSERT INTO perfilfunc VALUES("260","2","111","2012-12-04 18:15:16");
INSERT INTO perfilfunc VALUES("261","2","112","2012-12-12 12:02:32");
INSERT INTO perfilfunc VALUES("262","2","113","2012-12-12 12:02:32");
INSERT INTO perfilfunc VALUES("263","2","114","2012-12-12 16:04:20");
INSERT INTO perfilfunc VALUES("264","2","115","2012-12-12 19:28:33");
INSERT INTO perfilfunc VALUES("265","2","116","2012-12-12 20:17:25");
INSERT INTO perfilfunc VALUES("266","2","117","2012-12-12 20:31:29");
INSERT INTO perfilfunc VALUES("267","2","118","2012-12-12 23:19:53");
INSERT INTO perfilfunc VALUES("268","2","119","2012-12-12 23:55:19");
INSERT INTO perfilfunc VALUES("269","2","120","2012-12-13 00:06:38");
INSERT INTO perfilfunc VALUES("270","2","121","2012-12-13 00:19:51");
INSERT INTO perfilfunc VALUES("271","2","122","2012-12-18 23:16:06");
INSERT INTO perfilfunc VALUES("273","2","124","2012-12-19 19:19:09");
INSERT INTO perfilfunc VALUES("275","2","52","2012-12-31 19:18:39");
INSERT INTO perfilfunc VALUES("276","2","17","2013-01-09 22:35:19");
INSERT INTO perfilfunc VALUES("278","2","127","2013-01-10 09:46:18");
INSERT INTO perfilfunc VALUES("280","2","129","2013-02-08 22:13:46");
INSERT INTO perfilfunc VALUES("281","3","3","2013-02-14 13:05:56");
INSERT INTO perfilfunc VALUES("285","3","4","2013-02-14 13:05:56");
INSERT INTO perfilfunc VALUES("286","3","14","2013-02-14 13:05:56");
INSERT INTO perfilfunc VALUES("287","3","17","2013-02-14 13:05:56");
INSERT INTO perfilfunc VALUES("288","3","52","2013-02-14 13:05:56");
INSERT INTO perfilfunc VALUES("313","3","112","2013-02-14 13:05:58");
INSERT INTO perfilfunc VALUES("315","3","123","2013-02-14 13:05:58");
INSERT INTO perfilfunc VALUES("319","3","124","2013-02-14 13:12:56");
INSERT INTO perfilfunc VALUES("320","1","112","2013-02-14 14:08:07");
INSERT INTO perfilfunc VALUES("321","1","113","2013-02-14 14:08:07");
INSERT INTO perfilfunc VALUES("322","1","114","2013-02-14 14:08:07");
INSERT INTO perfilfunc VALUES("323","1","130","2014-07-03 17:26:49");
INSERT INTO perfilfunc VALUES("324","1","131","2014-07-03 17:26:49");
INSERT INTO perfilfunc VALUES("325","1","132","2014-07-03 17:26:49");
INSERT INTO perfilfunc VALUES("326","1","133","2014-07-03 17:26:49");
INSERT INTO perfilfunc VALUES("327","1","134","2014-07-03 18:40:16");
INSERT INTO perfilfunc VALUES("328","1","135","2014-07-04 09:56:45");
INSERT INTO perfilfunc VALUES("329","1","136","2014-07-04 09:56:45");
INSERT INTO perfilfunc VALUES("330","1","137","2014-07-04 09:56:45");
INSERT INTO perfilfunc VALUES("331","1","138","2014-07-04 09:56:45");
INSERT INTO perfilfunc VALUES("332","1","139","2014-07-05 09:20:15");
INSERT INTO perfilfunc VALUES("333","1","140","2014-07-05 09:20:15");
INSERT INTO perfilfunc VALUES("334","1","141","2014-07-05 09:20:15");
INSERT INTO perfilfunc VALUES("335","1","142","2014-07-05 09:20:15");
INSERT INTO perfilfunc VALUES("336","1","143","2014-07-05 09:58:20");
INSERT INTO perfilfunc VALUES("337","1","144","2014-07-05 12:57:23");
INSERT INTO perfilfunc VALUES("339","3","137","2014-07-05 23:25:19");
INSERT INTO perfilfunc VALUES("340","3","136","2014-07-05 23:25:19");
INSERT INTO perfilfunc VALUES("341","3","135","2014-07-05 23:25:19");
INSERT INTO perfilfunc VALUES("342","3","139","2014-07-05 23:25:19");
INSERT INTO perfilfunc VALUES("343","3","143","2014-07-05 23:25:19");
INSERT INTO perfilfunc VALUES("344","3","144","2014-07-05 23:25:19");
INSERT INTO perfilfunc VALUES("345","3","141","2014-07-05 23:25:20");
INSERT INTO perfilfunc VALUES("346","3","142","2014-07-05 23:25:20");
INSERT INTO perfilfunc VALUES("347","1","145","2014-07-06 00:59:00");
INSERT INTO perfilfunc VALUES("348","2","145","2014-07-06 00:59:16");
INSERT INTO perfilfunc VALUES("349","3","146","2014-07-06 02:14:54");
INSERT INTO perfilfunc VALUES("350","1","146","2014-07-06 02:28:00");
INSERT INTO perfilfunc VALUES("351","5","3","2014-07-06 03:10:33");
INSERT INTO perfilfunc VALUES("352","5","99","2014-07-06 03:10:33");
INSERT INTO perfilfunc VALUES("353","5","100","2014-07-06 03:10:33");
INSERT INTO perfilfunc VALUES("354","5","74","2014-07-06 03:10:33");
INSERT INTO perfilfunc VALUES("355","5","4","2014-07-06 03:10:33");
INSERT INTO perfilfunc VALUES("356","5","14","2014-07-06 03:10:33");
INSERT INTO perfilfunc VALUES("357","5","52","2014-07-06 03:10:33");
INSERT INTO perfilfunc VALUES("358","5","135","2014-07-06 03:10:33");
INSERT INTO perfilfunc VALUES("359","5","139","2014-07-06 03:10:33");
INSERT INTO perfilfunc VALUES("360","5","146","2014-07-06 03:10:34");
INSERT INTO perfilfunc VALUES("361","5","17","2014-07-06 03:25:03");
INSERT INTO perfilfunc VALUES("362","5","143","2014-07-06 23:07:31");
INSERT INTO perfilfunc VALUES("363","5","144","2014-07-06 23:07:31");
INSERT INTO perfilfunc VALUES("364","5","140","2014-07-06 23:07:31");
INSERT INTO perfilfunc VALUES("365","5","141","2014-07-06 23:07:31");
INSERT INTO perfilfunc VALUES("366","5","142","2014-07-06 23:07:32");
INSERT INTO perfilfunc VALUES("367","3","71","2014-07-07 12:29:49");
INSERT INTO perfilfunc VALUES("368","1","147","2014-07-07 17:51:56");
INSERT INTO perfilfunc VALUES("369","2","19","2014-07-07 17:54:08");
INSERT INTO perfilfunc VALUES("370","2","20","2014-07-07 17:54:09");
INSERT INTO perfilfunc VALUES("371","2","14","2014-07-07 17:54:09");
INSERT INTO perfilfunc VALUES("372","2","15","2014-07-07 17:54:09");
INSERT INTO perfilfunc VALUES("373","2","16","2014-07-07 17:54:09");
INSERT INTO perfilfunc VALUES("374","2","34","2014-07-07 17:54:09");
INSERT INTO perfilfunc VALUES("375","2","35","2014-07-07 17:54:09");
INSERT INTO perfilfunc VALUES("376","2","36","2014-07-07 17:54:09");
INSERT INTO perfilfunc VALUES("377","2","37","2014-07-07 17:54:09");
INSERT INTO perfilfunc VALUES("378","2","80","2014-07-07 17:54:09");
INSERT INTO perfilfunc VALUES("379","2","134","2014-07-07 17:54:09");
INSERT INTO perfilfunc VALUES("380","2","130","2014-07-07 17:54:09");
INSERT INTO perfilfunc VALUES("381","2","131","2014-07-07 17:54:09");
INSERT INTO perfilfunc VALUES("382","2","132","2014-07-07 17:54:09");
INSERT INTO perfilfunc VALUES("383","2","133","2014-07-07 17:54:09");
INSERT INTO perfilfunc VALUES("384","2","137","2014-07-07 17:54:09");
INSERT INTO perfilfunc VALUES("385","2","135","2014-07-07 17:54:09");
INSERT INTO perfilfunc VALUES("386","2","136","2014-07-07 17:54:09");
INSERT INTO perfilfunc VALUES("387","2","138","2014-07-07 17:54:10");
INSERT INTO perfilfunc VALUES("388","2","147","2014-07-07 17:54:10");
INSERT INTO perfilfunc VALUES("389","2","143","2014-07-07 17:54:10");
INSERT INTO perfilfunc VALUES("390","2","144","2014-07-07 17:54:10");
INSERT INTO perfilfunc VALUES("391","2","139","2014-07-07 17:54:10");
INSERT INTO perfilfunc VALUES("392","2","140","2014-07-07 17:54:10");
INSERT INTO perfilfunc VALUES("393","2","141","2014-07-07 17:54:10");
INSERT INTO perfilfunc VALUES("394","2","142","2014-07-07 17:54:10");
INSERT INTO perfilfunc VALUES("395","2","146","2014-07-07 17:54:10");
INSERT INTO perfilfunc VALUES("396","1","148","2014-07-07 21:42:21");
INSERT INTO perfilfunc VALUES("397","1","149","2014-07-07 21:42:21");
INSERT INTO perfilfunc VALUES("398","1","150","2014-07-07 21:42:21");
INSERT INTO perfilfunc VALUES("399","1","151","2014-07-07 21:42:21");
INSERT INTO perfilfunc VALUES("400","1","99","2019-04-02 14:51:22");
INSERT INTO perfilfunc VALUES("401","1","100","2019-04-02 14:51:22");
INSERT INTO perfilfunc VALUES("402","1","71","2019-04-02 14:51:22");
INSERT INTO perfilfunc VALUES("403","1","72","2019-04-02 14:51:22");
INSERT INTO perfilfunc VALUES("404","1","74","2019-04-02 14:51:22");
INSERT INTO perfilfunc VALUES("405","1","124","2019-04-02 14:51:23");
INSERT INTO perfilfunc VALUES("406","1","123","2019-04-02 14:51:23");
INSERT INTO perfilfunc VALUES("408","1","153","2019-04-03 13:18:48");
INSERT INTO perfilfunc VALUES("409","1","155","2019-04-04 15:20:57");
INSERT INTO perfilfunc VALUES("410","4","3","2019-04-08 12:42:46");
INSERT INTO perfilfunc VALUES("411","4","74","2019-04-08 12:42:46");
INSERT INTO perfilfunc VALUES("412","4","4","2019-04-08 12:42:46");
INSERT INTO perfilfunc VALUES("418","1","156","2019-04-09 15:10:04");
INSERT INTO perfilfunc VALUES("419","1","157","2019-04-11 11:36:22");
INSERT INTO perfilfunc VALUES("420","1","158","2019-04-11 11:36:22");
INSERT INTO perfilfunc VALUES("421","1","159","2019-04-11 12:26:42");
INSERT INTO perfilfunc VALUES("422","1","160","2019-04-11 14:35:21");
INSERT INTO perfilfunc VALUES("423","3","26","2019-04-12 15:49:03");
INSERT INTO perfilfunc VALUES("424","3","25","2019-04-12 15:49:03");
INSERT INTO perfilfunc VALUES("425","3","21","2019-04-12 15:49:03");
INSERT INTO perfilfunc VALUES("426","3","22","2019-04-12 15:49:04");
INSERT INTO perfilfunc VALUES("427","3","24","2019-04-12 15:49:04");
INSERT INTO perfilfunc VALUES("428","3","23","2019-04-12 15:49:04");
INSERT INTO perfilfunc VALUES("429","3","79","2019-04-12 15:49:04");
INSERT INTO perfilfunc VALUES("430","1","161","2019-04-16 08:44:46");
INSERT INTO perfilfunc VALUES("431","1","165","2019-04-16 08:44:46");
INSERT INTO perfilfunc VALUES("432","1","162","2019-04-16 08:44:46");
INSERT INTO perfilfunc VALUES("433","1","163","2019-04-16 08:44:46");
INSERT INTO perfilfunc VALUES("434","1","164","2019-04-16 08:44:46");
INSERT INTO perfilfunc VALUES("435","1","166","2019-04-16 11:05:33");
INSERT INTO perfilfunc VALUES("436","1","167","2019-04-17 08:43:51");
INSERT INTO perfilfunc VALUES("506","1","245","2019-05-02 15:45:40");
INSERT INTO perfilfunc VALUES("507","1","246","2019-05-03 14:13:48");



-- Tabela permissoes;


CREATE TABLE `permissoes` (
  `id_funcionalidade` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  `funcionalidade` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `acoes` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `exibirmenu` tinyint(4) NOT NULL DEFAULT '1',
  `ordem_controles` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_funcionalidade`),
  UNIQUE KEY `funcionalidade_UNIQUE` (`funcionalidade`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

INSERT INTO permissoes VALUES("1","Início","index","index","1","0","2019-01-01 00:00:00");
INSERT INTO permissoes VALUES("4","Erro","error","erro-forbbiden","1","0","2019-01-01 00:00:00");
INSERT INTO permissoes VALUES("5","Permissões","permissoes","index-inclui-altera","1","3","2019-01-01 00:00:00");
INSERT INTO permissoes VALUES("6","Sessão","auth","login-logout","0","1000","2019-01-01 00:00:00");
INSERT INTO permissoes VALUES("7","Ações","acoes","-","1","4","2011-12-17 13:11:50");
INSERT INTO permissoes VALUES("8","Cadastramento","cadastro",null,"1","5","2012-02-18 15:26:19");
INSERT INTO permissoes VALUES("10","Perfis","perfis",null,"1","1","2012-02-24 13:00:57");
INSERT INTO permissoes VALUES("16","Empresa","empresa",null,"1","2","2012-10-02 14:18:27");
INSERT INTO permissoes VALUES("19","Configurações","configs",null,"1","7","2012-12-12 12:01:01");
INSERT INTO permissoes VALUES("20","Relatorios","relatorios",null,"1","8","2012-12-19 19:17:01");
INSERT INTO permissoes VALUES("28","Conexoes","conexoes",null,"1","98","2019-04-09 15:08:39");
INSERT INTO permissoes VALUES("29","CrudMaker","crud",null,"1","97","2019-04-16 08:40:24");



-- Tabela tb_crud;


CREATE TABLE `tb_crud` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `role_default` int(11) DEFAULT NULL,
  `descriptor` json DEFAULT NULL,
  `table_name` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;




-- Tabela usuario;


CREATE TABLE `usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `senha` varchar(60) CHARACTER SET utf8mb4 DEFAULT NULL,
  `nome_completo` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `nome_pai` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `nome_mae` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 DEFAULT NULL,
  `telefone` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `telefone_movel` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `rua` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `numero` varchar(5) CHARACTER SET utf8mb4 DEFAULT NULL,
  `bairro` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `cidade` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `estado` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `cep` varchar(11) CHARACTER SET utf8mb4 DEFAULT NULL,
  `perfil_id` int(10) unsigned NOT NULL,
  `group_ldap_map` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `empresa` int(10) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `senha_alterada` tinyint(4) NOT NULL DEFAULT '0',
  `senhaRedefinida` varchar(30) CHARACTER SET utf8mb4 DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  KEY `perfil_id` (`perfil_id`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

INSERT INTO usuario VALUES("1","admin","f94fd7a9c1998d70c213a10bfe17a3e5c2a13877","Administrador","1978-03-12",null,null,"eder-soares@defensoria.rs.def.br","(51) 98515-9899",null,null,null,null,null,"RS",null,"1",null,"1","0000-00-00 00:00:00","1",null);
INSERT INTO usuario VALUES("2","000002","e0ffb90b074691c42ebd7b3cc39771b344c0083b","Gerente","1978-12-01",null,null,"ederandresoares@hotmail.com","(55) 3332-3333",null,"4","455",null,null,"RS",null,"2",null,"1","0000-00-00 00:00:00","1",null);
INSERT INTO usuario VALUES("3","000003","1b97ba718bf92e51b03dc05ea5ec7c842fd13781","Operador","1999-01-01",null,null,"ederandresoares@hotmail.com","(55) 9662-2233",null,null,null,null,null,"RS",null,"3",null,"1","2011-12-15 19:48:08","0","9691f1cb");
INSERT INTO usuario VALUES("6","000004","1fbb35e89bf71356baa1f46d037d5df441b229f6","estagiario","2001-01-01",null,null,"est@est.com.br","(11) 1111-1111",null,null,null,null,null,"RS",null,"4",null,"1","2013-02-14 13:06:54","0","c313dc94");
INSERT INTO usuario VALUES("21","4460510",null,"Felipe Rodrigues Perrone",null,null,null,"felipe-perrone@defensoria.rs.def.br",null,null,null,null,null,null,null,null,"4","Consulta,ROLE_API_SSP,ROLE_AAI_SER,ROLE_AD_OWNCLOUD,ROLE_ADM_INFO_TI,ROLE_SMB_OWNCLOUD,ROLE_VMWARE_DES,ROLE_NAGIOS_DES,ROLE_OTRS_LDAP,ROLE_SERVIDORES,ROLE_DESENVOLVIMENTO_TI",null,"2019-05-20 09:40:32","1",null);
INSERT INTO usuario VALUES("22","4245121",null,"Eder Andre Soares",null,null,null,"eder-soares@defensoria.rs.gov.br",null,null,null,null,null,null,null,null,"4","Consulta,ROLE_API_SSP,ROLE_AAI_SER,ROLE_ADM_INFO_TI,ROLE_VEEAM_REST_APOIO,ROLE_SMB_OWNCLOUD,ROLE_VMWARE_DES,ROLE_PORTAL_SERVIDOR,ROLE_NAGIOS_DES,ROLE_OTRS_LDAP,ROLE_VPN,ROLE_INTRANET_ADM,ROLE_SERVIDORES,ROLE_DESENVOLVIMENTO_TI",null,"2019-05-27 14:03:52","1",null);



