<?php

use UrlController as GlobalUrlController;

require_once('connection/database.php');

class UrlController
{
    private $prefix = 'https://shrt.est/';

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
        if (!$long_url) {
            return [];
        }

        $sql = "SELECT short_url FROM url_shortener WHERE long_url = :long_url";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':long_url', $long_url);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $short_url = $result['short_url'];
        }
        else {
            $short_code = $this->generate_short_code();
            $short_url = $this->prefix . $short_code;
            $sql = "INSERT INTO url_shortener (long_url, short_url) VALUES (:long_url, :short_url)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':long_url', $long_url);
            $stmt->bindParam(':short_url', $short_url);
            $stmt->execute();
        }

        return $short_url;
    }

    public function decode($short_url, $conn)
    {
        $sql = "SELECT long_url FROM url_shortener WHERE short_url = :short_url";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':short_url', $short_url);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result)
            return $result['long_url'];
        
        return '';
    }
}

