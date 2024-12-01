<?php
access_view('/components/head.view', ['title' => 'Logements']);
?>

<body>
    <?php
    access_view('/components/header.view');
    ?>
    <div class="container">
        <?php
        access_view('/components/sidebar.view');
        ?>
        <main class="content">
            <h2>Ajouter un logement</h2>
            <style>
                .form-container {
                    margin-top: 18px;
                }
            </style>
            <div class="form-container">
                <form action="/admin/dashboard/logements/save" method="post">
                    <h2>Ajout d'un logement</h2>
                    <label for="title">Titre:</label>
                    <input type="text" id="title" name="title" placeholder="Ajouter un titre">
                    <label for="host">Adresse mail propriétaire :</label>
                    <input type="email" id="host" name="host" placeholder="Ajouter un propriétaire">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" placeholder="Ajouter une description">  </textarea>
                    <label for="location">Localisation:</label>
                    <input type="text" id="location" name="location" placeholder="Ajouter une localisation">
                    <label for="cover">Image de couverture:</label>
                    <input type="text" id="cover" name="cover" placeholder="Ajouter une image de couverture">
                    <div class="pictures">
                        <label for="new-photo">Ajouter des photos :</label>
                        <div class="item-input">
                            <input type="text" id="new-photo" placeholder="Nouvelle photo">
                            <button class="btn btn-ajout-form" type="button" onclick="add_item('pictures','photo')">Ajouter</button>

                        </div>
                        <ul class="add-list" id="pictures">

                        </ul>
                    </div>
                    <div class="equipments">
                        <label for="new-equipment">Ajouter des équipements:</label>
                        <div class="item-input">
                            <input type="text" id="new-equipment" placeholder="Nouvel équipement">
                            <button class="btn btn-ajout-form" type="button" onclick="add_item('equipments','equipment')">Ajouter</button>
                        </div>
                        <ul class="add-list" id="equipments"></ul>
                    </div>
                    <div class="tags">
                        <label for="new-tag">Ajouter des tags:</label>
                        <div class="item-input">
                            <input type="text" id="new-tag" placeholder="Nouveau tag">
                            <button class="btn btn-ajout-form" type="button" onclick="add_item('tags','tag')">Ajouter</button>
                        </div>
                        <ul class="add-list" id="tags"></ul>
                    </div>

                    <button class="btn btn-back">
                        <a href="/admin/dashboard/logements">Retour</a>
                    </button>
                    <button class="btn btn-add" type="submit">Ajouter</button>
                </form>
                <script>
                    function add_item(items, item) {
                        const newItemInput = document.getElementById(`new-${item}`);
                        console.log(items);
                        const itemsList = document.getElementById(`${items}`);
                        if (newItemInput.value.trim() !== '') {
                            const li = document.createElement('li');
                            li.classList.add('equipment-li');
                            li.innerHTML = `
                    ${newItemInput.value}
                    <input type="hidden" name="${items}[]" value="${newItemInput.value}">
                    <button type="button" class="btn btn-delete" onclick="this.parentElement.remove()">Supprimer</button>
                `;
                            itemsList.appendChild(li);
                            newItemInput.value = '';
                        }
                    }
                </script>
            </div>
        </main>
    </div>
</body>

</html>