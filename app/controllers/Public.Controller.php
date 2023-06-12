<?php

class PublicController
{
    private $eventModel;

    public function __construct()
    {
        $this->eventModel = new EventModel();
    }

    public function index()
    {


        echo Renderer::render("Layout.php", [
            "content" => Renderer::render("pages/public/Content.php", [
                "latestEvent" => $this->eventModel->getLatestEvent() ?? null

            ])
        ]);
    }

    public function event($vars)
    {
        $id = $vars["id"];
        echo Renderer::render("Layout.php", [
            "content" => Renderer::render("pages/public/Event.php", [
                "event" => $this->eventModel->getEventById($id),
                "isRegistered" => $_GET["isRegistered"] ?? null
            ])
        ]);
    }
}
