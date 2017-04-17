<?php

namespace Blog\Http\Controllers\Auth;

use Blog\User;
use Blog\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Socialite;
use Blog\Social;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
        //dd($user->avatar_original);
        if(Social::where('email', $user->email)->exists()){
            //dd($user);
            // return redirect()->action('LoginController', [
            //     'email' => $user->email,
            //     'password' => 'null', 
            // ]);
            Auth::loginUsingId((User::where('email', $user->email)->pluck('id')[0]));
            return redirect('/home');
        }
        else {
            User::create([
                'name' => $user->name,  
                'email' => $user->email,
                'password' => bcrypt('null'),
            ]);
            Social::create([
                'name' => $user->name,
                'email' => $user->email,
                'token' => $user->token,
                'user_id' => User::where('email', $user->email)->pluck('id')[0],
                'image_path' => $user->avatar_original,

            ]);
        }

        // return redirect()->action('LoginController', [
        //         'email' => $user->email,
        //         'password' => 'null', 
        //     ]);

        // $user->token;
        Auth::loginUsingId((User::where('email', $user->email)->pluck('id')[0]));
        return redirect('/home');
    }

}
