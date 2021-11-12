<?php namespace LearnKit\Entree\Classes\Extend;

use Event;
use LearnKit\EntreeArpService\EntreeArpService;

class CodecyclerTeams
{
    public function subscribe()
    {
        Event::listen('backend.form.extendFields', function ($formController) {
            if (!$formController->getController() instanceof \Codecycler\Teams\Controllers\Teams) {
                return;
            }

            if (!$formController->model instanceof \Codecycler\Teams\Models\Team) {
                return;
            }

            //
            $service = new EntreeArpService();
            $options = $service
                ->schoolList()
                ->pluck('friendlyNameWithBrin', 'brin');

            //
            $formController->addTabFields([
                'entree_organisation' => [
                    'label' => 'Organisation',
                    'type' => 'dropdown',
                    'options' => $options,
                    'span' => 'left',
                    'tab' => 'Kennisnet Entree',
                    'placeholder' => 'Not attached',
                ],
            ]);
        });
    }
}