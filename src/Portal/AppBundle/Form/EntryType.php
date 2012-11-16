<?php

namespace Portal\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EntryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('comments')
            ->add('tags')
        ;
    }

    public function getName()
    {
        return 'portal_appbundle_entrytype';
    }
}
