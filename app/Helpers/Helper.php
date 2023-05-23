<?php

namespace PavelPlot\App\Helpers;

class Helper
{
    public static function redirect($url){
        header("Location: $url", true);
        exit();
    }
}