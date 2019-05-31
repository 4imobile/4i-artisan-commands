<?php

namespace App\Http\Middleware;

use App\Exceptions\SecurityException;
use App\Exceptions\NoDeviceException;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Device;
use Bus;
use Auth;
use Cache;

class DeviceAuthenticate
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
     * @throws NoDeviceException
     */
    public function handle($request, Closure $next)
    {

        $authHeader = $request->header('Authorization');

        if ($authHeader == null){
            throw new NoDeviceException('Authorization header is missing, or incorrect');
        }

        $authHeader = explode(' ',$authHeader);

        if ($authHeader[0] != 'Basic'){
            throw new NoDeviceException('Authorization header is not of type basic');
        }

        $credentials = explode(':',base64_decode($authHeader[1]));


        if (count($credentials) != 2){
            throw new NoDeviceException('Authorization header is incorrectly formatted');
        }


        $deviceId = $credentials[0];
        $deviceToken = $credentials[1];

        $device = Device::with('user')->where('device_id', $deviceId)->first();

        if($device == null) {
            throw new NoDeviceException();
        }

        if ($device->access_token != $deviceToken){
            throw new NoDeviceException('Device id or token incorrect');
        }

        $this->auth->loginUsingId($device->user_id);

        return $next($request);

    }
}
