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
            <?php
            if (isset($data)) { ?>
                <div class="add">
                    <h2>Liste des logements</h2>
                    <button class="btn"><a href="/admin/dashboard/logements/add">Ajouter un logement</a></button>
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="success">
                            <?= $_SESSION['success']; ?>
                        </div>
                        <?php unset($_SESSION['success']); ?>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="error">
                            <?= $_SESSION['error'] ?>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>
                </div>
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
                        <?php foreach ($data as $logement) { ?>
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
                                        <button class="btn btn-edit">
                                            <a href="/admin/dashboard/logements/edit?id=<?= htmlspecialchars(trim($logement['id'])) ?>">Editer</a>
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
                        <?php  } ?>
                    </tbody>
                </table>
            <?php } ?>
            <?php if (!empty($errors)) { ?>
                <div>
                    <h2><?= htmlspecialchars($errors['db']) ?></h2>
                </div>
            <?php } ?>
        </main>
    </div>
</body>

</html>