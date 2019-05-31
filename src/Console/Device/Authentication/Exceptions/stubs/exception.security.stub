<?php

namespace App\Exceptions;

use App\Http\Responses\StandardResponse;
use Exception;

class SecurityException extends Exception {

    protected $success = false;
    protected $error_code = 1;
    protected $msg = "Incorrect Username or Password. Please try again.";
    protected $info = "Username, or password incorrect";
    protected $data = "";


    function __construct($info = null, $msg = null, $code = null, $data = null) {
        if ($info) {
            $this->info = $info;
        }

        if ($msg) {
            $this->msg = $msg;
        }

        if ($code) {
            $this->error_code = $code;
        }

        if ($data) {
            $this->data = $data;
        }

        parent::__construct($this);
    }


    public function report() {

    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return StandardResponse
     */
    public function render($request) {
        return new StandardResponse($this->data, $this->msg, $this->info, false, $this->error_code);
    }

}