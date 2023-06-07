<?php
require 'app/controllers/Event.Controller.php';

$r->addRoute('GET', '/events', [EventController::class, 'events']);
$r->addRoute('GET', '/event/update/{id}', [EventController::class, 'eventsForm']);
$r->addRoute('GET', '/events/new', [EventController::class, 'eventsForm']);

$r->addRoute('GET', '/event/delete/{id}', [EventController::class, 'deleteEvent']);

$r->addRoute('POST', '/event/new', [EventController::class, 'newEvent']);
