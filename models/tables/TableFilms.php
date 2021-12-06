<?php

require_once './models/entities/Film.php';
require_once './models/DbConnector.php';

class TableFilms
{
    public function getAll()
    {
        $strJsonFileContents = file_get_contents("./DB/films.json");
        $items = json_decode($strJsonFileContents, true);

        $films = array();
        foreach ($items as $item) {

            $film = new Film(
                $item["Id"],
                $item["Name"],
                $item["Year"],
                $item["UserId"]
            );

            array_push($films, $film);
        }

        return $films;
    }

    public function addNew($name, $year)
    {
        $strJsonFileContents = file_get_contents('./DB/films.json');
        $items = json_decode($strJsonFileContents, true);

        $id = -1;
        foreach ($items as $item) {
            if ($item["Id"] > $id) {
                $id = $item["Id"];
            }
        }
        ++$id;

        $film = new Film(
            $id,
            $name,
            $year,
            $_SESSION["user_id"]
        );
        array_push($items, $film);

        $jsonData = json_encode($items);
        file_put_contents('./DB/films.json', $jsonData);
        return $film;
    }
}