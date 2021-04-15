
/*Depuis quelle date le client « Du monde entier » n’a plus commandé ?*/

DELIMITER $$
CREATE PROCEDURE date_derniere_commande(IN entreprise VARCHAR(50))
BEGIN
    SELECT MAX(orderdate) FROM orders
    JOIN customers
    ON orders.customerid = customers.customerid
    WHERE companyname = entreprise;
END $$
DELIMITER;

CALL date_derniere_commande('Du monde entier');


/*Quel est le délai moyen de livraison en jours ?*/

DELIMITER $$
CREATE PROCEDURE delai_livraison(IN datelivraison DATE, datecommande DATE)
BEGIN
    SELECT floor(avg(DATEDIFF(datelivraison, datecommande)))
    from orders;
END $$
DELIMITER ;

CALL delai_livraison(shippeddate, orderdate);