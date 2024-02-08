<?php

class Maison {
    //Attributs 
    private $nom;
    private $longueur;
    private $largeur;
    private $nbrEtage;

    //Constructeur
    public function __construct(string $nom, ?int $longueur, ?int $largeur, ?int $nbrEtage) {
        $this->nom = $nom;
        $this->longueur = $longueur;
        $this->largeur = $largeur;
        $this->nbrEtage = $nbrEtage;
    }

    //GETTERS
    public function getNom():string{
        return $this->nom;
    }

    public function getLongueur():float{
        return $this->longueur;
    }
    public function getLargeur():float{
        return $this->largeur;
    }

    //SETTERS
    public function setNom(string $nom):Maison{
        $this->nom = $nom;
        return $this;
    }

    public function setLongueur(float $longueur):Maison{
        $this->longueur = $longueur;
        return $this;
    }

    public function setLargeur(float $largeur):Maison{
        $this->largeur = $largeur;
        return $this;
    }


    //Fonctions :
    //fonction calculer et afficher la superficie de la maison
    public function surface() {
        $superficie = ($this->longueur * $this->largeur) * $this->nbrEtage;
        echo "<p>La superficie de $this->nom est de $superficie m2</p>";
    } 
}

//2ème méthode
class Maison2{
    //Attributs
    public ?string $nom;
    public ?float $longueur;
    public ?float $largeur;

    //Methode
    public function surface2():float {
        return $this->longueur * $this->largeur;
    }
}

?>