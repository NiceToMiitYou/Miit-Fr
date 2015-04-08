<?php
namespace Miit\FrontendBundle\Form\Type;

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
        $builder->add('user', 'user_type');

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
            'data_class'        => 'Miit\FrontendBundle\Model\Registration',
            'validation_groups' => array('registration'),
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