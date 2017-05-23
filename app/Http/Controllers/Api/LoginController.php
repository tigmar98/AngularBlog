<?php

namespace Blog\Http\Controllers\Auth;

use Blog\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Blog\Contracts\SocialServiceInterface;
use Blog\Contracts\UserServiceInterface;
use Socialite;
use Blog\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    
    public function login(Request $request, UserServiceInterface $userService){
        $id = $userService->getUserId($request->input('email'));
        if($id){
            Auth::loginUsingId($id);
        }
        return response()->json(Auth::user())
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback(SocialServiceInterface $socialService, UserServiceInterface $userService)
    {
        $user = Socialite::driver('facebook')->user();
        //dd($user->avatar_original);
        if($socialService->emailExists($user->email)){
            Auth::loginUsingId($userService->getUserId($user->email));
            return redirect('/app');
        }
        else {
            User::create([
                'name' => $user->name,  
                'email' => $user->email,
                'password' => bcrypt('null'),
            ]);
            $socialService->createSocial($user->name, $user->email, $user->token, $userService->getUserId($user->email), $user->avatar_original);
        }

        // return redirect()->action('LoginController', [
        //         'email' => $user->email,
        //         'password' => 'null', 
        //     ]);

        // $user->token;
        Auth::loginUsingId($userService->getUserId($user->email));
        return redirect('/app');
    }

}
