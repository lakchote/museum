<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 19/10/2016
 * Time: 22:59
 */

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;

class NotMaxCapacityValidator extends ConstraintValidator
{
    private $em;
    private $capaciteMax;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->capaciteMax = 1000;
    }

    public function validate($value, Constraint $constraint)
    {
        $nbBilletsVendus = $this->em->getRepository('AppBundle:Billet')->checkMaxCapacity($value);
        if(count($nbBilletsVendus) == $this->capaciteMax)
        {
            $date = $value->format('Y-m-d');
            $this->context->buildViolation($constraint->message)
                ->setParameter('%jour%', $date)
                ->setParameter('%billets%', $this->capaciteMax)
                ->addViolation();
        }
    }
}