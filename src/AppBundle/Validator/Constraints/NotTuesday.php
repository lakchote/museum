<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 19/10/2016
 * Time: 22:17
 */

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotTuesday extends Constraint
{
    public $message = 'commande.date_visite.not_tuesday';

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}