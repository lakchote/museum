<?php

namespace AppBundle\Validator\Constraints;

use AppBundle\Entity\Billet;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ReducedPriceValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        if(!$value) return;
        /**
         * @var Billet $billet
         */
        $billet = $this->context->getObject();
        $interval = (new \DateTime())->diff($billet->getDateNaissance());
        if($interval->format('%Y') <= 12 ) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
