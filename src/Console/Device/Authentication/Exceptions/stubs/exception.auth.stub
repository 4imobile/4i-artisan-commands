<?php

namespace App\Exceptions;

use \App\Http\Responses\StandardResponse;
use Exception;

class AuthorizationException extends Exception {

    /**
    *   @var string
    */
    protected $message;

    /**
    *   @var string
    */
    protected $info;

    /**
    *   Create a new instance
    *
    *   @param string $message
    *   @param string $info
    *
    *   @return void
    */
    public function __construct($message = null, $info = null)
    {
        $this->message = (string) ($message ?: 'That request could not be fulfilled by the server.');
        $this->info = (string) ($info ?: 'You are not allowed to do this action.');
    }

    /**
    *   Render an exception into an HTTP response.
    *
    *   @param \Illuminate\Http\Request $request
    *
    *   @return StandardResponse
    */
    public function render($request)
    {
        return new StandardResponse(null, $this->message, $this->info, false, 401);
    }

}