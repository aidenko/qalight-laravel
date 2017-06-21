<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteLoginController extends Controller{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToGithubAuth() {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleGithubCallback() {
        $githubUser = Socialite::driver('github')->user();

        $email = $githubUser->getEmail();

        $user = User::where('email', $email)->first();

        if(!$user){
            //create a new user and save it
            $user = new User();
            $user->name = (function() use ($githubUser) {
                $name = $githubUser->getName();

                if(!$name)
                    $name = $githubUser->getNickname();

                return $name;
            })();
            $user->email = $email;
            $user->password = str_random(16);

            $user->save();

            //create new socialite record and assign to a user
            $socialite = new \App\Socialite();

            $socialite->provider = 'github';

            $user->socialite()->save($socialite);
        }

        Auth::login($user);

        if(Auth::check())
            return redirect()->route('home');
        else
            return redirect()->route('login');

    }
}
