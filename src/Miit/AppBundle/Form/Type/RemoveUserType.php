<?php
namespace Miit\AppBundle\Form\Type;

use Miit\AppBundle\Model\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class RemoveUserType
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class RemoveUserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'text');
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'        => 'Miit\AppBundle\Model\User',
            'validation_groups' => array('remove_user'),
            'csrf_protection'   => true,
            'csrf_field_name'   => '_token',
            'intention'         => 'remove_user',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'remove_user_type';
    }
}