DROP TABLE IF EXISTS `garages`;
CREATE TABLE IF NOT EXISTS `garages`(
        garages_id           Int  Auto_increment  NOT NULL ,
        titre_service       Varchar (50) NOT NULL ,
        description_service Longtext NOT NULL ,
        image_service       Text NOT NULL ,
        titre_accueil       Varchar (50) NOT NULL ,
        description_accueil Longtext NOT NULL ,
        image_accueil       Text NOT NULL ,
        gsm                 Varchar (20) NOT NULL ,
        adresse             Varchar (250) NOT NULL ,
        horaires_id         Int  NULL
	,CONSTRAINT fk_garages PRIMARY KEY (garages_id)
)ENGINE=InnoDB;

DROP TABLE IF EXISTS `horaires`;
CREATE TABLE IF NOT EXISTS `horaires`(
        horaires_id       Int  Auto_increment  NOT NULL ,
        horaires_du_matin Varchar (50) NOT NULL ,
        horaires_du_soir  Varchar (50) NOT NULL ,
        jours             VARCHAT (20) NOT NULL ,
        garages_id         Int  NULL
	,CONSTRAINT fk_horaires PRIMARY KEY (horaires_id)
)ENGINE=InnoDB;

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis`(
        avis_id      Int  Auto_increment  NOT NULL ,
        nom          Varchar (250) NOT NULL ,
        message      Longtext NOT NULL ,
        note         Decimal NOT NULL ,
        verification Bool NOT NULL ,
        garages_id    Int  NULL
	,CONSTRAINT fk_avis PRIMARY KEY (avis_id)
)ENGINE=InnoDB;

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users`(
        users_id     Int  Auto_increment  NOT NULL ,
        nom          Varchar (250) NOT NULL ,
        email        Varchar (250) NOT NULL ,
        mot_de_passe Varchar (250) NOT NULL ,
        role         Varchar (50) NOT NULL ,
        garages_id    Int  NULL ,
        vehicules_id Int NULL
	,CONSTRAINT fk_users PRIMARY KEY (users_id)
)ENGINE=InnoDB;

DROP TABLE IF EXISTS `vehicules`;
CREATE TABLE IF NOT EXISTS `vehicules`(
        vehicules_id              Int  Auto_increment  NOT NULL ,
        prix                      Float NOT NULL ,
        image                     Text NOT NULL ,
        annee_mise_en_circulation Int NOT NULL ,
        kilometrage               Float NOT NULL ,
        titre                     Varchar (50) NOT NULL ,
        description               Longtext NOT NULL ,
        users_id                  Int NOT NULL ,
	,CONSTRAINT fk_vehicules PRIMARY KEY (vehicules_id)
)ENGINE=InnoDB;

DROP TABLE IF EXISTS `formulaires`;
CREATE TABLE IF NOT EXISTS `formulaires`
(
        formulaires Int  Auto_increment  NOT NULL ,
        nom         Varchar (250) NOT NULL ,
        prenom      Varchar (250) NOT NULL ,
        email       Varchar (250) NOT NULL ,
        gsm         Varchar (20) NOT NULL ,
        message     Longtext NOT NULL ,
        page_id     Int NOT NULL ,
        titre       Varchar (50) NOT NULL ,
        vehicules_id Int NULL
	,CONSTRAINT fk_formulaires PRIMARY KEY (formulaires)
)ENGINE=InnoDB;




ALTER TABLE garages
	ADD CONSTRAINT garages_fk_horaires
	FOREIGN KEY (horaires_id)
	REFERENCES horaires(horaires_id);

ALTER TABLE horaires
	ADD CONSTRAINT horaires_fk_garages
	FOREIGN KEY (garages_id)
	REFERENCES garages(garages_id);

ALTER TABLE avis
	ADD CONSTRAINT avis_fk_garages
	FOREIGN KEY (garages_id)
	REFERENCES garages(garages_id);

ALTER TABLE users
	ADD CONSTRAINT users_fk_garages
	FOREIGN KEY (garages_id)
	REFERENCES garages(garages_id);

ALTER TABLE users
	ADD CONSTRAINT users_fk_vehicules
	FOREIGN KEY (vehicules_id)
	REFERENCES vehicules(vehicules_id);

ALTER TABLE vehicules
	ADD CONSTRAINT vehicules_fk_users
	FOREIGN KEY (users_id)
	REFERENCES users(users_id);

ALTER TABLE formulaires
   ADD CONSTRAINT formulaires_fk_vehicules
   FOREIGN KEY (vehicules_id)
   REFERENCES vehicules(vehicules_id) ;




   
INSERT INTO `garages` (garages_id, titre_service, description_service, image_service, titre_accueil, description_accueil, image_accueil, gsm, adresse)
VALUES
(1, 'réparation mécanique', 'Le garage V.parrot prends en charge la totalité de vos réparation mécanique', '', 'bienvenue chez V.parrot', 'nouveau garage automobile de Vincent Parrot 15 années d\'expérience', '', '+33 0612345678', 'avenue paris 80230'),
(2, 'réparation carrosserie', 'Votre carrosserie est sous de bonne main dans notre garage', '', 'le garage vous propose plusieurs services', 'nous nous occupons de vos véhicules avec plusieurs services tels que la réparation mécanique, de carrosserie ainsi que les entretiens pour garantir vos performances et votre sécurité', '', '', ''),
(3, 'entretien du véhicule', 'faites confiance a notre garage pour vous assurer un véhicules perfomant grâce a nos services d\'entretien régulier et assurer votre sécurité sur la route', '', 'vente de véhicules d\'occasion', 'nous vous proposons un très bon service de vente de voiture d\'occasion aux meilleurs prix et en bon état', '', '', ''),
(4,'','','','contactez nous','n\'hésitez pas à prendre rendez-vous via notre formulaire ou à laisser votre avis','','','');


INSERT INTO `horaires` (horaires_id, horaires_du_matin, horaires_du_soir,jours)
VALUES (1, '08:45-12:00', '14:00-18:00','lundi'),
       (2, '08:45-12:00', '14:00-18:00','mardi'),
       (3, '08:45-12:00', '14:00-18:00','mercredi'),
       (4, '08:45-12:00', '14:00-18:00','jeudi'),
       (5, '08:45-12:00', '14:00-18:00','vendredi'),
       (6, '08:45-12:00', '','samedi');