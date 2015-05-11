<?php

namespace Miit\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class UserUpdateType
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class UserUpdateType extends AbstractType
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
            'data_class'        => 'Miit\AppBundle\Model\User',
            'validation_groups' => array('update'),
            'csrf_protection'   => true,
            'csrf_field_name'   => '_token',
            'intention'         => 'update',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'user_update_type';
    }
}