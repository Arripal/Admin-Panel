<?php
access_view('/components/head.view', ['title' => 'Utilisateurs - Edition']);
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
            <h2>Editer un utilisateur</h2>
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
                    <?php
                    if (isset($users)) { ?>
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
                                        <a href="/admin/dashboard/users/edit">Editer</a>
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
                    <?php } ?>
                </tbody>
            </table>
        </main>
    </div>
</body>

</html>