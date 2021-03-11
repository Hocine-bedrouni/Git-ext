<?php    
include("header.php"); 
    require "connexion.php"; // Inclusion de notre bibliothèque de fonctions
    // $db = connexionBase(); // Appel de la fonction de connexion
    
    $pro_id = $_GET["pro_id"]; // Pour récupérér la variable passée dans l'URL, il faut utiliser le tableau associatif $_GET
    $requete = "SELECT * FROM produits WHERE pro_id=".$pro_id; // Requête SQL pour sélectionner les produits en fonction de leur ID
    $requete2 = "SELECT * FROM categories ORDER BY cat_id"; // Requête SQL pour sélectionner les catégories 
    $result = $db->query($requete); // Exécute la requête SQL et retourne un jeu de résultat
    $result2 = $db->query($requete2);
    
    // Renvoi de l'enregistrement sous forme d'un objet
    $produit = $result->fetch(PDO::FETCH_OBJ);
    $categories = $result2->fetchAll(PDO::FETCH_OBJ);

    date_default_timezone_set('Europe/Paris');
    $date = date("d-m-Y H:i:s");

   
?>

 <div class="row">

<form class="col-lg-12" action="php/produits_modif_script.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="pro_id" value="<?php echo $pro_id; ?>">
<div class="form-group">
    <label for="référence">Référence :</label>
    <input type="text" class="form-control" name="reference" value ="<?=$produit->pro_ref?>" id="reference">   
</div>

<div class="form-group">
    <label for="pro_cat_id">Catégorie :</label>
    <select class="custom-select" name="pro_cat_id" id="pro_cat_id">
    <?php
    foreach($categories as $c) // Pour afficher la liste des catégories sous forme d'un menu déroulant
    {
        ?>
        <option value = "<?= $c->cat_id?>"
        <?php 

        if ($c->cat_id == $produit->pro_cat_id) // Si il y a correspondance on sélectionne la catégorie indiquée
        {
            echo "selected";
        }
        ?>

        > <?=$c->cat_id."-".$c->cat_nom?></option>
        <?php
    }
    
    ?>
    var_dump($categories);
</select>
</div>

<div class="form-group">
    <label for="libellé">Libellé :</label>   
    <input type="text" class="form-control" name="libelle" value ="<?=$produit->pro_libelle?>" id="libelle">  
</div>

<div class="form-group">
    <label for="description">Description :</label>
    <input type="text" class="form-control" name="description" value ="<?=$produit->pro_description?>" id="description">
</div>

<div class="form-group">
    <label for="prix">Prix :</label>  
    <input type="text" class="form-control" name="prix" value ="<?=$produit->pro_prix?>" id="prix">       
</div>

<div class="form-group">
    <label for="stock">Stock :</label>
    <input type="text" class="form-control" name="stock" value ="<?=$produit->pro_stock?>" id="stock"> 
</div>

<div class="form-group">
    <label for="couleur">Couleur :</label> 
    <input type="text" class="form-control" name="couleur" value ="<?=$produit->pro_couleur?>" id="couleur">  
</div>


<p>Produit bloqué ? :</p>

<div class="form-check form-check-inline">
  <input type="radio" class="form-check-input" value = 1 id="bloque_oui" name="bloque" <?php if ($produit->pro_bloque == 1) { echo "checked"; } ?>>
  <label class="form-check-label" for="bloque">Oui</label>
</div>

<div class="form-check form-check-inline">
  <input type="radio" class="form-check-input" value = 0 id="bloque_non" name="bloque" <?php if (is_null($produit->pro_bloque)) { echo "checked"; } ?>>
  <label class="form-check-label" for="bloque">Non</label>
</div>

</div><br>

<!-- TELECHARGEMENT IMAGE -->

<p>Photo du produit :</p>

<input type="hidden" name="MAX_FILE_SIZE" value="104857600" />
    
<p><input type="file" name="fichier" id="fichier"></p>

<div class="form-group">
    <label for="ajout">Date d'ajout :</label> 
    <input type="text" class="form-control" name="ajout" value ="<?=$produit->pro_d_ajout?>" id="ajout"> 
</div>

<div class="form-group">
    <label for="modif">Date de modification :</label> 
    <input type="text" class="form-control" name="modif" value ="<?=$date?>" readonly id="modif">
</div>

<div class="form-group">
    <a href="tableau.php" class="btn btn-dark m-0">Retour</a>
    <input type="submit" class="btn btn-warning m-0" value="Actualiser">
</div>

</form>

<?php
include("footer.php");
?>