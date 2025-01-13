<?php

use Classes\Session;

$session = new Session();

$session->close_session();
redirect_to('/admin/login');
