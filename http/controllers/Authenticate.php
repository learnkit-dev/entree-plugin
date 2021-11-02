<?php namespace LearnKit\Entree\Http\Controllers;

use Auth;
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
        $user = User::findByEmail($attributes['mail'][0]);

        //
        if (!$user) {
            $password = Uuid::uuid4();

            $data = [
                'name' => $attributes['givenName'][0],
                'surname' => $attributes['sn'][0],
                'email' => $attributes['mail'][0],
                'username' => $attributes['mail'][0],
                'password' => $password,
                'password_confirmation' => $password,
            ];

            $user = Auth::register($data, true);

            // Attach to team if plugin is installed
            if (PluginManager::instance()->exists('Codecycler.Teams')) {
                $team = \Codecycler\Teams\Models\Team::where('entree_organisation', $attributes['nlEduPersonHomeOrganizationId'][0])
                    ->first();

                if ($team && !$team->users->contains($user)) {
                    $team->users()->add($user);
                }
            }

            Auth::loginUsingId($user->id);

            $request->session()->save();

            return redirect('/');
        }
    }
}