<?php namespace SportExperiment\Controller\Researcher;

use SportExperiment\Model\ResearcherRepositoryInterface;
use SportExperiment\Model\Eloquent\User;
use SportExperiment\Controller\BaseController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use SportExperiment\Model\Eloquent\UserRole;

class Login extends BaseController
{
    private static $URI = 'researcher/login';

    private $researcherRepository;

    public function __construct(ResearcherRepositoryInterface $researcherRepository)
    {
        $this->researcherRepository = $researcherRepository;
    }

    public function getLogin() 
    {
        Auth::logout();
        return View::make('site.researcher.login');
    }

    public function postLogin()
    {
        $user = new User(Input::all());

        // Validate raw user attributes
        if ($user->validationFails())
            return Redirect::to(self::getRoute())->withErrors($user->getValidator());

        // Confirm researcher account exists and is active
        if ( ! $user->isRole(new UserRole(UserRole::$RESEARCHER)))
            return Redirect::to(self::getRoute())->with('error', 'Account not found');

        // Attempt login using Auth
        if ( ! Auth::attempt($user->getAuthInfo()))
            return Redirect::to(self::getRoute())->with('error', 'Unable to authorize');

        return Redirect::to(Dashboard::getRoute());
    }

    public static function getRoute()
    {
        return self::$URI;
    }
}
