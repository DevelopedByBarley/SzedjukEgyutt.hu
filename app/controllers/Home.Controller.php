<?php

class HomeController
{
    public function index()
    {
        echo Renderer::render("Layout.php",[
            "content" => Renderer::render("/pages/Content.php", [])
        ]);
    }
}
