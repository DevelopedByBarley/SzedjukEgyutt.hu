<?php
class AdminModel
{
    private  $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getConnect();
    }


    public  function register($body)
    {
        $userName = $body["userName"];
        $pw = password_hash($body["password"], PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare("INSERT INTO `super_admin` (`s_adminId`, `userName`, `password`, `createdAt`) VALUES (NULL, :userName, :pw, current_timestamp());");
        $stmt->bindParam("userName", $userName);
        $stmt->bindParam("pw", $pw);

        $stmt->execute();
    }

    public function login($body)
    {
        session_start();
        $userName = $body["userName"];
        $pw = $body["password"];

        $stmt = $this->pdo->prepare("SELECT * FROM `super_admin` WHERE `userName` = :userName");
        $stmt->bindParam("userName", $userName);
        $stmt->execute();
        $s_admin = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$s_admin) {
            echo "Felhasználó vagy jelszó nem létezik!";
            exit;
        }

        $isVerified = password_verify($pw, $s_admin["password"]);

        if (!$isVerified) {
            echo "Felhasználó vagy jelszó nem létezik!";
            exit;
        }

        $_SESSION["s_adminId"] = $s_admin["s_adminId"];

        return true;
    }

    public function logout()
    {
        session_start();
        session_destroy();

        $cookieParams = session_get_cookie_params();
        setcookie("s_adminId", "", 0, $cookieParams["path"], $cookieParams["domain"], $cookieParams["secure"], isset($cookieParams["httponly"]));



        header('Location: /');
    }
}
