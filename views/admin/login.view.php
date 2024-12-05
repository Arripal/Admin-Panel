<?php
access_view('/components/head.view', ['title' => 'Espace Administrateur - Connexion']);
?>

<body>
    <div class="login-container">
        <form class="form-login" action="/admin/login" method="post">
            <h1>Espace Administrateur</h1>
            <?php if (isset($user_error)) : ?>
                <div class="error">
                    <p class="error-txt"><?= htmlspecialchars($user_error) ?></p>
                </div>
                <?php unset($user_error) ?>
            <?php endif; ?>
            <div>
                <label for="email">Adresse mail</label>
                <input type="email" name="email" id="email" required>
                <?php if (isset($errors)) : ?>
                    <div class="error">
                        <?php foreach ($errors as $name => $value) : ?>
                            <?php if (str_contains($name, 'email')) : ?>
                                <p class="error-txt"><?= htmlspecialchars($value) ?></p>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
                <?php if (isset($errors)): ?>
                    <div class="error">
                        <?php foreach ($errors as $name => $value) : ?>
                            <?php if (str_contains($name, 'password')) : ?>
                                <p class="error-txt"><?= htmlspecialchars($value) ?></p>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="button-wrapper">
                <button class="btn btn-add" type="submit">Se connecter</button>
            </div>
        </form>
    </div>
    </form>
</body>

</html>