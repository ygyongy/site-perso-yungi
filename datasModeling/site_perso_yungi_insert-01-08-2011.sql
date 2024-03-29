SET FOREIGN_KEY_CHECKS = 0;

INSERT INTO `websites` VALUES(1,'Yungi_design','Rue Etraz 2',NULL,1003,'Lausanne','+41 78 769 00 80','+41 78 769 00 80','ygyongy@tradiluxe.com');

INSERT INTO `langues` VALUES(1,'fr','français',1,'1');
INSERT INTO `langues` VALUES(2,'de','deutsch',2,'1');
INSERT INTO `langues` VALUES(3,'en','english',3,'1');

INSERT INTO `types_contenus` VALUES(1,'page','1');
INSERT INTO `types_contenus` VALUES(2,'matrice','1');
INSERT INTO `types_contenus` VALUES(3,'form','1');
INSERT INTO `types_contenus` VALUES(4,'block','1');

INSERT INTO `groupes` (`id_groupe`, `nom_groupe`, `droit_groupe`) VALUES
(1, 'Administrateur', 'UPEA'),
(5, 'Anonymous', NULL),
(2, 'Editeur', 'UPE'),
(3, 'Professionnel', 'UP'),
(4, 'User', 'U');

INSERT INTO `contacts` VALUES(NULL , 'email', 'ygyongy@tradiluxe.com', '1', '1', '1');

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom_utilisateur`, `prenom_utilisateur`, `login_utilisateur`, `pwd_utilisateur`, `inscription_utilisateur`, `langues_id_langue`, `groupes_id_groupe`) VALUES
(1, 'Gyongy', 'Yann', 'ygyongy', 'ab50aa7fe9daa3f9fec058369db8e1fa', '2011-08-06 19:22:10', 1, 1),
(2, 'Anonymous', 'Anonymous', 'anonymous', 'bee1a4c7ca2f3d563067d0c9a47f4d1c', '2011-08-06 19:37:19', 1, 5);

INSERT INTO `categories` VALUES(1,'Accueil','navigation','1',1,NULL,1);
INSERT INTO `categories` VALUES(1,'Hause','navigation','1',1,NULL,2);
INSERT INTO `categories` VALUES(1,'Home','navigation','1',1,NULL,3);
INSERT INTO `categories` VALUES(2,'Entreprise','navigation','1',2,NULL,1 );
INSERT INTO `categories` VALUES(2,'Firma','navigation','1',2,NULL,2);
INSERT INTO `categories` VALUES(2,'Entreprise','navigation','1',2,NULL,3);
INSERT INTO `categories` VALUES(3,'Catalogue','navigation','1',3,NULL,1);
INSERT INTO `categories` VALUES(3,'Katalogue','navigation','1',3,NULL,2);
INSERT INTO `categories` VALUES(3,'Collection','navigation','1',3,NULL,3);
INSERT INTO `categories` VALUES(4,'Admin','admin','1',4,'UPEA',1);
INSERT INTO `categories` VALUES(5,'block_user','hidden','1',1,NULL,1);

INSERT INTO `sous_categories` VALUES(1,'Sous-accueil','sous_navigation','1','1',NULL,'1',1);
INSERT INTO `sous_categories` VALUES(2,'création d''utilisateur','sous_admin','1','1',NULL,'4',1);


INSERT INTO `contenus` VALUES(1,'Bienvenue sur notre page d''accueil','Accueil','Accueil','{"titre":"Accueil","contenu":"page d''accueil"}',1,'1',NULL,1,1,NULL,1,1,1);
INSERT INTO `contenus` VALUES(1,'Wilkommen aus unsere Hause Seite','Hause','Hause','{"titre":"Hause", "contenu":"Wilkommen zu unsere neue webiste"}',1,'1',NULL,1,1,NULL,1,1,2);
INSERT INTO `contenus` VALUES(1,'Welcome on our new homepage','home','home','{"titre":"Home", "contenu":"Welcome on our website"}',1,'1',NULL,1,1,NULL,2,1,3);
INSERT INTO `contenus` VALUES(2,'welcome on our new second homepage','home 2','home 2','{"titre":"Home 2", "contenu":"Funk 4 ever!!!"}',2,'1',NULL,1,1,NULL,1,1,3);
INSERT INTO `contenus` VALUES(3,'formulaire d''ajout de contenu','formulaire','d''ajout de contenu','{"titre":"Ajout de contenu",\r\n	"contenu":{"action":"\\/site_perso_yungi\\/fr\\/Admin\\/",\r\n				"enctype":"application\\/x-www-form-urlencoded",\r\n				"method":"POST",\r\n				"id":"ajout_type_page",\r\n				"fields":[{"display_name":"titre html",\r\n							"template":"input",\r\n							"type":"text",\r\n							"class":"",\r\n							"id":"titre_html",\r\n							"name":"titre_html",\r\n							"value":""\r\n						},\r\n						{\r\n							"display_name":"keywords html",\r\n							"template":"input",\r\n							"type":"text",\r\n							"class":"",\r\n							"id":"keywords",\r\n							"name":"keywords",\r\n							"value":""\r\n						},\r\n						{\r\n							"display_name":"titre de la bannière",\r\n							"template":"input",\r\n							"type":"text",\r\n							"class":"",\r\n							"id":"titre_banner",\r\n							"name":"titre_banner",\r\n							"value":""\r\n						},\r\n						{\r\n							"display_name":"sous-titre de la bannière",\r\n							"template":"textarea",\r\n							"class":"richtext_editor",\r\n							"id":"sous_titre_banner",\r\n							"name":"sous_titre_banner",\r\n							"value":""\r\n						},\r\n						{\r\n							"display_name":"Corps du block",\r\n							"template":"textarea",\r\n							"class":"richtext_editor",\r\n							"id":"block_content",\r\n							"name":"block_content",\r\n							"value":""						\r\n						},\r\n						{\r\n							"display_name":"Fichier a proposer",\r\n							"template":"input",\r\n							"type":"file",\r\n							"class":"",\r\n							"id":"file_content",\r\n							"name":"file_content",\r\n							"value":""							\r\n						},\r\n						{\r\n							"type":"submit",\r\n							"template":"input",\r\n							"class":"",\r\n							"id":"submit",\r\n							"name":"submit",\r\n							"value":"envoyer donnees"\r\n						}]\r\n			}\r\n}',1,'1',NULL,1,4,NULL,3,1,1);
INSERT INTO `contenus` VALUES(4,'formulaire de connexion','connexion','des utilisateurs','{"titre":"Connexion",\r\n	"id_fieldset":"fieldset_connexion_user",\r\n	"contenu":{"action":"",\r\n			"enctype":"application\\/x-www-form-urlencoded",\r\n			"method":"POST",\r\n			"id":"connexion_user",\r\n			"name_form":"connexion_user",\r\n			"evenement_form":"onsubmit=\\"return requestAuthentificationUser(this, printData)\\"",\r\n			"fields":[{"display_name":"login",\r\n						"template":"input",\r\n						"type":"text",\r\n						"class":"",\r\n						"id":"login",\r\n						"name":"login"\r\n					},\r\n					{\r\n						"display_name":"password",\r\n						"template":"input",\r\n						"type":"password",\r\n						"class":"",\r\n						"id":"pwd",\r\n						"name":"pwd"\r\n					},\r\n					{\r\n						"type":"reset",\r\n						"template":"input",\r\n						"class":"fleft",\r\n						"id":"reset_user_form",\r\n						"name":"reset_user_form",\r\n						"value":"effacer"\r\n					},\r\n					{\r\n						"type":"submit",\r\n						"template":"input",\r\n						"class":"fleft",\r\n						"id":"connexion_user",\r\n						"name":"connexion_user",\r\n						"value":"connexion"\r\n					}]}}',1,'1',NULL,1,5,NULL,3,1,1);
INSERT INTO `contenus` VALUES(5,'création de profil','Création d''un utilisateur','C''est à ce stade que vous allez définir votre prénom, et surtout votre nom d''utilisateur ainsi que votre mot de pase','{"titre":"Saisie des informations de connexion",\r\n	"contenu":{"action":"",\r\n				"enctype":"application\\/x-www-form-urlencoded",\r\n				"method":"POST",\r\n				"id":"create_user",\r\n				"evenement_form":"onsubmit=\\"return requestCreateUser(<?php echo AJAX_PATH); ?>,this, printData)\\"",\r\n				"fields":[{"display_name":"Prénom",\r\n							"template":"input",\r\n							"type":"text",\r\n							"class":"",\r\n							"id":"prenom_user",\r\n							"name":"prenom_user"\r\n						},\r\n						{\r\n							"display_name":"Nom",\r\n							"template":"input",\r\n							"type":"text",\r\n							"class":"",\r\n							"id":"nom_user",\r\n							"name":"nom_user"\r\n						},\r\n						{\r\n							"display_name":"Login",\r\n							"template":"input",\r\n							"type":"text",\r\n							"class":"",\r\n							"id":"login_user",\r\n							"name":"login_user"\r\n						},\r\n						{\r\n							"display_name":"Mot de passe",\r\n							"template":"input",\r\n							"type":"password",\r\n							"class":"",\r\n							"id":"pwd_user",\r\n							"name":"pwd_user"\r\n						},	\r\n						{\r\n							"display_name":"re-Saisissez votre Mot de passe",\r\n							"template":"input",\r\n							"type":"password",\r\n							"class":"",\r\n							"id":"pwd_user_2",\r\n							"name":"pwd_user_2"\r\n						},						\r\n						{\r\n							"type":"reset",\r\n							"template":"input",\r\n							"class":"fleft",\r\n							"id":"reset_createUser_form",\r\n							"name":"reset_createUser_form",\r\n							"value":"effacer"\r\n						},\r\n						{\r\n							"type":"submit",\r\n							"template":"input",\r\n							"class":"fleft",\r\n							"id":"submit_createUser_form",\r\n							"name":"submit_createUser_form",\r\n							"value":"Enregistrer"\r\n						}]}}',2,'1',NULL,1,4,NULL,3,1,1);
INSERT INTO `contenus` VALUES(6,'ajout_contacts','Ajout des coordonnées de contact','Depuis ce sous-formulaire vous pouvez entrer les différentes possibilités de vous joindre','{"titre":"Saisie des informations de Contact",\r\n	"contenu":{"action":"",\r\n				"enctype":"application\\/x-www-form-urlencoded",\r\n				"method":"POST",\r\n				"id":"create_user",\r\n				"evenement_form":"onsubmit=\\"return requestCreateContact(<?php echo AJAX_PATH); ?>,this, printData)\\"",\r\n				"fields":[{"display_name":"E-mail",\r\n							"template":"input",\r\n							"type":"text",\r\n							"class":"",\r\n							"id":"contact_0",\r\n							"name":"contact_0"\r\n						},						\r\n						{\r\n							"type":"reset",\r\n							"template":"input",\r\n							"class":"fleft",\r\n							"id":"reset_createContact_form",\r\n							"name":"reset_createContact_form",\r\n							"value":"effacer"\r\n						},\r\n						{\r\n							"type":"submit",\r\n							"template":"input",\r\n							"class":"fleft",\r\n							"id":"submit_createContact_form",\r\n							"name":"submit_createContact_form",\r\n							"value":"Enregistrer"\r\n						}]}}',3,'1',NULL,1,4,NULL,3,1,1);
INSERT INTO `contenus` VALUES(7,'Creation_adresse','Création des adresses','Depuis cette emplacement vous donnerez vos informations de contact postal','{"titre":"Saisie des informations de base",\r\n	"contenu":{"action":"",\r\n				"enctype":"application\\/x-www-form-urlencoded",\r\n				"method":"POST",\r\n				"id":"create_user",\r\n				"evenement_form":"onsubmit=\\"return requestCreateAdresse(<?php echo AJAX_PATH); ?>,this, printData)\\"",\r\n				"fields":[{"display_name":"Type d''adresse",\r\n							"template":"select",\r\n							"class":"",\r\n							"id":"type_adresse",\r\n							"name":"type_adresse",\r\n							"value":{"1":"Adresse principal",\r\n										"2":"Adresse d''envoi",\r\n										"3":"Adresse de facturation"\r\n									}\r\n						},\r\n						{"display_name":"Adresse",\r\n							"template":"input",\r\n							"type":"text",\r\n							"class":"",\r\n							"id":"adresse_0",\r\n							"name":"adresse_0"\r\n						},\r\n						{"display_name":"Adresse 2",\r\n							"template":"input",\r\n							"type":"text",\r\n							"class":"",\r\n							"id":"adresse_1",\r\n							"name":"adresse_1"\r\n						},\r\n						{"display_name":"NPA",\r\n							"template":"input",\r\n							"type":"text",\r\n							"class":"",\r\n							"id":"adresse_2",\r\n							"name":"adresse_2"\r\n						},\r\n						{"type":"reset",\r\n							"template":"input",\r\n							"class":"fleft",\r\n							"id":"reset_createAdresse_form",\r\n							"name":"reset_createAdresse_form",\r\n							"value":"effacer"\r\n						},\r\n						{"type":"submit",\r\n							"template":"input",\r\n							"class":"fleft",\r\n							"id":"submit_createAdresse_form",\r\n							"name":"submit_createAdresse_form",\r\n							"value":"enregistrer"\r\n						}]}}',4,'1',NULL,1,4,NULL,3,1,1);
INSERT INTO `contenus` VALUES(8, 'test block', 'Un petit block', 'Un Petit block sous titre', '{"titre":"Block de texte","contenu":"Un petit block supplémentaire afin de tester l''empilage de ceux-ci"}', 1, '1', NULL, 1, 5, NULL, 1, 1, 1);


INSERT INTO `pays` VALUES(1,'afghanistan','af');
INSERT INTO `pays` VALUES(2,'afrique-du-sud','za');
INSERT INTO `pays` VALUES(3,'albanie','al');
INSERT INTO `pays` VALUES(4,'algerie','dz');
INSERT INTO `pays` VALUES(5,'allemagne','de');
INSERT INTO `pays` VALUES(6,'andorre','ad');
INSERT INTO `pays` VALUES(7,'angola','ao');
INSERT INTO `pays` VALUES(8,'anguilla','ai');
INSERT INTO `pays` VALUES(9,'antarctique','aq');
INSERT INTO `pays` VALUES(10,'antigua-et-barbuda','ag');
INSERT INTO `pays` VALUES(11,'antilles-neerlandaises','an');
INSERT INTO `pays` VALUES(12,'arabie-saoudite','sa');
INSERT INTO `pays` VALUES(13,'argentine','ar');
INSERT INTO `pays` VALUES(14,'armenie','am');
INSERT INTO `pays` VALUES(15,'aruba','aw');
INSERT INTO `pays` VALUES(16,'australie','au');
INSERT INTO `pays` VALUES(17,'autriche','at');
INSERT INTO `pays` VALUES(18,'azerbaidjan','az');
INSERT INTO `pays` VALUES(19,'bahamas','bs');
INSERT INTO `pays` VALUES(20,'bahrain','bh');
INSERT INTO `pays` VALUES(21,'bangladesh','bd');
INSERT INTO `pays` VALUES(22,'belgique','be');
INSERT INTO `pays` VALUES(23,'belize','bz');
INSERT INTO `pays` VALUES(24,'benin','bj');
INSERT INTO `pays` VALUES(25,'bermudes-les','bm');
INSERT INTO `pays` VALUES(26,'bhoutan','bt');
INSERT INTO `pays` VALUES(27,'bielorussie','by');
INSERT INTO `pays` VALUES(28,'bolivie','bo');
INSERT INTO `pays` VALUES(29,'bosnie-herzegovine','ba');
INSERT INTO `pays` VALUES(30,'botswana','bw');
INSERT INTO `pays` VALUES(31,'bouvet-iles','bv');
INSERT INTO `pays` VALUES(32,'bresil','br');
INSERT INTO `pays` VALUES(33,'brunei','bn');
INSERT INTO `pays` VALUES(34,'bulgarie','bg');
INSERT INTO `pays` VALUES(35,'burkina-faso','bf');
INSERT INTO `pays` VALUES(36,'burundi','bi');
INSERT INTO `pays` VALUES(37,'cambodge','kh');
INSERT INTO `pays` VALUES(38,'cameroun','cm');
INSERT INTO `pays` VALUES(39,'canada','ca');
INSERT INTO `pays` VALUES(40,'cap-vert','cv');
INSERT INTO `pays` VALUES(41,'cayman-iles','ky');
INSERT INTO `pays` VALUES(42,'chili','cl');
INSERT INTO `pays` VALUES(43,'chine-rep-pop','cn');
INSERT INTO `pays` VALUES(44,'christmas-ile','cx');
INSERT INTO `pays` VALUES(45,'chypre','cy');
INSERT INTO `pays` VALUES(46,'cocos-iles','cc');
INSERT INTO `pays` VALUES(47,'colombie','co');
INSERT INTO `pays` VALUES(48,'comores','km');
INSERT INTO `pays` VALUES(49,'cook-iles','ck');
INSERT INTO `pays` VALUES(50,'coree-du-nord','kp');
INSERT INTO `pays` VALUES(51,'coree-sud','kr');
INSERT INTO `pays` VALUES(52,'costa-rica','cr');
INSERT INTO `pays` VALUES(53,'cote-divoire','ci');
INSERT INTO `pays` VALUES(54,'croatie','hr');
INSERT INTO `pays` VALUES(55,'cuba','cu');
INSERT INTO `pays` VALUES(56,'danemark','dk');
INSERT INTO `pays` VALUES(57,'djibouti','dj');
INSERT INTO `pays` VALUES(58,'dominique','dm');
INSERT INTO `pays` VALUES(59,'egypte','eg');
INSERT INTO `pays` VALUES(60,'el-salvador','sv');
INSERT INTO `pays` VALUES(61,'emirats-arabes-unis','ae');
INSERT INTO `pays` VALUES(62,'equateur','ec');
INSERT INTO `pays` VALUES(63,'erythree','er');
INSERT INTO `pays` VALUES(64,'espagne','es');
INSERT INTO `pays` VALUES(65,'estonie','ee');
INSERT INTO `pays` VALUES(66,'etats-unis','us');
INSERT INTO `pays` VALUES(67,'ethiopie','et');
INSERT INTO `pays` VALUES(68,'falkland-ile','fk');
INSERT INTO `pays` VALUES(69,'feroe-iles','fo');
INSERT INTO `pays` VALUES(70,'fidji-republique-des','fj');
INSERT INTO `pays` VALUES(71,'finlande','fi');
INSERT INTO `pays` VALUES(72,'france','fr');
INSERT INTO `pays` VALUES(73,'gabon','ga');
INSERT INTO `pays` VALUES(74,'gambie','gm');
INSERT INTO `pays` VALUES(75,'georgie','ge');
INSERT INTO `pays` VALUES(76,'georgie-du-sud-et-sandwich-du-sud-iles','gs');
INSERT INTO `pays` VALUES(77,'ghana','gh');
INSERT INTO `pays` VALUES(78,'gibraltar','gi');
INSERT INTO `pays` VALUES(79,'grece','gr');
INSERT INTO `pays` VALUES(80,'grenade','gd');
INSERT INTO `pays` VALUES(81,'groenland','gl');
INSERT INTO `pays` VALUES(82,'guadeloupe','gp');
INSERT INTO `pays` VALUES(83,'guam','gu');
INSERT INTO `pays` VALUES(84,'guatemala','gt');
INSERT INTO `pays` VALUES(85,'guinee','gn');
INSERT INTO `pays` VALUES(86,'guinee-bissau','gw');
INSERT INTO `pays` VALUES(87,'guinee-equatoriale','gq');
INSERT INTO `pays` VALUES(88,'guyane','gy');
INSERT INTO `pays` VALUES(89,'guyane-francaise','gf');
INSERT INTO `pays` VALUES(90,'haiti','ht');
INSERT INTO `pays` VALUES(91,'heard-et-mcdonald-iles','hm');
INSERT INTO `pays` VALUES(92,'honduras','hn');
INSERT INTO `pays` VALUES(93,'hong-kong','hk');
INSERT INTO `pays` VALUES(94,'hongrie','hu');
INSERT INTO `pays` VALUES(95,'iles-mineures-eloignees-des-etats-unis','um');
INSERT INTO `pays` VALUES(96,'inde','in');
INSERT INTO `pays` VALUES(97,'indonesie','id');
INSERT INTO `pays` VALUES(98,'irak','iq');
INSERT INTO `pays` VALUES(99,'iran','ir');
INSERT INTO `pays` VALUES(100,'irlande','ie');
INSERT INTO `pays` VALUES(101,'islande','is');
INSERT INTO `pays` VALUES(102,'israel','il');
INSERT INTO `pays` VALUES(103,'italie','it');
INSERT INTO `pays` VALUES(104,'jamaique','jm');
INSERT INTO `pays` VALUES(105,'japon','jp');
INSERT INTO `pays` VALUES(106,'jordanie','jo');
INSERT INTO `pays` VALUES(107,'kazakhstan','kz');
INSERT INTO `pays` VALUES(108,'kenya','ke');
INSERT INTO `pays` VALUES(109,'kirghizistan','kg');
INSERT INTO `pays` VALUES(110,'kiribati','ki');
INSERT INTO `pays` VALUES(111,'koweit','kw');
INSERT INTO `pays` VALUES(112,'la-barbad','bb');
INSERT INTO `pays` VALUES(113,'laos','la');
INSERT INTO `pays` VALUES(114,'lesotho','ls');
INSERT INTO `pays` VALUES(115,'lettonie','lv');
INSERT INTO `pays` VALUES(116,'liban','lb');
INSERT INTO `pays` VALUES(117,'liberia','lr');
INSERT INTO `pays` VALUES(118,'libye','ly');
INSERT INTO `pays` VALUES(119,'liechtenstein','li');
INSERT INTO `pays` VALUES(120,'lithuanie','lt');
INSERT INTO `pays` VALUES(121,'luxembourg','lu');
INSERT INTO `pays` VALUES(122,'macau','mo');
INSERT INTO `pays` VALUES(123,'macedoine','mk');
INSERT INTO `pays` VALUES(124,'madagascar','mg');
INSERT INTO `pays` VALUES(125,'malaisie','my');
INSERT INTO `pays` VALUES(126,'malawi','mw');
INSERT INTO `pays` VALUES(127,'maldives-iles','mv');
INSERT INTO `pays` VALUES(128,'mali','ml');
INSERT INTO `pays` VALUES(129,'malte','mt');
INSERT INTO `pays` VALUES(130,'mariannes-du-nord-iles','mp');
INSERT INTO `pays` VALUES(131,'maroc','ma');
INSERT INTO `pays` VALUES(132,'marshall-iles','mh');
INSERT INTO `pays` VALUES(133,'martinique','mq');
INSERT INTO `pays` VALUES(134,'maurice','mu');
INSERT INTO `pays` VALUES(135,'mauritanie','mr');
INSERT INTO `pays` VALUES(136,'mayotte','yt');
INSERT INTO `pays` VALUES(137,'mexique','mx');
INSERT INTO `pays` VALUES(138,'micronesie-etats-federes-de','fm');
INSERT INTO `pays` VALUES(139,'moldavie','md');
INSERT INTO `pays` VALUES(140,'monaco','mc');
INSERT INTO `pays` VALUES(141,'mongolie','mn');
INSERT INTO `pays` VALUES(142,'montserrat','ms');
INSERT INTO `pays` VALUES(143,'mozambique','mz');
INSERT INTO `pays` VALUES(144,'myanmar','mm');
INSERT INTO `pays` VALUES(145,'namibie','na');
INSERT INTO `pays` VALUES(146,'nauru','nr');
INSERT INTO `pays` VALUES(147,'nepal','np');
INSERT INTO `pays` VALUES(148,'nicaragua','ni');
INSERT INTO `pays` VALUES(149,'niger','ne');
INSERT INTO `pays` VALUES(150,'nigeria','ng');
INSERT INTO `pays` VALUES(151,'niue','nu');
INSERT INTO `pays` VALUES(152,'norfolk-iles','nf');
INSERT INTO `pays` VALUES(153,'norvege','no');
INSERT INTO `pays` VALUES(154,'nouvelle-caledonie','nc');
INSERT INTO `pays` VALUES(155,'nouvelle-zelande','nz');
INSERT INTO `pays` VALUES(156,'oman','om');
INSERT INTO `pays` VALUES(157,'ouganda','ug');
INSERT INTO `pays` VALUES(158,'ouzbekistan','uz');
INSERT INTO `pays` VALUES(159,'pakistan','pk');
INSERT INTO `pays` VALUES(160,'palau','pw');
INSERT INTO `pays` VALUES(161,'panama','pa');
INSERT INTO `pays` VALUES(162,'papouasie-nouvelle-guinee','pg');
INSERT INTO `pays` VALUES(163,'paraguay','py');
INSERT INTO `pays` VALUES(164,'pays-bas','nl');
INSERT INTO `pays` VALUES(165,'perou','pe');
INSERT INTO `pays` VALUES(166,'philippines','ph');
INSERT INTO `pays` VALUES(167,'pitcairn-iles','pn');
INSERT INTO `pays` VALUES(168,'pologne','pl');
INSERT INTO `pays` VALUES(169,'polynesie-francaise','pf');
INSERT INTO `pays` VALUES(170,'porto-rico','pr');
INSERT INTO `pays` VALUES(171,'portugal','pt');
INSERT INTO `pays` VALUES(172,'qatar','qa');
INSERT INTO `pays` VALUES(173,'rep-dem-du-congo','cg');
INSERT INTO `pays` VALUES(174,'republique-centrafricaine','cf');
INSERT INTO `pays` VALUES(175,'republique-dominicaine','do');
INSERT INTO `pays` VALUES(176,'republique-tcheque','cz');
INSERT INTO `pays` VALUES(177,'reunion-la','re');
INSERT INTO `pays` VALUES(178,'roumanie','ro');
INSERT INTO `pays` VALUES(179,'royaume-uni','uk');
INSERT INTO `pays` VALUES(180,'russie','ru');
INSERT INTO `pays` VALUES(181,'rwanda','rw');
INSERT INTO `pays` VALUES(182,'sahara-occidental','eh');
INSERT INTO `pays` VALUES(183,'sainte-helene','sh');
INSERT INTO `pays` VALUES(184,'sainte-lucie','lc');
INSERT INTO `pays` VALUES(185,'saint-kitts-et-nevis','kn');
INSERT INTO `pays` VALUES(186,'saint-marin-rep-de','sm');
INSERT INTO `pays` VALUES(187,'saint-pierre-et-miquelon','pm');
INSERT INTO `pays` VALUES(188,'saint-vincent-et-les-grenadines','vc');
INSERT INTO `pays` VALUES(189,'samoa','as');
INSERT INTO `pays` VALUES(190,'samoa','ws');
INSERT INTO `pays` VALUES(191,'sao-tome-et-principe-rep','st');
INSERT INTO `pays` VALUES(192,'senegal','sn');
INSERT INTO `pays` VALUES(193,'seychelles','sc');
INSERT INTO `pays` VALUES(194,'sierra-leone','sl');
INSERT INTO `pays` VALUES(195,'singapour','sg');
INSERT INTO `pays` VALUES(196,'slovaquie','sk');
INSERT INTO `pays` VALUES(197,'slovenie','si');
INSERT INTO `pays` VALUES(198,'somalie','so');
INSERT INTO `pays` VALUES(199,'soudan','sd');
INSERT INTO `pays` VALUES(200,'sri-lanka','lk');
INSERT INTO `pays` VALUES(201,'suede','se');
INSERT INTO `pays` VALUES(202,'suisse','ch');
INSERT INTO `pays` VALUES(203,'suriname','sr');
INSERT INTO `pays` VALUES(204,'svalbard-et-jan-mayen-iles','sj');
INSERT INTO `pays` VALUES(205,'swaziland','sz');
INSERT INTO `pays` VALUES(206,'syrie','sy');
INSERT INTO `pays` VALUES(207,'tadjikistan','tj');
INSERT INTO `pays` VALUES(208,'taiwan','tw');
INSERT INTO `pays` VALUES(209,'tanzanie','tz');
INSERT INTO `pays` VALUES(210,'tchad','td');
INSERT INTO `pays` VALUES(211,'territoire-britannique-de-locean-indien','io');
INSERT INTO `pays` VALUES(212,'territoires-francais-du-sud','tf');
INSERT INTO `pays` VALUES(213,'thailande','th');
INSERT INTO `pays` VALUES(214,'timor','tp');
INSERT INTO `pays` VALUES(215,'togo','tg');
INSERT INTO `pays` VALUES(216,'tokelau','tk');
INSERT INTO `pays` VALUES(217,'tonga','to');
INSERT INTO `pays` VALUES(218,'trinite-et-tobago','tt');
INSERT INTO `pays` VALUES(219,'tunisie','tn');
INSERT INTO `pays` VALUES(220,'turkmenistan','tm');
INSERT INTO `pays` VALUES(221,'turks-et-caiques-iles','tc');
INSERT INTO `pays` VALUES(222,'turquie','tr');
INSERT INTO `pays` VALUES(223,'tuvalu','tv');
INSERT INTO `pays` VALUES(224,'ukraine','ua');
INSERT INTO `pays` VALUES(225,'uruguay','uy');
INSERT INTO `pays` VALUES(226,'vanuatu','vu');
INSERT INTO `pays` VALUES(227,'vatican-etat-du','va');
INSERT INTO `pays` VALUES(228,'venezuela','ve');
INSERT INTO `pays` VALUES(229,'vierges-britanniques-iles','vg');
INSERT INTO `pays` VALUES(230,'vierges-iles','vi');
INSERT INTO `pays` VALUES(231,'vietnam','vn');
INSERT INTO `pays` VALUES(232,'wallis-et-futuna-iles','wf');
INSERT INTO `pays` VALUES(233,'yemen','ye');
INSERT INTO `pays` VALUES(234,'yougoslavie','yu');
INSERT INTO `pays` VALUES(235,'zaire','zr');
INSERT INTO `pays` VALUES(236,'zambie','zm');
INSERT INTO `pays` VALUES(237,'zimbabwe','zw');