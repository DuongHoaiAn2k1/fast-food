<?php


class Product extends Controller
{
    function LoadView()
    {
        $productModel = $this->model("ProductModel");
        $listProduct = $productModel->getProducts();
        $listCategory = $productModel->getCategories();
        $product = $this->view("main", [
            "Page" => "product",
            "products" => $listProduct,
            "categories" => $listCategory,

        ]);
    }
    function List($categoryId)
    {
        $productModel = $this->model("ProductModel");
        $listProduct = $productModel->getProducts();
        $listCategory = $productModel->getCategories();
        $product = $this->view("main", [
            "Page" => "product",
            "products" => $listProduct,
            "categories" => $listCategory,
            "categoryID" => $categoryId

        ]);
    }
}
