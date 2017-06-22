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
        return $this->redirectToProvider('github');
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleGithubCallback() {
        return $this->handleCallback('github');
    }

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToFacebookAuth() {
        return $this->redirectToProvider('facebook');
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleFacebookCallback() {
        return $this->handleCallback('facebook');

    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return Response
     */
    public function redirectToGoogleAuth() {
        return $this->redirectToProvider('google');
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleGoogleCallback() {
        return $this->handleCallback('google');
    }

    private function redirectToProvider($provider) {
        return Socialite::driver($provider)->redirect();
    }

    private function getProviderUser($provider) {
        return Socialite::driver($provider)->user();
    }

    private function handleCallback($provider) {
        $providerUser = $this->getProviderUser($provider);

        $email = $providerUser->getEmail();

        $user = User::where('email', $email)->first();

        if(!$user){
            //create a new user and save it
            $user = $this->createUser(
                (function() use ($providerUser) {

                    try {
                        $name = $providerUser->getName();

                        if(!$name)
                            $name = $providerUser->getNickname();
                    } catch(\Exception $e) {
                        $name = '';
                    }

                    return $name;
                })(),
                $email
            );

            //create new socialite record and assign to a user
            $this->appendSocialiteToUser($user, $provider);
        }

        Auth::login($user);

        if(Auth::check())
            return redirect()->route('home');
        else
            return redirect()->route('login');
    }

    private function createUser($name, $email) {
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = str_random(16);

        $user->save();

        return $user;
    }

    private function appendSocialiteToUser(User $user, $provider) {

        $socialite = new \App\Socialite();

        $socialite->provider = $provider;

        $user->socialite()->save($socialite);
    }
}
