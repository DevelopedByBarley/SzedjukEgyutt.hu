<?php

require('app/controllers/User.Controller.php');

$r->addRoute('POST', '/register/{id}', [UserController::class, 'registerUser']);

