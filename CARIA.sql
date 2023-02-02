use CARIA;
#------------------------------------------------------------
# Insertions de Données
#------------------------------------------------------------

INSERT INTO Client (dateenregistre,privilege,pseudo, prenom, nom, sexe, age, adresse, mdp, adressemail, permis,imageclient)
VALUES
('2016-09-12'   ,'1',	'sa'   		, 'sa'		, 'pc' 		, 'HOMME','20'	, 'sa'				, '382e0360e4eb7b70034fbaa69bec5786' , 'sa@gmail.com' ,'0', '/images/avatars/img_user.jpg'),
('2016-09-12'   ,'1',	'PAPI91'   , 'FLORIAN'	, 'ARBITA' 	, 'HOMME','17'	, '3 RUE PITI'		, '83ea007bfdd589f29b820552b3f94260' , 'PAPI@gmail.com'	,'0', '/images/avatars/img_user1.jpg'),
('2016-10-05'   ,'2',	'TATA85'	, 'JANNE'	, 'MORINA'  , 'FEMME','5'	, '78 RUE PARI'		, '01750feaaf112c40293ac49b658b12ab' , 'TATA@gmail.com'	,'1', '/images/avatars/img_user1.jpg'),
('2016-11-03'   ,'2',	'MODR4'    , 'DAVID'	, 'DAROP' 	, 'HOMME','45'	, '65 RUE PIORI'	, '81df18ab2fce0c63561642e298347e5b' , 'MODR@gmail.com'	,'4', '/images/avatars/img_user1.jpg'),
('2016-06-25'   ,'2',	'ALLOO6' 	, 'GEREMY'	, 'MILES'   , 'HOMME','14'	, '6 RUE NIOLO'		, '83ea007bfdd589f29b820552b3f94260' , 'ALLO@gmail.com'	,'2', '/images/avatars/img_user1.jpg'),
('2016-05-10'   ,'2',	'MAMA23'    , 'FLORIANE', 'BOLON'   , 'FEMME','25'	, '1 RUE ROB'		, '01750feaaf112c40293ac49b658b12ab' , 'MAMA@gmail.com'		,'1', '/images/avatars/img_user1.jpg'),
('2016-07-01'   ,'2',	'BIBI'   	, 'EMILIE'	, 'SIRANY'  , 'FEMME','6'	, 'MAISON DU CLOS'	, 'd74c404f01c1e3c127118a8c1fc81212' , 'BIBI@gmail.com'		,'0', '/images/avatars/img_user1.jpg'),
('2016-09-11'   ,'2',	'PIOUPIOU' , 'FLORA'	, 'CERINA' 	, 'FEMME','15'	, 'ALLE DU RUIS'	, '7b5550eae68b75c98a58881cb968c6ff' , 'PIOU@gmail.com'	,'0', '/images/avatars/img_user1.jpg'),
('2016-09-05'   ,'2',	'BANANA987', 'LUCY'		, 'CARELI'  , 'FEMME','18'	, '9 MER DU CIEL'	, '01750feaaf112c40293ac49b658b12ab' , 'BANA@gmail.com'	,'0', '/images/avatars/img_user1.jpg'),
('2016-09-30'   ,'2',	'RARA'  	, 'SOPHIE'	, 'BENIC'   , 'FEMME','26'	, 'CREUX DE L''HIRONDELLE'	, 'dc6accf0ee16c9dbf4daf2b81c1e7fd4' , 'RARA@gmail.com' ,'1', '/images/avatars/img_user1.jpg'),
('2017-05-29'   ,'2',	'DARKY91'  	, 'JONHATAN'	, 'MOITILE' , 'HOMME','5'	, '198 AVENUE DU GENERAL'	, 'b54637201175346cc78ec20fa2718b2f' , 'darky@gmail.com'	,'2', '/images/avatars/img_user1.jpg'),
('2017-04-05'   ,'2',	'DAMI85'  	, 'THOMAS'	, 'NIGOLE' , 'HOMME','5'	, '35 RUE DE LA RIVIIERE'	, 'b2ac9acf20fa3711eb6c8b00734adbde' , 'darky@gmail.com'	,'1', DEFAULT),
('2017-02-25'   ,'2',	'FOFO36'  	, 'REMY'	, 'MINONY' , 'HOMME','5'	, '01 AVENUE DE L''IMPASSE DU CREUX'	, '71b14f0cefc1b25455c3ca7c22a80473' , 'FOFO@gmail.com'	,'3', '/images/avatars/img_user1.jpg'),
('2017-03-14'   ,'2',	'MIBO466'  	, 'OLIVIA'	, 'MOITILE' , 'FEMME','5'	, '36 BIS ALLEE DE L''ETANG DE MILLE LIEUX'	, '857692b439598675d6f89db000a1dc0a' , 'MIBO@gmail.com'	,'4', '/images/avatars/img_user1.jpg'),
('2017-01-09'   ,'2',	'BIIIBBBBOOPOPIL'  	, 'SAMADOUDOURELIE'	, 'KILOPANAPONIKAT' , 'HOMME','100'	, '325 RUE DE PARIS, 3 EME ARRONDISSEMENT , BRUXELLE'	, '52b5dd8f28c934b7a4a3fd3d67835cd8' , 'BIIIBBBBOOPOPIL@yahoo.com'	,'7', DEFAULT);


INSERT INTO Voiture (privilege, prenom, nom, age, galop, sexe, adressemail,mdp)
VALUES
('1'	, 'sa'			, 'sa'		,'20', '2' , 'HOMME'	, 'sa@gmail.com'	 , 'P@ssword'),
('1'	, 'FLORIAN'		, 'ARBITA'	,'18', '3' , 'HOMME'	, 'farbita@gmail.com'	 , 'AZERTY' ),
('2'	, 'JEAN'		, 'DURILE'	,'25', '7' , 'HOMME' ,'jdurile@gmail.com'	 , '123' ),
('2'	, 'REMY'		, 'LIBY'	,'43', '6' , 'HOMME' ,'rliby@gmail.com'	 , '321' ),
('2'	, 'SOPHIA' 		, 'CERIA'	,'29', '8' , 'FEMME' ,'sceria@gmail.com'	 , 'qwerty' ),
('2'	, 'FLORA' 		, 'DUPUIS'	,'36', '4' , 'FEMME' ,'fdupuis@gmail.com'	 , 'aqwzsx' ),
('2'	, 'MEGANE' 		, 'CERIA'	,'29', '5' , 'FEMME' ,'sceria@gmail.com'	 , 'wxcvbn' ),
('2'	, 'DOMINIQUE'	, 'PLUTIE'	,'64', '7' , 'HOMME' ,'dplutie@gmail.com'	 , '2017' ),
('2'	, 'KEVIN'    	, 'LOPIT'	,'35', '4' , 'HOMME' ,'klopit@gmail.com'	 , 'azerty123' ),
('2'	, 'JONATHAN' 	, 'LIKY'	,'29', '8' , 'HOMME' ,'mimi@gmail.com'	 , 'tyu4u566' ),
('1'	, 'BENJAMIN' 	, 'DOMINAK'	,'36', '4' , 'HOMME' ,'pilix@gmail.com'	 , 'gs12sfg' ),
('2'	, 'OLIVIA' 		, 'XIJIRA'	,'29', '8' , 'FEMME' ,'nathalia@gmail.com'	 , 'bvc9d65er' ),
('2'	, 'DOMINIQUE'	, 'MANAPLA'	,'64', '7' , 'FEMME' ,'titineau@gmail.com'	 , '78hyh789' ),
('1'	, 'JEAN-PIERE'  , 'JUDUKI'	,'35', '9' , 'HOMME' ,'mimome@gmail.com'	 , 'vf54vfdv' ),
('2', 'SAMADOULOURELIE', 'KILOFANAPONIKAE'	,'100', '9' , 'FEMME' ,'BARIBOULBOPOPIL@yahoo.com'	 , 'F%F53&D96DF!FDS' );