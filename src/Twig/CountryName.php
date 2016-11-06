<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 21/10/2016
 * Time: 09:17
 */

namespace Twig;


use Symfony\Component\Intl\Intl;

class CountryName extends \Twig_Extension
{
    public function getFilters()
    {
        return [
          new \Twig_SimpleFilter('countryName', [$this, 'countryCodeToName'])
        ];
    }
    public function getName()
    {
        return 'twig_countryname';
    }

    public function countryCodeToName($value, $locale)
    {
        return Intl::getRegionBundle()->getCountryName($value, $locale);
    }
}
