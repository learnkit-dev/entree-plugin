<?php namespace LearnKit\Entree\Classes;

use OneLogin\Saml2\Auth;
use OneLogin\Saml2\Error;
use OneLogin\Saml2\ValidationError;
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

    public function processResponse(): self
    {
        try {
            $this->auth->processResponse();
        } catch (Error $e) {
        } catch (ValidationError $e) {
        }

        return $this;
    }

    public function getAttributes() : array
    {
        return $this->auth->getAttributes();
    }
}