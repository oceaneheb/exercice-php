<?php 
    session_start();
    
    $list = "";

    //Importer le modelUser
    include './model/modelUser.php';

    $message = "";

    //Vérifier la soumission du formulaire
    if(isset($_POST['submitCategory'])) {

        //Vérifier le remplissage du champ name_category
        if(isset($_POST['name_cat']) and !empty($_POST['name_cat'])) {

            //Nettoyer les datas
            $name_cat = htmlentities(strip_tags(stripslashes(trim($_POST['name_cat']))));

            //Appeler la fonction addCategory dans modelUser
            $data = addCategory($name_cat);

            //Vérifier que la catégorie n'existe pas
            // --------- A FAIRE --------------

        } else {
            $message = "Veuillez remplir tous les champs du formulaire";
        }
    }

    $listCategories = displayCategories();

    ob_start();

    //Pour chaque catégorie de la liste, afficher un <li>
    foreach($listCategories as $category) { 
?>

<li>
    <?= $category['name_cat'] ?>
</li>

<?php

    };

    $list =  ob_get_clean();

    include './controlerNav.php';
    include './vue/header.php';
    include './vue/nav.php';
    include './vue/vueCategory.php'

?>