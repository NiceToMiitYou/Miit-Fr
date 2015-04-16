<?php

namespace Miit\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class UserRegistrationType
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class UserRegistrationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', 'email');
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'        => 'Miit\AppBundle\Model\User',
            'validation_groups' => array('registration')
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'user_registration_type';
    }
}