<?php
    session_start();
    $login = "";
    $prenom = "";
    $nom = "";
    $id = "";
    $message = "";

    include './model/modelUser.php';

    //-> Si on est connecté, permet l'affichage des informations du comptes (stoké en $_SESSION)
    if(isset($_SESSION['connected'])){
        $login = $_SESSION['login'];
        $prenom = $_SESSION['firstname'];
        $nom = $_SESSION['name'];
        $id = $_SESSION['id'];
    }

    if(isset($_POST['submitData'])) {
    
        if(isset($_POST['name_user']) and !empty($_POST['name_user']) and
        isset($_POST['first_name_user']) and !empty($_POST['first_name_user'])) {
            
    
            //Nettoyer les données pour obtenir le bon format
            $name_user = htmlentities(strip_tags(stripslashes(trim($_POST['name_user']))));
            $first_name_user = htmlentities(strip_tags(stripslashes(trim($_POST['first_name_user']))));
            
            //Instancier l'obje user
            $user = new ModelUser($_SESSION['id'], $name_user, $first_name_user, null, null);

            $data = $user->modifyProfil();  
            
            //Assigner les nouvelles valeurs aux Global SESSION et au variables $prenom et $nom
            $_SESSION['name']=$name_user;
            $_SESSION['firstname']=$first_name_user;

            $prenom = $first_name_user;
            $nom = $name_user;

            // header('refresh:0');
            $message = $data[0];
    
        } else {
            $message = "Impossible de modifier vos infos";
        }
    }

    
    include './controlerNav.php';

    include './vue/header.php';
    include './vue/nav.php';
    include './vue/vueCompte.php';
?>