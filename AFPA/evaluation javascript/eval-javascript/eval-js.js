
//--------------------------------------------------------- EXO n°1------------------------------------------------------------------------------------
function exo1() {
    var jeune = 0;
    var moyen = 0;
    var vieux = 0;


    while (true) {
        alert("cette fonction permet de comparer les ages et de les classer selon 3 catégories")
        var Age = prompt("Veuillez saisir votre age la saisie sarrête avec un chiffre supérieur a 100 qui sera lui même comptablisisé ");
        console.log(Age);
        if (Age >= 100) {
            var vieux = vieux + 1;
            break;
        }
        if (Age < 100 && Age > 40) {
            var vieux = vieux + 1;
        }

        if (Age < 40 && Age > 20) {
            var moyen = moyen + 1;

        }

        else if (Age < 20) {
            var jeune = jeune + 1;

        }
    }


    document.write("nombre de jeunes " + jeune);
    document.write("<br>");
    document.write("nombre de personnes d'age moyen " + moyen);
    document.write("<br>");
    document.write("nombre de personnes mature " + vieux);
    document.write("<br>");
}

// -------------------------------------------------EXO n°2----------------------------------

// Fonction qui affiche une table de multiplication

function mutliplier(table) {
    var table = prompt("saisir un chiffre afin d'afficher sa table de multiplication");
    var res;
    for (i = 1; i <= 10; i++) {
        res = table * i;

        document.write(i + " x " + table + " = " + res + "<br>");
    }
}
// mutliplier(); j'ai désactivé la fonction qui met le chiffre de la table de multiplication en arguments
// parce qu'il est demandé lors du clique sur le bouton exo n°2


// --------------------------------------------------EXO n°3--------------------------------------------

// Fonction supprimer un nom dans le tableau et rajouter une case vide en fin de tableau

function modiftable() {
    var tab = ["Audrey", "Aurelien", "Flavien", "Jérémy", "Laurent", "Melik", "Nouara", "Salem", "Samuel", "Stéphane"];
    // document.write(tab);
    var id = prompt("Veuillez entrer un prenom, si celui-ci se trouve dans le tableau il sera supprimé." + "\n voici la liste des prénoms contenus dans le tableau " + tab);
    tabindex = tab.indexOf(id);
    if (tabindex == -1 || id == "") {
        alert("Erreur le prenom ne correspond pas");
        // si le prenom ne correspond pas on demande à l'utilisateur si il veut continuer
        if (confirm("voulez-vous continuer") == true) {
            modiftable();
        } else {
            return;
        }

    } else {
        console.log(tabindex);
        tab.splice(tabindex, 1);
        alert("Le prenom " + id + " a bien été supprimé");
        tab.push("(case vide)");
        console.log(tab);
        // pour vérifier qu'il a bien ajouter une "case vide" à la fin du tableau
    }
    document.write(tab + "<br>")
    if (confirm("voulez-vous continuer") == true) {
        modiftable();
    } else {
        return;
    }

}


// ------------------------------------------------EXO n°4-----------------------------------------

// Fonction qui permet de calculer le prix a payer à partir du nombre de produits et de son prix

function prixapayer() {
    var pu = prompt("Entrez le prix d'un produit");
    var qtecom = prompt("Entrez le nombre d'article");
    var tot = parseInt(pu) * parseInt(qtecom);
    var rem = tot * 0.1;
    var pap = 0;

    // pour une commande à 500€ les frais de port sont nul
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

    // en dessous de 300€ de commande les frais de port seront 6€ obligatoirement
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


    alert("Le prix à payer est de " + pap + " € \n la remise de " + rem + "€ \n et les frais de port de " + fp + "€ sont inclus");
}



