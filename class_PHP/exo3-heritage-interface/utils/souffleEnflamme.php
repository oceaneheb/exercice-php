<?php



class SouffleEnflamme implements Attaque {
    //Méthodes
    public function attaquer():int {
        $this->animer(); //fait appel à la fonction animer() en même temps
        return 4;
    }

    public function animer():string {
        return "Des flammes jaillissent";
    }
}

?>