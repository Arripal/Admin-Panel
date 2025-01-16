<?php
access_view('/components/head.view', ['title' => 'Utilisateur - Editer']);
?>

<div class="min-h-screen">
    <?php
    access_view('/components/sidebar.view');
    ?>
    <main class="p-4 sm:ml-64">
        <h2 class="py-6 lg:text-4xl sm:text-sm text-center lg:text-left  tracking-tight font-bold text-gray-900 dark:text-white">Editer un utilisateur</h2>
        <?php if (isset($_SESSION['update'])) : ?>
            <div class="py-3">
                <p class="text-red-500 text-xl"><?= htmlspecialchars($_SESSION['update']) ?></p>
            </div>
            <?php unset($_SESSION['update']) ?>
        <?php endif; ?>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Nom</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Mot de passe</th>
                        <th scope="col" class="px-6 py-3">Image</th>
                        <th scope="col" class="px-6 py-3">Rôle</th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Editer</span>
                            <span class="sr-only">Supprimer</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($user)) { ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?= htmlspecialchars(trim($user['id']))  ?></td>
                            <td scope="row" class="px-6 py-4"><?= htmlspecialchars(trim($user['name']))  ?></td>
                            <td scope="row" class="px-6 py-4"><?= htmlspecialchars(trim($user['email'])) ?></td>
                            <td scope="row" class="px-6 py-4"><?= htmlspecialchars(trim($user['password'])) ?? '' ?></td>
                            <td scope="row" class="px-6 py-4">
                                <p class="clamp">
                                    <?= htmlspecialchars(trim($user['picture']))  ?>
                                </p>
                            </td>
                            <td scope="row" class="px-6 py-4">
                                <p>
                                    <?= htmlspecialchars(trim($user['role']))  ?>
                                </p>
                            </td>
                            <td class="px-6 py-9 flex items-center justify-end">
                                <ul class="space-y-2">
                                    <li>
                                        <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="/admin/dashboard/users">Retour</a>
                                    </li>
                                    <form class="delete-form" action="/admin/dashboard/users/delete" method="post">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="user_email" value="<?= htmlspecialchars(trim($user['email'])) ?>">
                                        <button type="submit">
                                            <span class="font-medium text-red-600 dark:text-red-40 hover:underline">Supprimer</span>
                                        </button>
                                    </form>
                                </ul>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <section class="bg-white dark:bg-gray-900">
            <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
                <?php
                $full_name = explode(' ', $user['name']);
                $first_name = $full_name[0];
                $last_name = array_slice($full_name, 1);
                $last_name = join(' ', $last_name);
                ?>
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Modifications de l'utilisateur</h2>
                <form action="/admin/dashboard/users/update" method="post">
                    <?php if (isset($_SESSION['empty'])) : ?>
                        <div class="py-3">
                            <p class="text-red-500 text-xl"><?= htmlspecialchars($_SESSION['empty']) ?></p>
                        </div>
                        <?php unset($_SESSION['empty']) ?>
                    <?php endif; ?>
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" value="<?= htmlspecialchars(trim($user['id'])) ?>">
                    <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                        <div class="w-full">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prenom</label>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Ajouter un prénom" type="text" id="first_name" name="first_name" value="<?= htmlspecialchars(trim($first_name)) ?>">
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
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" type="text" id="last_name" name="last_name" value="<?= htmlspecialchars(trim($last_name)) ?>">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="password">Mot de passe :</label>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" type="text" id="password" name="password"
                                value="<?= htmlspecialchars(trim($user['password'])) ?>">
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
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" type="email" id="email" name="email" value="<?= htmlspecialchars(trim($user['email'])) ?>">
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
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" type="text" id="picture" name="picture" value="<?= htmlspecialchars(trim($user['picture'])) ?>">
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
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" type="text" id="role" name="role" value="<?= htmlspecialchars(trim($user['role'])) ?>">
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
                            Mettre à jour
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