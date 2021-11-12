<?php namespace LearnKit\Entree\Http\Controllers;

use Auth;
use LearnKit\Entree\Models\LoginLog;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use RainLab\User\Models\User;
use System\Classes\PluginManager;
use Illuminate\Routing\Controller;
use LearnKit\Entree\Classes\Entree;

class Authenticate extends Controller
{
    public function login()
    {
        Entree::instance()
            ->login();
    }

    public function acs(Request $request)
    {
        $attributes = Entree::instance()
            ->processResponse()
            ->getAttributes();

        //
        $auth = new \LearnKit\Entree\Classes\EntreeAuth();

        return $auth->handleLogin($attributes);
    }
}