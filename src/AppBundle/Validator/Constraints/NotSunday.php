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
class NotSunday extends Constraint
{
    public $message = 'Vous ne pouvez réserver de billet le Dimanche.';

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}