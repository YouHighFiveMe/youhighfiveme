<?php

namespace Portal\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('isPublic', null, array('label' => 'Anyone can see this event', 'required' => false))
            ->add('tags');
        ;
    }

    public function getName()
    {
        return 'portal_appbundle_eventtype';
    }
}
