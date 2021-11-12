<?php namespace LearnKit\Entree\Models;

use Cms\Classes\Page;
use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'learnkit_entree_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    public function getErrorPageOptions()
    {
        return Page::getNameList();
    }
}