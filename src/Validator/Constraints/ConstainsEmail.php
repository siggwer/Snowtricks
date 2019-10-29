<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class ConstainsEmail.
 *
 *
 * @Annotation
 */
class ConstainsEmail extends Constraint
{
    /**
     * @var string
     */
    public $message = 'Cet email "{{ email }}" n\'existe pas !';
}
