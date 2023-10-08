<?php

use UrlController as GlobalUrlController;

require_once('connection/database.php');

class UrlController
{
    public function generate_short_code()
    {
        $length = 6;
        $short_code = '';
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        for ($i = 0; $i < $length; $i++)
        {
            $index = rand(0, strlen($characters) - 1);
            $short_code .= $characters[$index];
        }
        
        return $short_code;
    }

    public function encode($long_url, $conn)
    {
        $sql = "SELECT short_code FROM url_shortener WHERE long_url = :long_url";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':long_url', $long_url);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $short_code = $result['short_code'];
        }
        else {
            $short_code = $this->generate_short_code();
            $sql = "INSERT INTO url_shortener (long_url, short_code) VALUES (:long_url, :short_code)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':long_url', $long_url);
            $stmt->bindParam(':short_code', $short_code);
            $stmt->execute();
        }

        $shorten_url = "https://www.somlfe.co/" . $short_code;
        return $shorten_url;
    }

    public function decode($short_code, $conn)
    {
        $sql = "SELECT long_url FROM url_shortener WHERE short_code = :short_code";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':short_code', $short_code);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result)
            return $result['long_url'];
        
        return '';
    }
}

// $conn = $db->conn;

// $url = new UrlController();

// $long_url = "https://www.sommalife.com/ssahfeljoisegha.ciods";

// $encoded_url = $url->encode($long_url, $conn);
// $decoded_url = $url->decode('Dh49er', $conn);
// var_dump($encoded_url, $decoded_url);

