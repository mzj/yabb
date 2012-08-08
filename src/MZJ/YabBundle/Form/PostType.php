<?php

namespace MZJ\YabBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('created_at')
            ->add('enabled', null, array('required' => false))
            ->add('commentsEnabled', null, array('required' => false))
            ->add('categories');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MZJ\YabBundle\Entity\Post'
        ));
    }

    public function getName()
    {
        return 'mzj_yabbundle_posttype';
    }
}
