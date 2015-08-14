<?php
// src/OAH/NewsBundle/DataFixtures/ORM/Categories.php

namespace OAH\NewsBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OAH\NewsBundle\Entity\Categorie;

class Categories implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    // Liste des noms de catégorie à ajouter
    $noms = array(
      'Promotions',
      'Optic At Home',
      'Conseils',
      'Garanties',
      'FAQ'
    );

    foreach ($noms as $i => $nom) 
	{
      // On crée la catégorie
      $liste_categories[$i] = new Categorie();
      $liste_categories[$i]->setNom($nom);

      // On la persiste
      $manager->persist($liste_categories[$i]);
    }

    // On déclenche l'enregistrement de toutes les catégories
    $manager->flush();
  }
}