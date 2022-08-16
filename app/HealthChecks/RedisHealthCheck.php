<?php

namespace App\HealthChecks;

use UKFast\HealthCheck\HealthCheck;

class RedisHealthCheck extends HealthCheck
{
    protected $name = 'redis';

    public function status()
    {
        return $this->okay();
    }
}
