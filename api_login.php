<?php
require_once "./data/db/db_connection.php";
require_once "./data/db/db_interaction.php";
require_once "./data/config/config.php";


function hashPassword(string $password): string
{
    $salt = "Sugar";
    return md5(md5($password) . $salt);
}

function isChecked(array $data): bool
{
    $email = $data['email'];
    $password = $data['password'];
    if ($email !== "" && filter_var($email) &&
        $password !== "" && strlen($password) >= 6)
    {
        return true;
    }
    return false;
}


try
{
    $jsonData = file_get_contents("php://input");
    $arrayData = json_decode($jsonData, associative: true);

    if (isChecked($arrayData))
    {
        $isFound = false;
        $connection = createDBConnection();
        $users = getUsers($connection);

        foreach ($users as $user)
        {
            if ($arrayData["email"] === $user["email"])
            {
                $password = hashPassword($arrayData["password"]);
                if ($password === $user["password"])
                {
                    session_name($user["email"]);
                    session_start();
                    $_SESSION['user_id'] = (int)$user["user_id"];

                    $isFound = true;
                    header("HTTP/1.1 200 OK");
                }
            }
        }
        closeDBConnection($connection);
        if (!$isFound)
        {
            header("HTTP/1.1 401 Not Found");
        }
    }
}
catch (Exception $e)
{
    echo $e->getMessage();
}
