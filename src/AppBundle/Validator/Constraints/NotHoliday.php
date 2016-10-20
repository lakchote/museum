<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 19/10/2016
 * Time: 22:11
 */

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotHoliday extends Constraint
{
    public $message = "Vous ne pouvez réserver de billet lorsque c'est un jour férié.";

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}