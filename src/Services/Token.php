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
    static public function generateToken(): string
    {
        return md5(uniqid('', true));
    }
}