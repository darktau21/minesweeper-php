<?php


namespace controllers;

use core\Controller;

class SessionController extends Controller
{
    public function index()
    {
        session_destroy();
        session_start();
        header('Location: /');
    }
}