<?php

class middleware {

    public function checklogin() {

        $url = $_GET['url'] ?? '';

        $publicPages = [
            '',
            'home/login',
            'auth/login',
            'auth/logout'
        ];

        if (
            !isset($_SESSION['username']) &&
            !in_array($url, $publicPages)
        ) {
            header('Location: index.php?url=home/login');
            exit();
        }
    }
}