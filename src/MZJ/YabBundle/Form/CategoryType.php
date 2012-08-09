<?php

namespace MZJ\YabBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('parent', 'entity',  
                        array(
                            'property' => 'indentedName',
                            'class' => 'MZJYabBundle:Category',
                            'query_builder' => function($er)
                                {
                                    return $er->createQueryBuilder('c')->orderBy('c.lft', 'ASC');
                                },
                             'multiple' => false
                        ))
            ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MZJ\YabBundle\Entity\Category'
        ));
    }

    public function getName()
    {
        return 'mzj_yabbundle_categorytype';
    }
}
