<?php
class App
{

    protected $controller = "Home";
    protected $action = "LoadView";
    protected $params = [];


    function __construct()
    {
        $arr = $this->UrlProcess();


        if (isset($arr)) {
            if (file_exists("./src/controllers/" . $arr[0] . ".php")) {
                $this->controller = $arr[0];
                unset($arr[0]);
            }
        }

        require "./src/controllers/" . $this->controller . ".php";
        $controllerInstance = new $this->controller();

        if (isset($arr[1])) {
            if (method_exists($this->controller, $arr[1])) {
                $this->action = $arr[1];
            }
            unset($arr[1]);
        }


        $this->params = $arr ? array_values($arr) : [];


        call_user_func_array([$controllerInstance, $this->action], $this->params);
    }

    function UrlProcess()
    {
        if (isset($_GET['url'])) {
            return explode("/", trim($_GET['url'], "/"));
        }
    }
}
