<?php

    //Analyse de l'URL avec parse_url() et retourne ses composants
    $url = parse_url($_SERVER['REQUEST_URI']);

    //test soit l'url a une route sinon on renvoi à la racine
    $path = isset($url['path']) ? $url['path'] : '/'; 

    /*--------------------------ROUTER -----------------------------*/
    //test de la valeur $path dans l'URL et import de la ressource

    var_dump($path);
    switch($path){
        
        case "/algo/router-php/" :
        case "/algo/router-php/accueil" :  
            include './controller/accueil.php'; 
            break ; 
    
        case "/algo/router-php/compte": 
            include './controller/compte.php'; 
            break ; 

        case "/algo/router-php/deco": 
            include './controller/deco.php'; 
            break ; 

        case "/algo/router-php/category": 
            include './controller/category.php'; 
            break ; 

        default : 
            include './controller/page404.php'; 
            break ;
    } 

?>