<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\Input;

use Auth;
use Session;
use Redirect;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected $username = 'username';
        
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
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
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',            
            'email' => 'required|email|max:255|unique:account',
            'password' => 'required|min:6|confirmed',            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create($data)
    {   
        /*    
        return User::create([
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'middle_name' => $data['middleName'],
            'username' => $data['email'],
            'email' => $data['email'],
            'age' => $data['age'],
            'gender' => $data['gender'],
            'barangay' => $data['barangay'],
            'city' => $data['city'],
            'contact_number' => $data['contact'],
            'accounttype' => 'Agent',
            'password' => bcrypt($data['password']),
            'isActive' => 0,
        ]);
        */       
       
    }    
    
    public function Register(Request $request)
    {
        $input = Input::all();    
        
        $validator = Validator::make($input, [
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',            
            'email' => 'required|email|max:255|unique:account',
            'password' => 'required|min:6|confirmed',            
        ]);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        
        User::create([
            'first_name' => $input['firstName'],
            'last_name' => $input['lastName'],
            'username' => $input['email'],
            'email' => $input['email'],            
            'account_type' => 'Admin',
            'password' => bcrypt($input['password']),
        ]);
                
        return redirect('postregister');
    }
    
    //get registration page
    public function getRegister()
    {        
        return view('auth.register');
    }
    
    //override post registration 
    public function postRegister()
    {                
        return redirect('auth/login');
    }    
    
    /** logout **/
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
    
    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
         $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        //built-in
        //if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
        //    return $this->handleUserWasAuthenticated($request, $throttles);
        //}
        
        $credentials['active'] = 1;
        $credentials['deleted'] = 0;
        
        //manual
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            if ($throttles) {
                $this->clearLoginAttempts($request);
            }
            
            if(Auth::user()->account_type == "Admin")
            {
                return redirect()->route('home.index');
            }
            else
                return redirect()->intended($this->redirectTo);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
        
    }
}
