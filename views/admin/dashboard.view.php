<?php
access_view('/components/head.view', ['title' => 'Dashboard']);
?>
<div class="sm:flex min-h-screen">
    <?php
    access_view('/components/sidebar.view');
    ?>
    <div class="p-4 sm:ml-64 w-full">
        <section class="bg-white dark:bg-gray-900 min-h-[100dvh] flex-1 flex items-center justify-center">
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12">
                    <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Bienvenue dans votre espace administrateur</h2>
                    <p class="mb-5 font-light text-gray-500 sm:text-xl dark:text-gray-400">Ici,vous pourrez gérer facilement les données de votre site.</p>
                </div>
                <div class="space-y-8 lg:grid lg:grid-cols-2 sm:gap-6 xl:gap-10 lg:space-y-0">
                    <div class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                        <h3 class="mb-4 text-2xl font-semibold">Utilisateurs</h3>
                        <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400 pb-5">Gérer les données des utilisateurs.</p>
                        <ul role="list" class="mb-8 space-y-6 lg:text-left ">
                            <li class="space-x-3">
                                <a href="/admin/dashboard/users" class="p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                    <span>Accéder à la liste des utilisateurs</span>
                                </a>
                            </li>
                            <li class="space-x-3">
                                <a href="/admin/dashboard/users/add" class=" p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                    <span>Ajouter un utilisateur</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                        <h3 class="mb-4 text-2xl font-semibold">Logements</h3>
                        <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400 pb-5">Gérer les données des logements.</p>
                        <ul role="list" class="mb-8 space-y-6 lg:text-left">
                            <li class="space-x-3">
                                <a href="/admin/dashboard/logements" class="p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                    <span>Accéder à la liste des logements</span>
                                </a>
                            </li>
                            <li class="space-x-3">
                                <a href="/admin/dashboard/logements/add" class="p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                    <span>Ajouter un logement</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>

</div>


<?php
access_view('/components/footer.view');
?>