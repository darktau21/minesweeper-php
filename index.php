<?php
require 'core/constants.php';
require 'autoload.php';
session_start();
date_default_timezone_set('UTC');

use controllers\ErrorController;
use controllers\GameController;
use controllers\SessionController;
use core\Router;

$router = new Router();

$gameController = new GameController();
$router->add('/', $gameController);

$sessionController = new SessionController();
$router->add('/reset-session', $sessionController);

$errorController = new ErrorController();
$router->add('/404', $errorController);

$router->load($_GET['path'], $_GET, $_POST);