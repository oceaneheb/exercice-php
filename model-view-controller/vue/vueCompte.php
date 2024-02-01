
    <main>
        <h1><?= $login ?></h1>
        <p>Prénom : <?= $prenom ?></p>
        <p>Nom : <?= $nom ?></p>

        <h2>Modifier ses infos personnelles</h2>
        <form action="compte.php" method="post">
            <label for="modifyname">Modifier votre nom</label>
            <input type="text" id="modifyname" name="name_user" value="<?= $nom ?>">
            <label for="modifyfirstname">Modifier votre prénom</label>
            <input type="text" id="modifyfirstname" name="first_name_user" value="<?= $prenom ?>">
            <input type="submit" name="submitData" value="Modifier">
        </form>
    </main>
</body>
</html>