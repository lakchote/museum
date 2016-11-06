<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 19/10/2016
 * Time: 22:59
 */

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotMaxCapacity extends Constraint
{
    public $message = 'commande.date_visite.not_max_capacity';

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}
