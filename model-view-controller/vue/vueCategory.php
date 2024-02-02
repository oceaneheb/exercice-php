    
    <main>
        <h2>Ajouter une catégorie</h2>
        <form action="category.php" method="post">
            <input type="text" name="name_cat" placeholder="Nom de la catégorie">
            <input type="submit" name="submitCategory" value="Ajouter la catégorie">
        </form>
        <p><?= $message ?></p>
        <h2>Liste des catégories</h2>
        <ul><?= $list ?></ul>
    </main>
</body>
</html>