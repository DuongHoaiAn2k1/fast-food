<?php

class Contact extends Controller
{
    function LoadView()
    {
        $contact = $this->view("main", [
            "Page" => "contact"
        ]);
    }
}
