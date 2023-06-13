<?php
class EventModel
{
    private  $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getConnect();
    }

    private function getMapsUrlByiFrame($iframeCode)
    {
        $dom = new DOMDocument();
        $dom->loadHTML($iframeCode);

        $iframe = $dom->getElementsByTagName('iframe')->item(0);

        if (!isset($iframe)) return $iframeCode;

        $src = $iframe->getAttribute('src');

        return $src;
    }

    public function new($body)
    {
        $bags = 0;
        $adminId = isset($_SESSION["adminId"]) ? $_SESSION["adminId"] : $_SESSION["s_adminId"];
        $title = isset($body["title"]) ? $body["title"] : '';
        $location = isset($body["location"]) ? $body["location"] : '';

        $maps = isset($body["maps"]) ? $body["maps"] : '';
        $dateString = isset($body["date"]) ? $body["date"] : '';
        $content = isset($body["content"]) ? $body["content"] : '';

        $dateTime = new DateTime($dateString);
        $formattedDateTime = $dateTime->format('Y-m-d H:i');

        $mapsUrl = self::getMapsUrlByiFrame($maps);

        $stmt = $this->pdo->prepare("INSERT INTO `events` VALUES (NULL, :title, :location, :bags, :maps, :content, :date, current_timestamp(), :adminId);");
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":location", $location);
        $stmt->bindParam(":bags", $bags);
        $stmt->bindParam(":maps", $mapsUrl);
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

    private function getToolsForEvent($event)
    {
        $id = $event["eventId"];
        $stmt = $this->pdo->prepare("SELECT * FROM `registrations` WHERE  `eventRefId` = :id ");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $registrations = 0;
        $bags = 0;

        foreach ($users as $user) {
            if ((int)$user["bag"] !== 0) {
                $bags += (int)$user["bag"];
            }

            $registrations += (int)$user["numOfRegistrations"];
        }

        return [
            "bags" => $bags,
            "registrations" => $registrations
        ];
    }



    public function getEventById($id)
    {
        session_start();
        $adminId = $_SESSION["s_adminId"] ?? null;

        $stmt = $this->pdo->prepare("SELECT * FROM `events` WHERE eventId = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $event = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$event) {
            header("Location: /");
        }

        if (isset($adminId)) {
            $event["bags"] = self::getToolsForEvent($event)["bags"];
            $event["registrations"] = self::getToolsForEvent($event)["registrations"];
        }

        return $event;
    }

    public function deleteEvent($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM `events` WHERE eventId = :id");
        $stmt->bindParam(":id", $id);
        $isSuccess = $stmt->execute();

        if ($isSuccess) header("Location: /events");
    }

    public function getLatestEvents()
    {
        $today = date("Y-m-d H:i");

        $stmt = $this->pdo->prepare("SELECT * FROM `events` WHERE `date` > :today ORDER BY `date` ASC LIMIT 1");
        $stmt->bindParam(':today', $today);
        $stmt->execute();
        $latestEvent = $stmt->fetch(PDO::FETCH_ASSOC);


        $latestEvent["registrations"] = self::getToolsForEvent($latestEvent)["registrations"];

        return $latestEvent;
    }

    public function getMoreEvents() {
        $today = date("Y-m-d H:i");

        $stmt = $this->pdo->prepare("SELECT * FROM `events` WHERE `date` > :today ORDER BY `date` ASC LIMIT 4");
        $stmt->bindParam(':today', $today);
        $stmt->execute();
        $moreEvents = $stmt->fetchAll(PDO::FETCH_ASSOC);

        array_shift($moreEvents);

        return $moreEvents;
    }


    public function update($id, $body)
    {
        $bags = 0;
        $adminId = isset($_SESSION["adminId"]) ? $_SESSION["adminId"] : $_SESSION["s_adminId"];
        $title = isset($body["title"]) ? $body["title"] : '';
        $location = isset($body["location"]) ? $body["location"] : '';

        $maps = isset($body["maps"]) ? $body["maps"] : '';
        $mapsUrl = self::getMapsUrlByiFrame($maps);
        $dateString = isset($body["date"]) ? $body["date"] : '';
        $content = isset($body["content"]) ? $body["content"] : '';
        $dateTime = new DateTime($dateString);
        $formattedDateTime = $dateTime->format('Y-m-d H:i');


        $stmt = $this->pdo->prepare("UPDATE `events` SET 
        `title` = :title,
        `location` = :location,
        `bags` = :bags,
        `maps` = :maps,
        `content` = :content,
        `date` = :date,
        `createdAt` = current_timestamp(),
        `adminRefId` = :adminId
    WHERE `eventId` = :eventId");

        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":location", $location);
        $stmt->bindParam(":bags", $bags);
        $stmt->bindParam(":maps", $mapsUrl);
        $stmt->bindParam(":date", $formattedDateTime);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":adminId", $adminId);
        $stmt->bindParam(":eventId", $id);
        $isSuccess = $stmt->execute();

        if ($isSuccess) {
            header("Location: /events");
        }
    }
}
