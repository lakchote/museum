<?php

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class BirthDateValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $today = new \DateTime();
        $yearAsOfToday = $today->format('Y');
        $yearOfBirth = $value->format('Y');
        if($yearOfBirth > $yearAsOfToday) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
