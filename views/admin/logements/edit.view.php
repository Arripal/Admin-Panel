<?php
access_view('/components/head.view', ['title' => 'Logements']);
?>

<div class="min-h-screen">
    <?php
    access_view('/components/sidebar.view');
    ?>
    <main class="p-4 sm:ml-64">
        <h2 class="py-6 lg:text-4xl sm:text-sm text-center lg:text-left  tracking-tight font-bold text-gray-900 dark:text-white">Editer un logement</h2>
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
                        <th scope="col" class="px-6 py-3">Nom</th>
                        <th scope="col" class="px-6 py-3">Hôte</th>
                        <th scope="col" class="px-6 py-3">Localisation</th>
                        <th scope="col" class="px-6 py-3">Description</th>
                        <th scope="col" class="px-6 py-3">Image couverture</th>
                        <th scope="col" class="px-6 py-3">Images Logements</th>
                        <th scope="col" class="px-6 py-3">Equipements</th>
                        <th scope="col" class="px-6 py-3">Note</th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Editer</span>
                            <span class="sr-only">Supprimer</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($logement)) { ?>
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
                                $picture =  $logement['pictures'];
                                $picture = str_replace(['{', '}'], '', $picture);
                                $picture = str_replace(['"', '"'], '', $picture);
                                $pictures_array = explode(',', $picture);
                                ?>
                                <ul class="equipments">
                                    <?php foreach ($pictures_array as $picture): ?>
                                        <li class="clamp"><?= htmlspecialchars($picture) ?></li>
                                    <?php endforeach; ?>
                                </ul>
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
                            <td scope="row" class="px-6 py-4 text-center"><?= htmlspecialchars(trim($logement['rating'])) ?></td>
                            <td class="px-6 py-9 flex items-center justify-end">
                                <ul class="space-y-2">
                                    <li>
                                        <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="/admin/dashboard/logements">Retour</a>
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
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <section class="bg-white dark:bg-gray-900">
            <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Modifications du logement</h2>
                <form action="/admin/dashboard/logements/update" method="post">
                    <?php
                    if (isset($_SESSION['empty'])) : ?>
                        <div class="py-3">
                            <p class="text-red-500 text-xl"><?= $_SESSION['empty'] ?></p>
                        </div>
                    <?php endif; ?>
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" value="<?= htmlspecialchars(trim($logement['id'])) ?>">
                    <input type="hidden" name="rating" value="<?= htmlspecialchars(trim($logement['rating'])) ?>">
                    <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                        <div class="sm:col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                            <input type="text" id="title" name="title" value="<?= htmlspecialchars(trim($logement['title'])) ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ajouter un titre" required="Ce champ est requis">
                            <?php if (isset($_SESSION['errors'])): ?>
                                <div class="py-3">
                                    <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                        <?php if (str_contains($name, 'title')) : ?>
                                            <p class="text-red-500 text-xl"><?= htmlspecialchars($value) ?></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="w-full">
                            <label for="host" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Propriétaire</label>
                            <input type="text" id="host" name="host" value="<?= htmlspecialchars(trim($logement['host'])) ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="Ce champ est requis">
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
                            <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Localisation</label>
                            <input type="text" id="location" name="location" value="<?= htmlspecialchars(trim($logement['location'])) ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="Ce champ est requis">
                            <?php if (isset($_SESSION['errors'])): ?>
                                <div class="py-3">
                                    <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                        <?php if (str_contains($name, 'location')) : ?>
                                            <p class="text-red-500 text-xl"><?= htmlspecialchars($value) ?></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="cover" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image de couverture</label>
                            <input type="text" id="cover" name="cover" value="<?= htmlspecialchars(trim($logement['cover'])) ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" />
                            <?php if (isset($_SESSION['errors'])): ?>
                                <div class="py-3">
                                    <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                        <?php if (str_contains($name, 'cover')) : ?>
                                            <p class="text-red-500 text-xl"><?= htmlspecialchars($value) ?></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="description" name="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ajouter une description"><?= htmlspecialchars(trim($logement['description'])) ?></textarea>
                            <?php if (isset($_SESSION['errors'])): ?>
                                <div class="py-3">
                                    <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                        <?php if (str_contains($name, 'description')) : ?>
                                            <p class="text-red-500 text-xl"><?= htmlspecialchars($value) ?></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="new-item" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Equipements</label>
                            <div class="flex items-center justify-center">
                                <input type="text" id="new-equipment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 mr-5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ajouter un nouvel équipement" required="Ce champ est requis">
                                <button onclick="add_item('equipments','equipment')" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm  p-2.5  dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Ajouter</button>
                            </div>
                            <?php if (isset($_SESSION['errors'])): ?>
                                <div class="py-3">
                                    <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                        <?php if (str_contains($name, 'equipments')) : ?>
                                            <p class="text-red-500 text-xl"><?= htmlspecialchars($value) ?></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <ul class=" mt-5 space-y-2" id="equipments" class="equipments">
                                <?php
                                $equipment =  $logement['equipments'];
                                $equipment = str_replace(['{', '}'], '', $equipment);
                                $equipment = str_replace(['"', '"'], '', $equipment);
                                $equipments_array = explode(',', $equipment);
                                ?>
                                <?php foreach ($equipments_array as $equipment): ?>
                                    <li class="w-1/2 flex items-center justify-center">
                                        <p class="bg-gray-30 border border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 mr-5 dark:bg-gray-500 dark:border-gray-600 dark:placeholder-gray-200 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"><?= $equipment ?></p>
                                        <input type="hidden" name="equipments[]" value="<?= $equipment ?>">
                                        <button onclick="this.parentElement.remove()" type="button" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-1.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                            Supprimer
                                        </button>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="new-photo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ajouter des photos</label>
                            <div class="flex items-center justify-center">
                                <input type="text" name="new-photo" id="new-photo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 mr-5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ajouter une nouvelle photo" required="Ce champ est requis">
                                <button onclick="add_item('pictures','photo')" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm  p-2.5  dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Ajouter</button>
                            </div>
                            <?php if (isset($_SESSION['errors'])): ?>
                                <div class="py-3">
                                    <?php foreach ($_SESSION['errors'] as $name => $value) : ?>
                                        <?php if (str_contains($name, 'pictures')) : ?>
                                            <p class="text-red-500 text-xl"><?= htmlspecialchars($value) ?></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <ul class=" mt-5 space-y-2" id="pictures">
                                <?php
                                $picture =  $logement['pictures'];
                                $picture = str_replace(['{', '}'], '', $picture);
                                $picture = str_replace(['"', '"'], '', $picture);
                                $pictures_array = explode(',', $picture);
                                ?>
                                <?php foreach ($pictures_array as $picture): ?>
                                    <li class="flex items-center justify-center">
                                        <p class="bg-gray-30 border border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 mr-5 dark:bg-gray-500 dark:border-gray-600 dark:placeholder-gray-200 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"><?= $picture ?></p>
                                        <input type="hidden" name="pictures[]" value="<?= $picture ?>" />
                                        <button onclick="this.parentElement.remove()" type="button" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-1.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                            Supprimer
                                        </button>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button type="submit" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Mettre à jour
                        </button>
                        <button type="button" class="text-white inline-flex items-center hover:text-white border border-white-600 hover:bg-white-600 focus:ring-4 focus:outline-none focus:ring-white font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-white dark:text-white  dark:hover:bg-white- dark:focus:ring-white">
                            <a href="/admin/dashboard/logements">Retour</a>
                        </button>
                    </div>
                    <script>
                        function add_item(items, item) {

                            const newItemInput = document.getElementById(`new-${item}`);
                            const itemsList = document.getElementById(`${items}`);

                            if (newItemInput.value.trim() !== '') {
                                const li = document.createElement('li');

                                if (items !== 'pictures') {
                                    li.classList.add('w-1/2');
                                }
                                li.classList.add('flex', 'items-center', 'justify-center');

                                li.innerHTML = `
            <p class="bg-gray-30 border border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 mr-5 dark:bg-gray-500 dark:border-gray-600 dark:placeholder-gray-200 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">${newItemInput.value}</p>
            <input type="hidden" name="${items}[]" value="${newItemInput.value}"/>
            <button type="button" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-1.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900" onclick="this.parentElement.remove()">Supprimer</button>
        `;
                                itemsList.appendChild(li);
                                newItemInput.value = '';
                            }
                        }
                    </script>
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