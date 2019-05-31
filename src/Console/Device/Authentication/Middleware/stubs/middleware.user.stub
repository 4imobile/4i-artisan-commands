<?php

namespace App\Http\Middleware;

use App\Exceptions\AuthorizationException;
use App\Exceptions\SecurityException;
//use App\Exceptions\UserSuspendedException;
use Carbon\Carbon;
use Closure;
use Hash;
use Illuminate\Contracts\Auth\Guard;
use App\Device;
use App\User;
use Auth;

class UserAuthenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws AuthorizationException
     * @throws SecurityException
     */
    public function handle($request, Closure $next)
    {

        $authHeader = $request->header('Authorization');

        if ($authHeader == null){
            throw new SecurityException('Authorization header is missing, or incorrect');
        }

        $authHeader = explode(' ',$authHeader);

        if ($authHeader[0] != 'Basic'){
            throw new SecurityException('Authorization header is not of type basic');
        }

        $credentials = explode( ':',base64_decode($authHeader[1]));

        if (count($credentials) != 2){
            throw new SecurityException('Authorization header is incorrectly formatted');
        }

        $email = $credentials[0];
        $password = $credentials[1];

        $user = User::where('email', $email)->first();
        if (!$user) {
            throw new AuthorizationException('Email or password incorrect.', 'Authorization error');
        }

        if (!Hash::check($password, $user->password)) {
            throw new AuthorizationException('Email or password incorrect.', 'Authorization error');
        }

        $this->auth->loginUsingId($user->id);


        return $next($request);
    }
}
