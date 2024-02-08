<?php 
    session_start();
    
    $list = "";
    

    //Importer le modelUser
    include './model/modelCategory.php';

    $message = "";

    //Vérifier la soumission du formulaire
    if(isset($_POST['submitCategory'])) {

        //Vérifier le remplissage du champ name_category
        if(isset($_POST['name_cat']) and !empty($_POST['name_cat'])) {

            //Nettoyer les datas
            $name_cat = htmlentities(strip_tags(stripslashes(trim($_POST['name_cat']))));
            
            //Créer une instance de la Class ModelCategory()
            $modelCategory = new ModelCategory($name_cat);

            //Appeler la fonction addCategory sur la nouvelle instance
            $data = $modelCategory->addCategory();

            //Vérifier que la catégorie n'existe pas
            // --------- A FAIRE --------------

        } else {
            $message = "Veuillez remplir tous les champs du formulaire";
        }
    }

    $modelCategory = new ModelCategory(null);
    $listCategories = $modelCategory->displayCategories();

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