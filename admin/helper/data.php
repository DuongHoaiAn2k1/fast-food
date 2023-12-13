<?php

function show_array($data)
{
    if (is_array($data)) {
        echo "<pre>";
        print_r($data);
        echo "<pre>";
    }
}

function currency_format($number, $suffix = 'đ')
{
    return number_format($number) . $suffix;
}
