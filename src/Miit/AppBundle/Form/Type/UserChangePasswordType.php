<?php

namespace Miit\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class UserChangePasswordType
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class UserChangePasswordType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('password', 'repeated', array(
            'type'           => 'password',
            'first_options'  => array('label' => 'Mot de passe'),
            'second_options' => array('label' => 'Mot de passe (validation)'),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'        => 'Miit\AppBundle\Model\User',
            'validation_groups' => array('change_password'),
            'csrf_protection'   => true,
            'csrf_field_name'   => '_token',
            'intention'         => 'change_password',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'user_change_password_type';
    }
}