<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 25/01/2017
 * Time: 15:42
 */

namespace AppBundle\Validator\Constraints;


use AppBundle\Entity\Commande;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class BilletJourneeValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /**
         * @var Commande $commande
         */
        $commande = $this->context->getRoot()->getData();
        $today = (new \DateTime())->format('Ymd');
        if($value == 'journee' && $commande->getDateVisite()->format('Ymd') == $today) {
            $currentHour = date('H');
            if($currentHour >= 14) {
                $this->context->buildViolation($constraint->message)->addViolation();
            }
        }
    }
}
