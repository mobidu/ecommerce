<?php

namespace App\Http\Controllers\front;

use App\Customer;
use App\Setting;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
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

    public function showRegistrationForm()
    {
        $pengaturan = Setting::first();
        return view('front.register', compact('pengaturan'));
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
            'nama_lengkap' => 'required|max:255',
            'username' => 'required|max:255|unique:customers',
            'no_hp' => 'required|max:255',
            'email' => 'required|max:255|unique:customers',
            'password' => 'required|min:6|confirmed',
            'g-recaptcha-response' => 'required|captcha'
        ], $this->messages());
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//    public function register(Request $request)
//    {
//        $this->validator($request->all())->validate();
//
//        event(new Registered($user = $this->create($request->all())));
//
//        $this->guard('customer')->login($user);
//
//        return $this->registered($request, $user)
//            ?: redirect($this->redirectPath());
//    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $referred_by = Cookie::get('referral');
        $data = [
            'nama_lengkap' => $data['nama_lengkap'],
            'email' => $data['email'],
            'no_hp' => $data['no_hp'],
            'pinbbm' => $data['bbm'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'affiliate_id'=>str_random(10),
            'referred_by'   => $referred_by
        ];
//        dd($data);
        Log::info('Insert Data : '.json_encode($data));
        return Customer::create($data);
    }

    public function messages()
    {
        return [
            'g-recaptcha-response.required' => 'Centang Recaptcha dibutuhkan',
            'g-recaptcha-response.captcha' => 'Perlu Validasi Recaptcha',
            'username.required'=>'Kolom Username Tidak Boleh Kosong',
            'password.required'=>'Kolom Password Tidak Boleh Kosong'

        ];
    }

    protected function guard()
    {
        return Auth::guard('customer');
    }
}
