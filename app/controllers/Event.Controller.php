<?php
require 'app/models/Event.Model.php';

class EventController
{
    private $eventModel;

    public function __construct()
    {
        $this->eventModel = new EventModel();
    }


    public function events()
    {
        LoginChecker::checkUserIsLoggedInOrRedirect("s_adminId", "/admin");
        $events = $this->eventModel->getEventsByAdmin();

        echo Renderer::render("Layout.php", [
            "content" => Renderer::render("pages/super_admin/events/Events.php", [
                "events" => $events
            ]),
        ]);
    }

    public function newEvent()
    {
        LoginChecker::checkUserIsLoggedInOrRedirect("s_adminId", "/admin");
        $this->eventModel->new($_POST);
    }


    public function eventsForm($vars)
    {
        LoginChecker::checkUserIsLoggedInOrRedirect("s_adminId", "/admin");
        $eventIdForUpdate = isset($vars["id"]) ? $vars["id"] : null;


        echo Renderer::render("Layout.php", [
            "content" => Renderer::render("pages/super_admin/events/Form.php", [
                "eventForUpdate" => isset($eventIdForUpdate) ? $this->eventModel->getEventById($eventIdForUpdate) : null
            ])
        ]);
    }




    public function deleteEvent($vars)
    {
        LoginChecker::checkUserIsLoggedInOrRedirect("s_adminId", "/admin");
        $id = $vars["id"] ?? null;
        $this->eventModel->deleteEvent($id);
    }

    public function updateEvent($vars)
    {
        LoginChecker::checkUserIsLoggedInOrRedirect("s_adminId", "/admin");
        $id = $vars["id"] ?? null;
        $this->eventModel->update($id, $_POST);
    }
}
