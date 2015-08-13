<?php

//src/OAH/NewsBundle/Controller/NewsController.php

namespace OAH\NewsBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\httpFoundation\Response;
use Symfony\Component\httpFoundation\Request;

class NewsController extends Controller
{
	public function indexAction($page)
	{
    // On ne sait pas combien de pages il y a
    // Mais on sait qu'une page doit être supérieure ou égale à 1
    if ($page < 1) {
      // On déclenche une exception NotFoundHttpException, cela va afficher
      // une page d'erreur 404 (qu'on pourra personnaliser plus tard d'ailleurs)
      throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
    }

    // Ici, on récupérera la liste des annonces, puis on la passera au template

    // Mais pour l'instant, on ne fait qu'appeler le template
    return $this->render('OAHNewsBundle:News:index.html.twig');
  }

	public function voirAction($id)
	{
    // Ici, on récupérera l'annonce correspondante à l'id $id

    return $this->render('OAHNewsBundle:News:voir.html.twig', array(
      'id' => $id
    ));
  }
	
	 public function ajouterAction(Request $request)
  {
  
	if ($request->isMethod('POST')){
		$request->getSession()->getFlashBag()->add('info','Annonce bien enregistré.');
		return $this->redirect($this->generateUrl('OAHNews_voir',array('id' => 5)));
		}
	return $this->render('OAHNewsBundle:News:ajouter.html.twig');
  }
  
	public function modifierAction($id, Request $request)
	{
	
		if ($request->isMethod('POST')){
			$request->getSession()->getFlashBag()->add('info','Annonce bien modifiée.');
			return $this->redirect($this->generateUrl('OAHNews_voir',array('id' => 5 )));
			}
		
		return $this->render('OAHNewsBundle:News:modifier.html.twig');
		}
	public function supprimerAction($id)
		{
		
		
		return $this->render('OAHNewsBundle:News:supprimer.html.twig');
		}
	
	
	
	
   
}