<?php

namespace App\Exceptions;

use App\Http\Responses\StandardResponse;
use Exception;

class NoDeviceException extends Exception
{

    protected $errorCode = 10;
    protected $msg = "You are not logged in.";
    protected $info = "Device does not exist.";
    protected $success = false;
    protected $error_code = 10;
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
