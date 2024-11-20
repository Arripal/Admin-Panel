<?php

$router->get('/logements', '/logements/show.php');

$router->get('/admin/login', '/admin/login_form.php');
$router->post('/admin/login', '/admin/login.php');

$router->get('/admin/dashboard', '/admin/dashboard.php', true);

$router->get('/admin/dashboard/users', '/admin/users/show.php', true);
$router->get('/admin/dashboard/users/edit', '/admin/users/edit.php', true);
$router->put('/admin/dashboard/users/update', '/admin/users/update.php', true);
$router->delete('/admin/dashboard/users/delete', '/admin/users/delete.php', true);

$router->get('/admin/dashboard/logements', '/admin/logements/show.php', true);
$router->get('/admin/dashboard/logements/edit', '/admin/logements/edit.php', true);
$router->put('/admin/dashboard/logements/update', '/admin/logements/update.php', true);
$router->delete('/admin/dashboard/logements/delete', '/admin/logements/delete.php', true);
