<?php
//CONTROLER DE LA NAVBAR

    $linkProfil = "";
    //-> Permet d'afficher le lien vers Mon Compte et le Boutton de Déconnexion, si on est connecté
    if(isset($_SESSION['connected'])){
        $linkProfil = '<a href="compte.php">Mon Compte</a><a href="category.php">Mes catégories</a><a href="task.php">Mes tâches</a><button><a href="deco.php">Deconnexion</a></button>';
    }

?>