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

        // $src tartalmazza az iframe teljes src attribútumát
        return $src;
    }

    public function new($body)
    {
        $bags = 0;
        $glows = 0;
        $adminId = isset($_SESSION["adminId"]) ? $_SESSION["adminId"] : $_SESSION["s_adminId"];
        $title = isset($body["title"]) ? $body["title"] : '';
        $location = isset($body["location"]) ? $body["location"] : '';

        $maps = isset($body["maps"]) ? $body["maps"] : '';
        $dateString = isset($body["date"]) ? $body["date"] : '';
        $content = isset($body["content"]) ? $body["content"] : '';

        $dateTime = new DateTime($dateString);
        $formattedDateTime = $dateTime->format('Y-m-d H:i');

        $mapsUrl = self::getMapsUrlByiFrame($maps);

        $stmt = $this->pdo->prepare("INSERT INTO `events` VALUES (NULL, :title, :location,:glows, :bags, :maps, :content, :date, current_timestamp(), :adminId);");
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":location", $location);
        $stmt->bindParam(":glows", $glows);
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

        $glows = 0;
        $bags = 0;

        foreach ($users as $user) {
            if ((int)$user["glows"] !== 0) {
                $glows += (int)$user["glows"];
            }
            if ((int)$user["bag"] !== 0) {
                $bags += (int)$user["bag"];
            }
        }

        return [
            "glows" => $glows,
            "bags" => $bags
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

        if (isset($adminId)) {
            $event["tools"] = self::getToolsForEvent($event);
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

    public function getLatestEvent()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `events` ORDER BY eventId DESC LIMIT 1");
        $stmt->execute();
        $latestEvent = $stmt->fetch(PDO::FETCH_ASSOC);

        return $latestEvent;
    }


    public function update($id, $body)
    {
        $bags = 0;
        $glows = 0;
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
        `glows` = :glows,
        `bags` = :bags,
        `maps` = :maps,
        `content` = :content,
        `date` = :date,
        `createdAt` = current_timestamp(),
        `adminRefId` = :adminId
    WHERE `eventId` = :eventId");

        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":location", $location);
        $stmt->bindParam(":glows", $glows);
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
