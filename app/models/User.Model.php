<?php
class UserModel
{
    private $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getConnect();
    }

    public function register($body, $id)
    {
        $name = isset($body["name"]) ? $body["name"] : '';
        $bag = $body["bag"] === 'on' ? 1 : 0;
        $numOfRegistrations = isset($body["numOfRegistrations"]) ? $body["numOfRegistrations"] : 1;
        $message = isset($body["message"]) ? $body["message"] : '';




        $stmt = $this->pdo->prepare("INSERT INTO `registrations` 
            (`id`, `name`, `bag`, `numOfRegistrations`, `message`, `eventRefId`) 
            VALUES 
            ('', :name, :bag, :numOfRegistrations, :message, :eventRefId);");


        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":bag", $bag);
        $stmt->bindParam(":numOfRegistrations", $numOfRegistrations);
        $stmt->bindParam(":message", $message);
        $stmt->bindParam(":eventRefId", $id);


        $stmt->execute();

        if ($this->pdo->lastInsertId()) {
            header("Location: /event/$id?isRegistered=1");
        }
    }
}
