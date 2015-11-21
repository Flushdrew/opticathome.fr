<?php

namespace OAH\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilder;

class ArticleEditType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('date');
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return 'oah_newsbundle_article_modifier';
    }

    public function getParent()
  {
    return new ArticleType();
  }

}