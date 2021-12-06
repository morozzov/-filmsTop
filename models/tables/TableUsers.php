<?php
session_start();


require_once './models/entities/User.php';
require_once './models/DbConnector.php';

class TableUsers
{
    public function getById($id): User
    {
        $db = DbConnector::getConnection();

        $queryResult = $db->query("SELECT * FROM `users` WHERE `id` = {$id}");

        if ($queryResult->num_rows == 0) {
            throw new Exception("User with id = {$id} not found");
        } else {
            $row = $queryResult->fetch_assoc();
            $user = new User(
                $row["Id"],
                $row["Name"],
                $row["Login"],
                $row["Password"]
            );
            return $user;
        }
    }

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


    public
    function edit($id, $login, $password1, $password2, $name)
    {
        $db = DbConnector::getConnection();

        if ($password1 == $password2 and $password1 != "") {
            $password = hash('sha512', $password1);

            $db->query("UPDATE `users` SET `password` = '{$password}' WHERE `users`.`id` = '{$id}';");
        }

        $result = $db->query("SELECT * FROM `users` WHERE (login='{$login}')");

        $countRows = mysqli_num_rows($result);
        if ($countRows == 0) {
            $db->query("UPDATE `users` SET `login` = '{$login}' WHERE `users`.`id` = '{$id}';");
        }
        if ($name != "") {
            $db->query("UPDATE `users` SET `name` = '{$name}' WHERE `users`.`id` = '{$id}';");
        }
    }
}