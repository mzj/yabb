<?php

/*
 * This file is part of the Yabb package.
 *
 * (c) Marko Jovanovic <markozjovanovic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MZJ\YabBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * MZJ\YabBundle\Form\PostType
 *
 * Post form type
 *
 * @author Marko Jovanovic <markozjovanovic@gmail.com>
 */
class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('created_at')
        ;
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
