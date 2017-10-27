<?php

namespace PL\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PLUserBundle extends Bundle
{
  public function getParent()
 {
   return 'FOSUserBundle';
 }
}
