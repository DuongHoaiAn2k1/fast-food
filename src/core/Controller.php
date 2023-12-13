<?php

class Controller
{
    public function model($model)
    {
        require_once "./src/models/" . $model . ".php";
        return new $model;
    }

    public function view($view, $data)
    {
        require_once "./src/views/" . $view . ".php";
    }
    public function redirect($url = '/fast-food')
    {
        if (!empty($url)) {
            header("Location: {$url}");
        }
    }

    function currency_format($number, $suffix = 'đ')
    {
        return number_format($number) . $suffix;
    }
}
