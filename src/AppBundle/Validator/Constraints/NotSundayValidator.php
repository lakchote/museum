<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 19/10/2016
 * Time: 22:18
 */

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


class NotSundayValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if ($value === null) {
            return;
        }
        $day = $value->format('w');
        if($day == 0)
        {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
