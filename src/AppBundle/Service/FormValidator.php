<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 17/10/2016
 * Time: 09:08
 */

namespace AppBundle\Service;


use AppBundle\Form\CommandeModel;

class FormValidator
{
    private $commande_model;
    private $isEmailCorrect = true;
    private $isDateCorrect = true;

    /**
     * @param CommandeModel $commande_model
     */
    public function init(CommandeModel $commande_model)
    {
        $this->commande_model = $commande_model;
    }

    /**
     * @return bool
     */
    public function checkEmail()
    {
        if ($this->commande_model->getEmailVisiteur() !== $this->commande_model->getSecondEmail()) {
            $this->isEmailCorrect = false;
        }

        return $this->isEmailCorrect;
    }

    /**
     * @return bool|string
     */
    public function checkDate()
    {

        $jours = ['11-01', '25-12', '05-01'];
        $date = new \DateTime('- 1 days');
        $date_utilisateur = $this->commande_model->getDateVisite();
        $weekDay = $date_utilisateur->format('w');

        if ($date_utilisateur < $date) {
            $this->isDateCorrect = false;
        } else if (in_array($date_utilisateur->format('m-d'), $jours)) {
            $this->isDateCorrect = 'Jour_ferie';
        } else if ($weekDay == 0 || $weekDay == 2) {
            $this->isDateCorrect = 'Bad_day';
        }

        return $this->isDateCorrect;
    }
}