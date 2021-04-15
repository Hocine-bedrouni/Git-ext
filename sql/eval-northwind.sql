1) Liste des contacts français

SELECT CompanyName AS Société, companyName AS contact,
       contacttitle AS Fonction, phone As Téléphone
FROM customers
WHERE country = 'France';


2) Produits vendus par le fournisseur « Exotic Liquids »

SELECT productname AS Prodtuit, unitprice as Prix
FROM products, suppliers
WHERE products.SupplierID = suppliers.SupplierID
AND companyname = 'Exotic Liquids';


3) - Nombre de produits vendus par les fournisseurs Français dans l’ordre décroissant:

SELECT DISTINCT companyname AS Fournisseur,count(productID) AS 'Nbre_produits'
FROM suppliers, products
WHERE suppliers.SupplierID = products.SupplierID
  AND country = 'France'
GROUP BY CompanyName
ORDER BY Nbre_produits DESC;


4) Liste des clients Français ayant plus de 10 commandes

SELECT CompanyName AS Client, count(orderdate) AS Nbre_commandes
from customers, orders
WHERE orders.CustomerID = customers.CustomerID
  AND customers.Country = 'France'
GROUP BY CompanyName
HAVING Nbre_commandes> 10;


5) Liste des clients ayant un chiffre d’affaires > 30.000

SELECT Companyname AS client, sum(quantity*unitprice) AS ca, Country AS pays
FROM orders, customers, orderdetails
WHERE orders.CustomerID = customers.CustomerID
  AND orders.OrderID = Orderdetails.orderId
GROUP BY Companyname, country
HAVING ca >30000
ORDER BY ca desc;


6) Liste des pays dont les clients ont passé commande de produits fournis par « Exotic  Liquids »

SELECT customers.Country AS pays
FROM customers, orders, orderdetails, products, suppliers
WHERE customers.CustomerID = orders.CustomerID
  AND orders.OrderID = orderdetails.OrderID
  AND orderdetails.ProductID = products.ProductID
  AND products.SupplierID = suppliers.SupplierID
  AND Suppliers.companyname = 'Exotic Liquids'
GROUP BY pays;


7) Montant des ventes de 1997

SELECT SUM(quantity*unitprice) as 'Montant des ventes 97'
FROM orderdetails, orders
WHERE orderdetails.OrderID = orders.OrderID
  AND YEAR(Orderdate) = 1997;


8) Montant des ventes de 1997 mois par mois

SELECT MONTH(orderdate) as Mois_97, SUM(quantity*unitprice) as 'Montant des ventes 97'
FROM orderdetails, orders
WHERE orderdetails.OrderID = orders.OrderID
  AND YEAR(Orderdate) = 1997
group by Mois_97;


9) Depuis quelle date le client « Du monde entier » n’a plus commandé ?

SELECT MAX(orderdate) as 'Date dernière commande'
from orders, customers
WHERE orders.CustomerID = customers.CustomerID
  AND companyName = 'Du monde entier';


10) Quel est le délai moyen de livraison en jours ?

SELECT ROUND(avg(datediff(shippeddate, orderdate))) AS 'Délai moyen de livraison en jours'
FROM orders;

