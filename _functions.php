<?php

function returndata(int $code = 0, string $log = null)
{
    global $return_obj;
    $return_obj->Log[] = $log;
    $return_obj->Status = $code;
    // echo json_encode($return_obj);
    echo "<script>console.log(" . json_encode($return_obj) . ");</script>";
}

function Query(string $sql)
{
    global $conn;
    if (!$result = $conn->query($sql)) {
        die(returndata(1, $conn->error));
    } else {
        return $result;
    }
}

function CreateToken(int $lenght = 15)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $token = '';
    for ($i = 0; $i < $lenght; $i++) $token .= $characters[rand(0, strlen($characters) - 1)];

    return $token;
}

function render($script, array $vars = array(), bool $loadStyle = FALSE)
{
    extract($vars);

    if ($loadStyle) {
        $style = file_get_contents('http://www.confediliziacomo.it/style.css');
        $style .= file_get_contents(UTILS_SITE . '/template/site/_style.css',);
    }

    ob_start();
    include $script;
    return ob_get_clean();
}

function Cookie($cookie_value)
{
    setcookie('token', "$cookie_value", [
        'expires' => time() + 60 * 60 * 24 * 30,
        'path' => '/',
        'samesite' => 'None',
        'secure' => 'Secure',
        'httponly' => false,
    ]);
}

function ClearCookie()
{
    setcookie('token', '', [
        'path' => '/',
        'samesite' => 'None',
        'secure' => 'Secure',
        'httponly' => true,
    ]);
}

function updateInteractions()
{
    global $conn;
    $namePage = basename($_SERVER['REQUEST_URI'], ".php");
    $year = date("Y");
    $month = (int) date("m") - 1;
    $lang = 'it';

    if (!Query("SHOW COLUMNS FROM Visite_sito LIKE '$year'")->num_rows) {
        Query("ALTER TABLE Visite_sito ADD COLUMN `$year` JSON DEFAULT ('[{},{},{},{},{},{},{},{},{},{},{},{}]')");
    }

    if (isset($_COOKIE['token']) && $_COOKIE['token'] == API_KEY) return;
    if (Query("SELECT * FROM Visite_sito WHERE namePage = '$namePage' LIMIT 1")->num_rows == 0) return;

    if (!Query("SELECT JSON_EXTRACT(`$year`, '$[$month].$lang') as is_null FROM Visite_sito WHERE namePage = '$namePage'")->fetch_array(MYSQLI_ASSOC)['is_null']) {
        Query("UPDATE Visite_sito SET `$year`=JSON_SET(`$year`, '$[$month].$lang', 1) WHERE namePage = '$namePage'");
    } else {
        Query("UPDATE Visite_sito SET `$year`=JSON_SET(`$year`, '$[$month].$lang', JSON_EXTRACT(`$year`, '$[$month].$lang') + 1) WHERE namePage = '$namePage'");
    }
}
