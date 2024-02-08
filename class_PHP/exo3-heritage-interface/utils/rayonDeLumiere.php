<?php



class RayonDeLumiere implements Attaque {
    //Méthodes
    public function attaquer():int {
        return 7;
    }

    public function animer():string {
        return "Un rayon de lumière éclaire la cible";
    }
}

?>