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
                                    <button class="btn btn-delete">
                                        <a href="/admin/dashboard/users/delete">Supprimer</a>
                                    </button>
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