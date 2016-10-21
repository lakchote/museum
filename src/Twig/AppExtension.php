<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 21/10/2016
 * Time: 09:17
 */

namespace Twig;


use Symfony\Component\Intl\Intl;
use Locale;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return [
          new \Twig_SimpleFilter('countryName', [$this, 'countryCodeToName'])
        ];
    }
    public function getName()
    {
        return 'app_extension';
    }

    public function countryCodeToName($value)
    {
        return Intl::getRegionBundle()->getCountryName($value, 'fr');
    }
}