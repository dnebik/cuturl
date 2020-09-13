<?php

require_once "convert.php";
if (!isset($connection)) {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/database/database.php";
}
/* @var $connection PDO */

function urlExists($url=NULL)
{
    if($url == NULL) return false;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if($httpcode>=200 && $httpcode<300){
        return true;
    } else {
        return false;
    }
}

    error_log(print_r($_POST, TRUE));

if ($_POST["url"]) {
    $url = $_POST["url"];
    foreach ($_POST as $key => $value) {
        if ($key != 'url') {
            $value = str_replace(" ", "+", $value);
            $url .= '&' . $key . '=' . $value;
        }
    }
    if (urlExists($url)) {
        $id = $connection->prepare("SELECT id FROM urls WHERE url = '$url'");
        $id->execute();
        $id = $id->fetch()['id'];

        if (!$id) {
            $url = $connection->query("INSERT INTO urls (url) VALUE ('$url')");
            $id = $connection->lastInsertId();
        }
//        $id = convBase($id, '0123456789', 'QqRrSsDdOoPpHhVvXx123467890');
        $url = "http://" . $_SERVER["SERVER_NAME"] . "/" . $id;
        ?>

        short URL: <a href="<?=$url?>"><?= $url ?>

        <?
    } else {
        ?>
        <h2>Адресса '<?=$url?>' не существует!</h2>
        <?
    }
}

?>

