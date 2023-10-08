# URL Shortening Service - Documentation

## Introduction

This is a documentation on how to install and run the URL shortening service implemented using PHP/MySQL.

## Requirements

To run the application, you will need the following software:

- PHP 7.0 or later
- MySQL server 5.7 or later
- A web server such as Apache or Nginx
- A modern web browser

## Installation

Follow the steps below to install and configure the application:

1. Clone the repository to your local machine:

   ```
   git clone https://github.com/mufidmohammed/url_shortener.git
   ```

2. Create a MySQL database and a table for the short URLs:

   ```
   CREATE DATABASE shorten_url;
   USE shorten_url;
   CREATE TABLE url_shortener (
     `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
     `long_url` TEXT,
     `short_url` VARCHAR(255),
     PRIMARY KEY(`id`)
   );
   ```

3. Rename `config.example.php` to `config.php` and configure the database connection details in the `config.php` file:

   ```
   define('DB_HOST', 'localhost');
   define('DB_USER', 'username');
   define('DB_PASS', 'password');
   define('DB_NAME', 'shorten_url');
   ```

   Replace `username` and `password` with your MySQL credentials.

4. Start your web server.

## Usage

The application provides two endpoints:

- `/encode` - Encodes a URL to a shortened URL
- `/decode` - Decodes a shortened URL to its original URL

Both endpoints return JSON responses.

### /encode

To encode a URL, make a POST request to the `/encode` endpoint with the long URL as the payload. For example:

```

{
  "long_url": "https://sommalife.com/impact/"
}
```

The endpoint will return a JSON response containing the short URL:

```

{
  "short_url": "http://shrt.est/ZeAK"
}
```

If the provided URL already exists in the database or no url is given, the endpoint will return an error response:

```

{
  "error": "Empty URL"
}
```

or

```

{
  "error": "URL already exists"
}
```

### /decode

To decode a shortened URL, make a POST request to the `/decode` endpoint with the short URL as input. For example:


```

The endpoint will return a JSON response containing the original URL:

```

{
  "long_url": "https://sommalife.com/impact/"
}
```

If the provided short URL is not found in the database, the endpoint will return an error message:

```

{
  "error": "Short URL not found"
}
```