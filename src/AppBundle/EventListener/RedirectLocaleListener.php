<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 03/11/2016
 * Time: 23:32
 */

namespace AppBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RedirectLocaleListener
{
    private $defaultLocale;
    private $supportedLocales;

    public function __construct($defaultLocale, array $supportedLocales)
    {
        $this->defaultLocale = $defaultLocale;
        $this->supportedLocales = $supportedLocales;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        if ($request->getPathInfo() == '/') {
            $locale = substr($request->getPreferredLanguage(), 0, 2);
            if (!in_array($locale, $this->supportedLocales)) {
                $locale = $this->defaultLocale;
            }
            return $event->setResponse(new RedirectResponse('/' . $locale));
        }
    }
}