
<?php
 require "../modele/connexion.php";
 date_default_timezone_set('Europe/Paris'); // Toujours le datetime avant la variable $date
 $date = date("Y-m-d H:i:s");
// var_dump($_FILES);

// Récupération de l'extension du fichier
$extension = substr (strrchr ($_FILES['fichier']['name'], "."), 1);
$nouveauNom = $_POST['pro_id'].'.'.$extension;

$requete = $pdo->prepare("UPDATE produits SET pro_ref=:pro_ref, pro_cat_id=:pro_cat_id, pro_libelle=:pro_libelle, pro_description=:pro_description, 
pro_prix=:pro_prix, pro_stock=:pro_stock, pro_couleur=:pro_couleur, pro_bloque=:pro_bloque, pro_d_modif='".$date."', pro_id=:pro_id WHERE pro_id=:pro_id");

$requete->bindValue(':pro_ref', $_POST['reference'], PDO::PARAM_STR);
$requete->bindValue(':pro_cat_id', $_POST['pro_cat_id'], PDO::PARAM_STR);
$requete->bindValue(':pro_libelle', $_POST['libelle'], PDO::PARAM_STR);
$requete->bindValue(':pro_description', $_POST['description'], PDO::PARAM_STR);
$requete->bindValue(':pro_prix', $_POST['prix'], PDO::PARAM_STR);
$requete->bindValue(':pro_stock', $_POST['stock'], PDO::PARAM_STR);
$requete->bindValue(':pro_couleur', $_POST['couleur'], PDO::PARAM_STR);
$requete->bindValue(':pro_id', $nouveauNom, PDO::PARAM_STR);
$requete->bindValue(':pro_id', $_POST['pro_id'], PDO::PARAM_INT);

if ($_POST['bloque']==0) {
    $bloque = NULL;
} else if  ($_POST['bloque']==1) {
    $bloque = 1;
}

$requete->bindValue(':pro_bloque', $bloque, PDO::PARAM_STR);


 // ----------------------------- SECURITE - VERIFICATION DU TYPE DE FICHIER AUTORISE -----------------------------

// On met les types autorisés dans un tableau (ici pour une image)
// Liste des types autorisés : https://developer.mozilla.org/fr/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Complete_list_of_MIME_types
$aMimeTypes = array("image/gif", "image/jpeg", "image/jpg", "image/pjpeg", "image/png", "image/x-png", "image/tiff");
 

 

if($_FILES["fichier"]["tmp_name"]!= Null){
    // On ouvre l'extension FILE_INFO
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    // On extrait le type MIME du fichier via l'extension FILE_INFO 
    $mimetype = finfo_file($finfo, $_FILES["fichier"]["tmp_name"]);
    // On ferme l'utilisation de FILE_INFO 
    finfo_close($finfo);
    if (in_array($mimetype, $aMimeTypes))
    {
        /* Le type est parmi ceux autorisés, donc OK, on va pouvoir déplacer et renommer le fichier */          
    } 
    else 
    {
       // Le type n'est pas autorisé, donc ERREUR
     
       echo "Type de fichier non autorisé";    
       exit;
    } 
}
 


// ----------------------------- LIMITATION TAILLE FICHIER -----------------------------

$taille_max    = 104857600; // Convertir Ko en Mo : 200 Ko est égal à 200 000 Mo
$taille_fichier = filesize($_FILES['fichier']['tmp_name']);

// var_dump($taille_fichier); // Pour connaitre la taille du fichier

if ($taille_fichier > $taille_max)
{
    
    echo "Vous avez dépassé la taille de fichier autorisée";
    exit;
}

// ----------------------------- UPLOAD ET RENOMMAGE DE FICHIER -----------------------------

$cheminEtNomTemporaire = $_FILES['fichier']['tmp_name']; // ['fichier'] récupère le name du fichier qui s'appelle fichier à la ligne 189 dans l'input de produits_ajout.php

$cheminEtNomDefinitif = '../images/'.$nouveauNom;

$moveIsOk = move_uploaded_file($cheminEtNomTemporaire, $cheminEtNomDefinitif); // Fonction qui permet de renommer et déplacer le fichier dans le dossier souhaité


if ($moveIsOk) {

    $message = "Le fichier a été uploadé dans ".$cheminEtNomDefinitif;

}
else {

    $message ="Suite à une erreur, le fichier n'a pas été uploadé";

}

$InsertIsOk = $requete ->execute();

if($InsertIsOk){
    //$message = "Le produit a été rajouté dans la base de données";
    header("Location: ../vue/list.php"); // Si le produit a bien été ajouté, il y a une redirection vers le tableau.php
   
}
else{
    $message = "Echec de l'insertion";
}
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modification du produit</title>
</head>
<body>
    <h1>Modification du produit</h1>
    <p><?php echo $message; ?></p>
</body>
</html> -->


