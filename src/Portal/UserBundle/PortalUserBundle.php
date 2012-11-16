<?php

namespace Portal\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PortalUserBundle extends Bundle
{
    public function getParent()
    {
        return "FOSUserBundle";
    }
}
