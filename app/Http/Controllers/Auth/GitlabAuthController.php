<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use App\User;
use Hash;

class GitlabAuthController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('gitlabweb')->stateless()->redirect();
    }

    /**
     * Obtain the user information from gitlab.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('gitlabweb')->stateless()->user();
        // dd($user);
        $apiUser = User::firstOrCreate(
            ['email' => $user->email],
            ['name' => $user->name, 'password' => Hash::make($user->nickname)]
        );
        $token = auth('api')->login($apiUser);
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
