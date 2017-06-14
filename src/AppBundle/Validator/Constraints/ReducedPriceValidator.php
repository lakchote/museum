<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 14/06/2017
 * Time: 15:18
 */

namespace AppBundle\Validator\Constraints;


use AppBundle\Entity\Commande;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ReducedPriceValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        /**
         * @var Commande $commande
         */
        $commande = $this->context->getRoot()->getData();
        $currentYear = (new \DateTime())->format('Y');
        foreach($commande->getBillets() as $billet) {
            if ($billet->getDateNaissance() > $currentYear && $billet->isTarifReduit()) {
                $this->context->buildViolation($constraint->message)->addViolation();
            }
        }
    }
}
