<?php namespace LearnKit\Entree;

use Event;
use System\Classes\PluginBase;
use LearnKit\Entree\Console\InstallEntree;
use LearnKit\Entree\Classes\Extend\CodecyclerTeams;

class Plugin extends PluginBase
{
    public function register()
    {
        // Change the config
        define('ONELOGIN_CUSTOMPATH', plugins_path('learnkit/entree/'));

        // Register console command
        $this->registerConsoleCommand('entree.install', InstallEntree::class);
    }

    public function boot()
    {
        Event::subscribe(CodecyclerTeams::class);
    }
}
