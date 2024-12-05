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
                        <th>Images Logements</th>
                        <th>Equipements</th>
                        <th>Note</th>
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
                                $picture =  $logement['pictures'];
                                $picture = str_replace(['{', '}'], '', $picture);
                                $picture = str_replace(['"', '"'], '', $picture);
                                $pictures_array = explode(',', $picture);
                                ?>
                                <ul class="equipments">
                                    <?php foreach ($pictures_array as $picture): ?>
                                        <li class="clamp"><?= htmlspecialchars($picture) ?></li>
                                    <?php endforeach; ?>
                                </ul>
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
                            <td><?= htmlspecialchars(trim($logement['rating'])) ?></td>
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
            <div class="form-container">
                <form action="/admin/dashboard/logements/update" method="post">
                    <h2>Modifications</h2>
                    <?php
                    if (isset($_SESSION['empty'])) : ?>
                        <div class="error">
                            <p class="error-txt"><?= $_SESSION['empty'] ?></p>
                        </div>
                    <?php endif; ?>
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" value="<?= htmlspecialchars(trim($logement['id'])) ?>">
                    <input type="hidden" name="rating" value="<?= htmlspecialchars(trim($logement['rating'])) ?>">
                    <label for="title">Nom :</label>
                    <input type="text" id="title" name="title" value="<?= htmlspecialchars(trim($logement['title'])) ?>">
                    <?php if (isset($_SESSION['errors'])): ?>
                        <div class="error">
                            <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                <?php if (str_contains($name, 'title')) : ?>
                                    <p class="error-txt"><?= htmlspecialchars($value) ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <label for="host">Hôte :</label>
                    <input type="text" id="host" name="host" value="<?= htmlspecialchars(trim($logement['host'])) ?>">
                    <?php if (isset($_SESSION['errors'])): ?>
                        <div class="error">
                            <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                <?php if (str_contains($name, 'email')) : ?>
                                    <p class="error-txt"><?= htmlspecialchars($value) ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <label for="description">Description:</label>
                    <textarea id="description" name="description"><?= htmlspecialchars(trim($logement['description'])) ?>
                        </textarea>
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
                    <input type="text" id="location" name="location" value="<?= htmlspecialchars(trim($logement['location'])) ?>">
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
                    <input type="text" id="cover" name="cover" value="<?= htmlspecialchars(trim($logement['cover'])) ?>">
                    <?php if (isset($_SESSION['errors'])): ?>
                        <div class="error">
                            <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                <?php if (str_contains($name, 'cover')) : ?>
                                    <p class="error-txt"><?= htmlspecialchars($value) ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div class="equipments">
                        <label for="new-item">Ajouter des équipements:</label>
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
                        <div class="tags">
                            <label for="new-tag">Ajouter des tags:</label>
                            <div class="item-input">
                                <input type="text" id="new-tag" placeholder="Nouveau tag">
                                <button class="btn btn-ajout-form" type="button" onclick="add_item('tags','tag')">Ajouter</button>
                            </div>
                            <?php if (isset($_SESSION['errors'])): ?>
                                <div class="error">
                                    <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                        <?php if (str_contains($name, 'tags')) : ?>
                                            <p class="error-txt"><?= htmlspecialchars($value) ?></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <ul class="add-list" id="tags">

                                <?php
                                $tag =  $logement['tags'];
                                $tag = str_replace(['{', '}'], '', $tag);
                                $tag = str_replace(['"', '"'], '', $tag);
                                $tags_array = explode(',', $tag);
                                ?>
                                <?php foreach ($tags_array as $tag): ?>
                                    <li class="equipment-li">
                                        <p><?= $tag ?></p>
                                        <input type="hidden" name="tags[]" value="<?= $tag ?>">
                                        <button type="button" class="btn btn-delete" onclick="this.parentElement.remove()">Supprimer</button>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
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
                            <ul class="add-list" id="pictures">
                                <?php
                                $picture =  $logement['pictures'];
                                $picture = str_replace(['{', '}'], '', $picture);
                                $picture = str_replace(['"', '"'], '', $picture);
                                $pictures_array = explode(',', $picture);
                                ?>
                                <?php foreach ($pictures_array as $picture): ?>
                                    <li class="equipment-li">
                                        <p><?= $picture ?></p>
                                        <input type="hidden" name="pictures[]" value="<?= $picture ?>">
                                        <button type="button" class="btn btn-delete" onclick="this.parentElement.remove()">Supprimer</button>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php if (isset($_SESSION['errors'])) {
                            unset($_SESSION['errors']);
                        } ?>
                    </div>
                    <div class="form-btns">
                        <button class="btn btn-back">
                            <a href="/admin/dashboard/logements">Retour</a>
                        </button>
                        <button class="btn btn-add" type="submit">Sauvegarder</button>
                    </div>
                    <?php if (isset($_SESSION['errors'])) {
                        unset($_SESSION['errors']);
                    } ?>
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