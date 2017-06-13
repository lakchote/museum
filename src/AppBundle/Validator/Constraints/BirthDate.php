<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class BirthDate extends Constraint
{
    public $message = 'billets.date_naissance.not_valid';
}
