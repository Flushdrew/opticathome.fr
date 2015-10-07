<?php

namespace OAH\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="OAH\NewsBundle\Entity\ArticleRepository")
 */
class Article
{
	/**
	 *
	 * @ORM\OneToOne(targetEntity="OAH\NewsBundle\Entity\Image", cascade={"persist", "remove"})
	 */
	private $image;	
	
	/**
	 * @ORM\ManyToMany(targetEntity="OAH\NewsBundle\Entity\Categorie", cascade={"persist"})
	 */
	 private $categories;
	 
	/**
	 * @ORM\OneToMany(targetEntity="OAH\NewsBundle\Entity\Commentaire", mappedBy="article")
	 */
	 private $commentaires;
	
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=80)
     */
    private $auteur;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;
	
	/**
	 * @ORM\Column(name="publication", type="boolean")
	 */
	 private $publication;

     /**
     * @Gedmo\Slug(fields={"titre"})
     * @ORM\Column(length=255)
     */
    private $slugarticle;


	
	public function __construct()
	{
		$this->date = new \Datetime();
		$this->publication = true;
		$this->categories = new \Doctrine\Common\Collections\ArrayCollection();
		$this->commentaires = new \Doctrine\Common\Collections\ArrayCollection();
	}
	
	
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Article
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Article
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     *
     * @return Article
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Article
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set publication
     *
     * @param boolean $publication
     *
     * @return Article
     */
    public function setPublication($publication)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return boolean
     */
    public function getPublication()
    {
        return $this->publication;
    }

	/**
	 * @param OAH\NewsBundle\Entity\Image $image
	 */
	 public function setImage(\OAH\NewsBundle\entity\Image $image = null)
	 {
		 $this->image = $image;
	 }
	 
	 /**
	  * @return OAH\NewsBundle\Entity\Image
	  */
	 public function getImage()
	 {
		 return $this->image;
	 }
	
    /**
     * Add category
     *
     * @param \OAH\NewsBundle\Entity\Categorie $category
     *
     * @return Article
     */
    public function addCategory(\OAH\NewsBundle\Entity\Categorie $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \OAH\NewsBundle\Entity\Categorie $category
     */
    public function removeCategory(\OAH\NewsBundle\Entity\Categorie $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add commentaire
     *
     * @param \OAH\NewsBundle\Entity\Commentaire $commentaire
     *
     * @return Article
     */
    public function addCommentaire(\OAH\NewsBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaires[] = $commentaire;
		$commentaire->setArticle($this); //car la relation est bidirectionnelle !!!
        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param \OAH\NewsBundle\Entity\Commentaire $commentaire
     */
    public function removeCommentaire(\OAH\NewsBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaires->removeElement($commentaire);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }



    /**
     * Set slugarticle
     *
     * @param string $slugarticle
     *
     * @return Article
     */
    public function setSlugarticle($slugarticle)
    {
        $this->slugarticle = $slugarticle;

        return $this;
    }

    /**
     * Get slugarticle
     *
     * @return string
     */
    public function getSlugarticle()
    {
        return $this->slugarticle;
    }
}
