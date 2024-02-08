
    <main>
        <h1><?= $login ?></h1>
        <p>Prénom : <?= $prenom ?></p>
        <p>Nom : <?= $nom ?></p>

        <form action="compte.php" method="post">
            <h2>Mis à jour du profil</h2>
            <input type="text" name="prenom" value="<?= $prenom ?>">
            <input type="text" name="nom" value="<?= $nom ?>">
            <input type="submit" name="submit" value="Mettre à Jour">
        </form>
        <p><?= $message ?></p>
    </main>
</body>
</html>