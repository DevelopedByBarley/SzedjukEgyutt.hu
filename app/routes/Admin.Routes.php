<?php

    require_once "app/controllers/Admin.Controller.php";


    // GET
    $r->addRoute('GET', '/admin', [AdminController::class, 'index']);
    $r->addRoute('GET', '/admin/dashboard', [AdminController::class, 'dashboard']);
    



    // POST
    $r->addRoute('POST', '/admin/register', [AdminController::class, 'registerAdmin']);
    $r->addRoute('POST', '/admin/login', [AdminController::class, 'loginAdmin']);