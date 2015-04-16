<?php

namespace Miit\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class TeamRegistrationType
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class TeamRegistrationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text');
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'        => 'Miit\AppBundle\Model\Team',
            'validation_groups' => array('registration')
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'team_registration_type';
    }
}