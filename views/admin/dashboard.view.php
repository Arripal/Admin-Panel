<?php
access_view('/components/head.view', ['title' => 'Dashboard']);
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
            <h2>Bienvenue dans le Panneau d'Administration</h2>
            <p>Cet espace est dédier à la gestion de votre entreprise. Vous pourrez ici gérer vos clients comme vos produits bla bla bla</p>
        </main>
    </div>
</body>

</html>