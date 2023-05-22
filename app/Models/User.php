<?php

namespace PavelPlot\App\Models;

class User extends Model
{
    protected string $table = 'users';

    public function __construct()
    {
        parent::__construct();
    }
}