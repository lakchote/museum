<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 25/01/2017
 * Time: 15:42
 */

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class BilletJourneeValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if($value == 'journee') {
            $currentHour = date('H');
            if($currentHour >= 14) {
                $this->context->buildViolation($constraint->message)->addViolation();
            }
        }
    }
}