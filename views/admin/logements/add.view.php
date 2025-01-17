<?php
access_view('/components/head.view', ['title' => 'Logements']);
?>


<div class="min-h-screen">
    <?php
    access_view('/components/sidebar.view');
    ?>
    <main class="p-4 sm:ml-64">
        <h2 class="py-6 lg:text-4xl sm:text-sm text-center lg:text-left  tracking-tight font-bold text-gray-900 dark:text-white">Ajouter un logement</h2>
        <?php if (isset($_SESSION['save'])) : ?>
            <div class="py-3">
                <p class="text-red-500 text-xl"><?= htmlspecialchars($_SESSION['save']) ?></p>
            </div>
            <?php unset($_SESSION['save']) ?>
        <?php endif; ?>
        <section class="bg-white dark:bg-gray-900">
            <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Informations du logement</h2>
                <form action="/admin/dashboard/logements/save" method="post">
                    <input type="hidden" name="rating" value="0">
                    <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                        <div class="sm:col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                            <input type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ajouter un titre" required="Ce champ est requis">
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
                            <input type="text" id="host" name="host" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ajouter l'email du propriétaire" required="Ce champ est requis">
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
                            <input type="text" id="location" name="location" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ajouter la localisation" required="Ce champ est requis">
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
                            <input type="text" id="cover" name="cover" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ajouter une image de couverture" />
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
                            <textarea id="description" name="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ajouter une description"></textarea>
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
                                <input type="text" id="new-equipment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 mr-5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ajouter un nouvel équipement">
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
                            </ul>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="new-photo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ajouter des photos</label>
                            <div class="flex items-center justify-center">
                                <input type="text" name="new-photo" id="new-photo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 mr-5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ajouter une nouvelle photo">
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
                            </ul>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button type="submit" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Sauvergarder
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