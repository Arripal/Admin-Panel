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
            if (isset($data)) { ?>
                <div class="add">
                    <h2>Liste des utilisateurs</h2>
                    <button class="btn"><a href="/admin/dashboard/users/add">Ajouter un utilisateur</a></button>
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
                            <th>Email</th>
                            <th>Mot de passe</th>
                            <th>Image</th>
                            <th>Rôle</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $user) { ?>
                            <tr>
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
                                        <input type="hidden" name="user_email" value="<?= htmlspecialchars(trim($user['email'])) ?>">
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