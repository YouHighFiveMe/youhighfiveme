<?php

namespace Portal\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class HighfiveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('comment');
    }

    public function getName()
    {
        return 'portal_appbundle_highfivetype';
    }
}

