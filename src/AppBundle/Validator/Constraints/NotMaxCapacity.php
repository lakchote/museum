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
    public $message = 'La capacité du musée pour le "%jour%" a été dépassée (%billets% billets vendus).';

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}