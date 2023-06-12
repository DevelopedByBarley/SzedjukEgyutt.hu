<?php

require('app/controllers/Public.Controller.php');

$r->addRoute('GET', '/', [PublicController::class, 'index']);
$r->addRoute('GET', '/event/{id}', [PublicController::class, 'event']);

