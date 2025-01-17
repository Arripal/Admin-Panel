<?php
access_view('/components/head.view', ['title' => 'Utilisateurs - Ajout']);
?>
<div class="min-h-screen">
    <?php
    access_view('/components/sidebar.view');
    ?>
    <main class="p-4 sm:ml-64">
        <h2 class="py-6 lg:text-4xl sm:text-sm text-center lg:text-left  tracking-tight font-bold text-gray-900 dark:text-white">Ajouter un utilisateur</h2>
        <?php if (isset($_SESSION['save'])) : ?>
            <div class="py-3">
                <p class="text-red-500 text-xl"><?= htmlspecialchars($_SESSION['save']) ?></p>
            </div>
            <?php unset($_SESSION['save']) ?>
        <?php endif; ?>
        <section class="bg-white dark:bg-gray-900">
            <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Informations de l'utilisateur</h2>
                <form action="/admin/dashboard/users/save" method="post">
                    <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                        <div class="w-full">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prenom</label>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Ajouter un prénom" type="text" id="first_name" name="first_name">
                            <?php if (isset($_SESSION['errors'])): ?>
                                <div class="py-3">
                                    <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                        <?php if (str_contains($name, 'name')) : ?>
                                            <p class="text-red-500 text-xl"><?= htmlspecialchars($value) ?></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="w-full">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="last_name">Nom</label>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" type="text" id="last_name" name="last_name">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="password">Mot de passe :</label>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" type="text" id="password" name="password">
                            <?php if (isset($_SESSION['errors'])): ?>
                                <div class="py-3">
                                    <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                        <?php if (str_contains($name, 'password')) : ?>
                                            <p class="text-red-500 text-xl"><?= htmlspecialchars($value) ?></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="email">Adresse mail</label>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" type="email" id="email" name="email">
                            <?php if (isset($_SESSION['errors'])): ?>
                                <div class="py-3">
                                    <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                        <?php if (str_contains($name, 'email')) : ?>
                                            <p class="text-red-500 text-xl"><?= htmlspecialchars($value) ?></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="w-full">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="picture">Photo de profil</label>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" type="text" id="picture" name="picture">
                            <?php if (isset($_SESSION['errors'])): ?>
                                <div class="py-3">
                                    <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                        <?php if (str_contains($name, 'picture')) : ?>
                                            <p class="text-red-500 text-xl"><?= htmlspecialchars($value) ?></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="w-full">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="role">Rôle</label>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" type="text" id="role" name="role">
                            <?php if (isset($_SESSION['errors'])): ?>
                                <div class="py-3">
                                    <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                        <?php if (str_contains($name, 'role')) : ?>
                                            <p class="text-red-500 text-xl"><?= htmlspecialchars($value) ?></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                    <div class="flex items-center space-x-4">
                        <button type="submit" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Sauvergarder
                        </button>
                        <button type="button" class="text-white inline-flex items-center hover:text-white border border-white-600 hover:bg-white-600 focus:ring-4 focus:outline-none focus:ring-white font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-white dark:text-white  dark:hover:bg-white- dark:focus:ring-white">
                            <a href="/admin/dashboard/users">Retour</a>
                        </button>
                    </div>
                    <?php if (isset($_SESSION['errors'])) {
                        unset($_SESSION['errors']);
                    } ?>
                </form>
            </div>
        </section>
    </main>
</div>
<?php
access_view('/components/footer.view');
?>