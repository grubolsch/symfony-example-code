<?php


namespace App\Service;

class DatabaseLogger
{
    private Config $config;

    /**
     * DatabaseLogger constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }


}