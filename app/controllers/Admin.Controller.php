<?php
require_once 'app/models/Admin.Model.php';

class AdminController
{

    private $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }


    public function index()
    {
        session_start();
        $isLoggedIn = isset($_SESSION["s_adminId"]) ? true : false;

        if ($isLoggedIn) {
            header("Location: /admin/dashboard");
            exit;
        }
        echo Renderer::render("Layout.php", [
            "content" => Renderer::render("super_admin/Form.php")
        ]);
    }

    public function dashboard()
    {
        LoginChecker::checkUserIsLoggedInOrRedirect("s_adminId", "/admin");
        echo Renderer::render("Layout.php", [
            "content" => Renderer::render("super_admin/Dashboard.php")
        ]);
    }

    public function registerAdmin()
    {
        $this->adminModel->register($_POST);
    }

    public function loginAdmin()
    {
        $isSuccess = $this->adminModel->login($_POST);
        if ($isSuccess) {
            header("Location: /admin/dashboard");
        }
    }

    public function logoutAdmin() {
        $this->adminModel->logout();
    }
}
