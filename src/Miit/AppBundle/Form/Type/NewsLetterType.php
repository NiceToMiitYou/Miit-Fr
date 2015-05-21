<?php

namespace Miit\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class NewsLetterType
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class NewsLetterType extends AbstractType
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
            'data_class'        => 'Miit\AppBundle\Model\NewsLetter',
            'validation_groups' => array('news_letter'),
            'csrf_protection'   => true,
            'csrf_field_name'   => '_token',
            'intention'         => 'news_letter',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'news_letter_type';
    }
}