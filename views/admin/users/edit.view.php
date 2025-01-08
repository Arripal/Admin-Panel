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
                                        <input type="hidden" name="user_email" value="<?= htmlspecialchars(trim($user['email'])) ?>">
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
                <?php
                $full_name = explode(' ', $user['name']);
                $first_name = $full_name[0];
                $last_name = array_slice($full_name, 1);
                $last_name = join(' ', $last_name);
                ?>
                <form action="/admin/dashboard/users/update" method="post">
                    <h2>Modifications</h2>
                    <?php if (isset($_SESSION['empty_user'])) : ?>
                        <div class="error">
                            <p class="error-txt"><?= htmlspecialchars($_SESSION['empty_user']) ?></p>
                        </div>
                        <?php unset($_SESSION['empty_user']) ?>
                    <?php endif; ?>
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" value="<?= htmlspecialchars(trim($user['id'])) ?>">
                    <label for="name">Prenom :</label>
                    <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars(trim($first_name)) ?>">
                    <?php if (isset($_SESSION['errors'])): ?>
                        <div class="error">
                            <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                <?php if (str_contains($name, 'name')) : ?>
                                    <p class="error-txt"><?= htmlspecialchars($value) ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <label for="last_name">Nom :</label>
                    <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars(trim($last_name)) ?>">
                    <?php if (strtolower($user['role']) === 'admin') : ?>
                        <label for="password">Mot de passe :</label>
                        <input type="text" id="password" name="password"
                            value="<?= htmlspecialchars(trim($user['password'])) ?>">
                        <?php if (isset($_SESSION['errors'])): ?>
                            <div class="error">
                                <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                    <?php if (str_contains($name, 'password')) : ?>
                                        <p class="error-txt"><?= htmlspecialchars($value) ?></p>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif ?>
                    <label for="email">Adresse mail :</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars(trim($user['email'])) ?>">
                    <?php if (isset($_SESSION['errors'])): ?>
                        <div class="error">
                            <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                <?php if (str_contains($name, 'email')) : ?>
                                    <p class="error-txt"><?= htmlspecialchars($value) ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (strtolower($user['role']) === 'user') : ?>
                        <input type="hidden" name="password" value="<?= htmlspecialchars(trim($user['password'])) ?>">
                    <?php endif ?>
                    <label for="picture">Photo de profil :</label>
                    <input type="text" id="picture" name="picture" value="<?= htmlspecialchars(trim($user['picture'])) ?>">
                    <?php if (isset($_SESSION['errors'])): ?>
                        <div class="error">
                            <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                <?php if (str_contains($name, 'picture')) : ?>
                                    <p class="error-txt"><?= htmlspecialchars($value) ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <label for="role">Rôle :</label>
                    <input type="text" id="role" name="role" value="<?= htmlspecialchars(trim($user['role'])) ?>">
                    <?php if (isset($_SESSION['errors'])): ?>
                        <div class="error">
                            <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                <?php if (str_contains($name, 'role')) : ?>
                                    <p class="error-txt"><?= htmlspecialchars($value) ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div class="form-btns">
                        <button class="btn btn-back">
                            <a href="/admin/dashboard/users">Retour</a>
                        </button>
                        <button class="btn btn-add" type="submit">Sauvegarder</button>
                    </div>
                    <?php if (isset($_SESSION['errors'])) {
                        unset($_SESSION['errors']);
                    } ?>
                </form>
            </div>
        </main>
    </div>
</body>

</html>