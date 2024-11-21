<?php

$router->get('/logements', '/logements/show.php');

$router->get('/admin/login', '/admin/login_form.php');
$router->post('/admin/login', '/admin/login.php');

$router->get('/admin/dashboard', '/admin/dashboard.php');
$router->get('/admin/dashboard/not_found', '/admin/not_found.php');
$router->get('/admin/dashboard/users', '/admin/users/show.php');
$router->get('/admin/dashboard/users/edit', '/admin/users/edit.php');
$router->put('/admin/dashboard/users/update', '/admin/users/update.php');
$router->delete('/admin/dashboard/users/delete', '/admin/users/delete.php');

$router->get('/admin/dashboard/logements', '/admin/logements/show.php');
$router->get('/admin/dashboard/logements/edit', '/admin/logements/edit.php');
$router->put('/admin/dashboard/logements/update', '/admin/logements/update.php');
$router->delete('/admin/dashboard/logements/delete', '/admin/logements/delete.php');
