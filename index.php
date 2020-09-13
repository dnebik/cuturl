<?php

$link = explode("/", $_SERVER["REQUEST_URI"]);
$link = array_reverse($link)[0];

if (!in_array($link, ["", "index", "index.php"])) {
    //проверка на редирект и редирект
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
