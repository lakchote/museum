<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 14/06/2017
 * Time: 15:18
 */

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ReducedPrice extends Constraint
{
    public $message = 'billets.tarif_reduit.not_valid';
}
