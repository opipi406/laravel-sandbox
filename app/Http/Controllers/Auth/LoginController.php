<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function redirectToProvider(Request $request)
    {

        $provider = $request->provider;
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(Request $request)
    {

        $provider = $request->provider;
        $provider_user = Socialite::driver($provider)->user();

        $user = User::where('line_id', $provider_user->getId())->first();

        $provider_user_email = $provider_user->getEmail();
        $provider_user_name = $provider_user->getName();
        $social_id = $provider_user->getId();

        if (!is_null($provider_user_email)) {

            if (!$user) {
                $user = User::create([
                    'name' => $provider_user_name,
                    'email' => $provider_user_email,
                    'password' => Hash::make("qweqweqwe"),
                    'line_id' => $social_id,
                ]);
            }

            auth()->login($user);
            return redirect('/dashboard');
        }

        return '必要な情報が取得できていません。';
    }
}
