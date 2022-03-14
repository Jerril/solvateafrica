<?php

namespace App\Exceptions;

use Exception;

class CustomErrorException extends Exception
{
    public function render(Exception $exception)
    {
        if($exception instanceof ModelNotFoundException)
        {
            return response()->json([ 'success' => false, 'error' => array('message' => 'Entry for '.str_replace('App\\', '', $exception->getModel()).' not found' )  ],404);
        }
        else if($exception instanceof RequestException)
        {

        }
        else 
        {
            return response()->json([ 'success' => false, 'error' => array('message' => 'Great' )  ]);
        }
    }
}
