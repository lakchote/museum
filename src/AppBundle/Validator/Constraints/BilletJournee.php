<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 25/01/2017
 * Time: 15:38
 */

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class BilletJournee extends Constraint
{
    public $message = 'commande.date_visite.past_14_hours';

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }

}