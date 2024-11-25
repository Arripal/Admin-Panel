<?php
access_view('/components/head.view', ['title' => 'Utilisateurs']);
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
            if (isset($users)) { ?>
                <h2>Liste des utilisateurs</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Mot de passe</th>
                            <th>Image</th>
                            <th>Rôle</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($users as $user) { ?>
                            <tr>
                                <td><?= htmlspecialchars(trim($user['id']))  ?></td>
                                <td><?= htmlspecialchars(trim($user['name'])) ?></td>
                                <td><?= htmlspecialchars(trim($user['email']))  ?></td>
                                <td><?= htmlspecialchars(trim($user['password']))  ?></td>
                                <td><?= htmlspecialchars(trim($user['picture'])) ?></td>
                                <td><?= htmlspecialchars(trim($user['role']))  ?></td>
                                <td class="actions">
                                    <button class="btn btn-edit">
                                        <a href="/admin/dashboard/users/edit?id=<?= htmlspecialchars(trim($user['id'])) ?>">Editer</a>
                                    </button>
                                    <form class="delete-form" action="/admin/dashboard/users/delete" method="post">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="user_id" value="<?= htmlspecialchars(trim($user['id'])) ?>">
                                        <button type="submit" class="btn btn-delete">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php  } ?>

                    </tbody>
                </table>
            <?php } ?>
            <?php if (!empty($errors)) { ?>
                <?php foreach ($errors as $key => $value) : ?>
                    <div>
                        <p><?= htmlspecialchars($errors[$key]) ?></p>
                    </div>
                <?php endforeach ?>
            <?php } ?>
        </main>
    </div>
</body>

</html>