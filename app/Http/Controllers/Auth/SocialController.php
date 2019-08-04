<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use App\SocialProvider;

class SocialController extends Controller
{
    /**
     * Redirect the user to the FaceBook & Twitter authentication page.
     *
     * @param $provider
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from FaceBook.
     *
     * @param $providerName
     * @return Response
     */
    public function handleProviderCallback($providerName)
    {
        try {
            $socialUser = Socialite::driver($providerName)->user();
        } catch (\Exception $e) {
            return redirect("/");
        }

        //privider_idですでに登録済みかチェック
        $provider = SocialProvider::where('provider_id', $socialUser->getId())->first();

        if (!$provider) {
            $user = \DB::transaction(function () use ($socialUser, $providerName) {
                if (empty($socialUser->getEmail())) {
                    $email = $socialUser->getName() . '@fakeEmail.com';
                } else {
                    $email = $socialUser->getEmail();
                }

                if (User::where('email', $email)->exists()) {
                    $user = User::where('email', $email)->first();
                    $user->update(['api_token' => str_random(60)]);
                } else {
                    $user = User::firstOrCreate(
                        [
                            'name' => $socialUser->getName(),
                            'email' => $email,
                            'password' => uniqid(),
                            'api_token' => str_random(60)
                        ]
                    );
                }
                SocialProvider::firstOrCreate(
                    [
                        'user_id' => $user->id,
                        'provider_id' => $socialUser->getId(),
                        'provider' => $providerName
                    ]
                );
                return $user;
            });
        } else {
            $user = User::where(['id' => $provider->user_id])->first();
            $user->update(['api_token' => str_random(60)]);
        }

        auth()->login($user);

        if (strpos(URL::previous(), SocialProvider::PROVIDER_TWITTER) !== false) {
            return redirect('/');
        } else {
            return redirect(URL::previous());
        }
    }
}
