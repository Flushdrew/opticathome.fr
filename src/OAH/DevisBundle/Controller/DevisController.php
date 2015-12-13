<?php

namespace OAH\DevisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\httpFoundation\Request;
use OAH\DevisBundle\Entity\Devis;
use OAH\DevisBundle\Form\DevisType;
use OAH\DevisBundle\Entity\Newsletter;
use OAH\DevisBundle\Form\NewsletterType;

class DevisController extends Controller
{


    public function DevisAction(Request $request)
  {
    $devis = new Devis();
    $form = $this->createForm(new DevisType(), $devis);

    $newsletter = new Newsletter();
      $formEmail = $this->createForm(new NewsletterType(), $newsletter);

      if ($formEmail->handleRequest($request)->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($newsletter);
      $em->flush();

      $request->getSession()->getFlashBag()->add('info', 'Vous êtes bien inscrit à la newsletter ');

      return $this->redirect($this->generateUrl('oah_core_homepage'));
    } 

    if ($form->handleRequest($request)->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($devis);
      $em->flush();

      $request->getSession()->getFlashBag()->add('info', 'Le devis a bien été envoyé !');

      

		$message = \Swift_Message::newInstance();
    $imgUrl = $message->attach(\Swift_Attachment::fromPath('http://img15.hostingpics.net/pics/419370oah.png')
                      ->setDisposition('inline'));
    $message->setSubject('Demande de devis bien reçue !')
        		->setFrom('guiardjulien@gmail.com')
        		->setTo($devis->getEmail())
        		->setBody(
        			$this->renderView(
        				'OAHDevisBundle:Devis:devis_email.html.twig',array('url'=>$imgUrl)
        				),
        			'text/plain'
        			);

      	$this->get('mailer')->send($message); 


      	$message = \Swift_Message::newInstance()
      		->setSubject('Nouvelle demande de devis')
      		->setFrom('guiardjulien@gmail.com')
      		->setTo('guiardjulien@gmail.com')
      		->setBody(
      			$this->renderView(
      				'OAHDevisBundle:Devis:devis_recu.html.twig'
      				),
      			'text/html'
      			);
      	$this->get('mailer')->send($message);

      
      return $this->redirect($this->generateUrl('oah_core_homepage'));
    }


    // Si on n'est pas en POST, alors on affiche le formulaire
    return $this->render('OAHCoreBundle:Core:layout.html.twig', array(
      'form' => $form->createView(),
      'formEmail' =>$formEmail->createView()
      ));
  }
}
