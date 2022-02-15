<?php

class Router {
    private $get;
    private $post;
    private $errors;

    public function __construct() {
        $this->get = [];
        $this->post = [];
    }

    public function get($path, $action) {
        $this->get[$path] = $action;
    }

    public function post($path, $action) {
        $this->post[$path] = $action;
    }

    public function _404($action) {
        $this->errors['404'] = $action;
    }

    public function dispatch() {
        $requestedPath = explode('?', $_SERVER['REQUEST_URI'])[0]; 
        $method = strtolower($_SERVER['REQUEST_METHOD']);

        $availablePathMappings = $this->$method;

        if (!isset($availablePathMappings)) {
            return $this->callAction($this->errors['404']);
        }

        foreach ($availablePathMappings as $assignedPath => $action) {
            if (
                $this->isGlobalPath($assignedPath) && 
                $this->matchesGlobalPath($requestedPath, $assignedPath)
            ) {
                return $this->callAction($action);
            }

            if ($assignedPath == $requestedPath) {
                return $this->callAction($action);
            }
        }

        return $this->callAction($this->errors['404']);
    }

    private function callAction($actionName) {
        $controller = explode('::', $actionName)[0];
        $handler = explode('::', $actionName)[1];
        require_once "controllers/{$controller}.php";
        return (new $controller)->$handler();
    }

    private function startsWith($target, $needle) {
        return substr($target, 0, strlen($needle)) == $needle;
    }

    private function isGlobalPath($path) {
        return substr($path, -2) == '/*';
    }

    private function matchesGlobalPath($pathToCheck, $globalPath) {
        $assignedPathWithoutEnd = substr($globalPath, 0, strlen($globalPath) - 2);
        return $this->startsWith($pathToCheck, $assignedPathWithoutEnd);
    }
}