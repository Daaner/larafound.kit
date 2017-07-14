<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Traits\CaptureIpTrait;

use Auth;
use Mail;
use App\Mail\Register;

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
    protected $redirectTo = '/';

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
            'name'      => 'required|string|max:255',
            'username'  => 'required|string|max:255|unique:users',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:6|confirmed',
        ],
        [
            'name.required'         => trans('auth.NameRequired'),
            'username.required'     => trans('auth.UserNameRequired'),
            'username.unique'       => trans('auth.UserNameUnique'),
            'email.unique'          => trans('auth.emailUnique'),
            'email.required'        => trans('auth.emailRequired'),
            'email.email'           => trans('auth.emailInvalid'),
            'password.required'     => trans('auth.passwordRequired'),
            'password.min'          => trans('auth.passwordMin'),
            'password.confirmed'    => trans('auth.passwordConfirmed'),
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
        $ipAddress = new CaptureIpTrait;

        $user = User::create([
            'name'      => $data['name'],
            'username'  => $data['username'],
            'email'     => $data['email'],
            'password'  => bcrypt($data['password']),
            'signup_ip' => $ipAddress->getClientIp(),
        ]);

        return $user;
    }

    public function register(Request $request)
    {
        $validation = $this->validator($request->all());
        if ($validation->fails()) {
            return response()->json($validation->errors()->toArray());
        } else {
            $user = $this->create($request->all());
            Auth::login($user);

            Mail::to($user)->send(new Register($user));

            if (Auth::user()) {
                $request->session()->regenerate();
                return view('block.login')->with('status', trans('email.info_register_complite'));
            }
        }
    }
}
