<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class ConstainsEmail
 *
 * @package App\Validator\Constraints
 *
 * @Annotation
 */
class ConstainsEmail extends Constraint
{
    /**
     * @var string
     */
    public $message = 'Cet email "{{ string }}" contient des caractères illégaux: il ne doit contenir que des lettres, desz chiffres et un @mon-domain.fr';
}