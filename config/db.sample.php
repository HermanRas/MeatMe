<?php
    // OWOZ
    $siteCode = 'TSTSTE0001';
    $privateKey = '215114531AFF7134A94C88CEEA48E';
    $apiKey = 'EB5758F2C3B4DF3FF4F2669D5FF5B';

    // DB
    $dsn = "sqlite:"."db/Store.sqlite3";
    try {
        $pdo = new PDO($dsn);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
        echo 'DB_CONNECTION ERROR !';
    }

?>