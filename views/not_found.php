<?php
access_view('/components/head.view', ['title' => 'Erreur']);
?>

<body>
    <style>

    </style>
    <?php
    access_view('/components/header.view');
    ?>
    <div class="container">
        <?php
        access_view('/components/sidebar.view');
        ?>
        <main class="content">
            <h2>La page demandée n'existe pas </h2>
            <?php if (!empty($errors)) { ?>
                <div>
                    <?php foreach ($errors as $error): ?>
                        <p class="error-404"><?= htmlspecialchars($error) ?></p>
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