<?php
require_once('./Classes/Session.php');
$session = new Session();

$session->close_session();
redirect_to('/admin/login');
