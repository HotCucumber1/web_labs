<?php
require_once "./data/db/db_connection.php";
require_once "./data/db/db_interaction.php";
require_once "./data/config/config.php";


function getRandomColor(): string
{
    $r = rand(0, 255);
    $g = rand(0, 255);
    $b = rand(0, 255);
    return "rgb({$r}, {$g}, {$b})";
}

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
        closeDBConnection($connection);

        foreach ($users as $user)
        {
            if ($arrayData["email"] === $user["email"])
            {
                $password = hashPassword($arrayData["password"]);
                if ($password === $user["password"])
                {
                    $sessionName = explode("@", $user["email"])[0];

                    session_start();
                    session_name($sessionName);

                    $_SESSION['user_id'] = (int)$user["user_id"];
                    if (!$_SESSION['user_name'])
                    {
                        $_SESSION['user_name'] = $sessionName;
                    }
                    if (!$_SESSION['color'])
                    {
                        $_SESSION['color'] = getRandomColor();
                    }
                    $isFound = true;
                    header("HTTP/1.1 200 OK");
                }
            }
        }
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
