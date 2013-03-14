<?php

namespace Portal\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class QuickHighfiveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('author', null,
            array('label'     => 'Your name',
                   'required' => false)
        );
        $builder->add('comment');
    }

    public function getName()
    {
        return 'portal_appbundle_quickhighfivetype';
    }
}

