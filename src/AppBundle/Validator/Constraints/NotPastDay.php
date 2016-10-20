<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 19/10/2016
 * Time: 21:55
 */

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotPastDay extends Constraint
{
    public $message = 'Vous ne pouvez réserver un billet pour un jour passé.';

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}