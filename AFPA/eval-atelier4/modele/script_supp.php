<?php
require "../modele/connexion.php";

$requete = $pdo->prepare("DELETE FROM produits WHERE pro_id=:pro_id LIMIT 1");
$requete->bindValue(":pro_id", $_GET['pro_id']);
$idok = $requete->execute();


if($idok){
    //$message = "Le produit a été supprimé dans la base de données";
    header("Location: ../vue/list.php"); // Si le produit a bien été supprimé, il y a une redirection ver le tableau.php
}
else{
    $message = "Echec de la suppression";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Suppression du produit</title>
</head>
<body>
    <h1>Suppression du produit</h1>
    <p><?php echo $message; ?></p>
</body>
</html>