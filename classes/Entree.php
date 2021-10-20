<?php

namespace LearnKit\Entree\Classes;

use OneLogin\Saml2\Auth;
use October\Rain\Support\Traits\Singleton;

class Entree
{
    use Singleton;

    public function init()
    {
        $this->auth = new Auth();
    }

    public function login()
    {
        return $this->auth->login();
    }
}