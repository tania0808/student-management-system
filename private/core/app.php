<?php

/*
 *
 */
class App
{
    protected $controller = "home";
    protected $method = "index";
    protected $params = [];

    public function __construct()
    {
        echo "<pre>";
        print_r($this->getURL());
        echo "</pre>";
    }

    private function getURL()
    {
        return explode("/", filter_var(trim($_GET['url'], "/")),FILTER_SANITIZE_URL);
    }
}