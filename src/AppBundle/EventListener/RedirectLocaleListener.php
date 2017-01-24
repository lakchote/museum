<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 03/11/2016
 * Time: 23:32
 */

namespace AppBundle\EventListener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class RedirectLocaleListener
{
    private $defaultLocale;
    private $supportedLocales;
    private $router;

    public function __construct($defaultLocale, array $supportedLocales, Router $router)
    {
        $this->defaultLocale = $defaultLocale;
        $this->supportedLocales = $supportedLocales;
        $this->router = $router;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        if ($request->getPathInfo() == '/') {
            $locale = substr($request->getPreferredLanguage(), 0, 2);
            if (!in_array($locale, $this->supportedLocales)) {
                $locale = $this->defaultLocale;
            }
            if ($request->getPathInfo() == '/') {
                return $event->setResponse(new RedirectResponse($this->router->generate('app_homepage', ['_locale' => $locale])));
            }
        }
    }
}
