<?php
session_start();

//import de mes ressources
include './utils/functions.php';
include './model/modelCategory.php';

$message = "";
$listCat = "";

//ENREGISTREMENT D'UNE CATEGORIE
//Vérifie que le formulaire est soumis
if(isset($_POST['submit'])){
    //Vérification des champs
    if(isset($_POST['category']) and !empty($_POST['category'])){

        //Nettoyer mes données
        $category = sanitize($_POST['category']);

        //Vérifie si la catégorie existe déjà
        $data = getCategory($category);

        if(empty($data)){

            //Lancer l'enregistrement
            $message = addCategory($category);
        }else{
            $message = "La catégorie existe déjà";
        }
    }else{
        $message = "Veuillez remplir le formulaire.";
    }
}

//AFFICHER LA LISTE DE TOUTES LES CATEGORIES
//Appeler la requête SELECT :
$data = getAllCategory();

//Vérifier la réponse : Si j'ai un tableau de donnée, je le traite, si j'ai une String, je l'affiche
if(gettype($data) === "array" ){
    
    //Traitement de $data pour afficher une liste de catégories
    //J'active le buffering
    ob_start();
    foreach($data as $category){
?>
        <li><?= $category['name_cat'] ?></li>
<?php
    }

    //Je récupère mes données mises en mémoire tampon
    $listCat = ob_get_clean();
}else{
    $listCat = "<li> $data </li>";
}


include './controller/controlerNav.php';
include './vue/header.php'; //-> affiche la header
include './vue/nav.php'; //-> affiche la navbar
include './vue/vueCategory.php'
?>