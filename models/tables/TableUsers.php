<?php
session_start();

require_once './models/entities/User.php';

class TableUsers
{
    public function isUserByLogin($login)
    {
        $strJsonFileContents = file_get_contents("./DB/users.json");
        $items = json_decode($strJsonFileContents, true);

        foreach ($items as $item) {
            if ($item["Login"] == $login) {
                return true;
            }
        }
        return false;
    }

    public function auth($login, $password)
    {
        $strJsonFileContents = file_get_contents("./DB/users.json");
        $items = json_decode($strJsonFileContents, true);

        foreach ($items as $item) {
            if ($item["Login"] == $login && $item["Password"] == $password) {
                $user = new User(
                    $item["Id"],
                    $item["Name"],
                    $item["Login"],
                    $item["Password"]
                );

                $_SESSION['user_id'] = $item["Id"];
                $_SESSION['user_name'] = $item["Name"];
                return $user;
            }
        }
        return null;
    }

    public function addNew($login, $password, $name)
    {
        if (!$this->isUserByLogin($login)) {
            $strJsonFileContents = file_get_contents('./DB/users.json');
            $items = json_decode($strJsonFileContents, true);

            $id = -1;
            foreach ($items as $item) {
                if ($item["Id"] > $id) {
                    $id = $item["Id"];
                }
            }
            ++$id;

            $user = new User(
                $id,
                $name,
                $login,
                $password
            );
            array_push($items, $user);

            $jsonData = json_encode($items);
            file_put_contents('./DB/users.json', $jsonData);

            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;
            return $user;
        }
        return null;
    }
}