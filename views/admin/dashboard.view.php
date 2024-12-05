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
        <main class="content main-content">
            <section class="welcome-section">
                <h1>Bienvenue dans votre panel d'administration</h1>
                <p>Gérez facilement vos logements et utilisateurs.</p>
            </section>
            <section class="quick-actions">
                <div class="action-list">
                    <h2>Gestion des Logements</h2>
                    <ul>
                        <li><a href="/admin/dashboard/logements">Afficher les logements</a></li>
                        <li><a href="/admin/dashboard/logements/add">Ajouter un logement</a></li>
                    </ul>
                </div>
                <div class="action-list">
                    <h2>Gestion des Utilisateurs</h2>
                    <ul>
                        <li><a href="/admin/dashboard/users">Afficher les utilisateurs</a></li>
                        <li><a href="/admin/dashboard/users/add">Ajouter un utilisateur</a></li>
                    </ul>
                </div>
            </section>
        </main>
    </div>
</body>

</html>