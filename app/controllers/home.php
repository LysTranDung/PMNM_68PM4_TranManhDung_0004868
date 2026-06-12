<?php
require_once __DIR__ . '/../core/Controller.php';

class home extends Controller
{
    public function index()
    {
        $this->view('home/index');
    }

    public function login()
    {
        $this->view('auth/login');
    }
}
