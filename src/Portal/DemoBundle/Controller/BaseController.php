<?php
namespace Portal\DemoBundle\Controller;

use \Closure;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;

class BaseController extends Controller
{
    /**
     * @param string $path
     * @param array $parameters
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createSuccessRedirectResponse($path, array $parameters = array() )
    {
        return $this->redirect($this->generateUrl($path, $parameters) );
    }

    /**
     * @param Form $form
     * @param Closure $successCallback
     * @param Closure $failureFallback
     * @return mixed
     */
    public function processForm(Form $form, Closure $successCallback, Closure $failureFallback = null)
    {
        $form->bind($this->getRequest() );

        return $form->isValid() ? $successCallback($form) : $failureFallback($form);
    }
}
