<?php

class App {
    private $controller = 'dashboard';
    private $method = 'index';
    private $params = [];

    public function __construct() {
        $url = $this->getUrl();

        // ambil controller 
        if(!empty($url[0]) && file_exists('app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        // import controller
        require_once('app/controllers/' . $this->controller . '.php');

        // buat objek controller
        $this->controller = new $this->controller;

        // ambil method
        if(isset($url[1])) {
            if(method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // ambil paramater
        if(!empty($url)) {
            $this->params = array_values($url);
        }

        call_user_func([$this->controller, $this->method], $this->params);
    }

    private function getUrl() {
        if(isset($_GET['url'])) {
            $url = $_GET['url'];
            $url = rtrim($url, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        } else {
            return array();
        }
    }
}