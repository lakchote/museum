<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 21/10/2016
 * Time: 09:17
 */

namespace Twig;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Intl\Intl;

class AppExtension extends \Twig_Extension
{
    public function getFilters() {
        return [
          new \Twig_SimpleFilter('countryName', [$this, 'countryCodeToName'])
        ];
    }

    public function getFunctions() {
        return [
            new \Twig_SimpleFunction('getCurrentURLWithLocale', [$this, 'getCurrentURLWithLocale'])
        ];
    }

    public function countryCodeToName($value, $locale) {
        return Intl::getRegionBundle()->getCountryName($value, $locale);
    }

    public function getCurrentURLWithLocale($locale, Request $request) {
        $pathInfo = $request->getPathInfo();
        $scheme = $request->getSchemeAndHttpHost();
        return  ($pathInfo == '/fr' || $pathInfo == '/en') ? $scheme . '/' . $locale : $scheme . '/' . $locale . substr($pathInfo,3);
    }
}
