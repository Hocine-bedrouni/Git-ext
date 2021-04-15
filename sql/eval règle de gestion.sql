DELIMITER $$
CREATE TRIGGER compare_pays before INSERT ON order_details
    FOR EACH ROW
BEGIN
    DECLARE pay_livraison VARCHAR (15);
    DECLARE pay_fournisseur VARCHAR(15);
    DECLARE id_command INT ;
    DECLARE id_produit INT ;
    DECLARE id_fournisseur int;
    SET id_command = NEW.orderid;
    SET id_produit =NEW.productid;
    SET id_fournisseur=(SELECT products.supplierid FROM products,suppliers
                        WHERE products.SupplierID=suppliers.SupplierID
                          AND products.ProductID=id_produit);
    SET pay_livraison = ( SELECT orders.ShipCountry FROM orders, order_details, products, suppliers
                          WHERE orders.OrderID = order_details.OrderID
                            AND order_details.ProductID = products.ProductID
                            AND products.SupplierID = suppliers.SupplierID
                            AND  id_command=orders.OrderID
                            AND id_produit = order_details.ProductID);
    SET pay_fournisseur= ( SELECT suppliers.Country FROM orders, order_details, products, suppliers
                           WHERE products.SupplierID = suppliers.SupplierID
                             AND order_details.ProductID = products.ProductID
                             AND orders.OrderID = order_details.OrderID
                             AND  id_command=orders.OrderID
                             AND id_produit = order_details.ProductID
                             AND id_fournisseur=suppliers.SupplierID);
    IF pay_livraison<>pay_fournisseur THEN
        SIGNAL SQLSTATE '40000' SET MESSAGE_TEXT ="le pays du fournisseur étant différent du pays de livraison, la commande est annulée";
    END IF;
END $$
delimiter ;