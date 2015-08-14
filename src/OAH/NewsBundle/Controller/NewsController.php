<?php

//src/OAH/NewsBundle/Controller/NewsController.php

namespace OAH\NewsBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\httpFoundation\Response;
use Symfony\Component\httpFoundation\Request;
use OAH\NewsBundle\Entity\Article;

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
	
	$articles = array(
	array(
		'titre'  => 'Comment bien mettre ses lentilles',
		'id'     => 1,
		'auteur' => 'OpticAtHome',
		'contenu'=> 'blablablablabla',
		'date'   => new \datetime()),
	array(
		'titre'  => 'Offres de Noel',
		'id'     => 2,
		'auteur' => 'OpticAtHome',
		'contenu'=> 'blablablablabla',
		'date'   => new \datetime()),
	array(
		'titre'  => 'Optic At Home , votre opticien à domicile',
		'id'     => 3,
		'auteur' => 'OpticAtHome',
		'contenu'=> 'blablablablabla',
		'date'   => new \datetime())
	
	);
    // Ici, on récupérera la liste des annonces, puis on la passera au template

    // Mais pour l'instant, on ne fait qu'appeler le template
    return $this->render('OAHNewsBundle:News:index.html.twig',array(
		'articles' => $articles));
  }

	public function voirAction($id)
	{
    // On récupere le repository
	$repository = $this->getDoctrine()
					   ->getManager()
					   ->getRepository('OAHNewsBundle:Article');

	// On récupere l'entité
	$article = $repository->find($id);
	
	if ($article === null)
	{
		throw $this->createNotFoundException('Article[id='.$id.'] inexistant.');
	}
	
    return $this->render('OAHNewsBundle:News:voir.html.twig', array(
      'article' => $article
    ));
  }
	
	 public function ajouterAction(Request $request)
  {
	//creation de l'entité
	$article = new Article();
	$article->setTitre('Nos nouvelles montures');
	$article->setauteur('OpticAtHome');
	$article->setContenu('blablablablabla');
	
	//on recupere l'entity manager
	$em = $this->getDoctrine()-getManager();
	
	//etape 1 : on persiste l'entité
	$em->persist($article);
	
	//etape 2 : on flush ce qui a été persisté avant
	$em->flush();  
  
  
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
			
		$article = array(
	'id' => 1,
	'titre' => 'Comment bien mettre ses lentilles',
	'auteur' => 'OpticAtHome',
	'contenu' => 'blablablablablablabla',
	'date' => new \Datetime()
	);	
		
		return $this->render('OAHNewsBundle:News:modifier.html.twig',array(
		'article' => $article 
		));
	}
		
		
	public function supprimerAction($id)
		{
			$article = array(
	'id' => 1,
	'titre' => 'Comment bien mettre ses lentilles',
	'auteur' => 'OpticAtHome',
	'contenu' => 'blablablablablablabla',
	'date' => new \Datetime()
							);	
		
		return $this->render('OAHNewsBundle:News:supprimer.html.twig',array(
		'article' => $article 
		));
		}
	
	
	
	
   
}