<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 19/10/2016
 * Time: 22:11
 */

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NotHolidayValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if ($value === null) {
            return;
        }
        $joursFeries = ['05-01', '11-01', '12-25'];
        $dateUtilisateur = $value->format('m-d');

        if (in_array($dateUtilisateur, $joursFeries)) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
