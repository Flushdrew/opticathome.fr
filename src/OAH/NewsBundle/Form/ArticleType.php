<?php

namespace OAH\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormBuilder;
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
            ->add('date',        'date' , array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'attr' => array(
                        'class' => 'form-control input-inline datepicker',
                        'class' => 'datepicker',
                        'data-provide' => 'datepicker',
                        'data-date-format' => 'dd-mm-yyyy')
                    ))

            ->add('titre',       'text' , array(
                    'attr' => array(
                    'placeholder' => 'Titre',
                    )) )
            ->add('auteur',      'text' , array(
                    'attr' => array(
                    'placeholder' => 'Auteur',
    )))
            ->add('contenu',     'ckeditor')
            ->add('image',        new ImageType())
            ->add('categories','entity', array(
                'class'         => 'OAHNewsBundle:Categorie',
                'property'    => 'nom',
                'multiple'    => true,
                'expanded' => true,
            ))
            ->add('enregistrer',     'submit',array( 
                'attr'=> array(
                'class'=>'pull-right btn btn-custom2')))
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
