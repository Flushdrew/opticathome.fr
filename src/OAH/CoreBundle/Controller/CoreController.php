<?php

namespace OAH\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
    public function indexAction()
    {
        return $this->render('OAHCoreBundle:Core:Layout.html.twig');
    }

    public function presseAction()
    {
    	return $this->render('OAHCoreBundle:Core:presse.html.twig');
    }
}
