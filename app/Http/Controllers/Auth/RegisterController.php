<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Address;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Carbon\Carbon;
use App\Mylibs\Mylibs;

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
    protected $redirectTo = '/login';

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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postcode' => 'required|numeric|regex:/[0-9]{5}/',
            'tel' => 'required|numeric|regex:/0[689][0-9]{8}/',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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
        $user = User::create([
            // 'name' => $data['name'],
            // 'email' => $data['email'],
            // 'password' => bcrypt($data['password']),
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'tel' => $data['tel'],
            'email' => $data['email'],
            'avatar' => "",
            'password' => bcrypt($data['password']),
            'login_at' => date('Y-m-d H:i:s')
        ]);

        $address = Address::create([
                'user_id' => $user->id,
                'fullname' => $data['firstname']." ".$data['lastname'],
                'detail' => $data['address'],
                'postcode' => $data['postcode'],
                'tel' => $data['tel']
                ]);


        return $user;
    }
}
