<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class StandardResponse implements Responsable {

    private $success;
    private $errorCode;
    private $msg;
    private $info;
    private $data;

    public function __construct($data = null, $msg = '', $info = '', $success = true, $errorCode = 0) {
        $this->success = $success;
        $this->errorCode = $errorCode;
        $this->msg = $msg;
        $this->info = $info;
        $this->data = $data;
    }

    public function toResponse($request)
    {
        return response()->json([
            'success' => $this->success,
            'errorCode' => $this->errorCode,
            'msg' => $this->msg,
            'info' => $this->info,
            'data' => $this->data
        ]);
    }
}
