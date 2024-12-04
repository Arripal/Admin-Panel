<?php
access_view('/components/head.view', ['title' => 'Espace Administrateur - Connexion']);
?>
<style>
    .button-wrapper {
        margin-top: 10px;
    }

    .error {
        margin-top: 10px;
    }

    .error p {
        color: red;
        font-weight: bold;
        font-size: 18px;
    }

    .container {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: white;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 100%;
    }

    h1 {
        text-align: center;
        color: #333;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    label {
        margin-bottom: 0.5rem;
        color: #555;
    }

    input {
        padding: 0.5rem;
        margin-bottom: 1rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
    }

    .button-wrapper {
        margin-top: 1rem;
    }

    button {
        width: 100%;
        padding: 0.75rem;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #0056b3;
    }

    .error {
        margin-top: 1rem;
    }

    .error p {
        color: #dc3545;
        font-weight: bold;
        font-size: 0.9rem;
        margin: 0.25rem 0;
    }
</style>

<body>
    <div class="container">
        <form action="/admin/login" method="post">
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
                <button type="submit">Se connecter</button>
            </div>
        </form>
    </div>
    </form>
</body>

</html>