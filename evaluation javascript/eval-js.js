function exo1(){
var jeune = 0;
var moyen = 0;
var vieux = 0;


while (true) {
    var Age = prompt("Veuillez saisir votre age");
    console.log(Age);
    if (Age>=100){
        var vieux = vieux + 1;
       break;
    }
    if (Age < 100 && Age > 40) {
        var vieux = vieux + 1;
    }
    
  if (Age< 40 && Age>20) {
        var moyen = moyen + 1;

    }

     else if (Age < 20) {
        var jeune = jeune + 1;
       
    }
}


document.write("nombre de jeunes "+ jeune);
document.write("<br>");
document.write("nombre d'age moyen "+moyen);
document.write("<br>");
document.write("nombre de personne mature " +vieux);
document.write("<br>");
}

// -------------------------------------------------EXO n°1----------------------------------

function mutliplier(table){
  var table =  prompt("saisir un chiffre");
    var res;
for (i=1; i<=10; i++)
{
    res= table*i;

document.write(i+" x "+table+ " = "+res+"<br>");
}
}
// mutliplier(); j'ai désactivé la fonction qui met le chiffre de la table de multiplication en arguments
// parce
// --------------------------------------------------EXO n°2--------------------------------------------

function modiftable(){
var tab = ["Audrey", "Aurelien","Flavien","Jérémy","Laurent","Melik","Nouara","salem","Samuel","Stéphane" ];
var id= prompt("Veuillez entrer un prenom");
// document.write(tab);
tabindex = tab.indexOf(id);
if(tabindex==-1){
    alert("Erreur le prenom ne correspond pas");

}else {
    console.log(tabindex);
    tab.splice(tabindex,1);
    alert("Le prenom "+ id+" a bien été supprimé");
    tab.push("");
    console.log(tab);
    // pour vérifier qu'il a bien ajourter une case vide à la fin du tableau
    }
document.write(tab);
}

// ------------------------------------------------EXO n°3-----------------------------------------

function prixapayer(){
var pu = prompt("Entrez le prix d'un produit");
var qtecom = prompt("Entrez le nombre d'article");
var tot = parseInt(pu) * parseInt(qtecom);
var rem = tot * 0.1;
var pap = 0;

if (tot > 500) {
    var fp = 0;
    rem = tot * 0.1;
    pap = tot - rem + fp;
    // console.log(pu);         les consol.log me permettent de controler les résultat de chaque variable
    // console.log(qtecom);
    // console.log(tot);
    // console.log(rem);
    // console.log(fp);
} else if (tot > 300) {
    fp = tot * 0.02;
    rem = tot * 0.05;
    pap = tot - rem + fp;
    // console.log(pu);
    // console.log(qtecom);
    // console.log(tot);
    // console.log(rem);
    // console.log(fp);
}
if (tot > 100 && tot < 300) {
    fp = 6;
    rem = tot * 0.05;
    pap = tot - rem + fp;
    // console.log(pu);
    // console.log(qtecom);
    // console.log(tot);
    // console.log(rem);
    // console.log(fp);
}

if (tot >= 100 && tot <= 200) {
    fp = 6;
       rem = tot * 0.05;
    // console.log(pu);
    // console.log(qtecom);
    // console.log(tot);
    // console.log(rem);
    // console.log(fp);

} else if (tot < 100) {
    fp = 6;
    rem = 0;
    pap = tot - rem + fp;
    // console.log(pu);
    // console.log(qtecom);
    // console.log(tot);
    // console.log(rem);
    // console.log(fp);
}


alert("Le prix à payer est de " + pap + " € la remise de "+rem+"€ et les frais de port de "+ fp+"€ sont inclus");
}
//--------------------------------------------------------- EXO n°4------------------------------------------------------------------------------------


