<?php
access_view('/components/head.view', ['title' => 'Logements']);
?>

<div class="sm:flex min-h-screen">
    <?php
    access_view('/components/sidebar.view');
    ?>
    <div class="p-4 sm:ml-64 w-full">
        <?php
        if (isset($data)) { ?>
            <div class="add">
                <h2 class="mb-4 text-4xl tracking-tight font-bold text-gray-900 dark:text-white">Liste des logements</h2>
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-4 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"><a href="/admin/dashboard/logements/add">Ajouter un logement</a>
                </button>
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="text-emerald-600 text-lg py-3 mb-3">
                        <?= $_SESSION['success']; ?>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="error">
                        <?= $_SESSION['error'] ?>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>

                            <th scope="col" class="px-6 py-3">Nom</th>
                            <th scope="col" class="px-6 py-3">Hôte</th>
                            <th scope="col" class="px-6 py-3">Localisation</th>
                            <th scope="col" class="px-6 py-3">Description</th>
                            <th scope="col" class="px-6 py-3">Image couverture</th>
                            <th scope="col" class="px-6 py-3">Equipements</th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Editer</span>
                                <span class="sr-only">Supprimer</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $logement) { ?>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?= htmlspecialchars(trim($logement['title']))  ?></td>
                                <td scope="row" class="px-6 py-4"><?= htmlspecialchars(trim($logement['host'])) ?></td>
                                <td scope="row" class="px-6 py-4"><?= htmlspecialchars(trim($logement['location'])) ?></td>
                                <td scope="row" class="px-6 py-4">
                                    <p class="clamp">
                                        <?= htmlspecialchars(trim($logement['description']))  ?>
                                    </p>
                                </td>
                                <td scope="row" class="px-6 py-4">
                                    <p class="clamp">
                                        <?= htmlspecialchars(trim($logement['cover']))  ?>
                                    </p>
                                </td>
                                <td scope="row" class="px-6 py-4">
                                    <?php
                                    $equipment =  $logement['equipments'];
                                    $equipment = str_replace(['{', '}'], '', $equipment);
                                    $equipment = str_replace(['"', '"'], '', $equipment);
                                    $equipements_array = explode(',', $equipment);
                                    ?>
                                    <ul class="equipments">
                                        <?php foreach ($equipements_array as $equipement): ?>
                                            <li><?= htmlspecialchars($equipement) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </td>
                                <td class="px-6 py-9 flex items-center justify-end">
                                    <ul class="space-y-2">
                                        <li>
                                            <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="/admin/dashboard/logements/edit?id=<?= htmlspecialchars(trim($logement['id'])) ?>">Editer</a>
                                        </li>
                                        <form class="delete-form" action="/admin/dashboard/logements/delete" method="post">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="logement_id" value="<?= htmlspecialchars(trim($logement['id'])) ?>">
                                            <button type="submit">
                                                <span class="font-medium text-red-600 dark:text-red-40 hover:underline">Supprimer</span>
                                            </button>
                                        </form>
                                    </ul>
                                </td>
                            </tr>
                        <?php  } ?>
                    </tbody>
                </table>
            </div>

        <?php } ?>
    </div>
</div>
<?php
access_view('/components/footer.view');
?>