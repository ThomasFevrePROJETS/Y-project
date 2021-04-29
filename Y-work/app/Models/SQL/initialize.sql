#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------

START TRANSACTION;
SET autocommit=0;

-- DROP DATABASE IF EXISTS `y_work`;
CREATE DATABASE IF NOT EXISTS `y_work`;

USE `y_work`;

#------------------------------------------------------------
# Table: Personnel
#------------------------------------------------------------

CREATE TABLE Personnel(
        ID     Int  Auto_increment  NOT NULL ,
        nom    Varchar (128) NOT NULL ,
        prenom Varchar (128) NOT NULL ,
        centre Varchar (128) NOT NULL
	,CONSTRAINT Personnel_PK PRIMARY KEY (ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Identifiant
#------------------------------------------------------------

-- CREATE TABLE Identifiant(
--         ID           Int Auto_increment NOT NULL ,
--         username     Varchar (128) NOT NULL ,
--         mdp          Varchar (256) NOT NULL,
--         ID_Personnel INT NOT NULL
-- 	,CONSTRAINT Identifiant_PK PRIMARY KEY (ID)

--     ,CONSTRAINT Identifiant_Personnel_FK FOREIGN KEY (ID_Personnel) REFERENCES Personnel(ID)
-- )ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Entreprise
#------------------------------------------------------------

CREATE TABLE Entreprise(
        ID                 Int  Auto_increment  NOT NULL ,
        nom                Varchar (128) NOT NULL ,
        nb_stagiaires_cesi Int NOT NULL,
        eval_stagiaires    Int ,
        confiance_pilote   Int
	,CONSTRAINT Entreprise_PK PRIMARY KEY (ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Statut
#------------------------------------------------------------

CREATE TABLE Statut(
        ID          Int Auto_increment NOT NULL ,
        designation Varchar (128) NOT NULL
	,CONSTRAINT Statut_PK PRIMARY KEY (ID)
)ENGINE=InnoDB;

INSERT INTO Statut(designation) VALUES ('Étudiant'), ('Délégué'), ('Pilote');


#------------------------------------------------------------
# Table: Promo
#------------------------------------------------------------

CREATE TABLE Promo(
        ID          Int Auto_increment NOT NULL ,
        type_promo  Varchar (10) NOT NULL ,
        annee       VARCHAR(2) NOT NULL
	,CONSTRAINT Promo_PK PRIMARY KEY (ID)
)ENGINE=InnoDB;

INSERT INTO Promo(type_promo, annee)
VALUES
('BTP', 'A1'), ('BTP', 'A2'), ('BTP', 'A3'), ('BTP', 'A4'), ('BTP', 'A5'),
('INFO', 'A1'), ('INFO', 'A2'), ('INFO', 'A3'), ('INFO', 'A4'), ('INFO', 'A5'),
('GN', 'A1'), ('GN', 'A2'), ('GN', 'A3'), ('GN', 'A4'), ('GN', 'A5'),
('S3E', 'A1'), ('S3E', 'A2'), ('S3E', 'A3'), ('S3E', 'A4'), ('S3E', 'A5');

#------------------------------------------------------------
# Table: Competences
#------------------------------------------------------------

CREATE TABLE Competence(
        ID          Int Auto_increment NOT NULL ,
        designation Varchar (256) NOT NULL
	,CONSTRAINT Competence_PK PRIMARY KEY (ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Critere
#------------------------------------------------------------

CREATE TABLE Critere(
        ID          Int Auto_increment NOT NULL ,
        designation Varchar (256) NOT NULL
	,CONSTRAINT Critere_PK PRIMARY KEY (ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Evaluation
#------------------------------------------------------------

CREATE TABLE Evaluation(
        ID            Int Auto_increment NOT NULL ,
        note          Int NOT NULL ,
        comments      Varchar (512) ,
        ID_Critere    Int NOT NULL ,
        ID_Personnel  Int NOT NULL ,
        ID_Entreprise Int NOT NULL
	,CONSTRAINT Evaluation_PK PRIMARY KEY (ID)

	,CONSTRAINT Evaluation_Critere_FK FOREIGN KEY (ID_Critere) REFERENCES Critere(ID)
	,CONSTRAINT Evaluation_Personnel_FK FOREIGN KEY (ID_Personnel) REFERENCES Personnel(ID)
	,CONSTRAINT Evaluation_Entreprise_FK FOREIGN KEY (ID_Entreprise) REFERENCES Entreprise(ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Localite
#------------------------------------------------------------

CREATE TABLE Localite(
        ID            Int Auto_increment NOT NULL ,
        ville         Varchar (128) NOT NULL ,
        ID_Entreprise Int NOT NULL
	,CONSTRAINT Localite_PK PRIMARY KEY (ID)

	,CONSTRAINT Localite_Entreprise_FK FOREIGN KEY (ID_Entreprise) REFERENCES Entreprise(ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Offre
#------------------------------------------------------------

CREATE TABLE Offre(
        ID            Int Auto_increment NOT NULL ,
        intitule      Varchar (50) NOT NULL ,
        descriptif    Varchar (1024) ,
        type_promo    Varchar (128) NOT NULL ,
        duree_stage   Int NOT NULL ,
        remuneration  Decimal(6,2) NOT NULL ,
        date_debut    Date NOT NULL ,
        nb_places     Int NOT NULL ,
        ID_Entreprise Int NOT NULL ,
        ID_Localite   Int NOT NULL
	,CONSTRAINT Offre_PK PRIMARY KEY (ID)

	,CONSTRAINT Offre_Entreprise_FK FOREIGN KEY (ID_Entreprise) REFERENCES Entreprise(ID)
	,CONSTRAINT Offre_Localite_FK FOREIGN KEY (ID_Localite) REFERENCES Localite(ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Candidature
#------------------------------------------------------------

CREATE TABLE Candidature(
        ID               Int Auto_increment NOT NULL ,
        CV               Varchar (256) NOT NULL ,
        LM               Varchar (256) ,
        msg              Varchar (256) ,
        fiche_validation Varchar (256) ,
        convention_stage Varchar (256) ,
        avancement       Int NOT NULL ,
        ID_Offre         Int NOT NULL ,
        ID_Personnel     Int NOT NULL
	,CONSTRAINT Candidature_PK PRIMARY KEY (ID)

	,CONSTRAINT Candidature_Offre_FK FOREIGN KEY (ID_Offre) REFERENCES Offre(ID)
	,CONSTRAINT Candidature_Personnel_FK FOREIGN KEY (ID_Personnel) REFERENCES Personnel(ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Secteur
#------------------------------------------------------------

CREATE TABLE Secteur(
        ID          Int Auto_increment NOT NULL ,
        designation Varchar (128) NOT NULL
	,CONSTRAINT Secteur_PK PRIMARY KEY (ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: qualifier
#------------------------------------------------------------

CREATE TABLE qualifier(
        ID_Personnel   Int NOT NULL ,
        ID_Statut      Int NOT NULL
	,CONSTRAINT qualifier_PK PRIMARY KEY (ID_Personnel,ID_Statut)

	,CONSTRAINT qualifier_Personnel_FK FOREIGN KEY (ID_Personnel) REFERENCES Personnel(ID)
	,CONSTRAINT qualifier_Statut_FK FOREIGN KEY (ID_Statut) REFERENCES Statut(ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: assigner
#------------------------------------------------------------

CREATE TABLE assigner(
        ID_Promo       Int NOT NULL ,
        ID_Personnel   Int NOT NULL
	,CONSTRAINT assigner_PK PRIMARY KEY (ID_Promo,ID_Personnel)

	,CONSTRAINT assigner_Promo_FK FOREIGN KEY (ID_Promo) REFERENCES Promo(ID)
	,CONSTRAINT assigner_Personnel_FK FOREIGN KEY (ID_Personnel) REFERENCES Personnel(ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: requerir
#------------------------------------------------------------

CREATE TABLE requerir(
        ID_Offre       Int NOT NULL ,
        ID_Competence Int NOT NULL
	,CONSTRAINT requerir_PK PRIMARY KEY (ID_Offre,ID_Competence)

	,CONSTRAINT requerir_Offre_FK FOREIGN KEY (ID_Offre) REFERENCES Offre(ID)
	,CONSTRAINT requerir_Competence_FK FOREIGN KEY (ID_Competence) REFERENCES Competence(ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: appartient
#------------------------------------------------------------

CREATE TABLE appartient(
        ID_Secteur    Int NOT NULL ,
        ID_Entreprise Int NOT NULL
	,CONSTRAINT appartient_PK PRIMARY KEY (ID_Secteur,ID_Entreprise)

	,CONSTRAINT appartient_Secteur_FK FOREIGN KEY (ID_Secteur) REFERENCES Secteur(ID)
	,CONSTRAINT appartient_Entreprise_FK FOREIGN KEY (ID_Entreprise) REFERENCES Entreprise(ID)
)ENGINE=InnoDB;

COMMIT;
