<?php


// GESTION DES MESSAGES D'ERREUR

// Initialisation d'un tableau d'erreur

$aErreur = [];

// REFERENCE

if(empty ($_POST["reference"]))
{
    $aErreur[] = "erreur1=true";
}
else if(!preg_match("/^[A-zA-ZñéèîïÉÈÎÏ0-9][A-zA-Zñéèêàçîï0-9]+([-'\s][A-zA-ZñéèîïÉÈÎÏ0-9][A-zA-Zñéèêàçîï0-9]+)?$/",($_POST["reference"])))
{
    $aErreur[] = "erreur1b=true";
}
else
{
    echo "Référence : ". $_POST["reference"] . "<br>";
}

// CATEGORIE

if (empty($_POST["pro_cat_id"])) 
{

    $aErreur[] = "erreur2=true"; 
}
else
{
    echo "Catégorie =". $_POST["pro_cat_id"]."<br>";
}


// LIBELLE

if(empty ($_POST["libelle"]))
{
    $aErreur[] = "erreur3=true";
}
else
{
    echo "Libellé : ". $_POST["libelle"] . "<br>";
}



// DESCRIPTION

if(empty ($_POST["description"]))
{
    $aErreur[] = "erreur4=true";
}
else
{
    echo "Description : ". $_POST["description"] . "<br>";
}

// PRIX

if(empty ($_POST["prix"]))
{
    $aErreur[] = "erreur5=true";
}
else if(!preg_match("/^[0-9]+$/",($_POST["prix"])))
{
    $aErreur[] = "erreur5b=true";
}
else
{
    echo "Prix : ". $_POST["prix"] . "<br>";
}

// STOCK

if(empty ($_POST["stock"]))
{
    $aErreur[] = "erreur6=true";
}
else if(!preg_match("/^[0-9]+$/",($_POST["stock"])))
{
    $aErreur[] = "erreur6b=true";
}
else
{
    echo "Prix : ". $_POST["stock"] . "<br>";
}

// COULEUR

if(empty ($_POST["couleur"]))
{
    $aErreur[] = "erreur7=true";
}
else
{
    echo "Couleur : ". $_POST["couleur"] . "<br>";
}

// PRODUIT BLOQUE

if( ! isset ($_POST["bloque"]))
{
    $aErreur[] = "erreur8=true";
}
else
{
    echo "Produit bloqué : ". $_POST["bloque"] . "<br>";
}

// CONNEXION A LA BDD ET RECUPERATION DES INFORMATIONS AVEC DES REQUETES SQL

require "../modele/connexion.php";
// $pdo = connexionBase();
//$objetPdo = new PDO('mysql:host=localhost;charset=utf8;dbname=jarditou', 'root', '');
date_default_timezone_set('Europe/Paris'); // Pour récupérer l'heure locale
$date = date("Y-m-d H:i:s");
//$pro_cat_id = $_POST["pro_cat_id"];

// Requête SQL pour insérer les valeurs ajoutées dans le formulaire d'ajout
$pdoStat = $pdo ->prepare("INSERT INTO produits(pro_ref, pro_cat_id, pro_libelle, pro_description, pro_prix, pro_stock, pro_couleur, pro_bloque, pro_d_ajout)
VALUES(:pro_ref, :pro_cat_id, :pro_libelle, :pro_description, :pro_prix, :pro_stock, :pro_couleur, :pro_bloque, '".$date."')");


$pdoStat->bindValue(':pro_ref', $_POST['reference'], PDO::PARAM_STR); // bindValue : Associe une valeur à un paramètre - $_POST['reference'] : on récupère le name du fichier produits_ajout.php
$pdoStat->bindValue(':pro_cat_id', $_POST['pro_cat_id'], PDO::PARAM_STR);
$pdoStat->bindValue(':pro_libelle', $_POST['libelle'], PDO::PARAM_STR);
$pdoStat->bindValue(':pro_description', $_POST['description'], PDO::PARAM_STR);
$pdoStat->bindValue(':pro_prix', $_POST['prix'], PDO::PARAM_STR);
$pdoStat->bindValue(':pro_stock', $_POST['stock'], PDO::PARAM_STR);
$pdoStat->bindValue(':pro_couleur', $_POST['couleur'], PDO::PARAM_STR);


// Condition si le produit n'est pas bloqué alors cela affiche 0 ou NULL dans le tableau phpMyAdmin
if ($_POST['bloque']==0) {
    $bloque = NULL;
} else if  ($_POST['bloque']==1) { // Si le produit est bloqué alors cela affiche 1 dans le tableau phpMyAdmin
    $bloque = 1;
}

$pdoStat->bindValue(':pro_bloque', $bloque, PDO::PARAM_STR);

$InsertIsOk = $pdoStat ->execute();

if($InsertIsOk){
    //$message = "Le produit a été rajouté dans la base de données";
    $new_id = (int)($pdo -> lastInsertId()); // En lien avec l'insertion d'image et le renommage du fichier qui sera l'ID
    $message = "Insertion réussie";
}
else{
    $message = "Echec de l'insertion";
}

// Récupération de l'extension du fichier
$extension = substr (strrchr ($_FILES['fichier']['name'], "."), 1);
$nouveauNom = $new_id.'.'.$extension;

// Requête SQL pour récupérer le nouveau nom qui est l'ID
$requete2 = $pdo ->prepare("UPDATE produits SET pro_id=:nouveauNom WHERE pro_id=:pro_id");
$requete2->bindValue(':nouveauNom', $nouveauNom, PDO::PARAM_INT);
$requete2->bindValue(':pro_id', $new_id, PDO::PARAM_INT);

// INSERTION IMAGE

// Source web : https://www.youtube.com/watch?v=2RofhTyNFyI

// var_dump($_POST['FileName']); // Permet à l'utilisateur de renommer le fichier uploadé
// echo "<pre>"; // Pour afficher le tableau en ligne
// var_dump($_FILES);

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

$InsertIsOk2 = $requete2 ->execute();


if($InsertIsOk2){
    //$message = "Le produit a été rajouté dans la base de données";
    header("Location: ../vue/list.php"); // Si le produit a bien été ajouté, il y a une redirection ver le tableau.php
}
else{
    $message = "Echec de la modification";
}

// Initialisation d'une condition pour que toutes les erreurs apparaissent en même temps
if (!empty($aErreur)) // Si le tableau n'est pas vide
{
    $sUrl = implode("&", $aErreur); // Alors on regroupe toutes les erreurs
    header("Location: ../vue/list.php?".$sUrl); // On affiche les erreurs dans le formulaire formulaire.php
    exit; // Arrêt de la condition
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajout du produit</title>
</head>
<body>
    <h1>Ajout du produit</h1>
    <p><?php echo $message; ?></p> <!-- Affichage du message confirmant l'insertion du produit ou l'échec d'insertion -->
</body>
</html>
