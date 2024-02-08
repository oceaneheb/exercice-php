<?php

//Créer une class abstraite 
// abstract class Pokemon {
class Pokemon {
    //ATTRIBUTS
    private ?string $name;
    private ?int $age;
    private ?string $background;
    private ?Element $element; //retourne un objet

    //GETTERS
    public function getName():?string {
        return $this->name;
    }

    public function getAge():?int {
        return $this->age;
    }

    public function getBackground():?string {
        return $this->background;
    }

    public function getElement():?Element {
        return $this->element;
    }

    //SETTERS 
    public function setName(?string $name):Pokemon {
        $this->name = $name;
        return $this;
    }

    public function setAge(?int $age):Pokemon {
        $this->age = $age;
        return $this;
    }

    public function setBackground(?string $background):Pokemon {
        $this->background = $background;
        return $this;
    }

    public function setElement($element):Pokemon {
        $this->element = $element;
        return $this;
    }

    //METHODES
    //METHODE CONCRETE 
    public function parler() {
        //Phrase à retourner quand le Pokemon parle
    }

    public function attaquerUneCible(?Pokemon $cible):?int {
        echo $this->getName()." attaque ".$cible->getName()."adverse.";
        return 10;
    }

    //METHODE ABSTRAITE : -> on utilise le mot clé abstract avant le mot clé function
    //public abstract function parler():?string;
}

?>