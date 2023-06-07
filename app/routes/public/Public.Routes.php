<?php

require('app/controllers/Public.Controller.php');

$r->addRoute('GET', '/', [PublicController::class, 'index']);
$r->addRoute('GET', '/event', [PublicController::class, 'event']);

