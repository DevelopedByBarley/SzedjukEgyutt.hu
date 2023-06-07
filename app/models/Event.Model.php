<?php
class EventModel
{
    private  $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getConnect();
    }


    public function new($body)
    {
        $adminId = isset($_SESSION["adminId"]) ? $_SESSION["adminId"] : $_SESSION["s_adminId"];
        $title = isset($body["title"]) ? $body["title"] : '';
        $location = isset($body["location"]) ? $body["location"] : '';
        $dateString = isset($body["date"]) ? $body["date"] : '';
        $content = isset($body["content"]) ? $body["content"] : '';

        $dateTime = new DateTime($dateString);
        $formattedDateTime = $dateTime->format('Y-m-d H:i');

        $stmt = $this->pdo->prepare("INSERT INTO `events` VALUES (NULL, :title, :location, :content, :date, current_timestamp(), :adminId);");
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":location", $location);
        $stmt->bindParam(":date", $formattedDateTime);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":adminId", $adminId);

        $stmt->execute();

        if ($this->pdo->lastInsertId()) header("Location: /events");
    }

    public function getEventsByAdmin()
    {
        $adminId = $_SESSION["s_adminId"] ?? null;

        $stmt = $this->pdo->prepare("SELECT * FROM `events` WHERE adminRefId = :id");
        $stmt->bindParam(":id", $adminId);
        $stmt->execute();
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $events;
    }


    public function getEventById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `events` WHERE eventId = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $event = $stmt->fetch(PDO::FETCH_ASSOC);

        return $event;
    }

    public function deleteEvent($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM `events` WHERE eventId = :id");
        $stmt->bindParam(":id", $id);
        $isSuccess = $stmt->execute();

        if ($isSuccess) header("Location: /events");
    }

    public function getLatestEvent() {
        $stmt = $this->pdo->prepare("SELECT * FROM `events` ORDER BY eventId DESC LIMIT 1");
        $stmt->execute();
        $latestEvent = $stmt->fetch(PDO::FETCH_ASSOC);

        return $latestEvent;
    }
}
