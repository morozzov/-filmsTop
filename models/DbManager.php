<?php

require_once './models/tables/TableUsers.php';
require_once './models/tables/TableFilms.php';

class DbManager{
    public $Users;
    public $Films;

    public function __construct()
    {
        $this->Users = new TableUsers();
        $this->Films = new TableFilms();
    }
}