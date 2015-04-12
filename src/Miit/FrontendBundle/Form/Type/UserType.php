<?php

namespace Miit\FrontendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class UserType
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email',    'email');
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Miit\FrontendBundle\Model\User',
            'validation_groups' => array('registration')
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'user_type';
    }
}