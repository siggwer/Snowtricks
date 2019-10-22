<?php

namespace App\Services;

/**
 * Class Token
 *
 * @package App\Services
 */
class Token
{
    /**
     * @return string
     */
    public function generate(): string
    {
        return md5(uniqid('', true));
    }
}