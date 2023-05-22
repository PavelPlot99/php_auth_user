<?php

namespace PavelPlot\App\View;

class ViewFactory
{
    public static function createView($templatePath){
        return new View($templatePath);
    }
}