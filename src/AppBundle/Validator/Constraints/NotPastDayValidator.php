<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 19/10/2016
 * Time: 21:56
 */

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NotPastDayValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if ($value == null) {
            return;
        }
            $today = new \DateTime();
            $todayFormat = $today->format('Y-m-d');
            $dateUtilisateur = $value->format('Y-m-d');
            if($dateUtilisateur < $todayFormat)
            {
                $this->context->buildViolation($constraint->message)->addViolation();
            }
    }
}