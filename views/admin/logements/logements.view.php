<?php
access_view('/components/head.view', ['title' => 'Logements']);
?>

<body>
    <style>

    </style>
    <?php
    access_view('/components/header.view');
    ?>
    <div class="container">
        <?php
        access_view('/components/sidebar.view');
        ?>
        <main class="content">
            <h2>Liste des logements</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
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
                    if (isset($logements)) { ?>
                        <?php foreach ($logements as $logement) { ?>
                            <tr>
                                <td><?= htmlspecialchars(trim($logement['id']))  ?></td>
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
                                        <button class="btn btn-delete">
                                            <a href="/admin/dashboard/logements/delete?id=<?= htmlspecialchars(trim($logement['id'])) ?>">Supprimer</a>
                                        </button>
                                    </div>

                                </td>
                            </tr>
                        <?php  } ?>
                    <?php } ?>
                </tbody>
            </table>
        </main>
    </div>
</body>

</html>