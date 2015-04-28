<?php
namespace Miit\AppBundle\Form\Type;

use Miit\CoreDomain\Team\Team;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class PromoteUserType
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class PromoteUserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('roles', 'choice', array(
            'choices'   => Team::getAllowedRoles(),
            'multiple'  => true,
            'required'  => true
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'        => 'Miit\AppBundle\Model\User',
            'validation_groups' => array('promote_user'),
            'csrf_protection'   => true,
            'csrf_field_name'   => '_token',
            'intention'         => 'promote_user',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'promote_user_type';
    }
}