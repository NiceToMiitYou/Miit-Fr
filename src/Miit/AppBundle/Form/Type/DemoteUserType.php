<?php
namespace Miit\AppBundle\Form\Type;

use Miit\CoreDomain\Team\Team;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class DemoteUserType
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class DemoteUserType extends AbstractType
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
            'data_class'        => 'Miit\AppBundle\Model\DemoteUser',
            'validation_groups' => array('demote_user'),
            'csrf_protection'   => true,
            'csrf_field_name'   => '_token',
            'intention'         => 'demote_user',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'demote_user_type';
    }
}