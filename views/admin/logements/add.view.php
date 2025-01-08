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
            <div class="form-container">
                <form action="/admin/dashboard/logements/save" method="post">
                    <input type="hidden" name="rating" value="0">
                    <h2>Ajout d'un logement</h2>
                    <?php if (isset($_SESSION['user_error'])) : ?>
                        <div class="error">
                            <p class="error-txt"><?= htmlspecialchars($_SESSION['user_error']) ?></p>
                        </div>
                        <?php unset($_SESSION['user_error']) ?>
                    <?php endif; ?>
                    <label for="title">Titre:</label>
                    <input type="text" id="title" name="title" placeholder="Ajouter un titre">
                    <?php if (isset($_SESSION['errors'])): ?>
                        <div class="error">
                            <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                <?php if (str_contains($name, 'title')) : ?>
                                    <p class="error-txt"><?= htmlspecialchars($value) ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <label for="host">Adresse mail propriétaire :</label>
                    <input type="email" id="host" name="host" placeholder="Ajouter un propriétaire">
                    <?php if (isset($_SESSION['errors'])): ?>
                        <div class="error">
                            <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                <?php if (str_contains($name, 'host')) : ?>
                                    <p class="error-txt"><?= htmlspecialchars($value) ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" placeholder="Ajouter une description"></textarea>
                    <?php if (isset($_SESSION['errors'])): ?>
                        <div class="error">
                            <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                <?php if (str_contains($name, 'description')) : ?>
                                    <p class="error-txt"><?= htmlspecialchars($value) ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <label for="location">Localisation:</label>
                    <input type="text" id="location" name="location" placeholder="Ajouter une localisation">
                    <?php if (isset($_SESSION['errors'])): ?>
                        <div class="error">
                            <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                <?php if (str_contains($name, 'location')) : ?>
                                    <p class="error-txt"><?= htmlspecialchars($value) ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <label for="cover">Image de couverture:</label>
                    <input type="text" id="cover" name="cover" placeholder="Ajouter une image de couverture">
                    <?php if (isset($_SESSION['errors'])): ?>
                        <div class="error">
                            <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                <?php if (str_contains($name, 'cover')) : ?>
                                    <p class="error-txt"><?= htmlspecialchars($value) ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <div class="pictures">
                        <label for="new-photo">Ajouter des photos :</label>
                        <div class="item-input">
                            <input type="text" id="new-photo" placeholder="Nouvelle photo">
                            <button class="btn btn-ajout-form" type="button" onclick="add_item('pictures','photo')">Ajouter</button>
                        </div>
                        <?php if (isset($_SESSION['errors'])): ?>
                            <div class="error">
                                <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                    <?php if (str_contains($name, 'pictures')) : ?>
                                        <p class="error-txt"><?= htmlspecialchars($value) ?></p>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <ul class="add-list" id="pictures"></ul>
                    </div>
                    <div class="equipments">
                        <label for="new-equipment">Ajouter des équipements:</label>
                        <div class="item-input">
                            <input type="text" id="new-equipment" placeholder="Nouvel équipement">
                            <button class="btn btn-ajout-form" type="button" onclick="add_item('equipments','equipment')">Ajouter</button>
                        </div>
                        <?php if (isset($_SESSION['errors'])): ?>
                            <div class="error">
                                <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                    <?php if (str_contains($name, 'equipments')) : ?>
                                        <p class="error-txt"><?= htmlspecialchars($value) ?></p>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <ul class="add-list" id="equipments"></ul>
                    </div>
                    <?php if (isset($_SESSION['errors'])) {
                        unset($_SESSION['errors']);
                    } ?>
                    <button class="btn btn-back">
                        <a href="/admin/dashboard/logements">Retour</a>
                    </button>
                    <button class="btn btn-add" type="submit">Ajouter</button>
                </form>
                <script>
                    function add_item(items, item) {
                        const newItemInput = document.getElementById(`new-${item}`);
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

                    document.querySelector('form').addEventListener('submit', function(event) {

                        if (document.getElementById('pictures').children.length === 0) {
                            const hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.name = 'pictures[]';
                            hiddenInput.value = '';
                            this.appendChild(hiddenInput);
                        }

                        if (document.getElementById('equipments').children.length === 0) {
                            const hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.name = 'equipments[]';
                            hiddenInput.value = '';
                            this.appendChild(hiddenInput);
                        }
                    });
                </script>
            </div>
        </main>
    </div>
</body>

</html>