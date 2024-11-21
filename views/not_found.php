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
            <p>Veuillez vérifier qu'il n'y ai pas d'erreur dans votre reqûete.</p>
        </main>
    </div>
</body>

</html>