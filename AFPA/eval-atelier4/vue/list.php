<?php

include("header.php");

require "../modele/connexion.php";

$requete = $pdo->prepare("SELECT * FROM jarditou.produits");

$requete->execute();

$tab_list = $requete->fetchAll();

//  var_dump($tab_list)
?>

 <H1>Liste matériel</H1>

    <div class= 'row'>
    <div class="table-responsive">
    <table class="table table-bordered table-striped text-center">
        
      <thead class="thead-light">
          <tr>
          <th scope="col">Photo</th>
          <th scope="col">ID</th>
          <th scope="col">Catégorie</th>
          <th scope="col">Libellé</th>
          <th scope="col">Prix</th>
          <th scope="col">Stock</th>
          <th scope="col">Couleur</th>
          <th scope="col">Ajout</th>
          <th scope="col">Modif</th>
          <th scope="col">Bloqué</th>
          </tr> 
      </thead>
      <tbody>
      <?php foreach ($tab_list as $article){ ?>
          <tr>
     
              <td><img src="../images/<?= $article['pro_id']. '.' . $article['pro_photo']?>"width= "100" height= "auto" class="text-center align-middle"></td>
              <td class = 'align-middle'><?= $article['pro_id'] ?> </td>
              <td class = 'align-middle'><?= $article['pro_ref']?></td>
              <td class = 'align-middle'><a href="detail.php?pro_id=<?= $article['pro_id'] ?>" title="libelle" id="link_dark" style= "color: #4169FE; text-decoration: underline" ><?= $article['pro_libelle']?></td>
              <td class = 'align-middle'><?= $article['pro_prix']?></td>
              <td class = 'align-middle'><?= $article['pro_stock']?></td>
              <td class = 'align-middle'><?= $article['pro_couleur']?></td>
              <td class = 'align-middle'><?= $article['pro_d_ajout']?></td>
              <td class = 'align-middle'><?= $article['pro_d_modif']?></td>
              <td class = 'align-middle'><?= $article['pro_bloque']?></td>
              </tr>
          <?php }  ?>
      </tbody>    
    </table> 
  </div>
  </div>

  <a href="../vue/form_ajout.php?pro_id=<?= $article['pro_id']?>" class="btn btn-primary m-0">Ajouter</a>
  <?php 
    include("footer.php");
?>
