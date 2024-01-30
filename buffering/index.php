<?php 
include 'data.php';
ob_start();

    foreach($USERS_HUMAN as $humain):
?>

<article>
    <h2>nom : <?=$humain["name"]?></h2>
    <p>email : <?=$humain["email"]?></p>
    <p>age : <?=$humain["age"]?> ans</p>
</article>

<?php 
    endforeach;

    $profil =  ob_get_clean();
    
    $title = "Buffering";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=*, initial-scale=1.0">
    <title><?= $title ?></title>
</head>
<body>
    <main>
    <?= $profil ?>
    </main>
</body>
</html>