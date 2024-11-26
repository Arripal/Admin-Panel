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
            <style>
                .form-container {
                    margin-top: 18px;
                }
            </style>
            <div class="form-container">
                <form action="/admin/dashboard/users/save" method="post">
                    <h2>Ajout d'un utilisateur</h2>
                    <label for="last_name">Nom :</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Ajouter un nom">
                    <label for="first_name">Prénom :</label>
                    <input type="text" id="first_name" name="first_name" placeholder="Ajouter un prénom">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" placeholder="Ajouter une adresse mail">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" placeholder="Ajouter un mot de passe">
                    <label for="picture">Photo de profil :</label>
                    <input type="text" id="picture" name="picture" placeholder="Ajouter une photo de profil">
                    <label for="role">Rôle :</label>
                    <input type="text" id="role" name="role" placeholder="Ajouter un rôle">
                    <button class="btn btn-back">
                        <a href="/admin/dashboard/users">Retour</a>
                    </button>
                    <button class="btn btn-add" type="submit">Ajouter</button>
                </form>
            </div>
        </main>
    </div>
</body>

</html>