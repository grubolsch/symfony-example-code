<?php


namespace App\Service;


class Config
{
    private string $configfile;

    public function __construct(string $configfile)
    {
        $this->configfile = $configfile;
    }
}