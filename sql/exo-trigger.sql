Les Déclencheurs
Exo 1
1)
DELIMITER $$
CREATE TRIGGER modif_resa before INSERT ON reservation
    FOR EACH ROW
BEGIN
    SIGNAL SQLSTATE '40000' SET MESSAGE_TEXT = 'impossible de modifier les reservations ';
END $$
DELIMITER ;

2)
DELIMITER $$
CREATE TRIGGER insert_reservation before INSERT ON reservation
    FOR EACH ROW
BEGIN
    if (SELECT COUNT(*) FROM reservation, chambre, hotel
        WHERE res_cha_id = cha_id
          AND cha_hot_id = hot_id) >10
    then SIGNAL SQLSTATE '40000' SET MESSAGE_TEXT = 'impossible total chambre dépassée ';
    END if;
END $$
DELIMITER ;

3)
DELIMITER $$
CREATE TRIGGER insert_resa2 before INSERT ON reservation
    FOR EACH ROW
BEGIN
    DECLARE varint INT;
    SET varint = NEW.res_cli_id;

    if (SELECT COUNT(res_cli_id) FROM reservation
        where varint = res_cli_id) > 3
    then SIGNAL SQLSTATE '40000' SET MESSAGE_TEXT = 'impossible total reservation dépassée ';
    END if;
END $$
DELIMITER ;

4)
DELIMITER $$
CREATE TRIGGER insert_chambre before INSERT ON reservation
    FOR EACH ROW
BEGIN
    if (SELECT count(cha_id) FROM chambre
        WHERE cha_hot_id = 1) >50
    then SIGNAL SQLSTATE '40000' SET MESSAGE_TEXT = 'impossible le total de chambres enregistrées est dépassées';
    END if;
END $$
DELIMITER ;


Cas pratique
1) cf ncode

2)
DELIMITER $$
CREATE TRIGGER supp_lig AFTER DELETE ON lignedecommande
    FOR EACH ROW
BEGIN
    DECLARE id_vieu INT;
    DECLARE sous double;
    DECLARE reduc INT;
    SET id_vieu = old.id_commande;
    SET reduc = (SELECT (remise/100) FROM commande WHERE id=id_vieu);
    SET sous = (SELECT SUM(prix*quantite)*(1-reduc) FROM lignedecommande WHERE id_commande = id_vieu);
    UPDATE commande SET total=(total-sous) WHERE id=id_vieu;
END $$
DELIMITER ;

3) DELIMITER $$
CREATE TRIGGER maj_lig BEFORE update ON lignedecommande
    FOR EACH ROW
BEGIN
    DECLARE id_vieu INT;
    DECLARE sous double;
    DECLARE reduc INT;
    SET id_vieu = old.id_commande;
    SET reduc = (SELECT (remise/100) FROM commande WHERE id=id_vieu);
    SET sous = (SELECT SUM(prix*quantite)*(1-reduc) FROM lignedecommande WHERE id_commande = id_vieu);
    UPDATE commande SET total=(total-sous) WHERE id=id_vieu;
END $$
DELIMITER ;

Déclencheur Papyrus
Créer la table
CREATE table article_a_commander (
                                     id_art_com  int AUTO_INCREMENT NOT NULL,
                                     Date_comm timestamp,
                                     qte INT,
                                     codart_id CHAR (4) not null,
                                     PRIMARY KEY (id_art_com),
                                     FOREIGN KEY(codart_id) REFERENCES produit(codart)
);


/*Créer un déclencheur UPDATE sur la table produit : lorsque le stock physique devient inférieur ou égal au stock d'alerte, une nouvelle ligne est insérée dans la table ARTICLES_A_COMMANDER.*/

DELIMITER $$
CREATE TRIGGER gest_stock AFTER UPDATE ON produit
    FOR EACH ROW
BEGIN
    DECLARE st_al int;
    DECLARE st_ph INT ;
    DECLARE codart_iden CHAR (4);
    DECLARE qante INT;
    SET st_ph = NEW.stkphy;
    SET qante = (st_al-st_ph);
    SET codart_iden = NEW.codart;
    SET st_al = (SELECT stkale FROM produit WHERE codart = codart_iden);
    IF (st_al > st_ph) AND codart_iden NOT IN (SELECT article_a_commander.codart_id from article_a_commander WHERE codart_id = codart_iden) THEN
        INSERT INTO article_a_commander VALUES  (NULL, CURDATE(), qante, codart_iden);
    ELSE UPDATE article_a_commander SET qte = qante WHERE codart_id = codart_iden;

    END IF;
END $$
DELIMITER ;