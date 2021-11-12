<?php namespace LearnKit\Entree\Classes;

use Auth;
use LearnKit\Entree\Models\Settings;
use Ramsey\Uuid\Uuid;
use RainLab\User\Models\User;
use LearnKit\Entree\Models\LoginLog;
use System\Classes\PluginManager;

class EntreeAuth
{
    protected $rules = [
        'givenName' => ['array', 'min:1'],
        'givenName.*' => 'string',
        'sn' => ['array', 'min:1'],
        'sn.*' => 'string',
        'mail' => ['array', 'min:1'],
        'mail.*' => 'string',
        'nlEduPersonHomeOrganizationId' => ['array', 'min:1'],
        'nlEduPersonHomeOrganizationId.*' => 'string',
    ];

    protected $messages = [
        'givenName.array' => 'Wij hebben geen voornaam doorgekregen',
        'givenName.min' => 'Wij hebben geen voornaam doorgekregen',
        'givenName.*.string' => 'Wij hebben geen voornaam doorgekregen',
        'sn.array' => 'Wij hebben geen achternaam doorgekregen',
        'sn.min' => 'Wij hebben geen achternaam doorgekregen',
        'sn.*.string' => 'Wij hebben geen achternaam doorgekregen',
        'mail.array' => 'Wij hebben geen e-mailadres doorgekregen',
        'mail.min' => 'Wij hebben geen e-mailadres doorgekregen',
        'mail.*.string' => 'Wij hebben geen e-mailadres doorgekregen',
        'nlEduPersonHomeOrganisationId.array' => 'Wij hebben geen organisatie doorgekregen',
        'nlEduPersonHomeOrganisationId.min' => 'Wij hebben geen organisatie doorgekregen',
        'nlEduPersonHomeOrganisationId.*.min' => 'Wij hebben geen organisatie doorgekregen',
    ];

    protected $user = null;

    protected $attributes = [];

    public function handleLogin($attributes, $redirect = '/')
    {
        $this->attributes = $attributes;

        $validator = \Validator::make($attributes, $this->rules, $this->messages);

        if ($validator->fails()) {
            // Run exception
            return $this->handleValidationError($validator);
        }

        // Log the login attempt for debugging purposes
        $this->log();

        // Find user by email
        $this->findUser();

        // Create user if not yet exists
        if (!$this->user) {
            $this->createUser();
        }

        // Login the user by their email
        $this->login();

        // Redirect to specified url
        return redirect($redirect);
    }

    protected function log()
    {
        $log = new LoginLog([
            'login_attributes' => $this->attributes,
        ]);

        $log->save();
    }

    protected function findUser()
    {
        $this->user = User::findByEmail($this->getEmail());
    }

    protected function login()
    {
        Auth::loginUsingId($this->user->id);
    }

    protected function createUser()
    {
        $password = Uuid::uuid4();

        $data = [
            'name' => $this->getName(),
            'surname' => $this->getSurname(),
            'email' => $this->getEmail(),
            'username' => $this->getEmail(),
            'password' => $password,
            'password_confirmation' => $password,
        ];

        $this->user = Auth::register($data, true);

        // Attach to team if plugin is installed
        if (PluginManager::instance()->exists('Codecycler.Teams')) {
            $team = \Codecycler\Teams\Models\Team::where('entree_organisation', $this->getBrin())
                ->first();

            if ($team && !$team->users->contains($this->user)) {
                $team->users()->add($this->user);
            }
        }
    }

    protected function getEmail()
    {
        return $this->attributes['mail'][0];
    }

    protected function getName()
    {
        return $this->attributes['givenName'][0];
    }

    protected function getLastname()
    {
        return $this->attributes['sn'][0];
    }

    protected function getBrin()
    {
        return $this->attributes['nlEduPersonHomeOrganizationId'][0];
    }

    protected function handleValidationError($validator)
    {
        return redirect(Settings::get('error_page'))
            ->withErrors($validator);
    }
}