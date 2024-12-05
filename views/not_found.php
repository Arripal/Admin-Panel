<?php
access_view('/components/head.view', ['title' => 'Ressource introuvable']);
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
            <h2>La page demandée n'existe pas </h2>
            <?php if (isset($errors)) { ?>
                <div class="error">
                    <?php foreach ($errors as $error): ?>
                        <p class="error-txt"><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php } ?>
            <div>
                <a href="/admin/dashboard">Retourner à l'accueil</a>
            </div>
        </main>

    </div>
</body>

</html>