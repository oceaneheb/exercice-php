   
    <main>
        <h2>Ajouter une tâche</h2>
        <form action="task.php" method="post">

            <input type="text" name="nom_task" placeholder="Nom de la tâche">
            <input type="text" name="content_task" placeholder="Contenu de la tâche">
            <input type="date" name="date_task" placeholder="Date">
            <input type="text" name="id_cat" placeholder="Catégorie">
            <label for="list_categories">Choisir la catégorie :</label> 
            <select name="list_categories" id="list_categories"> 
                <?= $listCategories ?>
            </select>

            <input type="submit" name="submitTask" value="Ajouter la tâche">

        </form>

        <p><?= $message ?></p>
        <h2>Liste des tâches</h2>
        <!--<ul><?= $listTasks ?></ul>-->
    </main>
</body>
</html>