DROP DATABASE IF EXISTS orange;

CREATE DATABASE orange;

USE orange;



CREATE TABLE users
(
    idUser INT(3) NOT NULL AUTO_INCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    adresse VARCHAR(50),
    telephone VARCHAR(50),
    email VARCHAR(50),
    mdp VARCHAR(50),
    PRIMARY KEY(idUser)
);

CREATE TABLE client
(
    idClient INT(3) NOT NULL,
    type VARCHAR(50),
    fidelite VARCHAR(50),
    PRIMARY KEY(idClient),
    FOREIGN KEY (idClient) REFERENCES users(idUser)
);



CREATE TABLE technicien (
    idTechnicien Int(3) NOT NULL,
    specialite VARCHAR(50),
    dateEntree DATE,
    poste VARCHAR(50),
    PRIMARY KEY (idTechnicien),
    FOREIGN KEY (idTechnicien) REFERENCES users(idUser)
) ;


CREATE TABLE materiel (
    idMateriel INT(3) NOT NULL AUTO_INCREMENT,
    designation VARCHAR(50),
    marque VARCHAR(50),
    modele VARCHAR(50),
    prixachat float,
    date_achat DATE,
    idUser INT(3),
    PRIMARY KEY(idMateriel),
    FOREIGN KEY(idUser) REFERENCES users(idUser)
);




CREATE TABLE intervention (
    idIntervention INT(3) NOT NULL AUTO_INCREMENT,
    date_inter DATE,
    duree VARCHAR(50),
    statut VARCHAR(50),
    description VARCHAR(50),
    idMateriel INT(3),
    idtechnicien INT(3),
    PRIMARY KEY(idIntervention),
    FOREIGN KEY(idMateriel) REFERENCES materiel(idMateriel),
    FOREIGN KEY(idTechnicien) REFERENCES technicien(idTechnicien)
);




CREATE TABLE hashing (
    cle VARCHAR(255) PRIMARY KEY
);

-- hashing key
INSERT INTO hashing VALUES ("40e8aed82c0662ab0f5b33d4ad9f6d7f44dcb99c");

-- triggers

-- hasher le mdp avant de le sauvegarder dans la bdd users
delimiter  $ 
	create trigger avant_insertion before insert on users
	for each row 
	begin 
		declare hashKey varchar(255) ;
		select cle into hashkey from hashing ; 

		set new.mdp = sha1(concat(new.mdp, hashKey));
	end $
delimiter ;



-- procédure pour créer un client

delimiter $

    create Procedure insererClient(IN pNom VARCHAR(50), IN pPrenom VARCHAR(50), IN pAdresse VARCHAR(50), 
                                    IN pTelephone VARCHAR(50), IN pEmail VARCHAR(50), IN pMdp VARCHAR(50), IN pType VARCHAR(50), IN pFidelite VARCHAR(50))
    Begin
        Declare identifiant INT(3);
        INSERT INTO users VALUES (NULL, pNom, pPrenom, pAdresse, pTelephone, pEmail, pMdp);
        SELECT users.idUser INTO identifiant FROM users WHERE email = pEmail;
        INSERT INTO client  VALUES (identifiant, pType, pFidelite);

    End $

delimiter ;

Call insererClient("Nandakumaran", "Anandan", "Paris", "06", "a@gmail.com", "123", "client", "1");


-- procédure pour créer un technicien

delimiter $

    create Procedure insererTechnicien(IN pNom VARCHAR(50), IN pPrenom VARCHAR(50), IN pAdresse VARCHAR(50), 
                                    IN pTelephone VARCHAR(50), IN pEmail VARCHAR(50), IN pMdp VARCHAR(50), IN pSpecialite VARCHAR(50), 
                                    IN pPoste VARCHAR(50))
    Begin
        DECLARE identifiant INT(3);
        INSERT INTO users VALUES (NULL, pNom, pPrenom, pAdresse, pTelephone, pEmail, pMdp);
        SELECT users.idUser INTO identifiant FROM users WHERE email = pEmail;
        INSERT INTO technicien  VALUES (identifiant, pSpecialite, NOW(), pPoste);

    End $

delimiter ;

Call insererTechnicien("Nandakumaran", "Anandan", "Paris", "06", "b@gmail.com", "123", "box wifi", "manager");
Call insererTechnicien("Nandakumaran", "Anandan", "Paris", "06", "c@gmail.com", "123", "telephone", "manager");
Call insererTechnicien("Nandakumaran", "Anandan", "Paris", "06", "d@gmail.com", "123", "ordinateur", "manager");


-- procédure pour créer une intervention

delimiter $

    create Procedure insererIntervention(IN pDateInterv DATE, IN pDuree VARCHAR(50), IN pStatut VARCHAR(50), IN pDescription VARCHAR(50), IN pIdMateriel VARCHAR(50))

    Begin
        DECLARE identifiant INT(5);
        DECLARE speciality VARCHAR(50);
        SELECT designation INTO speciality FROM materiel WHERE idMateriel = pIdMateriel;
        SELECT idTechnicien INTO identifiant FROM technicien WHERE specialite = speciality ORDER BY RAND();
        INSERT INTO intervention VALUES (null, pDateInterv, pDuree, pStatut, pDescription, pIdMateriel, identifiant);

    End $

delimiter ;