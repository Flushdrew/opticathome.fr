<?php

//src/OAH/NewsBundle/Controller/NewsController.php

namespace OAH\NewsBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\httpFoundation\Response;
use Symfony\Component\httpFoundation\Request;
use OAH\NewsBundle\Entity\Article;
use OAH\NewsBundle\Entity\Image;
use OAH\NewsBundle\Entity\Commentaire;
use OAH\NewsBundle\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class NewsController extends Controller
{
	public function indexAction($page)
	{
    
    if ($page < 1) {
      throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
    }
	
	$nbPerPage = 5;
	
	$listArticles = $this->getDoctrine()
		->getManager()
		->getRepository('OAHNewsBundle:Article')
		->getArticles($page, $nbPerPage)	
	;	
    
	$nbPages = ceil(count($listArticles)/$nbPerPage);
	
	if ($page > $nbPages) {
		throw $this->createNotFoundException("La page ".$page." n'existe pas.");
		}
	
	
    return $this->render('OAHNewsBundle:News:index.html.twig',array(
		'listArticles' => $listArticles,
		'nbPages'      => $nbPages,
		'page'         => $page
	));
  }


  /**
 * @ParamConverter("article", options={"mapping": {"slugarticle": "slugarticle"}})
 */
	public function voirAction(Article $article, $slugarticle)
	{
    // On récupere l'entityManager
	
	
	// On récupere la liste des commentaires
	//$liste_commentaires = $em->getRepository('OAHNewsBundle:Commentaire')
							 //->findAll();
	
    return $this->render('OAHNewsBundle:News:voir.html.twig', array(
      'article' => $article//,
	  //'liste_commentaires' => $liste_commentaires
    ));
  }
	
	 public function ajouterAction(Request $request)
  {
    $article = new Article();
    $form = $this->createForm(new ArticleType(), $article);

    if ($form->handleRequest($request)->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($article);
      $em->flush();

      $request->getSession()->getFlashBag()->add('info', 'Annonce bien enregistrée.');

      // Puis on redirige vers la page de visualisation de cet article
      return $this->redirect($this->generateUrl('OAHNews_voir', array('slugarticle' => $article->getSlugarticle())));
    }

    // Si on n'est pas en POST, alors on affiche le formulaire
    return $this->render('OAHNewsBundle:News:ajouter.html.twig', array(
      'form' => $form->createView(),
      ));
  }
  
	public function modifierAction($id, Request $request)
	{
    // On récupère l'EntityManager
    $em = $this->getDoctrine()->getManager();

    // On récupère l'entité correspondant à l'id $id
    $article = $em->getRepository('OAHNewsBundle:Article')->find($id);

    // Si l'annonce n'existe pas, on affiche une erreur 404
    if ($article == null) {
      throw $this->createNotFoundException("L'annonce d'id ".$id." n'existe pas.");
    }

    $form = $this->createForm(new ArticleEditType(), $article);

    if ($form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

      return $this->redirect($this->generateUrl('OAHNews_voir', array('id' => $article->getId())));
    }

    return $this->render('OAHNewsBundle:News:modifier.html.twig', array(
      'form'    => $form->createView(),
      'article' => $article
    ));
  }

		
		
	public function supprimerAction($id, Request $request)
		{
    // On récupère l'EntityManager
    $em = $this->getDoctrine()->getManager();

    // On récupère l'entité correspondant à l'id $id
    $article = $em->getRepository('OAHNewsBundle:Article')->find($id);

    // Si l'annonce n'existe pas, on affiche une erreur 404
    if ($article == null) {
      throw $this->createNotFoundException("L'annonce d'id ".$id." n'existe pas.");
    }
    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->createFormBuilder()->getForm();

    if ($form->handleRequest($request)->isValid()) {
      $em->remove($article);
      $em->flush();

      $request->getSession()->getFlashBag()->add('info', 'Annonce bien supprimée.');

      // Puis on redirige vers l'accueil
      return $this->redirect($this->generateUrl('OAHNews_accueil'));
    }

    // Si la requête est en GET, on affiche une page de confirmation avant de delete
    return $this->render('OAHNewsBundle:News:supprimer.html.twig', array(
      'article' => $article,
      'form'    => $form->createView()
    ));
  }
	
	public function menuAction()
  {
    $listCategories = $this->getDoctrine()
      ->getManager()
      ->getRepository('OAHNewsBundle:Categorie')
      ->findAll();

    return $this->render('OAHNewsBundle:News:menu.html.twig', array(
      'listCategories' => $listCategories
    ));
  }

  public function categorieAction($slug,$page)
  //{
    //$listArticles = $this->getDoctrine()
    //->getManager()
    //->getRepository('OAHNewsBundle:Article')
    //->getAvecCategories() ; 
  
    //return $this->render('OAHNewsBundle:News:categorie.html.twig',array(
    //'listArticles' => $listArticles,
    //));

  //}
{
    
    if ($page < 1) {
      throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
    }
  
  $nbPerPage = 5;
  
  $listArticles = $this->getDoctrine()
    ->getManager()
    ->getRepository('OAHNewsBundle:Article')
    ->getAvecCategories($slug, $page, $nbPerPage)  
  ; 
    
  $nbPages = ceil(count($listArticles)/$nbPerPage);
  
  if ($page > $nbPages) {
    throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }
  
  
    return $this->render('OAHNewsBundle:News:categorie.html.twig',array(
    'listArticles' => $listArticles,
    'nbPages'      => $nbPages,
    'page'         => $page
  ));
  }
	
	
   
}