<?php

require_once('app.php');

$url = '';

if (isset($_POST['encode'])) 
{
    $url_controller = new UrlController();

    $conn = $db->conn;

    $encoded_url = $url_controller->encode($_POST['long_url'], $conn);

    $url_object = json_decode($encoded_url);    

    $url = $url_object->error ?? $url_object->short_url;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL shortener | encode</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold">Encode URL</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Enter full URL</p>

            <form class="row g-3" method="POST" action="./encode.php">
                <div class="d-flex align-items-end justify-content-center">
                    <div class="form-group">
                        <input type="text" name="long_url" class="form-control" placeholder="Enter URL">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="encode" class="btn btn-primary">
                    </div>
                </div>
            </form>

            <p>Encoded url: <?= $url ?></p>

            <div class="mt-4 text-left">
                <a href="./index.php">back</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>