<?php
function redirect($url = '?mod=home')
{
    if (!empty($url)) {
        header("Location: {$url}");
    }
}
