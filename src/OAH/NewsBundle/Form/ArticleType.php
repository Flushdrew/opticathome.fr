<?php

namespace OAH\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date',        'date')
            ->add('titre',       'text' )
            ->add('auteur',      'text')
            ->add('contenu',     'textarea')
            ->add('image',        new ImageType())
            ->add('categories','entity', array(
                'class'         => 'OAHNewsBundle:Categorie',
                'property'    => 'nom',
                'multiple'    => true,
                'expanded' => true,
            ))
            ->add('save',        'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OAH\NewsBundle\Entity\Article'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'oah_newsbundle_article';
    }
}
