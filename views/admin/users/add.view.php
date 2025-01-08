<?php
access_view('/components/head.view', ['title' => 'Utilisateurs - Ajout']);
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
            <h2>Ajouter un utilisateur</h2>
            <div class="form-container">
                <form action="/admin/dashboard/users/save" method="post">
                    <h2>Ajout d'un utilisateur</h2>
                    <?php if (isset($_SESSION['existing_user'])) : ?>
                        <div class="error">
                            <p class="error-txt"><?= htmlspecialchars($_SESSION['existing_user']) ?></p>
                        </div>
                        <?php unset($_SESSION['existing_user']) ?>
                    <?php endif; ?>
                    <label for="last_name">Nom :</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Ajouter un nom">
                    <?php if (isset($_SESSION['errors'])): ?>
                        <div class="error">
                            <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                <?php if (str_contains($name, 'name')) : ?>
                                    <p class="error-txt"><?= htmlspecialchars($value) ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <label for="first_name">Prénom :</label>
                    <input type="text" id="first_name" name="first_name" placeholder="Ajouter un prénom">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" placeholder="Ajouter une adresse mail">
                    <?php if (isset($_SESSION['errors'])): ?>
                        <div class="error">
                            <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                <?php if (str_contains($name, 'email')) : ?>
                                    <p class="error-txt"><?= htmlspecialchars($value) ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" placeholder="Ajouter un mot de passe">
                    <?php if (isset($_SESSION['errors'])): ?>
                        <div class="error">
                            <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                <?php if (str_contains($name, 'password')) : ?>
                                    <p class="error-txt"><?= htmlspecialchars($value) ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <label for="picture">Photo de profil :</label>
                    <input type="text" id="picture" name="picture" placeholder="Ajouter une photo de profil">
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
                    <input type="text" id="role" name="role" placeholder="Ajouter un rôle">
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
                        <button class="btn btn-add" type="submit">Ajouter</button>
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