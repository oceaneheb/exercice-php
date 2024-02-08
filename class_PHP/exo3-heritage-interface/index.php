<?php

include './interface/Attaque.php';
include './utils/jetDeau.php';
include './utils/rayonDeLumiere.php';
include './utils/souffleEnflamme.php';

include './model/modelElement.php';
include './model/modelPokemon.php';

include './model/dracofeu.php';
include './model/florizard.php';
include './model/tortank.php';


//Instancier un pokémon Dracofeu
$dracofeu = new Dracofeu();
$dracofeu->setName("Dracofeu")->setAge(2)->setBackground("3 combats à son actif")->setElement(new Element("feu", ['plante'], ['eau'], new SouffleEnflamme()));

echo $dracofeu->getName();
echo $dracofeu->getElement()->getAttaque()->animer();
var_dump($dracofeu);
// $dracofeu->parler();
// $dracofeu->attaquerUneCible($florizarre);

echo '<br>';
echo '<br>';

$souffleFeu = new SouffleEnflamme();
echo $souffleFeu->attaquer();

echo '<br>';


//EXECUTION DU CODE
//on va donner à dracofeu un souffle enflammé
//1. Créer un souffle enflammé
$souffle = new SouffleEnflamme();
//2. Créer un Element pour lui mettre le souffle
$element = new Element(null, null, null, $souffle);
//3. Mettre l'élement à mon dracofeu
$dracofeu->setElement($element);

//Avec constructeur 
$dracofeu->setElement(new Element(null,null,null,(new SouffleEnflamme)));

//Sans constructeur
// $dracofeu->setElement(new Element())->getElement()->setAttaque(new SouffleEnflamme);

?>