<?php



class JetDeau implements Attaque {
    //Méthodes
    public function attaquer():int {
        $this->animer();
        return 5;
    }

    public function animer():string {
        return "Lancement d'un jet d'eau sur la cible";
    }
}

?>