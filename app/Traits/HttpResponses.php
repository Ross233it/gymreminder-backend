<?php

namespace App\Traits;

trait HttpResponses{
    protected function success($data, $message = null, $code =200){
        return response()->json([
            "status"=>"Richiesta completata con successo",
            "message"=>$message,
            "data"=>$data
        ], $code);
    }

    protected function error($data, $message = null, $code){
        return response()->json([
            "status"=>"Si è verificato un errore.",
            "message"=>$message,
            "data"=>$data
        ], $code);
    }
}
