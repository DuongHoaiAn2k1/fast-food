<?php

class Home extends Controller
{
    function LoadView()
    {

        $homeModel = $this->model("HomeModel");
        $listProduct = $homeModel->getProducts();
        $listCategory = $homeModel->getCategories();
        $home = $this->view("main", [
            "Page" => "home",
            "products" => $listProduct,
            "categories" => $listCategory
        ]);
    }
}
