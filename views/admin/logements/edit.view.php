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
            <h2>Editer un logement</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Hôte</th>
                        <th>Localisation</th>
                        <th>Description</th>
                        <th>Image couverture</th>
                        <th>Equipements</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($logement)) { ?>
                        <tr>
                            <td><?= htmlspecialchars(trim($logement['title']))  ?></td>
                            <td><?= htmlspecialchars(trim($logement['host'])) ?></td>
                            <td><?= htmlspecialchars(trim($logement['location'])) ?></td>
                            <td>
                                <p class="clamp">
                                    <?= htmlspecialchars(trim($logement['description']))  ?>
                                </p>
                            </td>
                            <td>
                                <p class="clamp">
                                    <?= htmlspecialchars(trim($logement['cover']))  ?>
                                </p>
                            </td>
                            <td>
                                <?php
                                $equipment =  $logement['equipments'];
                                $equipment = str_replace(['{', '}'], '', $equipment);
                                $equipment = str_replace(['"', '"'], '', $equipment);
                                $equipements_array = explode(',', $equipment);
                                ?>
                                <ul class="equipments">
                                    <?php foreach ($equipements_array as $equipement): ?>
                                        <li><?= htmlspecialchars($equipement) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                            <td>
                                <div class="actions">
                                    <button class="btn btn-back">
                                        <a href="/admin/dashboard/logements">Retour</a>
                                    </button>
                                    <form class="delete-form" action="/admin/dashboard/logements/delete" method="post">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="logement_id" value="<?= htmlspecialchars(trim($logement['id'])) ?>">
                                        <button type="submit" class="btn btn-delete">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <style>
                .form-container {
                    margin-top: 18px;
                }
            </style>
            <div class="form-container">
                <form action="/admin/dashboard/logements/update" method="post">
                    <h2>Modifications</h2>
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" value="<?= htmlspecialchars(trim($logement['id'])) ?>">
                    <label for="title">Titre:</label>
                    <input type="text" id="title" name="title" value="<?= htmlspecialchars(trim($logement['title'])) ?>">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description"><?= htmlspecialchars(trim($logement['description'])) ?>
                        </textarea>
                    <label for="location">Localisation:</label>
                    <input type="text" id="location" name="location" value="<?= htmlspecialchars(trim($logement['location'])) ?>">
                    <label for="cover">Image de couverture:</label>
                    <input type="text" id="cover" name="cover" value="<?= htmlspecialchars(trim($logement['cover'])) ?>">
                    <div class="item-list">
                        <label for="new-item">Ajouter des équipements:</label>
                        <div class="item-input">
                            <input type="text" id="new-item" placeholder="Nouvel équipement">
                            <button class="btn btn-ajout-form" type="button" onclick="add_item()">Ajouter</button>
                        </div>
                        <ul id="equipments" class="equipments">
                            <?php
                            $equipment =  $logement['equipments'];
                            $equipment = str_replace(['{', '}'], '', $equipment);
                            $equipment = str_replace(['"', '"'], '', $equipment);
                            $equipments_array = explode(',', $equipment);
                            ?>
                            <?php foreach ($equipments_array as $equipment): ?>
                                <li class="equipment-li">
                                    <p><?= $equipment ?></p>
                                    <input type="hidden" name="equipments[]" value="<?= $equipment ?>">
                                    <button type="button" class="btn btn-delete" onclick="this.parentElement.remove()">Supprimer</button>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <button class="btn btn-back">
                        <a href="/admin/dashboard/logements">Retour</a>
                    </button>
                    <button class="btn btn-add" type="submit">Sauvegarder</button>
                </form>
                <script>
                    function add_item() {
                        const newItemInput = document.getElementById('new-item');
                        const itemsList = document.getElementById('equipments');
                        if (newItemInput.value.trim() !== '') {
                            const li = document.createElement('li');
                            li.innerHTML = `
                    ${newItemInput.value}
                    <input type="hidden" name="equipments[]" value="${newItemInput.value}">
                    <button type="button" class="btn btn-ajout-form" onclick="this.parentElement.remove()">Supprimer</button>
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