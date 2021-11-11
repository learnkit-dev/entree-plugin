<?php namespace LearnKit\Entree\Controllers;

use System\Classes\SettingsManager;
use Backend\Classes\Controller;
use BackendMenu;

class LoginLogs extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('LearnKit.Entree', 'entree-logs');
    }
}
