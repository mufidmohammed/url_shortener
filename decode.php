<?php

require_once('app.php');


if (isset($_POST['decode']) )
{
    $url_controller = new UrlController();
    $conn = $db->conn;
    $decoded_url = $url_controller->decode($_POST['short_url'], $conn);
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
    <h1>Decode URL</h1>
    <form action="" method="POST">
        <div>
            <label for="">Enter short URL</label>
            <input type="text" name="short_url">
        </div>
        <div>
            <input type="submit" name="decode">
        </div>
    </form>

    <p>Long url: <?= $decoded_url ?? 'Url not found' ?></p>
    
</body>
</html>