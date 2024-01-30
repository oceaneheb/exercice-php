<?php
include("../data.php");

$tabData = array();

$tabData[] = $USERS_HUMAN;
$tabData[] = $USERS_PET;
$tabData[] = $USERS_XENO;

function afficherHummain($value) {
    ?>
    <article style= 'border-bottom : 3px solid black'>
        <h2>nom : <?=$value["name"]?></h2>
        <p>email : <?=$value["email"]?></p>
        <p>age : <?=$value["age"]?> ans</p>
    </article>
    <?php
};

// afficherHummain($USERS_HUMAN[0]);

function afficherAnimal($value) {
    ?>
    <article style= 'border-bottom : 3px solid black '>
        <h2>nom : <?=$value["name"]?></h2>
        <p>espece : <?=$value["espece"]?></p>
        <p>age : <?=$value["age"]?> ans</p>
        <p>propriétaire : <?=$value["propriétaire"]?></p>
    </article>
    <?php
};

// afficherAnimal($USERS_PET[0]);

function afficherXeno($value) {
    ?>
    <article style= 'border-bottom : 3px solid black '>
        <h2>nom : <?=$value["name"]?></p>
        <p>espece : <?=$value["espece"]?></p>
        <p>age : <?=$value["age"]?> ans</p>
        <p>niveau de menace: <?=$value["menace"]?></p>
    </article>
    <?php
};
// afficherXeno($USERS_XENO[0]);

/* 9. Créer la fonction profil() */
function profil($tab) {
    foreach($tab as $value):
            if($value['type'] == "humain"):
                afficherHummain($value);
            elseif ($value['type'] == "animal de compagnie"):
                afficherAnimal($value);
            elseif ($value['type'] == "Xeno"):
                afficherXeno($value);
            else: ?>
            <p>"Type de Profil non Existant"</p>
            <?php endif; 
    endforeach;
};

// profil($USERS_HUMAN);
// profil($USERS_PET);
// profil($USERS_XENO);


/* 10. Créer la fonction allProfil() */
function allProfil($allTab) { 
    foreach($allTab as $tab): ?>
        <?= profil($tab);
    endforeach; 
};

allProfil($tabData);
?>