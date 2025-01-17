<?php
access_view('/components/head.view', ['title' => 'Ressource introuvable']);
?>
<section class="bg-white dark:bg-gray-900 min-h-[100dvh] flex-1 flex items-center justify-center">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12">
            <h1 class="mb-4 text-9xl tracking-tight font-bold text-gray-900 dark:text-white">404</h1>
            <h2 class="mb-4 text-3xl tracking-tight font-bold text-gray-900 dark:text-white">La page demandée n'existe pas </h2>
            <a class="p-2 text-xl font-normal text-gray-900 rounded-lg dark:text-blue-600 hover:bg-gray-100 dark:hover:bg-gray-700 group" href="/admin/dashboard">Retourner à l'accueil</a>
        </div>

    </div>
</section>
<?php
access_view('/components/footer.view');
?>