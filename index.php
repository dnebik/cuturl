<?php

require_once "database/database.php";
/* @var $connection PDO */

$link = explode("/", $_SERVER["REQUEST_URI"]);
$link = array_reverse($link)[0];

if (!in_array($link, ["", "index", "index.php"])) {
    $link = $connection->prepare("SELECT url FROM urls WHERE id = '$link'");
    $link->execute();
    $link = $link->fetch(PDO::FETCH_ASSOC)['url'];

    if ($link) {
        $link = str_replace(["http://", "https://"], "", $link);
        header("Location: http://$link");
        die();
    }
}

?>

<!doctype HTML>
<html>

<head>
    <title>CutUrl</title>

</head>

<body>
    URL: <input type="text" placeholder="http://example.com" id="url">
    <button id="button">CUT</button>

    <br>

    <div class="url">
        <? require_once "actions/generateUrl.php" ?>
    </div>

    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/ajax.js"></script>

</body>

</html>
