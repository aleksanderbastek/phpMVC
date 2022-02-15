<?php
require '../vendor/autoload.php';

session_start();
if (!is_writable(session_save_path())) {
    echo 'Session path "'.session_save_path().'" is not writable for PHP!';
	return;
}

require_once '../Router.php';

$router = new Router();

$router->get('/resources/*', 'ResourceController::serve');
$router->get('/', 'HomeController::index');

$router->get('/films', 'HomeController::films');
$router->get('/series', 'HomeController::series');
$router->get('/gallery', 'GalleryController::show');

$router->get('/register', 'RegisterController::signUpView');
$router->post('/register', 'RegisterController::signUp');
$router->post('/login', 'RegisterController::login');
$router->post('/upload', 'GalleryController::upload');
$router->get('/logout', 'RegisterController::logout');


$router->_404('ErrorController::_404');

$view = $router->dispatch();
$view->render();