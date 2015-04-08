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
        $builder->add('username', 'text');
        
        $builder->add('email',    'email');

        $builder->add('password', 'repeated', array(
            'type' => 'password',
            'invalid_message' => 'Les mots de passe doivent correspondre',
            'options' => array('required' => true),
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