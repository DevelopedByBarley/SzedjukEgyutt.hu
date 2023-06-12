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
        $glows = $body["glows"] === 'on' ? 1 : 0;
        $email = isset($body["email"]) ? $body["email"] : '';
        $message = isset($body["message"]) ? $body["message"] : '';




        $stmt = $this->pdo->prepare("INSERT INTO `registrations` 
            (`id`, `name`, `glows`, `bag`, `date`, `email`, `message`, `eventRefId`) 
            VALUES 
            ('', :name, :glows, :bag, :date, :email, :message, :eventRefId);");


        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":bag", $bag);
        $stmt->bindParam(":glows", $glows);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":message", $message);
        $stmt->bindParam(":eventRefId", $id);


        $stmt->execute();

        if ($this->pdo->lastInsertId()) {
            header("Location: /event/$id?isRegistered=1");
        }
    }
}
