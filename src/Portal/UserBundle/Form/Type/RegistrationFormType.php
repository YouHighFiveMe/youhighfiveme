<?php

namespace Portal\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    protected $translator;
    
    public function __construct($userClass, $translator) {
        parent::__construct($userClass);
        $this->translator = $translator;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', null, array('label' => $this->translator->trans('form.realname')));
        $builder->add('email', null, array('label' => $this->translator->trans('form.email')));
        $builder->add('gravatar', null, array('label' => $this->translator->trans('form.gravatar'), 'required' => false));
        parent::buildForm($builder, $options);
    }

    public function getName()
    {
        return 'portal_user_registration';
    }
}