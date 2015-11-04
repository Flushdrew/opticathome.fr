<?php

namespace OAH\DevisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\httpFoundation\Request;
use OAH\DevisBundle\Entity\Devis;
use OAH\DevisBundle\Form\DevisType;

class DevisController extends Controller
{
    public function DevisAction(Request $request)
  {
    $devis = new Devis();
    $form = $this->createForm(new DevisType(), $devis);

    if ($form->handleRequest($request)->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($devis);
      $em->flush();

      $request->getSession()->getFlashBag()->add('info', 'Le devis a bien été envoyé !');

      

		$message = \Swift_Message::newInstance()
      		->setSubject('Demande de devis bien reçue !')
      		->setFrom('guiardjulien@gmail.com')
      		->setTo($devis->getEmail())
      		->setBody(
      			$this->renderView(
      				'OAHDevisBundle:Devis:devis_email.html.twig', $image_src
      				),
      			'text/html'
      			);

      	$this->get('mailer')->send($message); 

$image_src = $message->embed(\Swift_Image::fromPath('logo.jpg'));

      	$message = \Swift_Message::newInstance()
      		->setSubject('Nouvelle demande de devis')
      		->setFrom('guiardjulien@gmail.com')
      		->setTo('guiardjulien@gmail.com')
      		->setBody(
      			$this->renderView(
      				'OAHDevisBundle:Devis:devis_recu.html.twig', $image_src
      				),
      			'text/html'
      			);
      	$this->get('mailer')->send($message);

      
      return $this->redirect($this->generateUrl('oah_core_homepage'));
    }


    // Si on n'est pas en POST, alors on affiche le formulaire
    return $this->render('OAHCoreBundle:Core:layout.html.twig', array(
      'form' => $form->createView(),
      ));
  }
}
