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

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Entree Settings',
                'description' => 'Manage Kennisnet Entree based settings.',
                'category'    => 'system::lang.system.categories.system',
                'icon'        => 'icon-cog',
                'class'       => 'LearnKit\Entree\Models\Settings',
                'order'       => 500,
                'keywords'    => 'entree kennisnet',
                'permissions' => ['learnkit.entree.access_settings']
            ]
        ];
    }

    public function registerPermissions()
    {
        return [
            'learnkit.entree.access_settings' => [
                'label' => 'Access the Entree settings',
                'tab' => 'Kennisnet Entree',
                'order' => 200,
            ],
        ];
    }
}
