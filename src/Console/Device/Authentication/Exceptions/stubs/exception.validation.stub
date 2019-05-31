<?php

namespace App\Exceptions;

use App\Http\Responses\StandardResponse;
use Exception;
use Throwable;

class ValidationException extends Exception {

    private $validationErrors;
    private $firstError;
    public function __construct(array $validationErrors, $message = "", $code = 0, Throwable $previous = null)
    {
        $this->validationErrors = $validationErrors;
        $error = reset($validationErrors);
        if (count($error) > 0) {
            $this->firstError = $error[0];
        }
        parent::__construct($this);
    }

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report() {

    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return StandardResponse
     */
    public function render($request) {
        if (!$this->firstError) {
            $this->firstError = "Invalid Request; user not authorized";
        }
        return new StandardResponse($this->validationErrors, $this->firstError, 'An error has occurred on the server.', false, 400);
    }
}