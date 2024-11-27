<?php
access_view('/components/head.view', ['title' => 'Utilisateur - Editer']);
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
                    if (isset($user)) { ?>
                        <tr>
                            <td><?= htmlspecialchars(trim($user['id']))  ?></td>
                            <td><?= htmlspecialchars(trim($user['name']))  ?></td>
                            <td><?= htmlspecialchars(trim($user['email'])) ?></td>
                            <td><?= htmlspecialchars(trim($user['password'])) ?? '' ?></td>
                            <td>
                                <p class="clamp">
                                    <?= htmlspecialchars(trim($user['picture']))  ?>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <?= htmlspecialchars(trim($user['role']))  ?>
                                </p>
                            </td>
                            <td>
                                <div class="actions">
                                    <button class="btn btn-back">
                                        <a href="/admin/dashboard/users">Retour</a>
                                    </button>
                                    <form class="delete-form" action="/admin/dashboard/users/delete" method="post">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="user_id" value="<?= htmlspecialchars(trim($user['id'])) ?>">
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
                <?php

                $full_name = explode(' ', $user['name']);
                $first_name = $full_name[0];
                $last_name = array_slice($full_name, 1);
                $last_name = join(' ', $last_name);

                ?>
                <form action="/admin/dashboard/users/update" method="post">
                    <h2>Modifications</h2>
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" value="<?= htmlspecialchars(trim($user['id'])) ?>">
                    <label for="name">Prenom :</label>
                    <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars(trim($first_name)) ?>">
                    <label for="last_name">Nom :</label>
                    <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars(trim($last_name)) ?>">
                    <?php if (strtolower($user['role']) === 'admin') : ?>
                        <label for="password">Mot de passe :</label>
                        <input type="text" id="password" name="password"
                            value="<?= htmlspecialchars(trim($user['password'])) ?>">
                        <label for="email">Adresse mail :</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars(trim($user['email'])) ?>">
                    <?php endif ?>
                    <?php if (strtolower($user['role']) === 'user') : ?>
                        <input type="hidden" name="password" value="<?= htmlspecialchars(trim($user['password'])) ?>">
                        <input type="hidden" name="email" value="<?= htmlspecialchars(trim($user['email'])) ?>">
                    <?php endif ?>
                    <label for="picture">Photo de profil :</label>
                    <input type="text" id="picture" name="picture" value="<?= htmlspecialchars(trim($user['picture'])) ?>">
                    <label for="role">Rôle :</label>
                    <input type="text" id="role" name="role" value="<?= htmlspecialchars(trim($user['role'])) ?>">
                    <div class="form-btns">
                        <button class="btn btn-back">
                            <a href="/admin/dashboard/users">Retour</a>
                        </button>
                        <button class="btn btn-add" type="submit">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>