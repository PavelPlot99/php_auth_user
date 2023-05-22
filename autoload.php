<?php

spl_autoload_register(
    function ($class) {
        $class = str_replace(["PavelPlot\App", "\\"], ["", "/"], $class);
        $path = './app'.$class.'.php';

        if (file_exists($path)) {
            include_once $path;
        }
    }
);