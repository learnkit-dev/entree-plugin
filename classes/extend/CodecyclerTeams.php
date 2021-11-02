<?php namespace LearnKit\Entree\Classes\Extend;

use Event;

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

            $formController->addTabFields([
                'entree_organisation' => [
                    'label' => 'nlEduPersonHomeOrganizationId',
                    'type' => 'text',
                    'span' => 'left',
                    'tab' => 'Kennisnet Entree',
                    'comment' => 'Organization (e.g. REF1)',
                ],
            ]);
        });
    }
}