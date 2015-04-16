<?php
namespace Miit\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class RegistrationType
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class RegistrationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('user', 'user_registration_type');

        $builder->add('team', 'team_registration_type');

        $builder->add('terms', 'checkbox', array(
            'property_path' => 'termsAccepted'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'        => 'Miit\AppBundle\Model\Registration',
            'validation_groups' => array('registration'),
            'csrf_protection'   => true,
            'csrf_field_name'   => '_token',
            'intention'         => 'registration',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'registration_type';
    }
}