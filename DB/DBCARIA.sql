#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------

/*****************	Fonction **********************/

DROP DATABASE CARIA;

/*DROP Table Voiture ;*/
/*DROP Table Eleve ;*/

CREATE DATABASE CARIA DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
use CARIA;
#------------------------------------------------------------
# Table: Client
#------------------------------------------------------------

CREATE TABLE Client(
        idclient        int (11) Auto_increment  NOT NULL ,
        privilege      Int DEFAULT 2 ,
        dateenregistre TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        pseudo         Varchar (25) ,
        prenom         Varchar (25) ,
        nom            Varchar (25) ,
        sexe           Varchar (5) ,
        age            Int ,
        adresse        Varchar (100) ,
        mdp            Varchar (32) NOT NULL ,
        adressemail    Varchar (30) ,
        permis          Int ,
        imageclient     Varchar (250) DEFAULT '/images/avatars/img_user.jpg' ,
        PRIMARY KEY (idclient )
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: Voiture
#------------------------------------------------------------

CREATE TABLE Voiture(
        idvoiture int (11) Auto_increment  NOT NULL ,
        privilege   Int NOT NULL ,
        prenom      Varchar (25) ,
        nom         Varchar (25) ,
        age         Int ,
        galop       Int ,
        sexe        Varchar (5) NOT NULL ,
        adressemail Varchar (30) NOT NULL ,
        mdp         Varchar (25) NOT NULL ,
        PRIMARY KEY (idvoiture )
)ENGINE=InnoDB;
