<?php

namespace App\Service;

class FileLogger {
    public function __construct(FileLoader $fileLoader, Config $config)
    {

    }
}

class DatabaseConnection {
    public function __construct(Config $config)
    {

    }
}

class PriceCalculator
{
    private DatabaseLogger $logger;

    /**
     * PriceCalculator constructor.
     * @param Logger $logger
     */
    public function __construct(DatabaseLogger $logger)
    {
        $this->logger = $logger;
    }

    public function log()
    {
        echo 'log';
    }
}