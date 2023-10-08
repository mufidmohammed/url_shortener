<?php

require_once('app.php');


if (isset($_POST['encode']) )
{
    $url_controller = new UrlController();
    $conn = $db->conn;
    $long_url = $_POST['long_url'];

    $encoded_url = $url_controller->encode($_POST['long_url'], $conn);

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <h1>Encode URL</h1>
    <form action="" method="POST">
        <div>
            <label for="">Enter full URL</label>
            <input type="text" name="long_url">
        </div>
        <div>
            <input type="submit" name="encode">
        </div>
    </form>

    <p>Encoded url: <?= $encoded_url ?? 'Invalid url' ?></p>
    
</body>
</html>