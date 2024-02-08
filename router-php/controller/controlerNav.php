<?php
//CONTROLER DE LA NAVBAR

    $linkProfil = "";
    //-> Permet d'afficher le lien vers Mon Compte et le Boutton de Déconnexion, si on est connecté
    if(isset($_SESSION['connected'])){
        $linkProfil = '<a href="category">Catégories</a><a href="compte">Mon Compte</a><button><a href="deco">Deconnexion</a></button>';
    }

?>