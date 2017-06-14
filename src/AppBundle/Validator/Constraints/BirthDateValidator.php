<?php

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class BirthDateValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if(!$value) return;
        $currentYear = (new \DateTime())->format('Y');
        $yearOfBirth = $value->format('Y');
        if($yearOfBirth > $currentYear) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
