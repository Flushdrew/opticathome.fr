<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/News')) {
            // OAHNews_accueil
            if (preg_match('#^/News(?:/(?P<page>\\d*))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'OAHNews_accueil')), array (  '_controller' => 'OAH\\NewsBundle\\Controller\\NewsController::indexAction',  'page' => 1,));
            }

            if (0 === strpos($pathinfo, '/News/a')) {
                // OAHNews_voir
                if (0 === strpos($pathinfo, '/News/article') && preg_match('#^/News/article/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'OAHNews_voir')), array (  '_controller' => 'OAH\\NewsBundle\\Controller\\NewsController::voirAction',));
                }

                // OAHNews_ajouter
                if ($pathinfo === '/News/ajouter') {
                    return array (  '_controller' => 'OAH\\NewsBundle\\Controller\\NewsController::ajouterAction',  '_route' => 'OAHNews_ajouter',);
                }

            }

            // OAHNews_modifier
            if (0 === strpos($pathinfo, '/News/modifier') && preg_match('#^/News/modifier/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'OAHNews_modifier')), array (  '_controller' => 'OAH\\NewsBundle\\Controller\\NewsController::modifierAction',));
            }

            // OAHNews_supprimer
            if (0 === strpos($pathinfo, '/News/supprimer') && preg_match('#^/News/supprimer/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'OAHNews_supprimer')), array (  '_controller' => 'OAH\\NewsBundle\\Controller\\NewsController::supprimerAction',));
            }

        }

        // oah_core_homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'oah_core_homepage');
            }

            return array (  '_controller' => 'OAH\\CoreBundle\\Controller\\CoreController::indexAction',  '_route' => 'oah_core_homepage',);
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
