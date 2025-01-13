<?php

use Classes\Authentification;

$auth = new Authentification();

if ($auth->is_authenticated()) {
    redirect_to('/admin/dashboard');
    die();
}

access_view('/admin/login.view');
