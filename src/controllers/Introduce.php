<?php


class Introduce extends Controller
{
    function LoadView()
    {
        $home = $this->view("main", ["Page" => "introduce"]);
    }
}
