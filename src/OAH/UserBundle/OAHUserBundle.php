<?php

namespace OAH\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class OAHUserBundle extends Bundle
{
	public function getParent()
  {
    return 'FOSUserBundle';
  }
}
